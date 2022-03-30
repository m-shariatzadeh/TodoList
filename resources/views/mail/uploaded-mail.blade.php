@component('mail::message')
# Hi {{ $user->name }}

Your File Was Uploaded!

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
