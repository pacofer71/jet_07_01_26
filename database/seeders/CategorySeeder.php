<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            'Tecnología' => '#4A90E2', // azul moderno
            'Vida Saludable' => '#7ED321', // verde fresco
            'Emprendimiento' => '#F5A623', // naranja cálido
            'Opinión' => '#9013FE', // violeta distintivo
            'Entretenimiento' => '#D0021B', // rojo vibrante
        ];
        foreach($categorias as $nombre=>$color){
            Category::create(compact('nombre', 'color'));
            /*
            Category::create([
                'nombre'=>$nombre,
                'color'=>$color
            ])
            */
        }
    }
}
