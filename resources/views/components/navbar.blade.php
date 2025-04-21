<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mhornos</title>
    <link rel="stylesheet" href="{{ asset('estils.css') }}">
</head>
<body>
    <!--si l'usuari está logat -->
    @if(session()->has('usuari'))
    <div class="navbar">
        <!-- imatge de perfil -->
        <div class="imatge-perfil">
            <img src="{{ obtenirImatge(session('usuari')) }}" alt="">
        </div>

        <a href="{{ route('perfil.editar') }}"><button>Editar perfil</button></a>
        <a href="{{ route('logout') }}"><button>Deslogar-se</button></a>
        <a href="{{ route('password.form') }}"><button>Canviar password</button></a>

        <!-- mostrar només si l'usuari és "admin" -->
        @if(session('usuari') === 'admin')
            <a href="{{ route('usuaris.gestionar') }}"><button>Gestionar usuaris</button></a><br><br>
        @endif
    </div>

    <!-- 3 botons que ens envien al document corresponent per tractar les dades -->
    <h3>Que vols fer?</h3> 
    <a href="{{ route('vehicle.inserir', ['pagina' => request('pagina', 1)]) }}">
        <button>Inserir vehicle</button>
    </a><br>
    <a href="{{ route('vehicle.modificar', ['pagina' => request('pagina', 1)]) }}">
        <button>Modificar vehicle</button>
    </a><br>
    <a href="{{ route('vehicle.esborrar', ['pagina' => request('pagina', 1)]) }}">
        <button>Esborrar vehicle</button>
    </a><br><br>
    
    @else
    <div class="navbar">
        <!-- si l'usuari no està logat -->
        <a href="{{ route('login') }}"><button>Logar-se</button></a>
        <a href="{{ route('register') }}"><button>Registrar-se</button></a>
        </div>
    @endif

</body>
</html>