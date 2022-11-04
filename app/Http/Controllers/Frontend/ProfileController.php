<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use Spatie\Activitylog\Models\Activity;
use Spatie\Permission\Models\Permission;
use Stevebauman\Location\Facades\Location;

class ProfileController extends Controller
{


    public function index(){
        // Kullanıcının yönetim paneli yetkisi olup olmadığını kontrol edelim, eğer varsa izinlerini $permissions değişkenine aktaralım.
        if($this->middleware(['permission:panel'])){
            $permissions=array();
            $all_permissions=Permission::all();
            foreach($all_permissions as $perm){
                array_push($permissions,['title'=>$perm->title,'description'=>$perm->description]);
            }
        } else {
            $permissions = '';
        }
        return view("frontend.profile.index", compact('permissions'));
    }

    public function show_secure_page(){
        //todo bunlar helpera verilebilir
        $last_failed_login=Activity::where([
            'log_name' => 'login',
            'event' => 'loginfailed',
            'subject_id' => auth()->user()->id,
        ])
            ->whereJsonContains('properties->is_confirmed',0)
            ->orderBy('created_at','DESC')
            ->get();


        return view("frontend.profile.secure", compact('last_failed_login'));
    }

    public function confirm_failed_login(Request $request){
        $attempt = Activity::find($request->post('log_id'))
            ->update(['properties->is_confirmed'=>1]);
        return redirect()->route('profile.secure')->with('confirmed','Giriş denemesinin size ait olduğunu onayladınız.');
    }
}
