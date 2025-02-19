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
                        <a class="dropdown-item" href="{{ url('/settings') }}"><i class="me-50" data-feather="help-circle"></i> Log history</a>
                        <div class="dropdown-divider"></div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="me-50" data-feather="power"></i> Logout</a>
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
                    <span data-i18n="Search">Search</span>
                    <i data-feather="more-horizontal"></i>
                </li>

                <li class="nav-item mt-2">
                    <div class="row">
                        &nbsp;&nbsp;&nbsp;
                        <div class="col-md-11">
                            <form action="{{ route('search') }}" method="GET" class="input-group">
                                <input type="text" class="form-control" name="keyword" placeholder="Dashboard name" />
                                <button type="submit" class="btn btn-primary"><i data-feather="search"></i></button>
                            </form>

                        </div>
                    </div>
                </li>

                <li class="navigation-header mt-2">
                    <span data-i18n="Categories">Categories</span>
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
                                            <label class="form-check-label" for="allCategories">All Categories</label>
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
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">&nbsp;Content Management</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active">Categories List
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="card">
                    <div class="card-header border-bottom">
                        <div class="header-content">
                            <h5 class="card-title">Categories List</h5>
                        </div>
                        <div class="action-button-container">
                            <button type="button" class="action-button btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addNewCard"><i data-feather='plus'></i>&nbsp; New categories</button>
                        </div>
                    </div>


                    <div class="card-datatable table-responsive pt-0">
                        <table id="example" class="table table-hover table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Categories</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $category->category_name }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i data-feather='settings'></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editCategoryModal{{ $category->category_id }}">Update</a>
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteCategoryModal{{ $category->category_id }}">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--/ Permission Table -->
                <br><br><br>

            </div>
        </div>
    </div>
    <!-- END: Content-->


    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <div class="modal fade" id="addNewCard" tabindex="-1" aria-labelledby="addNewCardTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-sm-5 mx-50 pb-5">
                    <h1 class="text-center mb-1" id="addNewCardTitle">Add New Categories</h1>
                    <p class="text-center">Add categories for dashboard details</p>
                    <hr>

                    <!-- form -->
                    <form id="addNewCardValidation" class="row gy-1 gx-2 mt-75" action="{{ route('categories.store') }}" method="post">
                        @csrf
                        <div class="col-12">
                            <label class="form-label" for="modalAddCardNumber">Categoeries Name</label>
                            <div class="input-group input-group-merge">
                                <input name="category_name" class="form-control" type="text" placeholder="Enter categories name" />
                            </div>
                        </div>

                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary me-1 mt-1">Submit</button>
                            <button type="reset" class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal" aria-label="Close">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- update kategori -->
    @foreach($categories as $category)
    <div class="modal fade" id="editCategoryModal{{ $category->category_id }}" tabindex="-1" aria-labelledby="editCategoryModalTitle{{ $category->category_id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-sm-5 mx-50 pb-5">
                    <h1 class="text-center mb-1" id="editCategoryModalTitle{{ $category->category_id }}">Edit Category</h1>
                    <p class="text-center">Edit the category details</p>

                    <!-- Form untuk edit -->
                    <form class="row gy-1 gx-2 mt-75" action="{{ route('categories.update', $category->category_id) }}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="col-12">
                            <label class="form-label">Category Name</label>
                            <div class="input-group input-group-merge">
                                <input name="category_name" class="form-control" type="text" value="{{ $category->category_name }}" autofocus />
                            </div>
                        </div>

                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary me-1 mt-1">Update</button>
                            <button type="button" class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    @endforeach

    @foreach ($categories as $category)
    <div class="modal fade" id="deleteCategoryModal{{ $category->category_id }}" tabindex="-1" aria-labelledby="deleteCategoryModalTitle{{ $category->category_id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-sm-5 mx-50 pb-5">
                    <h1 class="text-center mb-1" id="deleteCategoryModalTitle{{ $category->category_id }}">Delete Categories</h1>
                    <p class="text-center">Are you sure you want to delete this category?</p>

                    <!-- Form untuk hapus -->
                    <form action="{{ route('categories.destroy', $category->category_id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-danger me-1 mt-1">Delete</button>
                            <button type="button" class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    @endforeach


    <!-- Footer -->
    <div>
        {!! $footer !!}
    </div>

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