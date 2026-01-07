<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Category;
class CreateCategoryForm extends Form
{
    #[Validate(['required', 'string', 'min:3', 'max:20', 'unique:categories,nombre'])]
    public string $nombre="";
    
    #[Validate(['required', 'color'])]
    public string $color="#000000";

    public function guardarForm(){
        //1.- Validamos todo
        $this->validate();
        //2.- Guardamos
        Category::create($this->all());
    }
    public function resetForm(){
        $this->resetValidation();
        $this->reset('nombre', 'color');
    }
}
