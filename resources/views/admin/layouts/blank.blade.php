<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $title . ' |' ?? '' }} {{ env('APP_NAME') }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon-ori.png') }}">
    <!-- Icon -->
    <link rel="icon" sizes="192x192" href="{{ asset('images/favicon-ori.png') }}">
    <!-- Meta Title -->
    <meta name="title" content="{{ $title . ' |' ?? '' }} {{ env('APP_NAME') }}">
    <!-- Meta Image -->
    <meta property="og:image" content="{{ asset('images/logo.png') }}">
    <!-- Meta Description -->
    <meta name="description" content="{{ $description }}">

    <!-- Bootstrap css -->
    <link rel="stylesheet" href="{{ asset('temp/admin/v2/css/bootstrap.min.css') }}">

    <!-- Animated css -->
    <link rel="stylesheet" href="{{ asset('temp/admin/v2/css/animate.css') }}">

    <!-- Bootstrap font icons css -->
    <link rel="stylesheet" href="{{ asset('temp/admin/v2/fonts/bootstrap/bootstrap-icons.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" />

    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('temp/admin/v2/css/main.css') }}">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @livewireStyles
    @stack('styles')
    @livewireScripts

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="login-container">

    {{ $slot }}

    <!-- Required jQuery first, then Bootstrap Bundle JS -->
    <script src="{{ asset('temp/admin/v2/js/jquery.min.js') }}"></script>
    <script src="{{ asset('temp/admin/v2/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('temp/admin/v2/js/modernizr.js') }}"></script>
    <script src="{{ asset('temp/admin/v2/js/moment.js') }}"></script>

    <!-- Main Js Required -->
    <script src="{{ asset('temp/admin/v2/js/main.js') }}"></script>

    @stack('script')

    <!-- SWEETALERT -->
    <script src="{{ asset('plugins/sweetalert/sweatalert2@11') }}"></script>
    <script src="{{ asset('plugins/sweetalert/toastr.min.js') }}"></script>
    <script>
        const SwalModal = (icon, title, html) => {
            Swal.fire({
                icon,
                title,
                html
            })
        }

        const SwalConfirm = (icon, title, html, confirmButtonText, method, params, callback) => {
            Swal.fire({
                icon,
                title,
                html,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText,
                reverseButtons: true,
            }).then(result => {
                if (result.value) {
                    return livewire.emit(method, params)
                }

                if (callback) {
                    return livewire.emit(callback)
                }
            })
        }

        const SwalAlert = (icon, title, text, timeout = 1000) => {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
                showCloseButton: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
            Toast.fire({
                icon,
                title,
                text
            })
        }

        document.addEventListener('DOMContentLoaded', () => {
            this.livewire.on('swal:modal', data => {
                SwalModal(data.icon, data.title, data.text)
            })

            this.livewire.on('swal:confirm', data => {
                SwalConfirm(data.icon, data.title, data.text, data.confirmText, data.method, data.params,
                    data.callback)
            })

            this.livewire.on('swal:alert', data => {
                SwalAlert(data.icon, data.title, data.text, data.timeout)
            })
        });
    </script>

</body>

</html>
