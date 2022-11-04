<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Jenssegers\Agent\Agent;
use Stevebauman\Location\Facades\Location;

class LogSuccessfulLogout
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
            ->event('logoutsuccessful')
            ->performedOn($user)
            ->withProperties([
                'agent'=>$agent_array,
                'location'=>$location
            ])
            ->useLog('logout')
            ->log('Kullanıcı çıkış yaptı.');
    }
}
