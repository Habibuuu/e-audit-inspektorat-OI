<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <title>{{ $title . ' |' ?? '' }} {{ env('APP_NAME') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="{{ $title . ' |' ?? '' }} {{ env('APP_NAME') }}" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('') }}assets_admin/images/favicon.ico">

    <!-- App css -->
    <link href="{{ asset('assets_admin/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets_admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets_admin/css/theme.min.css') }}" rel="stylesheet" type="text/css" />

    @livewireStyles
    @stack('styles')
    @livewireScripts

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center min-vh-100">
                        <div class="w-100 d-block bg-white shadow-lg rounded my-5">
                            {{$slot}}
                        </div> <!-- end .w-100 -->
                    </div> <!-- end .d-flex -->
                </div> <!-- end col-->
            </div> <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <!-- jQuery  -->
    <script src="{{ asset('assets_admin/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets_admin/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets_admin/js/metismenu.min.js') }}"></script>
    <script src="{{ asset('assets_admin/js/waves.js') }}"></script>
    <script src="{{ asset('assets_admin/js/simplebar.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets_admin/js/theme.js') }}"></script>

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
