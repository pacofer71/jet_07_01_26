<?php

namespace App\Livewire;

use App\Livewire\Forms\CrearPostForm;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;

class CrearPost extends Component
{
    use WithFileUploads;
    public bool $openCrear=false;

    public CrearPostForm $cform;

    public function render()
    {
        $categorias=Category::select('nombre', 'id')->orderBy('nombre')->get();
        return view('livewire.crear-post', compact('categorias'));
    }

    public function guardar(){
        $this->cform->crearForm();
        $this->dispatch('mensaje', 'Post Creado');
        $this->dispatch('evtPostCreado')->to(ShowUserPosts::class);
        $this->cancelar();
    }
    public function cancelar(){
        $this->cform->cancelarForm();
        $this->openCrear=false;
    }
}
