<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Failed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Jenssegers\Agent\Agent;
use Stevebauman\Location\Facades\Location;

class LogFailedLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */

    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Failed $event){
        //Log::warning($event->credentials);
        //Log::warning($event->user);

        if(!is_null($event->user)) {
            $user = $event->user;
        }else {
            $user=NULL;
        }
        //todo buraya useragent bilgisi de eklenecek.
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
        $log = activity()
            ->event('loginfailed')
            ->withProperties([
                'email'=>$event->credentials['email'],
                'password'=>$event->credentials['password'],
                'agent'=>$agent_array,
                'location'=>$location
            ])
            ->useLog('login');
            if(!is_null($user)){
                $log->performedOn($user);
                $log->withProperties([
                    'is_exist'=>1,
                    'is_confirmed'=>0,
                    'email'=>$event->credentials['email'],
                    'password'=>$event->credentials['password'],
                    'agent'=>$agent_array,
                    'location'=>$location
                ]);
            } else {
                $log->withProperties([
                    'is_exist'=>0,
                    'is_confirmed'=>0,
                    'email'=>$event->credentials['email'],
                    'password'=>$event->credentials['password'],
                    'agent'=>$agent_array,
                    'location'=>$location
                ]);
            }
        $log->log('Başarısız giriş denemesi yapıldı.');
    }

}
