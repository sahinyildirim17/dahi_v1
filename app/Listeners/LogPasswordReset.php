<?php

namespace App\Listeners;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Jenssegers\Agent\Agent;
use Stevebauman\Location\Facades\Location;

class LogPasswordReset
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
    public function handle(PasswordReset $event)
    {
        $user=$event->user;
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
            ->event('passwordreset')
            ->performedOn($user)
            ->causedBy($user)
            ->withProperties([
                'agent'=>$agent_array,
                'location'=>$location
            ])
            ->useLog('passwordreset')
            ->log('Parola sıfırlandı.');

        $time=Carbon::now();
        //todo mail gönderilecek.
        Mail::to($user->email)->send(new \App\Mail\PasswordReset($user,$agent_array,$time,get_user_ip(),$location));
        //Log::alert('Şifre değişti. Event: '.json_encode($event));

        $sms_message="Sayın ".$user->name.' '.$user->surname.', TFFHGD Niğde internet sitesindeki kullanıcı şifreniz değiştirilmiştir. Bu işlemi siz yapmadıysanız lütfen aşağıdaki bağlantıyı kullanarak parolanızı sıfırlayın. Ayrıca güvenliğiniz için iki adımlı doğrulama kullanmanız tavsiye edilir.\n'.route('password.request');
        send_sms('5415892420',$sms_message); //todo buradaki metoda kullanıcının numarası verilecek.
    }
}
