@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'MatahariSongketBali')
<img src="{{ asset('assets/images/logo.png') }}" class="logo" alt="Matahari Songket Bali Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
