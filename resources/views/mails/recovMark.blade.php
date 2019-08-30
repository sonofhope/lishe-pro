@component('mail::message')
    Hi <b>{{ $user->firstname }},</b>

You have requested to recover your account on {{ config('app.name') }}

please click on the link below to change your password.

@component('mail::button', ['url' => 'https://lishep.herokuapp.com/reset/'.base64_encode($user->id)])
Recover My Account
@endcomponent

@component('mail::panel')
    If you did not send this request ignore this email. Do not reply this email as emails are automatically sent.
@endcomponent
-
Thanks,<br>

{{ config('app.name') }}

@endcomponent