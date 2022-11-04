<?php

namespace App\Http\Livewire\Backend\Posts;

use App\Models\Backend\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Tags\Tag;
use function Symfony\Component\Translation\t;
use Illuminate\Support\Facades\Validator;

class CreatePostForm extends Component
{

    use WithFileUploads;
    use LivewireAlert;

    protected $listeners = [
        'refresh' => '$refresh'
    ];
    public $post_type;
    public $title;
    public $slug;
    public $content;
    public $is_active;
    public $is_featured;

    //todo bu değişken seçilen resim var ise true olarak set ediliyor.
    public $thumb_updated=false;
    public $photo_preview_link;
    public $file_storage_address;
    public $photo_storage_address;

    public $photo;

    public $filename;
    public $file;
    public $file_size;
    public $file_updated=false;
    public $attached_files=[];

    public $current_id;

    public $all_tags;

    public $new_tag;
    public $added_tags=[];

    public function mount(){
        $this->all_tags=Tag::all();
    }
    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
    public function render()
    {
        $this->current_id= DB::table('posts')->latest('created_at')->first()->id+1;
        return view('livewire.backend.posts.create-post-form');
    }

    public function updatedTitle(){
        if($this->post_type!=''){
            if($this->post_type==1){
                $type_tag='haberler';
            }else{
                $type_tag='duyurular';
            }
            $this->slug=URL::to('/').'/'.$type_tag.'/'.$this->current_id.'/'.Str::slug($this->title,'-');
        }

    }

    public function updatedPostType(){
        if($this->post_type!=''&&$this->title!=''){
            if($this->post_type==1){
                $type_tag='haberler';
            }else{
                $type_tag='duyurular';
            }
            $this->slug=URL::to('/').'/'.$type_tag.'/'.$this->current_id.'/'.Str::slug($this->title,'-');
        }
    }

    public function updatedPhoto(){
        $validator = Validator::make(
            ['photo' => $this->photo],
            ['photo' => 'required|image|max:1024']
        );

        if ($validator->fails()) {
            $this->photo = NULL;
            $this->photo_preview_link = '';
        }

        $validator->validate();

        $destination_path='public/temp-photos/posts';
        $filename='temppostphoto_'.md5(now()).'.'.($this->photo->getClientOriginalExtension());
        $this->photo->storeAs($destination_path,$filename);

        //silme için deneme
        $this->photo_storage_address=$destination_path.'/'.$filename;
        ///

        $this->photo_preview_link = Storage::url('temp-photos/posts/').$filename;

        $this->alert('success', 'Fotoğraf yükleme başarılı!');
        $this->thumb_updated = true;
    }

    public function remove_existing_photo(){
        $this->photo_preview_link='';
        $this->thumb_updated=false;
        $this->photo='';
        Storage::delete($this->photo_storage_address);
        $this->alert('success', 'Dosya başarıyla silindi!');

    }

    public function updatedFile(){
        $validator = Validator::make(
            ['file' => $this->file],
            ['file' => 'required|file|mimes:jpeg,bmp,png,jpg,pdf,xls,xlsx,doc,docx,txt,zip,rar|max:8192']
        );

        if ($validator->fails()) {
            $this->file_updated = false;
        }

        $validator->validate();
        $destination_path='public/temp-files/posts';
        $filename='tempfile_'.md5(now()).'.'.($this->file->getClientOriginalExtension());
        $this->file->storeAs($destination_path,$filename);

        //silme için deneme
        $this->file_storage_address=$destination_path.'/'.$filename;
        $this->file_size=Storage::size($destination_path.'/'.$filename);
        ///

        $this->file_updated=true;
    }
    public function attachFile(){
        if($this->file_updated && $this->file !=NULL){
            $file=[
                'filename'=> $this->filename,
                'storage_address'=>$this->file_storage_address,
                'file_size'=>number_format($this->file_size / 1048576,2),
                'extension'=>$this->file->getClientOriginalExtension(),
            ];
            $this->attached_files[rand(1,500)]=$file;

        }
        $this->alert('success', 'Dosya başarıyla eklendi!');
        $this->file_updated=false;
        $this->file=NULL;
    }

    public function detachFile($key){
        $file=$this->attached_files[$key]['storage_address'];
        Storage::delete($file);
        unset($this->attached_files[$key]);
        $this->alert('success', 'Dosya başarıyla silindi!');
    }

    public function storePost(){
        $validator = Validator::make(
            [
                'post_type' => $this->post_type,
                'title' => $this->title,
                'content' => $this->content
            ],
            [
                'post_type' => 'required',
                'title' => 'required|min:5',
                'content'=>'required|min:40'
            ]
        );

        if ($validator->fails()) {
            $this->alert('error', 'İşlem başarısız! Lütfen formdaki hataları düzelterek tekrar deneyin.');
        }
        $validator->validate();

        //todo artık ekleyelim
        $post = Post::create(
            [
                'writer_id'=>Auth::id(),
                'post_type'=>$this->post_type,
                'title'=>$this->title,
                'content'=>$this->content,
                'slug'=>Str::slug($this->title),
                'is_active'=> $this->is_active ? 1 : 0,
                'is_featured'=>$this->is_featured ? 1 : 0
            ]
        );

        foreach ($this->added_tags as $tag){
            $post->attachTag($tag);
        }

        $images_with_0_id=Media::where('model_id',0)->update([
            'model_id'=>$post->id
        ]);

        if($post){
            $alert=[
                'icon'=>'success',
                'title'=>'Başarılı!',
                'text'=>'İçerik başarıyla eklendi.'
            ];
            session()->flash('alert', $alert);
            $this->redirect(route('posts.index'));
        }

        if($this->thumb_updated){
            $stored_post = Post::find($post->id);
            $stored_post->addMediaFromDisk($this->photo_storage_address)->toMediaCollection('featured_photos');
        }

        if(!empty($this->attached_files)){
            foreach ($this->attached_files as $key => $file){
                $stored_post = Post::find($post->id);
                $stored_post
                    ->addMediaFromDisk($file['storage_address'])
                    ->withCustomProperties([
                        'filename'=>$file['filename'],
                        'file_size'=>$file['file_size'],
                        'extension'=>$file['extension']
                    ])
                    ->usingName($file['filename'])
                    ->usingFileName($file['filename'].'.'.$file['extension'])
                    ->toMediaCollection('attached');
            }
        }
    }

    public function addTag(){
        if (!in_array($this->new_tag, $this->added_tags)) {
            array_push($this->added_tags,$this->new_tag);
            $this->new_tag='';
        }
    }

    public function removeTag($tag){
        $key = array_search($tag, $this->added_tags, true);
        if ($key !== false) {
            unset($this->added_tags[$key]);
        }

    }
}
