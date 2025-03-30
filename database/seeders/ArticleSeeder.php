<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    DB::table('article')->insert([
        [
            'marca' => 'Toyota',
            'model' => 'Corolla',
            'any' => 1985,
            'color' => 'Blanc',
            'matricula' => '1234ABC',
            'nom_usuari' => 'Miguel',
            'imatge' => 'https://noticias.coches.com/wp-content/uploads/2014/10/toyota_corolla-gt-s-sport-liftback-ae86-1985-86_r10.jpg'
        ],
        [
            'marca' => 'Ford',
            'model' => 'Fiesta',
            'any' => 1988,
            'color' => 'Blau',
            'matricula' => '5678DEF',
            'nom_usuari' => 'Miguel',
            'imatge' => 'https://tennants.blob.core.windows.net/stock/142185-0.jpg?v=63615747600000'
        ],
        [
            'marca' => 'Honda',
            'model' => 'Civic',
            'any' => 1995,
            'color' => 'Verd',
            'matricula' => '9101GHI',
            'nom_usuari' => 'Frank',
            'imatge' => 'https://live.staticflickr.com/2337/1870361700_31046bb363_c.jpg'
        ],
        [
            'marca' => 'Volkswagen',
            'model' => 'Polo',
            'any' => 2008,
            'color' => 'Blau',
            'matricula' => '3568JMG',
            'nom_usuari' => 'Hector',
            'imatge' => 'https://www.km77.com/media/fotos/volkswagen_polo_2005_1854_1.jpg'
        ],
        [
            'marca' => 'BMW',
            'model' => 'e90 320d',
            'any' => 2006,
            'color' => 'Negre',
            'matricula' => '6733DGS',
            'nom_usuari' => 'Miguel',
            'imatge' => 'https://www.largus.fr/images/styles/max_1300x1300/public/images/top-ventes-occasion-2016-07.jpg?itok=qlbyDvaA'
        ],
        [
            'marca' => 'Volkswagen',
            'model' => 'Kombi',
            'any' => 1966,
            'color' => 'Blau',
            'matricula' => '6434DSA',
            'nom_usuari' => 'Frank',
            'imatge' => 'https://a.ccdn.es/cnet/2023/06/15/55373819/682216819_g.jpg'
        ],
        [
            'marca' => 'Dodge',
            'model' => 'Challenger',
            'any' => 2015,
            'color' => 'Negre',
            'matricula' => '0954OIS',
            'nom_usuari' => 'Frank',
            'imatge' => 'https://www.buscocoches.com/data/vehicles/76563579714E32BD907FCE57C12CA61B@1706013716425@690x460-adjust_middle.jpg'
        ],
        [
            'marca' => 'Mazda',
            'model' => 'Mx5',
            'any' => 1997,
            'color' => 'Vermell',
            'matricula' => '4321KKL',
            'nom_usuari' => 'Hector',
            'imatge' => 'https://images.classic.com/vehicles/d6e13b05eef5cda655d726d7b4631f31.jpeg?ar=16%3A9&fit=crop&w=600'
        ],
        [
            'marca' => 'Porsche',
            'model' => 'GT3 RS',
            'any' => 2019,
            'color' => 'Gris',
            'matricula' => '9999FSA',
            'nom_usuari' => 'Miguel',
            'imatge' => 'https://images0.autocasion.com/unsafe/origxorig/ad/19/1281/4bf586922f5544159059695d4c1fdfb1460b6101.jpeg'
        ],
        [
            'marca' => 'Lexus',
            'model' => 'LFA V10',
            'any' => 2011,
            'color' => 'Blanc',
            'matricula' => '1282AOI',
            'nom_usuari' => 'Frank',
            'imatge' => 'https://periodismodelmotor.com/venta-lexus-lfa-2011-6-000-km/337385/venta-lexus-lfa-2011/'
        ],
    ]);
}

}
