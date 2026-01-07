<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UpdatePostForm extends Form
{
    public ?Post $post=null; 
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

    public function setPost(Post $post){
        $this->post=$post;
        $this->titulo=$post->titulo;
        $this->contenido=$post->contenido;
        $this->estado=$post->estado;
        $this->category_id=$post->category_id;
    }
    public function updateForm(){
        $datos=$this->validate();
        $datos['imagen']=$this->imagen?->store('imagenes/posts') ?? $this->post->imagen;
        if($this->imagen && basename($this->post->imagen)!='default.png'){
            Storage::delete($this->post->imagen);
        }
        $this->post->update($datos);
    }
    public function cancelarForm(){
        $this->reset();
        $this->resetValidation();
    }
}
