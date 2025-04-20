<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuari;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



class ForgotPasswordController extends Controller
{
    public function showForm() {
        return view('auth.forgot');
    }

    public function enviarCorreu(Request $request)
    {
        $request->validate([
            'correu' => 'required|email'
        ]);

        $usuari = Usuari::where('correo', $request->correu)->first();

        if (!$usuari) {
            return back()->withErrors(["el correu '$request->correu' no està registrat a la base de dades ❌"]);
        }

        $token = bin2hex(random_bytes(16));
        $expiracio = now()->addHour();

        // guardar token
        $usuari->token = $token;
        $usuari->expiracio_token = $expiracio;
        $usuari->save();

        //enviar correu
        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'm.hornos@sapalomera.cat';
            $mail->Password = env('MAIL_PASSWORD');
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('m.hornos@sapalomera.cat', 'Recuperació de password');
            $mail->addAddress($request->correu);

            $reset_link = route('password.restart', ['token' => $token]);

            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = "Recuperar password";

            $mail->Body = "
                <h2>Recuperació de contrasenya</h2>
                <p>Fes clic al següent enllaç per reiniciar la teva contrasenya:</p>
                <a href='$reset_link'>$reset_link</a>
            ";

            $mail->send();

            return back()->with('status', "t'hem enviat un correu per recuperar la teva password ✅");
        } catch (Exception $e) {
            return back()->withErrors(["no hem pogut enviar el correu. Error: {$mail->ErrorInfo} ❌"]);
        }
    }
}
