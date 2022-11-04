<?php

// todo KULLANICI PROFİL RESMİ FONKSİYONU, yoksa tanımlanır.
use Illuminate\Support\Facades\Log;

if(!function_exists('user_avatar')){
    function user_avatar($user_id){
        $user = \App\Models\User::find($user_id);
        // Öncelikle kullanıcının resmi var mı kontrol edelim.
        if($user->getFirstMediaUrl('avatar')==''){
            //profil resmi yok, ui-avatars atanacak
            $url = "https://ui-avatars.com/api/?size=64&name=".$user->name.'+'.$user->surname."&bold=true&background=206bc4&color=ffffff";
        } else{
            // profil resmi var, storage url oluşturalım
            $url = $user->getFirstMediaUrl('avatar');
        }

        return $url;

    }
}

if(!function_exists('get_user_ip')){
    function get_user_ip(){
        /** burada kullanıcının ip adresini alıyoruz. birçok yerde kullanıldığı için metod yaptık.
         * Şimdilik string veriyoruz
         */
        //return request()->ip();
        //return '194.31.87.226';
        return '78.135.91.245';
        //return '66.71.242.56'; //amerika
    }
}

if(!function_exists('send_sms')){
    /** NETGSM SMS Entegrasyonu
     * Metoda kullanıcı modeli yerine doğrudan numara gönderilmesi değerlendirilebilir.
     * Ayrıca bu bir notification class'ı olarak tanımlanarak queable olmalı ya da bu class queuable olan notification classını çağırmalı.
     * Tarih değerleri Carbon sınıfı ile verilecek. SMS'in kaç günde gideceği ayara bağlanabilir. Ayrıca env'den alınan NETGSM kullanıcı bilgileri de aynı şekilde.
     * Hatta kullanılacak başlık sistemden API ile sorularak listelenebilir.
     */
    function send_sms($user, $message)
    {
        $username = env('NETGSM_SMS_USER');
        $pass = env('NETGSM_SMS_PASSWORD');
        $header = env('NETGSM_SMS_HEADER');
        $number = $user;
        $startdate = date('d.m.Y H:i');
        $startdate = str_replace('.', '', $startdate);
        $startdate = str_replace(':', '', $startdate);
        $startdate = str_replace(' ', '', $startdate);
        $stopdate = date('d.m.Y H:i', strtotime('+1 day'));
        $stopdate = str_replace('.', '', $stopdate);
        $stopdate = str_replace(':', '', $stopdate);
        $stopdate = str_replace(' ', '', $stopdate);
        $msg = html_entity_decode($message, ENT_COMPAT, "UTF-8");
        $msg = rawurlencode($msg );

        $sender =html_entity_decode($header, ENT_COMPAT, "UTF-8");
        $sender = rawurlencode($sender);

        $url = "https://api.netgsm.com.tr/bulkhttppost.asp?usercode=$username&password=$pass&gsmno=$user&message=$msg&msgheader=$sender&startdate=$startdate&stopdate=$stopdate"; //Türkçe karakter için &dil=TR
        //echo $url;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //  curl_setopt($ch,CURLOPT_HEADER, false);
        $output = curl_exec($ch);
        curl_close($ch);
        Log::info('SMS Gönderim Bilgisi: '.$output) ;
    }
}

if(!function_exists('get_sms_report')){
    function get_sms_report($sms_id){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://soap.netgsm.com.tr:8080/Sms_webservis/SMS?wsdl/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '<?xml version="1.0"?>
                <SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/"
                             xmlns:xsd="http://www.w3.org/2001/XMLSchema"
                  xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
                    <SOAP-ENV:Body>
                        <ns3:raporV3 xmlns:ns3="http://sms/">
                        <username>'.env('NETGSM_SMS_USER').'</username>
                        <password>'.env('NETGSM_SMS_PASSWORD').'</password>
                        <bulkid>'.$sms_id.'</bulkid>
                        <type>0</type>
                        <detail>1</detail>
                    </ns3:raporV3>
                    </SOAP-ENV:Body>
                </SOAP-ENV:Envelope>',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: text/xml'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $xml   = simplexml_load_string($response);
        $array = json_decode(json_encode((array) $xml), true);
        $array = array($xml->getName() => $array);
        return urldecode($response);
    }
}

