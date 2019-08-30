Welcome <b>{{ $user->firstname }}</b>,<br /><br />

You have recently created an account with <span style="color: #9BA747;"><i>Lishe Pro</i></span>, please click on the link below to verify your account.<br /><br />

<a style="text-decoration: none; color: #8B281F;" href="https://lishep.herokuapp.com/verify/{{ base64_encode($user->id) }}">Verify Account</a><br /><br />

If you were not involved in this event please ignore this email. Do not reply to this email as messages are automatically
sent.<br /><br />

Regards,<br />
Lishe Pro.

