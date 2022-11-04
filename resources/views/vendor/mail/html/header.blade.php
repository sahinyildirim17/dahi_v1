@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
@else
<img src="{{url('img/logo.png')}}" alt="TFFHGD Niğde Logo" style="width: 200px;height: auto">
@endif
</a>
</td>
</tr>
