<x-mail::message>
# Hesabınızdaki Kritik Etkinlik
<x-mail::panel>
Hesabınızın parolası değiştirildi.
</x-mail::panel>
Aşağıda yapılan işleme ait detayları görebilirsiniz. Eğer bu işlem sizin tarafınızdan yapılmadıysa lütfen şifrenizi **hemen** sıfırlayın ve bilginiz dışındaki bu işlemi yönetime bildirin.
Ayrıca hesabınızın güvenliği için **iki adımlı doğrulama** kullanmanızı tavsiye ederiz.

**Tarih:** {{\Carbon\Carbon::parse($time)->format('d.m.Y')}}\
**Saat:** {{\Carbon\Carbon::parse($time)->format('H:i')}}\
**IP Adresi:** {{$ip}}\
**Cihaz / Türü:** @if($agent['device_type']=='desktop') Masaüstü @elseif(($agent['device_type']=='phone')) Akıllı Telefon - {{$agent['device']}} @elseif(($agent['device_type']=='tablet')) Tablet - {{$agent['device']}}@endif\
**OS/Platform:** {{$agent['platform']}}\
**Tarayıcı:** {{$agent['browser'].' ('.$agent['browser_version'].')'}}\
**Yaklaşık Konum:** {{$location->regionName.' - '.$location->countryCode}}

<x-mail::button :url="\Illuminate\Support\Facades\URL::to('/').'/forgot-password'" color="success">
Parolamı Sıfırla
</x-mail::button>
</x-mail::message>
