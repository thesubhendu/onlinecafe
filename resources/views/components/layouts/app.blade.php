<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @if(app()->environment('production'))
        @include('_google-analytics')
    @endif

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>


    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{asset('/assets/css/font-awesome.min.css')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    @livewireStyles
    @livewireScripts

    <script src="https://js.stripe.com/v3/"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    @if(app()->environment('production'))
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5SFTN2F" height="0" width="0"
                style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
    @endif

@if(app()->environment('testing'))
    <div class="alert alert-danger text-center" role="alert">
        <strong>{{env('TEST_SITE_NOTICE')}}</strong>
    </div>
@endif


<x-navbar-home></x-navbar-home>

<x-validation-errors></x-validation-errors>
<x-message></x-message>

<!-- Page Content -->
{{ $slot }}

@stack('modals')


<!-- Scripts -->
<script src="{{ mix('js/app.js') }}"></script>

@stack('scripts')


@include('owl-carosel-script')

@auth
    <script>
        window.Laravel = @json([
                'userId' => auth()->id()
        ]);

        //listening notification
        Echo.private('App.Models.User.' + '{{auth()->id()}}')
            .notification((notification) => {
                let options = {
                    title: notification.title,
                    toast: true,
                    position: 'top-right',
                    text: notification.text,
                };

                if (notification.action) {
                    options.confirmButtonText = "<a class='text-white' href='" + notification.action + "'>View</a>"
                }
                window.Swal.fire(options)
                //add sound

            });
    </script>
@endauth
</body>
</html>
