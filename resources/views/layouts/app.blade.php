@php
    use App\Models\Settings\WebsIdentity;

    $identitas = WebsIdentity::find(1);

@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@stack('pageTitle') | {{ $identitas->name }}</title>
    <!-- fav icon -->
    <link rel="icon" href="{{ asset('assets_public/assets/Images/fav-icon/fav-icon.png') }}">

    <!-- bootstarp -->
    <link rel="stylesheet" href="{{ asset('assets_public/css/vendors/bootstrap.min.css') }}">

    <!-- Fancybox -->
    <link rel="stylesheet" href="{{ asset('assets_public/css/vendors/jquery.fancybox.min.css') }}">

    <!-- animate.css file -->
    <link rel="stylesheet" href="{{ asset('assets_public/css/vendors/animate.css') }}">

    <!-- Swiper -->
    <link rel="stylesheet" href="{{ asset('assets_public/css/vendors/swiper.min.css') }}">

    <!-- Splitting -->
    <link rel="stylesheet" href="{{ asset('assets_public/css/vendors/splitting.css') }}">

    <!-- fontAwesome -->
    <link rel="stylesheet" href="{{ asset('assets_public/css/vendors/all.min.css') }}">

    <!-- Font Family -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800;900&amp;family=Nunito:wght@400;500;600;700;800;900&amp;display=swap">


    <!-- main-LTR-1 -->
    <link rel="stylesheet" href="{{ asset('assets_public/css/main-LTR-1.css') }}">
    <title>Home-1</title>

    @livewireStyles
    @stack('style')
    @livewireScripts
</head>

<body class="overlay-is-linear-gradient rounded-btns">

    @include('livewire.public.component.navbar')

    {{ $slot }}

    @include('livewire.public.component.footer')
    <!--     JQuery     -->
    <script src="{{ asset('assets_public/js/vendors/jquery-3.4.1.min.js') }}"></script>

    <!--     bootstrap     -->
    <script src="{{ asset('assets_public/js/vendors/bootstrap.bundle.min.js') }}"></script>

    <!--     fancybox     -->
    <script src="{{ asset('assets_public/js/vendors/jquery.fancybox.min.js') }}"></script>

    <!--     countTo     -->
    <script src="{{ asset('assets_public/js/vendors/jquery.countTo.js') }}"></script>

    <!--     wow     -->
    <script src="{{ asset('assets_public/js/vendors/wow.min.js') }}"></script>

    <!--     swiper     -->
    <script src="{{ asset('assets_public/js/vendors/swiper.min.js') }}"></script>

    <!--     Splitting     -->
    <script src="{{ asset('assets_public/js/vendors/splitting.min.js') }}"></script>

    <!--     isotope     -->
    <script src="{{ asset('assets_public/js/vendors/isotope-min.js') }}"></script>

    <!--     main     -->
    <script src="{{ asset('assets_public/js/main.js') }}"></script>

</body>

</html>
