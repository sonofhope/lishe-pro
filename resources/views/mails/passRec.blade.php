

Hi<b> {{ $user->firstname }}</b>,<br /><br />

You have requested to recover your account with <span style="color: #9BA747;"><i>Lishe Pro</i></span>, please click on the link below to change your password.<br /><br />

<a style="text-decoration: none; color: #8B281F;" href="https://lishep.herokuapp.com/reset/{{ base64_encode($user->id) }}">Reset Password</a><br /><br />

If you were not involved in this event please ignore this email. Do not reply to this email as messages are automatically
sent.<br /><br />

Regards,<br />
Lishe Pro.

