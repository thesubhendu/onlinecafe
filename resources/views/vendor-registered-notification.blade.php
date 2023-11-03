@component('mail::message')
# New Vendor Registered

Hi,
{{ $user->name }} has just registered.

@component('mail::button', ['url' => route('filament.admin.pages.dashboard')  ])
View Vendor
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
