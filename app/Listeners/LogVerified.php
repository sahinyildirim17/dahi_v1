<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Jenssegers\Agent\Agent;
use Stevebauman\Location\Facades\Location;

class LogVerified
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
        $user=User::find($event->user->id);
        $agent = new Agent();
        $agent_array = [
            'platform'=>$agent->platform(),
            'device'=>$agent->device(),
            'device_type'=>$agent->deviceType(),
            'browser'=>$agent->browser(),
            'browser_version'=>$agent->version($agent->browser()),
            'is_robot'=>$agent->isRobot(),
        ];

        $location = Location::get(get_user_ip());
        activity()
            ->event('verified')
            ->performedOn($user)
            ->withProperties([
                'agent'=>$agent_array,
                'location'=>$location
            ])
            ->useLog('user')
            ->log('E-posta adresi doğrulandı.');

        request()->session()->flash('alert',[
            'title'=>'İşlem başarılı!',
            'icon'=>'success',
            'text'=>'E-posta adresiniz başarıyla doğrulandı. Adresinize iletilecek tüm mesajlar resmi tebligat niteliğinde olacaktır.'
        ]);
    }
}
