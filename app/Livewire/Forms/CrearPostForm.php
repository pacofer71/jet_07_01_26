<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CrearPostForm extends Form
{
    #[Validate(['required', 'string', 'min:3', 'max:100'])]
    public string $titulo="";
    #[Validate(['required', 'string', 'min:10', 'max:500'])]
    public string $contenido="";
    #[Validate(['required', 'in:Publicado,Borrador'])]
    public string $estado="";
    #[Validate(['required', 'exists:categories,id'])]
    public int $category_id=-1;
    #[Validate(['nullable', 'image', 'max:2048'])]
    public $imagen;

    public function crearForm(){
        $datos=$this->validate();
        $datos['imagen']=$this->imagen?->store('imagenes/posts') ?? 'imagenes/posts/default.png';
        $datos['user_id']=Auth::user()->id;
        Post::create($datos);
    }
    public function cancelarForm(){
        $this->reset();
        $this->resetValidation();
    }
}
