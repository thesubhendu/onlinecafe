<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
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
<!-- <link rel="stylesheet" href="{{asset('/assets/css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/responsive.css')}}"> -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    @laravelPWA

    @livewireStyles
    <script src="https://js.stripe.com/v3/"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    {{--    <script type='text/javascript'>--}}
    {{--        $(document).ready(function(){--}}
    {{--            $(".owl-carousel").owlCarousel();--}}
    {{--        });--}}
    {{--    </script>--}}

</head>

<body>

<x-navbar-home></x-navbar-home>

<x-validation-errors></x-validation-errors>
<x-message></x-message>

<!-- Page Content -->
{{ $slot }}

@stack('modals')

@livewireScripts

@stack('scripts')


<script>
    $(document).ready(function () {
        $('.owl-carousel').owlCarousel();
    });
</script>
</body>
</html>
