<?php

namespace App\Livewire;

use App\Livewire\Forms\UpdatePostForm;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ShowUserPosts extends Component
{
    use WithPagination; //Trait para poder hacer la paginacion
    use WithFileUploads;

    public string $campo="id";
    public string $orden="desc";
    public bool $openUpdate=false;
    public UpdatePostForm $uform;

    public string $buscar="";
    #[On('evtPostCreado')]
    public function render()
    {
        $posts=Post::select('posts.*')
        ->join('categories', 'posts.category_id', 'categories.id')
        ->with('category')
        ->where('posts.user_id', Auth::id())
        ->where(function($q){
            $q->where('posts.titulo', 'like', "%{$this->buscar}%")
            ->orWhere('posts.contenido', 'like', "%{$this->buscar}%")
            ->orWhere('posts.estado', 'like', "%{$this->buscar}%")
            ->orWhere('categories.nombre', 'like', "%{$this->buscar}%");
        })
        ->orderBy(
            $this->campo==='category' ? 'categories.nombre' : $this->campo,
            $this->orden
        )
        ->paginate(5);
            $categorias=Category::select('id', 'nombre')->orderBy('nombre')->get();

        return view('livewire.show-user-posts', compact('posts', 'categorias'));
    }
    //Si queremos buscar por todo el documento independientemente de la pagina
    public function updatingBuscar(){
        $this->resetPage();
    }
    public function ordenar(string $campo){
        $this->campo=$campo;
        $this->orden=($this->orden=='asc') ? 'desc' : 'asc';                
    }
    // Borrar
    public function pedirBorrar(Post $post){
        $this->authorize('delete', $post);
        $this->dispatch('evtBorrarPost', id: $post->id);
    }
    #[On('evtBorrarOk')]
    public function borrarPost(int $id){
        $post=Post::findOrFail($id);
        $this->authorize('delete', $post);
        $post->delete();
        $this->dispatch('mensaje', 'Post Borrado');
    }
    // Editar
    public function editarPost(Post $post){
        $this->authorize('update', $post);
        $this->uform->setPost($post);
        $this->openUpdate=true;
    }
    public function update(){
        $this->uform->updateForm();
        $this->cancelar();
    }
    public function cancelar(){
        $this->openUpdate=false;
        $this->uform->cancelarForm();
        
    }

}
