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
                            <i class="ficon" data-feather="package"></i>&nbsp; Kelola Konten
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ url('/content-dashboard') }}">Dashboard</a>
                            <a class="dropdown-item" href="{{ url('/categories') }}">Kategori</a>
                            <a class="dropdown-item" href="{{ url('/service-interruption') }}">Pemeliharaan</a>
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
                                    <i class="ficon" data-feather="check-circle"></i>&nbsp;&nbsp;
                                    @if ($pendingRequestsCount > 0)
                                    <span class="badge rounded-pill bg-danger badge-up small-badge">{{ $pendingRequestsCount }}</span>
                                    @endif
                                </div>&nbsp;
                                <span class="menu-title text-truncate" data-i18n="Permintaan Akses">
                                    Permintaan Akses
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


                <!-- @foreach($categories as $category)
                <li class="nav-item mt-2">
                    <a class="d-flex align-items-center" href="">
                        <i data-feather="circle"></i><span class="menu-title text-truncate" data-i18n="{{ $category->category_name }}">{{ $category->category_name }}</span>
                    </a>
                </li>
                @endforeach -->


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
                <h3>Kelola Permintaan</h3>
                <p class="mb-2">
                    Kelola izin akses pengguna untuk akses dashboard.
                </p>

                <!-- table -->
                <section id="basic-tabs-components">
                    <div class="row match-height">
                        <!-- Basic Tabs starts -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" aria-controls="home" role="tab" aria-selected="true">Terbaru</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" aria-controls="profile" role="tab" aria-selected="false">Diberikan</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="rejected-tab" data-bs-toggle="tab" href="#rejected" aria-controls="rejected" role="tab" aria-selected="false">Ditolak</a>
                                            </li>
                                        </ul>
                                        <div>
                                            @if ($pendingRequests->isNotEmpty())
                                            <button class="btn btn-sm btn-outline-primary ms-2" id="approveAllRequestsBtn">
                                                Persetujuan Cepat
                                            </button>&nbsp;
                                            @endif
                                            <button class="btn btn-sm btn-primary" data-bs-target="#addRoleModal" data-bs-toggle="modal">
                                                <i data-feather='plus'></i>&nbsp; Tambah Akses
                                            </button>
                                        </div>
                                    </div>


                                    <div class="tab-content">
                                        <div class="tab-pane active" id="home" aria-labelledby="home-tab" role="tabpanel">
                                            <div class="card-datatable table-responsive pt-0">
                                                <table id="request" class="table table-hover" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            @if ($pendingRequests->isNotEmpty())
                                                            <th>
                                                                <input type="checkbox" id="selectAllCheckbox"> <!-- Checkbox di header -->
                                                            </th>
                                                            @endif
                                                            <th>Nama Penerima</th>
                                                            <th>Jenis Izin</th>
                                                            <th>Job Title</th>
                                                            <th>Status</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($requests as $r)
                                                        <tr>
                                                            @if ($pendingRequests->isNotEmpty())
                                                            <td>
                                                                <input type="checkbox" class="row-checkbox" data-request-id="{{ $r->request_id }}">
                                                            </td>
                                                            @endif
                                                            <td>
                                                                <span class=""> {{ ucwords(strtolower($r->name)) }}</span>
                                                                <br>
                                                                <small class="text-muted">{{ $r->email }}</small>
                                                            </td>
                                                            <td><span class="">{{ $r->dashboard_name }}</span></td>
                                                            <td><span class="text-primary">{{ $r->departement }}</span></td>
                                                            <td>
                                                                @if ($r->request_status == 0)
                                                                <span class="badge badge-glow bg-warning">Pending</span>
                                                                @else
                                                                <span class="badge badge-glow bg-success">Approve</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($r->request_status == 0)
                                                                <div class="btn-group">
                                                                    <a href="#" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#detailRequest_{{ $r->request_id }}">
                                                                        View
                                                                    </a>
                                                                </div>
                                                                @else

                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        <!-- Add more rows as needed -->
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="profile" aria-labelledby="profile-tab" role="tabpanel">
                                            <p>
                                            <div class="card-datatable table-responsive pt-0">
                                                <table id="examples" class="table table-hover" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Nama Penerima</th>
                                                            <th>Job Title</th>
                                                            <th>Dashboard</th>
                                                            <th>Status</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($permission as $perm)
                                                        <tr>
                                                            <td>
                                                                <span class=""> {{ ucwords(strtolower($perm->user_name)) }}</span>
                                                                <br>
                                                                <small class="text-muted">{{ $perm->email }}</small>
                                                            </td>
                                                            <td>
                                                                @if (is_null($perm->job_title) || $perm->job_title === '')
                                                                <span class="text-danger">Unavailable</span>
                                                                @else
                                                                <span class="text-primary">{{ $perm->job_title }}</span>
                                                                @endif
                                                            </td>
                                                            <td>{{ $perm->dashboard_count }} Dashboard</td>
                                                            <td>
                                                                @if ($perm->dashboard_count == 0)
                                                                <span class="badge badge-glow bg-danger">Not active</span>
                                                                @else
                                                                <span class="badge badge-glow bg-success">Active</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <a href="{{ route('get.permissions', ['id' => $perm->user_id]) }}" class="btn btn-sm btn-primary">
                                                                        <i data-feather='settings'></i>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @endforeach

                                                        <!-- Add more rows as needed -->
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="rejected" aria-labelledby="profile-tab" role="tabpanel">
                                            <p>
                                            <div class="card-datatable table-responsive pt-0">
                                                <table id="reject" class="table table-hover" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Nama Penerima</th>
                                                            <th>Job title</th>
                                                            <th>Jenis Izin</th>
                                                            <th>Status</th>
                                                            <th>Waktu Permintaan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($rejected as $p)
                                                        <tr>
                                                            <td><span class=""> {{ ucwords(strtolower($p->name)) }}</span></td>
                                                            <td><span class="">{{ $p->departement }}</span></td>
                                                            <td>
                                                                @foreach (explode(',', $p->dashboard_id) as $dashboardId)
                                                                @php
                                                                $dashboard = DB::table('dashboard')->where('dashboard_id', $dashboardId)->first();
                                                                @endphp
                                                                {{ $dashboard->dashboard_name }}
                                                                @if (!$loop->last)
                                                                ,
                                                                @endif
                                                                @endforeach
                                                            </td>
                                                            <td>
                                                                <span class="badge badge-glow bg-danger">Rejected</span>
                                                            </td>
                                                            <td><span class="">{{ $p->request_date }}</span></td>
                                                        </tr>
                                                        @endforeach
                                                        <!-- Add more rows as needed -->
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Basic Tabs ends -->
                    </div>
                </section>


                <!-- table -->
                <!-- Add Role Modal -->
                <div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-role">
                        <div class="modal-content">
                            <div class="modal-header bg-transparent">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body px-5 pb-5">
                                <div class="text-center mb-4">
                                    <h1 class="role-title">Add Dashboard Access</h1>
                                </div>
                                <!-- Add role form -->
                                <form id="addRoleForm" class="row" action="{{ route('permissions.submit') }}" method="post">
                                    @csrf
                                    <div class="col-12">
                                        <label class="form-label" for="modalRoleName">Recipient email <small class="text-danger">*</small></label>

                                        <select name="recipient_email" class="select2 form-select" id="select2-basic">
                                            <option value="">Select an email</option>
                                        </select>
                                    </div>
                                    <div class="col-12 mt-1">
                                        <label class="form-label">Recipient name</label>
                                        <input type="text" id="recipient-name" name="recipient_name" class="form-control" placeholder="Automated recipient name" readonly>
                                    </div>
                                    <div class="col-12">
                                        <h5 class="mt-2 pt-50"><i data-feather="lock"></i>&nbsp; Permission</h5>
                                        <hr>
                                        <!-- Permission table -->
                                        <div class="table-responsive">
                                            <table id="exampless" class="table table-hover" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Dashboard</th>
                                                        <th>Permission</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($dashboards as $dashboard)
                                                    <tr>
                                                        <td>{{ $dashboard->dashboard_name }}</td>
                                                        <td>
                                                            <div class="d-flex">
                                                                <div class="form-check me-3 me-lg-5">
                                                                    <input
                                                                        type="checkbox"
                                                                        class="form-check-input"
                                                                        name="permissions[]"
                                                                        value="{{ $dashboard->dashboard_id }}"
                                                                        {{ $permissions->contains('dashboard_id', $dashboard->dashboard_id) ? 'checked' : '' }} />
                                                                    <label class="form-check-label" for="checkboxView{{ $dashboard->dashboard_id }}"></label>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- Permission table -->
                                    </div>
                                    <div class="col-12 text-center mt-2">
                                        <button type="submit" class="btn btn-primary me-1">Submit</button>
                                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                                            Discard
                                        </button>
                                    </div>
                                </form>
                                <!--/ Add role form -->
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Add Role Modal -->

                <!-- update modal -->
                @foreach($requests as $r)
                <div class="modal fade" id="detailRequest_{{ $r->request_id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-transparent">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body px-sm-5 mx-50 pb-5">
                                <h1 class="text-center mb-1" id="addNewCardTitle">Detail Permintaan</h1>
                                <p class="text-center">Detail permintaan untuk membuka izin dashboard</p>

                                <hr class="invoice-spacing pt-2" />

                                <!-- Address and Contact starts -->
                                <div class="card-body invoice-padding pt-2">
                                    <div class="row invoice-spacing">
                                        <div class="col-xl-8 p-0">
                                            <h6 class="mb-25">{{ $r->name }}</h6>
                                            <p class="text-muted mb-25">{{ $r->email }}</p>
                                            <p class="card-text text-primary mb-25 mt-1"><i>{{ $r->departement }}</i></p>
                                            <p class="card-text mb-0 mt-1"> <span class="badge badge-light-warning">Waiting for approval</span></p>
                                        </div>
                                        <div class="col-xl-4 p-0 mt-xl-0 mt-2">
                                            <h4 class="invoice-title">
                                                <span class="invoice-number">#{{ $r->application_number }}</span>
                                            </h4>
                                            <hr>
                                            <div class="invoice-date-wrapper">
                                                <p class="invoice-date-title"><b>Waktu Permintaan :</b> <br><span class="invoice-date">{{ \Carbon\Carbon::parse($r->permission_date)->format('j M Y, H:i') }}</span></p>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="alert alert-dark mb-2" role="alert">
                                    <h6 class="alert-heading">Alasan Pengajuan</h6>
                                    <div class="alert-body fw-normal"> {{ $r->reason }}</div>
                                </div>
                                <!-- Invoice Description ends -->

                                <hr class="invoice-spacing" />

                                <!-- Invoice Note starts -->
                                <div class="card-body invoice-padding pt-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <span class="fw-bold">Catatan:</span>
                                            <span>Komentar berikut berfungsi sebagai penjelasan yang direkam untuk permintaan untuk mengakses dasbor. Terima kasih!</span>
                                        </div>
                                    </div>

                                    <!-- Button section starts -->
                                    <div class="row mt-4">
                                        <div class="col-12 text-center">
                                            <a href="{{ route('approve.permission.request', ['requestId' => $r->request_id]) }}" class="btn btn-success">Approve</a>&nbsp;
                                            <a href="{{ route('reject.permission.request', ['requestId' => $r->request_id]) }}" class="btn btn-danger">
                                                Reject
                                            </a>
                                        </div>
                                    </div>
                                    <!-- Button section ends -->
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <script>
        $(document).ready(function() {
            $('#select2-basic').select2();

            // Function to show loading Swal
            function showLoading() {
                Swal.fire({
                    title: 'Please Wait',
                    allowOutsideClick: false,
                    showCancelButton: false,
                    showConfirmButton: false,
                    timerProgressBar: true,
                    onBeforeOpen: () => {
                        Swal.showLoading();
                    }
                });
            }

            // Function to close Swal
            function closeLoading() {
                Swal.close();
            }

            // Fetch emails and populate the dropdown
            $.ajax({
                url: "{{ route('recipient-emails') }}", // Define a route to fetch emails
                type: 'GET',
                success: function(response) {
                    if (response.success) {
                        // Clear existing options
                        $('#select2-basic').empty();
                        $('#select2-basic').append('<option value="">Select an email</option>'); // Placeholder option

                        // Populate the dropdown with emails
                        $.each(response.emails, function(index, email) {
                            $('#select2-basic').append('<option value="' + email.email + '">' + email.email + '</option>');
                        });
                    } else {
                        Swal.fire('Error', 'Error: ' + response.message, 'error');
                    }
                },
                error: function() {
                    Swal.fire('Error', 'An error occurred while fetching emails.', 'error');
                }
            });

            // Handle email selection change
            $('#select2-basic').on('change', function() {
                var selectedEmail = $(this).val();
                if (selectedEmail) {
                    showLoading(); // Show loading indicator when an email is selected
                    $.ajax({
                        url: "{{ route('recipient-details') }}", // Use the named route here
                        type: 'GET',
                        data: {
                            email: selectedEmail
                        },
                        success: function(response) {
                            if (response.success) {
                                $('#recipient-name').val(response.name);
                                $('#recipient-job-title').val(response.job_title);
                            } else {
                                Swal.fire('Error', 'Error: ' + response.message, 'error');
                            }
                        },
                        error: function() {
                            Swal.fire('Error', 'An error occurred while fetching recipient details.', 'error');
                        },
                        complete: function() {
                            closeLoading(); // Close loading indicator after the request completes
                        }
                    });
                } else {
                    $('#recipient-name').val('');
                    $('#recipient-job-title').val('');
                }
            });
        });
    </script>


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

    <div>
        {!! $footer !!}
    </div>