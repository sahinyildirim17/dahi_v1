<?php

namespace App\Http\Livewire\Backend\Committees;

use App\Models\Backend\Committee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use function Symfony\Component\Translation\t;

class CreateCommitteeForm extends Component
{

    use WithFileUploads;
    use LivewireAlert;

    protected $listeners = [
        'refresh' => '$refresh'
    ];

    public $name,$has_page,$description,$slug,$logo_url,$external_url_title,$external_url,$order;
    public $photo;
    public $uploaded_media_id;
    public $current_id;

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }


    public function mount(){
        $this->logo_url=NULL;
        if(DB::table('committees')->latest('created_at')->first()){
            $this->current_id= DB::table('committees')->latest('created_at')->first()->id+1;
            $this->order= DB::table('committees')->latest('created_at')->first()->id+1;
        }else{
            $this->current_id=1;
            $this->order=1;
        }
    }
    public function render()
    {
        return view('livewire.backend.committees.create-committee-form');
    }

    public function updatedName(){
        $this->slug=URL::to('/').'/kurullar/'.$this->current_id.'/'.Str::slug($this->name,'-');
    }

    public function updatedHasPage(){
        $this->description='';
        $this->external_url='';
        $this->external_url_title='';
    }

    public function updatedPhoto(){
        $temp_photo = new Committee();
        $temp_photo->id=0;
        $temp_photo->exists = true;
        $image = $temp_photo->addMedia($this->photo)
            ->toMediaCollection('temp_images');
        $this->logo_url=$image->getUrl();
        $this->uploaded_media_id=$image->id;
        $this->alert('success','Logo başarıyla yüklendi.');
    }
    public function storeCommittee(){
        $form_fields = [
            'name' => $this->name,
            'has_page' => $this->has_page,
            'order'=>$this->order
        ];

        $rules=[
            'name' => 'required',
            'has_page' => 'required',
            'order' => 'required|numeric|gt:0',
        ];

        if($this->has_page==0){
            $form_fields['external_url'] =$this->external_url;
            $form_fields['external_url_title'] =$this->external_url_title;
            $rules['external_url'] = 'required';
            $rules['external_url_title'] = 'required';
        }else if($this->has_page==1){
            $form_fields['description'] =$this->description;
            $rules['description'] = 'required';
        }

        $validator = Validator::make($form_fields,$rules);

        if ($validator->fails()) {
            $this->alert('error', 'İşlem başarısız!');
        }

        $validator->validate();

        $committee=Committee::create([
            'name'=>$this->name,
            'has_page'=>$this->has_page,
            'description'=>$this->description,
            'slug'=>$this->slug,
            'external_url'=>$this->external_url,
            'external_url_title'=>$this->external_url_title,
            'order'=>$this->order
        ]);

        $media=Media::find($this->uploaded_media_id);
        $media->update([
            'model_id'=>$committee->id,
            'collection_name'=>'committee'
        ]);

        $this->alert('success', 'Kurul başarıyla eklendi.');
        $this->reset(['name','has_page','order','description','slug','external_url','external_url_title','logo_url','photo']);
        $this->emit('refreshList');
    }

    public function clearForm(){
        $this->reset();
    }
}
