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
use Spatie\MediaLibrary\Support\MediaStream;
use Spatie\Tags\Tag;
use function Symfony\Component\Translation\t;
use Illuminate\Support\Facades\Validator;
use ZipStream\Option\Archive as ArchiveOptions;

class EditPostForm extends Component
{

    use WithFileUploads;
    use LivewireAlert;

    protected $listeners = [
        'refresh' => '$refresh'
    ];

    public $post;
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

    public $existing_featured_photo;

    public $existingFiles;

    public $type_tag;

    public $all_tags;

    public $new_tag;
    public $added_tags=[];
    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function mount(){
        if($this->post->post_type==1){
            $this->type_tag='haberler';
        }else{
            $this->type_tag='duyurular';
        }
        $this->post_type=$this->post->post_type;
        $this->title=$this->post->title;
        $this->content=$this->post->content;
        $this->is_active=$this->post->is_active;
        $this->is_featured=$this->post->is_featured;
        $this->existing_featured_photo = $this->post->getFirstMediaUrl('featured_photos');
        $this->photo_preview_link=$this->post->getFirstMediaUrl('featured_photos');
        $this->slug=URL::to('/').'/'.$this->type_tag.'/'.$this->post->id.'/'.Str::slug($this->title,'-');

        $this->existingFiles = $this->post->getMedia('attached');

        $this->all_tags=Tag::all();
        foreach ($this->post->tags as $tag) {
            array_push($this->added_tags,$tag["name"]);
        }

    }

    public function render()
    {
        return view('livewire.backend.posts.edit-post-form');
    }

    public function updatedTitle(){
        if($this->post_type!=''){
            if($this->post_type==1){
                $type_tag='haberler';
            }else{
                $type_tag='duyurular';
            }
            $this->slug=URL::to('/').'/'.$type_tag.'/'.$this->post->id.'/'.Str::slug($this->title,'-');
        }

    }

    public function updatedPostType(){
        if($this->post_type!=''&&$this->title!=''){
            if($this->post_type==1){
                $type_tag='haberler';
            }else{
                $type_tag='duyurular';
            }
            $this->slug=URL::to('/').'/'.$type_tag.'/'.$this->post->id.'/'.Str::slug($this->title,'-');
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
        if($this->thumb_updated){
            //yeni fotoğraf yüklenmiş, yeni yüklenen fotoğraf silinecek ve preview url mevcut foto olarak tanımlanacak.
            Storage::delete($this->photo_storage_address);
            $this->alert('success', 'Fotoğraf başarıyla kaldırıldı!');
            $this->photo_preview_link = $this->post->getFirstMediaUrl('featured_photos');


        }else{
            //eski fotoğraf siliniyor.
            $media=$this->post->getFirstMedia('featured_photos');
            $media->delete();
            $this->photo_preview_link='';
            $this->existing_featured_photo=false;

        }

        $this->thumb_updated=false;
        $this->photo='';

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
        $this->filename='';
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
        $post = Post::find($this->post->id)
            ->update(
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
        $post_to_sync_tags = Post::find($this->post->id);
        $post_to_sync_tags->syncTags($this->added_tags);

        if($this->thumb_updated){
            $stored_post = $this->post;
            //Burada güncellerken mevcut resim varsa sorun oluyor. O yüzden önce mevcut varsa silelim.
            $existing_featured_photos=$this->post->getMedia('featured_photos');
            foreach ($existing_featured_photos as $old_photo){
                $this->post->deleteMedia($old_photo->id);
            }
            $stored_post->addMediaFromDisk($this->photo_storage_address)->toMediaCollection('featured_photos');
        }

        if(!empty($this->attached_files)){
            foreach ($this->attached_files as $key => $file){
                $stored_post = $this->post;
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

        $this->thumb_updated=false;

        if($post){
            $alert=[
                'icon'=>'success',
                'title'=>'Başarılı!',
                'text'=>'İçerik başarıyla güncellendi.'
            ];
            session()->flash('alert', $alert);
            $this->redirect(route('posts.edit',$this->post->id));
        }


    }

    public function removeFile($file_id){
        $this->post->deleteMedia($file_id);
        $this->alert('success', 'Dosya başarıyla silindi!');
        $this->emit('refresh');
    }

    public function downloadFile($id){
        $mediaItem = Media::find($id);
        return response()->download($mediaItem->getPath(), $mediaItem->file_name);
    }

    public function downloadAllFiles(Post $post){

        $downloads = $post->getMedia('attached');
        // Download the files associated with the media in a streamed way.
        // No prob if your files are very large.
        ;
        return MediaStream::create($this->post->title.' - Ekler.zip')
            ->useZipOptions(function(ArchiveOptions $zipOptions) {
                $zipOptions->setComment(
                    "Bu arşiv dosyası ".config('settings.title')." \ninternet sitesinde yer alan ".$this->post->title." \nbaşlıklı içeriğe ait ekleri içermektedir.\nİlgili içeriğe bağlantıdan ulaşabilirsiniz: \n".URL::to('/').'/'.$this->type_tag.'/'.$this->post->id.'/'.Str::slug($this->title,'-')."\n\n".config('settings.app_name')." - versiyon: ".config('settings.app_version'));
            })
            ->addMedia($downloads);
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
