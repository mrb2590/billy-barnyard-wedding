@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block; text-align: center;">
<img src="{{ \Illuminate\Support\Facades\Vite::asset('resources/images/logo.png') }}" class="logo" alt="{{ config('app.name') }} Logo">
<br>
{{ $slot }}
</a>
</td>
</tr>
