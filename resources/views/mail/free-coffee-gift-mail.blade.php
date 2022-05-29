@component('mail::message')
    # Free Coffee

    ## Congratulations, {{$user->name}}  gifted you free coffee

    @component('mail::button', ['url' => route('cards.index')])
        Click to view
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
