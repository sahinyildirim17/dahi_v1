<?php

namespace App\Http\Livewire\Backend\Committees;

use App\Models\Backend\Committee;
use App\Models\Backend\CommitteeMember;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Index extends Component
{

    use WithFileUploads;
    use LivewireAlert;

    protected $listeners = [
        'refreshList'=>'render',
        'deleteConfirmed' => 'deleteCommittee'
    ];
    public $committees;

    public $committee_to_be_added;

    public $editing_committee_name;

    public $users; // mevcut üyelerden seçim için
    public $user; // bu da seçilen üye
    public $selected_user_details;

    // Kurula üye eklemede kullanılacak değişkenler tanımlanıyor
    public $is_registered=1;
    public $name,$surname,$member_photo,$photo_url,$order,$uploaded_media_id;
    public $added_roles=[];
    public $role_name,$role_order;

    public $temp_photo_path;

    public $id_to_be_deleted;
    public function mount(){
        $this->users=User::all();
    }
    public function render()
    {
        $this->committees=Committee::all();
        return view('livewire.backend.committees.index');
    }

    public function updatedUser(){

        if($this->user!=''){
            // mevcut üye var, eşleştirilecek.
            $user=User::find($this->user);
            $this->selected_user_details=$user;
            $this->name=$this->selected_user_details->name;
            $this->surname=$this->selected_user_details->surname;
            $this->photo_url=$user->getFirstMediaUrl('avatar');
            $this->temp_photo_path=$user->getFirstMedia('avatar')->getPath();
        } else{
            // üye yok, formdaki bilgiler ile giriş yapılacak.
            $this->reset(['name','surname','member_photo','photo_url']);
        }
    }

    public function updatedIsRegistered(){
        $this->reset(['name','surname','user','photo_url','member_photo']);
    }

    public function updatedMemberPhoto(){
        $temp_photo = new CommitteeMember();
        $temp_photo->id=0;
        $temp_photo->exists = true;
        $image = $temp_photo->addMedia($this->member_photo)
            ->toMediaCollection('temp_images');
        $this->photo_url=$image->getUrl();
        $this->temp_photo_path=$image->getPath();
        $this->uploaded_media_id=$image->id;
        $this->alert('success','Fotoğraf başarıyla yüklendi.');
    }

    public function openAddMemberModelFor($committee_id){
        $this->committee_to_be_added=$committee_id;
        //$this->alert('success',$this->committee_to_be_added);
        $this->dispatchBrowserEvent('openModelAddMember');
        $committee=Committee::find($committee_id);
        $this->editing_committee_name=$committee->name;
    }

    public function attachRole(){
        $form_fields = [
            'role_name' => $this->role_name,
            'role_order' => $this->role_order,
        ];

        $rules=[
            'role_name' => 'required',
            'role_order' => 'required',
        ];

        $validator = Validator::make($form_fields,$rules);

        if ($validator->fails()) {
            $this->alert('error', 'İşlem başarısız!');
        }

        $validator->validate();

        $role=[
            'role_name'=>$this->role_name,
            'role_order'=>$this->role_order
        ];
        $this->added_roles[rand(1,100000)]=$role;
        $this->alert('success','Rol - görev listeye eklendi.');
        $this->reset('role_name','role_order');

    }

    public function detachRole($key){
        unset($this->added_roles[$key]);
        $this->alert('success', 'Rol - görev listeden silindi.');
    }
    public function storeCommitteeMember(){
        $form_fields = [
            'name' => $this->name,
            'surname' => $this->surname,
            'order' => $this->order,
            'added_roles' => $this->added_roles,
        ];

        $rules=[
            'name' => 'required',
            'surname' => 'required',
            'order' => 'required',
            'added_roles' => 'required|array|min:1',
        ];

        $validator = Validator::make($form_fields,$rules);

        if ($validator->fails()) {
            $this->alert('error', 'İşlem başarısız!');
        }

        $validator->validate();

        $member = new CommitteeMember();
        $member->committee_id=$this->committee_to_be_added;
        if($this->is_registered){
            $member->user_id=$this->selected_user_details->id;
        }
        $member->name=$this->name;
        $member->surname=$this->surname;
        $member->order=$this->order;
        $member->roles=json_encode($this->added_roles);
        $member->save();

        //todo Burda bi ibnelik var

        if($this->temp_photo_path){
            $old_media=Media::find($this->uploaded_media_id);
            if($old_media) {
                $member->addMedia($this->temp_photo_path)->preservingOriginal()->toMediaCollection('committee_member');
                $old_media->delete();
            } else{
                $member->addMedia($this->temp_photo_path)->preservingOriginal()->toMediaCollection('committee_member');
            }
        } else{
            $member->addMedia('img/default_committee_member.png')->preservingOriginal()->toMediaCollection('committee_member');
        }

        $this->alert('success','Üye başarıyla eklendi!');
        $this->dispatchBrowserEvent('closeModelAddMember');
        $this->reset();
        $this->users=User::all();
        $this->emit('refreshList');
    }

    public function resetAll(){
        $this->reset();
        $this->users=User::all();
    }

    public function deleteConfirmation($id){
        $this->id_to_be_deleted = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteCommittee(){
        $committee = Committee::where('id', $this->id_to_be_deleted)->first();
        foreach (CommitteeMember::where('committee_id',$committee->id)->get() as $member){
            $member->delete();
        }
        //$committee->members()->delete();
        $committee->delete();
        $this->dispatchBrowserEvent('committeeDeleted');
        $this->emit('refresh');
    }

}
