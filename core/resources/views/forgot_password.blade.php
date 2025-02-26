<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Forgot Password</title>
    <link rel="apple-touch-icon" href="{{ asset('app-assets/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/tsel_ico.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/bordered-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/semi-dark-layout.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/authentication.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <!-- END: Custom CSS-->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.6/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.6/dist/sweetalert2.all.min.js"></script>
    <script src="https://unpkg.com/exceljs/dist/exceljs.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- Tambahkan script toastr CDN -->
    <link href="https://unpkg.com/toastr@2.1.4/build/toastr.min.css" rel="stylesheet">
    <script src="https://unpkg.com/toastr@2.1.4/build/toastr.min.js"></script>


</head>
<!-- END: Head-->

<style>
    .center-content {
        display: flex;
        justify-content: center;
    }

    .image-icon {
        margin-right: 10px;
    }
</style>

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="auth-wrapper auth-cover">
                    <div class="auth-inner row m-0">
                        <!-- Left Text-->
                        <div class="d-none d-lg-flex col-lg-7 align-items-center p-5">
                            @if(!isset($email))
                            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid" src="{{ asset('app-assets/images/pages/forgot-password-v2.svg') }}" alt="Login V2" /></div>
                            @else
                            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid" src="{{ asset('app-assets/images/pages/reset-password-v2.svg') }}" alt="Login V2" /></div>
                            @endif
                        </div>
                        <!-- /Left Text-->
                        <!-- Login-->
                        <div class="d-flex col-lg-5 align-items-center auth-bg px-2 p-lg-5">
                            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                                @if(!isset($email))
                                <h2 class="card-title font-weight-bold mb-1">Forgot Password</h2>
                                <p class="card-text mb-2">Enter your email and we'll send you instructions to reset your password</p>
                                @else
                                <h2 class="card-title font-weight-bold mb-1">Reset Password</h2>
                                <p class="card-text mb-2">Your new password must be different from previously used passwords</p>
                                @endif
                                <hr>

                                @if(!isset($email))
                                <!-- Form cek email -->
                                <form action="{{ route('forgot.password.check') }}" method="GET">
                                    @csrf
                                    <br>
                                    <div class="mb-1">
                                        <input class="form-control" id="login-email" type="email" name="email" placeholder="Enter your email address" aria-describedby="login-email" autofocus="" tabindex="1" value="{{ old('email') }}" />
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 mt-1" tabindex="4">Submit</button>
                                </form>
                                @else
                                <!-- Form reset password -->
                                <form action="{{ route('forgot.password.reset') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="email" value="{{ $email }}">

                                    <div class="mb-1">
                                        <input class="form-control" type="password" name="password" placeholder="Enter your new password" aria-describedby="login-email" autofocus="" tabindex="1" value="{{ old('email') }}" />
                                    </div>

                                    <div class="mb-1">
                                        <input class="form-control" type="password" name="password_confirmation" placeholder="Repeat your new password" aria-describedby="login-email" autofocus="" tabindex="1" value="{{ old('email') }}" />
                                    </div>

                                    <button type="submit" class="btn btn-success w-100 mt-1" tabindex="4">Reset Password</button>
                                </form>
                                @endif
                            </div>
                        </div>
                        <!-- /Login-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('app-assets/js/core/app.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('app-assets/js/scripts/pages/auth-login.js') }}"></script>
    <!-- END: Page JS-->

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>

    <!-- @if(Session::has('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Registrasi Berhasil',
            text: '{!! Session::get("success") !!}',
        });
    </script>
    @endif -->

    @if(Session::has('error'))
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right", // Posisi pesan flash, Anda dapat mengganti dengan "toast-top-left", "toast-top-center", dll.
            "showDuration": "200",
            "hideDuration": "800",
            "timeOut": "5000", // Waktu tampilan pesan flash dalam milidetik
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "slideDown", // Animasi slide-in saat muncul
            "hideMethod": "slideUp", // Animasi slide-out saat menghilang
        };
        toastr.error('{!! Session::get("error") !!}', 'Oopss..', {
            "progressBar": true,
            "timeOut": 5000
        });
    </script>
    @endif


</body>
<!-- END: Body-->

</html>