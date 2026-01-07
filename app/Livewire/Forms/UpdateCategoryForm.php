<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Category;

class UpdateCategoryForm extends Form
{
    public ?Category $category=null;

    public string $nombre="";
    
    #[Validate(['required', 'color'])]
    public string $color="#000000";

    public function rules(): array{
        return [
            'nombre'=>['required', 'string', 'min:3', 'max:20', 'unique:categories,nombre,'.$this->category->id]
        ];
    }
    public function setCategory(Category $category){
        $this->category=$category;
        $this->nombre=$category->nombre;
        $this->color=$category->color;
    }

    public function updateForm(){
        //1.- Validamos todo
        $this->validate();
        //2.- Guardamos
        $this->category->update($this->all());
    }
    public function resetForm(){
        $this->resetValidation();
        $this->reset();
    }
}
