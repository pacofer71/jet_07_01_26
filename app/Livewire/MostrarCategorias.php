<?php

namespace App\Livewire;

use App\Livewire\Forms\UpdateCategoryForm;
use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\Component;

class MostrarCategorias extends Component
{
    public string $campo = 'id';

    public string $orden = 'asc';

    public string $cadena = '';

    public bool $mostrarUpdate=false;
    public UpdateCategoryForm $uform;

    #[On('evtCategoriaCreada')]
    public function render()
    {
        $categorias = Category::where('nombre', 'like', "%{$this->cadena}%")
            ->orderBy($this->campo, $this->orden)
            ->get();

        return view('livewire.mostrar-categorias', compact('categorias'));
    }

    public function ordenar(string $campo)
    {
        $this->orden = ($this->orden) == 'asc' ? 'desc' : 'asc';
        $this->campo = $campo;
    }
    public function mostrarConfirmacion(Category $category){
        //dd($category);
        $this->dispatch('evtBorrarCategoria', id: $category->id);
    }

    #[On('evtBorrarOk')]
    public function borrarCategoria(int $id){
        $category=Category::findOrFail($id);
        $category->delete();
        $this->dispatch('mensaje', 'Categoria Borrada');
    }
    //--------------- Metodos para update
    public function edit(Category $category){
        $this->uform->setCategory($category);
        $this->mostrarUpdate=true;
    }
    public function update(){
        $this->uform->updateForm();
        $this->dispatch('mensaje', 'Categoria Actualizada');
        $this->cancelar();

    }
    public function cancelar(){
        $this->mostrarUpdate=false;
        $this->uform->resetForm();
    }
}
