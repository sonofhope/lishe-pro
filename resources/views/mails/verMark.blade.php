@component('mail::message')
    Welcome <b>{{ $user->firstname }},</b>

Thank you for registering!

Click the link below to verify your account, this helps you to access more features on {{ config('app.name') }}


@component('mail::button', ['url' => 'https://lishep.herokuapp.com/verify/'.base64_encode($user->id)])
    Verify my account
@endcomponent

@component('mail::panel')
    If you did not create an account with us ignore this email. Do not reply this email as emails are automatically sent.
@endcomponent
-
Thanks,<br>

{{ config('app.name') }}

@endcomponent

