@props([
    'photo_url',
    'name',
    'role',
    'phone'
])
<table class="subcopy" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="padding: 5px;margin: 0px">
<tr style="padding: 0px;">
<td style="width: 68px">
<img src="{{$photo_url}}" alt="" style="border-radius: 5px; border: 3px solid #322785; width: 64px">
</td>
<td style="padding-left: 20px;font-size: 0.9rem">{{$name}} ({{$role}})<br><a href="tel:{{$phone}}" style="text-decoration: none">{{$phone}}</a></td>
</tr>
</table>
