UserID: {{ $user->id }}<br/>
First Name: {{ $user->first_name }}<br/>
Last Name: {{ $user->last_name }}<br/>
Email: {{ $user->email }}<br/>
Phone Number: {{ $user->mobile_phone_no }}<br/>
Registered Date: {{ $user->registered_date }}<br/>
<br/>
Saya membutuhkan Bantuan terkait masalah: <b>{{ $topic }}</b><br/>
<pre>
{{ $data }}
</pre><br/>
<br/>
<small>Laporan diterima pada {{ $datetime }}, zona waktu {{ $timezone }}</small><br/>