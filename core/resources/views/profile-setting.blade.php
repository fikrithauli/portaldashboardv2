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
    <title>Analytics Dashboard - AAGM</title>
    <link rel="shortcut icon" type="image/x-icon" href="https://upload.wikimedia.org/wikipedia/commons/b/bc/Telkomsel_2021_icon.svg">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/charts/apexcharts.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/toastr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css') }}">
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
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/dashboard-ecommerce.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/charts/chart-apex.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/extensions/ext-component-toastr.css') }}">

    <!-- Datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.6/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.6/dist/sweetalert2.all.min.js"></script>
    <script src="https://unpkg.com/exceljs/dist/exceljs.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

    <!-- Tambahkan script toastr CDN -->
    <link href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>



    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

</head>
<!-- END: Head-->

<style>
    /* Menerapkan transisi pada elemen saat disentuh (hovered) */
    ul.nav li.nav-item a.nav-link:hover {
        animation: shake-once 0.5s ease-in-out;
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .header-content {
        flex: 1;
    }

    .action-button-container {
        display: flex;
        align-items: center;
    }

    .action-button {
        margin-left: 10px;
    }

    div.dataTables_wrapper div.dataTables_filter {
        text-align: right;
        margin-right: 13px;
    }

    div.dataTables_wrapper div.dataTables_paginate {
        text-align: right;
        margin-right: 13px;
        margin-top: 10px;
        margin-bottom: 20px;
    }

    div.dataTables_wrapper .dataTables_length {
        text-align: left;
        margin-left: 13px;
    }

    div.dataTables_wrapper .dataTables_info {
        text-align: left;
        margin-left: 13px;
        margin-bottom: 10px;
    }

    .hr-gradient {
        height: 4px;
        border: none;
        background-image: linear-gradient(to right, #8A2BE2 50%, #FF8C00 50%);
    }

    .img-container {
        width: 70%;
        height: 75px;
        position: relative;
    }

    .img-container .image-wrapper {
        width: 100%;
        height: 100%;
        overflow: hidden;
    }

    .img-container .image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .product-box {
        width: 100%;
        max-width: 300px;
        /* Sesuaikan dengan lebar maksimum yang Anda inginkan */
        margin-bottom: 20px;
        /* Gaya lain yang diperlukan untuk tata letak, warna latar belakang, dll. */
    }

    .product-box .product-img {
        position: relative;
        overflow: hidden;
        /* Gaya lain yang diperlukan untuk tata letak, padding, dll. */
    }

    .product-box .product-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* Gaya lain yang diperlukan untuk tata letak, padding, dll. */
    }

    /* Gaya lain yang diperlukan untuk tata letak teks, harga, dll. */

    .btn {
        position: relative;
        overflow: hidden;
        transition: transform 0.3s ease-in-out;
    }

    .btn:hover {
        transform: translateY(-3px);
    }

    .btn::after {
        content: '';
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        height: 3px;
        background-color: #000;
        transition: transform 0.3s ease-in-out;
        transform: scaleX(0);
        transform-origin: left;
    }

    .btn:hover::after {
        transform: scaleX(1);
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .btn i.fa-cog {
        animation: spin 2s linear infinite;
    }

    .modal-refer-earn-step {
        position: relative;
    }

    .modal-refer-earn-step i {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .modal-refer-earn-step .text-center {
        position: absolute;
        top: 50%;
        left: 100%;
        transform: translate(10px, -50%);
        white-space: nowrap;
    }

    .form-check {
        margin-bottom: 18px;
        /* Adjust the margin to add space between the checkboxes */
    }
</style>

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">

    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl">
        <div class="navbar-container d-flex content">
            <div class="bookmark-wrapper d-flex align-items-center">
                <ul class="nav navbar-nav d-xl-none">
                    <li class="nav-item"><a class="nav-link menu-toggle" href="#"><i class="ficon" data-feather="menu"></i></a></li>
                </ul>
                <ul class="nav navbar-nav bookmark-icons">
                    <li class="nav-item d-none d-lg-block"><a class="nav-link" href="{{ url('/home') }}"><i class="ficon" data-feather="home"></i>&nbsp; Home</a></li>&nbsp;&nbsp;

                    @if(Auth::user()->role_id == 1)
                    <li class="nav-item dropdown d-none d-lg-block">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ficon" data-feather="package"></i>&nbsp; Content Management
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ url('/categories') }}">Categories List</a>
                            <a class="dropdown-item" href="{{ url('/content-dashboard') }}">Dashboard List</a>
                            <a class="dropdown-item" href="{{ url('/service-interruption') }}">Under Maintenance</a>
                            <!-- Tambahkan menu-item lainnya jika diperlukan -->
                        </div>
                    </li>&nbsp;&nbsp;

                    @php
                    $pendingRequestsCount = DB::table('permission_request')->where('request_status', 0)->count();
                    @endphp
                    <li class="nav-item dropdown-notification me-25">
                        <a class="nav-link" href="{{ url('/permission') }}">
                            <div class="d-flex align-items-center">
                                <div class="position-relative">
                                    <i class="ficon" data-feather="shield"></i>&nbsp;&nbsp;
                                    @if ($pendingRequestsCount > 0)
                                    <span class="badge rounded-pill bg-danger badge-up small-badge">{{ $pendingRequestsCount }}</span>
                                    @endif
                                </div>&nbsp;
                                <span class="menu-title text-truncate" data-i18n="Roles &amp; Permission">
                                    Roles &amp; Permission
                                </span>
                            </div>
                        </a>
                    </li>&nbsp;&nbsp;

                    <li class="nav-item d-none d-lg-block"><a class="nav-link" href="{{ url('/user-management') }}"><i class="ficon" data-feather="users"></i>&nbsp; User Management</a></li>&nbsp;&nbsp;
                    @endif
                </ul>

            </div>
            <ul class="nav navbar-nav align-items-center ms-auto">
                @if(Auth::check())
                <li class="nav-item dropdown dropdown-user">
                    <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-nav d-sm-flex d-none">
                            <span class="user-name fw-bolder">Hi, {{ Auth::user()->name }}</span>
                            @if (Auth::user()->role_id == 1)
                            <span class="user-status">Administrator</span>
                            @elseif (Auth::user()->role_id == 2)
                            @if (Auth::user()->job_title)
                            <span class="user-status">{{ Auth::user()->job_title }}</span>
                            @else
                            <span class="user-status">Users</span>
                            @endif
                            @endif
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                        <a class="dropdown-item" href="{{ url('profile-settings') }}"><i class="me-50" data-feather="settings"></i> Pengaturan</a>
                        <a class="dropdown-item" href="{{ url('/settings') }}"><i class="me-50" data-feather="help-circle"></i> Riwayat Log</a>
                        <div class="dropdown-divider"></div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="me-50" data-feather="power"></i> Keluar</a>
                    </div>
                </li>
                @endif

            </ul>
        </div>
    </nav>
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item me-auto">
                    <img src="{{ asset('tsel.png') }}" width="170" alt="">
                </li>
                <!-- <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li> -->
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="navigation-header mt-3">
                    <span data-i18n="Pencarian">Pencarian</span>
                    <i data-feather="more-horizontal"></i>
                </li>

                <li class="nav-item mt-2">
                    <div class="row">
                        &nbsp;&nbsp;&nbsp;
                        <div class="col-md-11">
                            <form action="{{ route('search') }}" method="GET" class="input-group">
                                <input type="text" class="form-control" name="keyword" placeholder="Berdasarkan nama" />
                                <button type="submit" class="btn btn-danger"><i data-feather="search"></i></button>
                            </form>

                        </div>
                    </div>
                </li>

                <li class="navigation-header mt-2">
                    <span data-i18n="Kategori">Kategori</span>
                    <i data-feather="more-horizontal"></i>
                </li>

                <li class="nav-item mt-2">
                    <div class="row">
                        &nbsp;&nbsp;&nbsp;
                        <div class="col-md-11">
                            <form action="{{ route('filterByCategoryView') }}" method="GET" class="input-group" id="filterForm">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input category-filter" type="radio" name="category_id"
                                                id="allCategories" value="all" {{ request('category_id') == 'all' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="allCategories">Semua Kategori</label>
                                        </div>
                                        @foreach($categories as $category)
                                        <div class="form-check">
                                            <input class="form-check-input category-filter" type="radio" name="category_id"
                                                id="category{{ $category->category_id }}" value="{{ $category->category_id }}"
                                                {{ request('category_id') == $category->category_id ? 'checked' : '' }}>
                                            <label class="form-check-label" for="category{{ $category->category_id }}">{{ $category->category_name }}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div id="filterResult">
                        <!-- Tempat untuk menampilkan data filter -->
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- users edit start -->
                <section id="page-account-settings">
                    <div class="row">

                        <!-- right content section -->
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <section id="basic-tabs-components">
                                        <div class="row match-height">
                                            <!-- Basic Tabs starts -->
                                            <div class="col-xl-12 col-lg-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <ul class="nav nav-tabs" role="tablist">
                                                                <li class="nav-item">
                                                                    <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" aria-controls="home" role="tab" aria-selected="true">Profil Saya</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" aria-controls="profile" role="tab" aria-selected="false">Ubah Password</a>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                        <div class="tab-content">
                                                            <div class="tab-pane active" id="home" aria-labelledby="home-tab" role="tabpanel">
                                                                <p>
                                                                <form action="{{ route('profile-update', $user->id) }}" method="post" enctype="multipart/form-data" class="mt-2">
                                                                    @csrf
                                                                    <div class="media">
                                                                        <a href="javascript:void(0);" class="mr-25">
                                                                            <img src="{{ $user->avatar ? asset('core/uploads/avatar/' . $user->avatar) : asset('profile.jpg') }}" id="account-upload-img" class="rounded mr-50" alt="profile image" height="80" width="80" />
                                                                        </a>
                                                                        <!-- upload and reset button -->
                                                                        <div class="media-body mt-75 ml-1">
                                                                            <label for="account-upload" class="btn btn-sm btn-danger mb-75 mr-75">Upload</label>
                                                                            <input type="file" id="account-upload" name="avatar" hidden accept="image/*" />
                                                                            <button id="reset" type="button" class="btn btn-sm btn-outline-secondary mb-75" onclick="resetAvatar()">Reset</button>
                                                                            <p class="text-muted">Diizinkan JPG atau PNG.</p>
                                                                        </div>
                                                                        <!--/ upload and reset button -->
                                                                    </div>
                                                                    <!--/ header media -->

                                                                    <hr>

                                                                    <!-- form -->
                                                                    <div class="row">
                                                                        <div class="col-12 col-sm-6 mb-1">
                                                                            <div class="form-group">
                                                                                <label for="account-username">Username</label>
                                                                                <input type="text" class="form-control" id="account-username" name="name" value="{{ $user->name }}" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12 col-sm-6 mb-1">
                                                                            <div class="form-group">
                                                                                <label for="account-e-mail">E-mail</label>
                                                                                <input type="email" class="form-control" id="account-e-mail" name="email" value="{{ $user->email }}" readonly />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12 col-sm-6 mb-1">
                                                                            <div class="form-group">
                                                                                <label for="account-e-mail">Microsoft ID</label>
                                                                                <input
                                                                                    type="text"
                                                                                    class="form-control"
                                                                                    id="account-e-mail"
                                                                                    name="email"
                                                                                    value="{{ $user->microsoft_id ?? '-' }}"
                                                                                    readonly />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12 col-sm-6 mb-1">
                                                                            <div class="form-group">
                                                                                <label for="account-e-mail">Job Title</label>
                                                                                <input type="text" class="form-control" id="account-e-mail" name="email" value="{{ $user->job_title ?? '-' }}" readonly />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12 mt-75">
                                                                            <div class="alert alert-danger mb-50" role="alert">
                                                                                <h4 class="alert-heading" style="font-size: 12px;">Email yang terdaftar akan menerima notifikasi permohonan akses ke dashboard.</h4>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <button type="submit" class="btn btn-danger mt-2 mr-1">Simpan</button>
                                                                            <button type="reset" class="btn btn-outline-secondary mt-2">Batalkan</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                                </p>
                                                            </div>
                                                            <div class="tab-pane" id="profile" aria-labelledby="profile-tab" role="tabpanel">
                                                                <p>
                                                                <form class="validate-form" method="POST" action="{{ route('password.update') }}">
                                                                    @csrf
                                                                    <div class="row">
                                                                        <div class="col-12 col-sm-6">
                                                                            <div class="form-group">
                                                                                <label for="account-new-password">Kata Sandi Baru</label>
                                                                                <div class="input-group form-password-toggle input-group-merge">
                                                                                    <input type="password" id="account-new-password" name="new-password" class="form-control" placeholder="Kata Sandi Baru" required />
                                                                                </div>
                                                                                @error('new-password')
                                                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12 col-sm-6">
                                                                            <div class="form-group">
                                                                                <label for="account-retype-new-password">Ulangi Kata Sandi</label>
                                                                                <div class="input-group form-password-toggle input-group-merge">
                                                                                    <input type="password" class="form-control" id="account-retype-new-password" name="new-password_confirmation" placeholder="Ulangi Kata Sandi" required />
                                                                                </div>
                                                                                @error('new-password_confirmation')
                                                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <button type="submit" class="btn btn-danger mr-1 mt-1">Simpan</button>
                                                                            <button type="reset" class="btn btn-outline-secondary mt-1">Batalkan</button>
                                                                        </div>
                                                                    </div>
                                                                </form>

                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Basic Tabs ends -->
                                        </div>
                                    </section>

                                    <div class="tab-content">
                                        <!-- general tab -->

                                        <!--/ general tab -->

                                        <!-- change password -->
                                        <div class="tab-pane fade" id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="false">
                                            <!-- form -->
                                            <form class="validate-form">
                                                <div class="row">
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="account-old-password">Old Password</label>
                                                            <div class="input-group form-password-toggle input-group-merge">
                                                                <input type="password" class="form-control" id="account-old-password" name="password" placeholder="Old Password" />
                                                                <div class="input-group-append">
                                                                    <div class="input-group-text cursor-pointer">
                                                                        <i data-feather="eye"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="account-new-password">New Password</label>
                                                            <div class="input-group form-password-toggle input-group-merge">
                                                                <input type="password" id="account-new-password" name="new-password" class="form-control" placeholder="New Password" />
                                                                <div class="input-group-append">
                                                                    <div class="input-group-text cursor-pointer">
                                                                        <i data-feather="eye"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="account-retype-new-password">Retype New Password</label>
                                                            <div class="input-group form-password-toggle input-group-merge">
                                                                <input type="password" class="form-control" id="account-retype-new-password" name="confirm-new-password" placeholder="New Password" />
                                                                <div class="input-group-append">
                                                                    <div class="input-group-text cursor-pointer"><i data-feather="eye"></i></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <button type="submit" class="btn btn-primary mr-1 mt-1">Save changes</button>
                                                        <button type="reset" class="btn btn-outline-secondary mt-1">Cancel</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <!--/ form -->
                                        </div>
                                        <!--/ change password -->

                                        <!-- information -->
                                        <div class="tab-pane fade" id="account-vertical-info" role="tabpanel" aria-labelledby="account-pill-info" aria-expanded="false">
                                            <!-- form -->
                                            <form class="validate-form">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="accountTextarea">Bio</label>
                                                            <textarea class="form-control" id="accountTextarea" rows="4" placeholder="Your Bio data here..."></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="account-birth-date">Birth date</label>
                                                            <input type="text" class="form-control flatpickr" placeholder="Birth date" id="account-birth-date" name="dob" />
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="accountSelect">Country</label>
                                                            <select class="form-control" id="accountSelect">
                                                                <option>USA</option>
                                                                <option>India</option>
                                                                <option>Canada</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="account-website">Website</label>
                                                            <input type="text" class="form-control" name="website" id="account-website" placeholder="Website address" />
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="account-phone">Phone</label>
                                                            <input type="text" class="form-control" id="account-phone" placeholder="Phone number" value="(+656) 254 2568" name="phone" />
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <button type="submit" class="btn btn-primary mt-1 mr-1">Save changes</button>
                                                        <button type="reset" class="btn btn-outline-secondary mt-1">Cancel</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <!--/ form -->
                                        </div>
                                        <!--/ information -->

                                        <!-- social -->
                                        <div class="tab-pane fade" id="account-vertical-social" role="tabpanel" aria-labelledby="account-pill-social" aria-expanded="false">
                                            <!-- form -->
                                            <form class="validate-form">
                                                <div class="row">
                                                    <!-- social header -->
                                                    <div class="col-12">
                                                        <div class="d-flex align-items-center mb-2">
                                                            <i data-feather="link" class="font-medium-3"></i>
                                                            <h4 class="mb-0 ml-75">Social Links</h4>
                                                        </div>
                                                    </div>
                                                    <!-- twitter link input -->
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="account-twitter">Twitter</label>
                                                            <input type="text" id="account-twitter" class="form-control" placeholder="Add link" value="https://www.twitter.com" />
                                                        </div>
                                                    </div>
                                                    <!-- facebook link input -->
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="account-facebook">Facebook</label>
                                                            <input type="text" id="account-facebook" class="form-control" placeholder="Add link" />
                                                        </div>
                                                    </div>
                                                    <!-- google plus input -->
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="account-google">Google+</label>
                                                            <input type="text" id="account-google" class="form-control" placeholder="Add link" />
                                                        </div>
                                                    </div>
                                                    <!-- linkedin link input -->
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="account-linkedin">LinkedIn</label>
                                                            <input type="text" id="account-linkedin" class="form-control" placeholder="Add link" value="https://www.linkedin.com" />
                                                        </div>
                                                    </div>
                                                    <!-- instagram link input -->
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="account-instagram">Instagram</label>
                                                            <input type="text" id="account-instagram" class="form-control" placeholder="Add link" />
                                                        </div>
                                                    </div>
                                                    <!-- Quora link input -->
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="account-quora">Quora</label>
                                                            <input type="text" id="account-quora" class="form-control" placeholder="Add link" />
                                                        </div>
                                                    </div>

                                                    <!-- divider -->
                                                    <div class="col-12">
                                                        <hr class="my-2" />
                                                    </div>

                                                    <div class="col-12 mt-1">
                                                        <!-- profile connection header -->
                                                        <div class="d-flex align-items-center mb-3">
                                                            <i data-feather="user" class="font-medium-3"></i>
                                                            <h4 class="mb-0 ml-75">Profile Connections</h4>
                                                        </div>

                                                        <div class="row">
                                                            <!-- twitter user -->
                                                            <div class="col-6 col-md-3 text-center mb-1">
                                                                <p class="font-weight-bold">Your Twitter</p>
                                                                <div class="avatar mb-1">
                                                                    <span class="avatar-content">
                                                                        <img src="../../../app-assets/images/avatars/11-small.png" alt="avatar img" width="40" height="40" />
                                                                    </span>
                                                                </div>
                                                                <p class="mb-0">@johndoe</p>
                                                                <a href="javascript:void(0)">Disconnect</a>
                                                            </div>
                                                            <!-- facebook button -->
                                                            <div class="col-6 col-md-3 text-center mb-1">
                                                                <p class="font-weight-bold mb-2">Your Facebook</p>
                                                                <button class="btn btn-outline-primary">Connect</button>
                                                            </div>
                                                            <!-- google user -->
                                                            <div class="col-6 col-md-3 text-center mb-1">
                                                                <p class="font-weight-bold">Your Google</p>
                                                                <div class="avatar mb-1">
                                                                    <span class="avatar-content">
                                                                        <img src="../../../app-assets/images/avatars/3-small.png" alt="avatar img" width="40" height="40" />
                                                                    </span>
                                                                </div>
                                                                <p class="mb-0">@luraweber</p>
                                                                <a href="javascript:void(0)">Disconnect</a>
                                                            </div>
                                                            <!-- github button -->
                                                            <div class="col-6 col-md-3 text-center mb-2">
                                                                <p class="font-weight-bold mb-1">Your GitHub</p>
                                                                <button class="btn btn-outline-primary">Connect</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <!-- submit and cancel button -->
                                                        <button type="submit" class="btn btn-primary mr-1 mt-1">Save changes</button>
                                                        <button type="reset" class="btn btn-outline-secondary mt-1">Cancel</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <!--/ form -->
                                        </div>
                                        <!--/ social -->

                                        <!-- notifications -->
                                        <div class="tab-pane fade" id="account-vertical-notifications" role="tabpanel" aria-labelledby="account-pill-notifications" aria-expanded="false">
                                            <div class="row">
                                                <h6 class="section-label mx-1 mb-2">Activity</h6>
                                                <div class="col-12 mb-2">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" checked id="accountSwitch1" />
                                                        <label class="custom-control-label" for="accountSwitch1">
                                                            Email me when someone comments onmy article
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" checked id="accountSwitch2" />
                                                        <label class="custom-control-label" for="accountSwitch2">
                                                            Email me when someone answers on my form
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" id="accountSwitch3" />
                                                        <label class="custom-control-label" for="accountSwitch3">Email me hen someone follows me</label>
                                                    </div>
                                                </div>
                                                <h6 class="section-label mx-1 mt-2">Application</h6>
                                                <div class="col-12 mt-1 mb-2">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" checked id="accountSwitch4" />
                                                        <label class="custom-control-label" for="accountSwitch4">News and announcements</label>
                                                    </div>
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" checked id="accountSwitch6" />
                                                        <label class="custom-control-label" for="accountSwitch6">Weekly product updates</label>
                                                    </div>
                                                </div>
                                                <div class="col-12 mb-75">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" id="accountSwitch5" />
                                                        <label class="custom-control-label" for="accountSwitch5">Weekly blog digest</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary mt-2 mr-1">Save changes</button>
                                                    <button type="reset" class="btn btn-outline-secondary mt-2">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/ notifications -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ right content section -->
                    </div>
                </section>
                <!-- users edit ends -->

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const categoryRadios = document.querySelectorAll(".category-filter");
            const categoryForm = document.getElementById("filterForm");

            categoryRadios.forEach((radio) => {
                radio.addEventListener("change", function() {
                    categoryForm.submit();
                });
            });
        });
    </script>

    <script>
        function resetAvatar() {
            // Menampilkan avatar default atau menghapus gambar dari tampilan
            document.getElementById('account-upload-img').src = '{{ asset("profile.jpg") }}'; // Atau URL gambar default

            // Menghapus file input (jika perlu)
            document.getElementById('account-upload').value = '';

            // Mengirimkan permintaan ke backend untuk menghapus avatar
            fetch('{{ route("avatar-reset", $user->id) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        _method: 'DELETE' // Menggunakan method DELETE untuk menghapus data
                    })
                }).then(response => response.json())
                .then(data => {
                    if (data.success) {
                        toastr.success('Avatar berhasil dihapus!', {
                            timeOut: 5000
                        });
                    } else {
                        toastr.error('Terjadi kesalahan saat menghapus avatar.', {
                            timeOut: 5000
                        });
                    }
                });
        }
    </script>

    <script>
        document.querySelector('.validate-form').addEventListener('submit', function(e) {
            var newPassword = document.getElementById('account-new-password').value;
            var confirmPassword = document.getElementById('account-retype-new-password').value;

            if (newPassword !== confirmPassword) {
                // Jika password tidak cocok, tampilkan pesan error
                document.getElementById('password-error').style.display = 'inline';
                e.preventDefault(); // Hentikan pengiriman form
            } else {
                document.getElementById('password-error').style.display = 'none';
            }
        });
    </script>

    <div>
        {!! $footer !!}
    </div>