@component('mail::message')
@lang('Dear :USER',['USER'=>$user->name])
@component('mail::panel')
@lang('Hello you have requested a refund of your password, you have been sent a temporary password, if you are not sure please confirm your account with us')
@endcomponent
@component('mail::promotion')
{{ $pass }}
@endcomponent
@endcomponent
