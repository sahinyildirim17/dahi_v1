<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Jenssegers\Agent\Agent;
use Spatie\Activitylog\Models\Activity;
use Stevebauman\Location\Facades\Location;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $user=User::find(auth()->user()->id);
        $agent = new Agent();
        $agent_array = [
            'platform'=>$agent->platform(),
            'device'=>$agent->device(),
            'device_type'=>$agent->deviceType(),
            'browser'=>$agent->browser(),
            'browser_version'=>$agent->version($agent->browser()),
            'is_robot'=>$agent->isRobot(),
        ];
        //todo geliştirmede ip elle veriliyor $location = Location::get(request()->ip());
        $location = Location::get(get_user_ip());
        activity()
            ->event('loginsuccessful')
            ->performedOn($user)
            ->withProperties([
                'agent'=>$agent_array,
                'location'=>$location
            ])
            ->useLog('login')
            ->log('Kullanıcı girişi başarılı.');

        //kullanıcının başarısız giriş denemesini burada kontrol edelim eğer varsa secure sayfasına yönlendirelim.
        //todo bunlar helpera verilebilir
        $last_failed_login=Activity::where([
            'log_name' => 'login',
            'event' => 'loginfailed',
            'subject_id' => auth()->user()->id,
        ])
            ->whereJsonContains('properties->is_confirmed',0)
            ->orderBy('created_at','DESC')
            ->first();;
        if(!empty($last_failed_login)){
            abort(redirect()->route('profile.secure'));
        }

    }
}
