@php
    use App\Models\Settings\WebsIdentity;

    $identitas = WebsIdentity::find(1);

@endphp
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <title>{{ $title . ' |' ?? '' }} {{ env('APP_NAME') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="MyraStudio" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('images/' . $identitas->favicon) }}">

    <!-- App css -->
    <link href="{{ asset('assets_admin/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets_admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets_admin/css/theme.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets_admin/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets_admin/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets_admin/plugins/dropify/dropify.min.css') }}" rel="stylesheet" type="text/css" />

    @livewireStyles
    @stack('styles')
    @livewireScripts

    <style>

        @media screen and (max-width: 1199px) {
            .card-costume {
                border: solid 1px #7266bc;
                border-radius: 0.7rem;
                height: 407px;
            }
        }

        @media screen and (max-width: 992px) {
            .card-costume {
                border: solid 1px #7266bc;
                border-radius: 0.7rem;
                height: 387px;
            }
        }

        @media screen and (max-width: 767px) {
            .card-costume {
                border: solid 1px #7266bc;
                border-radius: 0.7rem;
                height: 427px;
            }
        }

        @media screen and (min-width: 1200px) {
            .card-costume {
                border: solid 1px #7266bc;
                border-radius: 0.7rem;
                height: 387px;
            }
        }
        </style>

</head>

<body>
    <!-- Begin page -->
    <div id="layout-wrapper">

        @livewire('p-a.components.header')

        <!-- ========== Left Sidebar Start ========== -->
        @livewire('p-a.components.sidebar')
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                {{ $slot }}
            </div>
            <!-- End Page-content -->

            <footer class="footer">
                @livewire('p-a.components.footer')
            </footer>

        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Overlay-->
    <div class="menu-overlay"></div>

    <!-- jQuery  -->
    <script src="{{ asset('assets_admin/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets_admin/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets_admin/js/metismenu.min.js') }}"></script>
    <script src="{{ asset('assets_admin/js/waves.js') }}"></script>
    <script src="{{ asset('assets_admin/js/simplebar.min.js') }}"></script>

    <!-- Morris Js-->
    <script src="{{ asset('plugins/morris-js/morris.min.js') }}"></script>
    <!-- Raphael Js-->
    <script src="{{ asset('plugins/raphael/raphael.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets_admin/js/theme.js') }}"></script>

    <script type="text/javascript">
        window.livewire.on('closeModal', () => {
            $('.modal').modal('hide');
        });
    </script>

    <!-- SWEETALERT -->
    <script src="{{ asset('plugins/sweetalert/sweatalert2@11') }}"></script>
    <script src="{{ asset('plugins/sweetalert/toastr.min.js') }}"></script>
    <script src="{{ asset('assets_admin/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets_admin/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets_admin/plugins/dropify/dropify.min.js') }}"></script>
    <script src="{{ asset('assets_admin/pages/fileuploads-demo.js') }}"></script>
    <script src="{{ asset('assets_admin/js/theme.js') }}"></script>

    @stack('script')

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
