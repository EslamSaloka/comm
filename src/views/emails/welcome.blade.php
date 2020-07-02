@component('mail::message')
@lang('Dear :USER',['USER'=>$user->name])
@component('mail::panel')
@lang('Thank you for joining us and we are happy that you are in the application and we hope you will interact with us')
@endcomponent
@endcomponent
