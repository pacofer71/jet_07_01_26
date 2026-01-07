<?php

namespace App\Livewire;

use App\Livewire\Forms\CreateCategoryForm;
use Livewire\Component;

class CrearCategoria extends Component
{
    public bool $mostrarCrear=false;
    public CreateCategoryForm $cform;
    public function render()
    {
        return view('livewire.crear-categoria');
    }
    /*
    public function mostrarModal(){
        $this->mostrarCrear=true;
    }
    */
    public function guardar(){
        //dd("Estoy en guardar");
        $this->cform->guardarForm();
        $this->cancelar();
        $this->dispatch('evtCategoriaCreada')->to(MostrarCategorias::class);
        $this->dispatch('mensaje','Categoria Creada');

    }
    public function cancelar(){
        $this->cform->resetForm();
        $this->mostrarCrear=false;
    }
}
