UserID: {{ $user->id }}<br/>
First Name: {{ $user->first_name }}<br/>
Last Name: {{ $user->last_name }}<br/>
Email: {{ $user->email }}<br/>
Phone Number: {{ $user->mobile_phone_no }}<br/>
Registered Date: {{ $user->registered_date }}<br/>
<br/>
This is reset password Mail</b><br/>
<pre>
Keep calm, the work just begin
visit the <a href="{{ 'http://ec2-52-220-52-208.ap-southeast-1.compute.amazonaws.com/reset_password/' . $user->reset_password_token }}">link</a> to reset password.<br/><br/>
<small>if you cannot see the link, click {{ 'http://ec2-52-220-52-208.ap-southeast-1.compute.amazonaws.com/reset_password/' . $user->reset_password_token }}</small>
</pre><br/>
<br/>
<small>Email ini dikirim pada {{ $datetime }}, zona waktu {{ $timezone }}</small><br/> 