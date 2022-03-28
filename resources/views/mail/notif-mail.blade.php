@component('mail::message')
# {{ $subject }}

## Hello {{ $user->name }}

{{ $description }}

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
