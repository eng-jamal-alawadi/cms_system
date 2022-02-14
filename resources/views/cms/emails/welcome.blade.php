@component('mail::message')
# Greetings

Hi, {{$data['name']}}

@component('mail::panel')
Welcom in CMS-System
@endcomponent

@component('mail::button', ['url' => 'http://127.0.0.1:8000/cms/admin/login'])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
