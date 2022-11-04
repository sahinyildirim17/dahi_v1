<?php

namespace App\Http\Livewire\Backend\Posts;

use App\Models\Backend\Post;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Carbon\Carbon;
use Livewire\WithPagination;
use function Symfony\Component\Translation\t;

class Index extends Component
{

    use WithPagination;
    public $posts;
    public $filter_title;
    public $filter_is_active = '';
    public $filter_post_type = '';
    public $last_post_diff;

    public $id_to_be_deleted;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'refresh' => '$refresh',
        'deleteConfirmed' => 'deletePost'
    ];

    public function mount(){
      $this->posts = Post::orderBy('created_at','DESC')->get();
      $this->last_post_diff = Carbon::createFromDate($this->posts->last()->created_at)->diffForHumans(Carbon::now());
    }
    public function render()
    {
        return view('livewire.backend.posts.index');
    }

    public function filter(){
        if($this->filter_title==''){
            $this->posts = Post::orderBy('created_at','DESC')->get();
        } else{
            $this->posts = Post::orderBy('created_at','DESC')->get()->filter(function($post){
                return stristr($post->title, $this->filter_title);

            });
        }

        if($this->filter_is_active!=''){
            $this->posts = $this->posts->where('is_active','=',$this->filter_is_active);
        }
        if($this->filter_post_type!=''){
            $this->posts = $this->posts->where('post_type','=',$this->filter_post_type);
        }
        //dd($this->posts);
        $this->emit('refresh');
        //$this->posts=Post::where('title','LIKE',$this->filter_title);
    }

    public function deleteConfirmation($id){
        $this->id_to_be_deleted = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deletePost(){
        $post = Post::where('id', $this->id_to_be_deleted)->first();
        $post->delete();
        $this->dispatchBrowserEvent('postDeleted');
        $this->emit('refresh');
    }
}
