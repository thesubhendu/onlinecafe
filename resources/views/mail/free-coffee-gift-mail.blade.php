@component('mail::message')
    # Free Coffee

    ## Congratulations, {{$user->name}}  gifted you free coffee

    @component('mail::button', ['url' => config('app.client_url')])
        Click to view
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
