<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Bilions\FakerImages\FakerImageProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        fake()->addProvider(new FakerImageProvider(fake()));
        $usuarios=User::all();
        $categorias=Category::all();
        $imagen= fake()->image(sys_get_temp_dir(), 640, 480);
        return [
            'titulo'=>fake()->realText(60),
            'contenido'=>fake()->realText(),
            'estado'=>fake()->randomElement(['Publicado', 'Borrador']),
            'user_id'=>$usuarios->random()->id,
            'category_id'=>$categorias->random()->id,
            'imagen'=>Storage::disk('public')->putFileAs('imagenes/posts', new File($imagen), basename($imagen)),
        ];
    }
}
