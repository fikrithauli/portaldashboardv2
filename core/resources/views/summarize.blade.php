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
    <script type="module">
        import {
            TableauViz
        } from "https://tabfire.telkomsel.co.id/javascripts/api/tableau.embedding.3.latest.min.js";

        // Initialization of the Tableau visualization via JavaScript. Learn more here:
        // https://help.tableau.com/current/api/embedding_api/en-us/docs/embedding_api_configure.html
        const viz = new TableauViz();

        viz.src = "{{ $url }}";
        viz.toolbar = "show";

        document.getElementById("tableauViz").appendChild(viz);
    </script>



    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <!-- Tambahkan script toastr CDN -->
    <link href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

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

    #cardResult {
        display: none;
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

    .spinner {
        border: 2px solid rgba(0, 0, 0, 0.1);
        border-left-color: #7983ff;
        border-radius: 50%;
        width: 12px;
        height: 12px;
        margin-right: 5px;
        /* Sesuaikan dengan jarak yang diinginkan antara spinner dan teks */
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        to {
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
                    <span data-i18n="Search">Select Image</span>
                    <i data-feather="more-horizontal"></i>
                </li>

                <li class="nav-item mt-2">
                    <div class="row">
                        &nbsp;&nbsp;&nbsp;
                        <div class="col-md-11">
                            <select name="imageSelector" class="form-select" id="imageSelector">
                                <option hidden>Please Select</option>
                                <option value="superseru" data-src="{{ asset('images/superseru.jpg') }}">Superseru</option>
                                <option value="rgb" data-src="{{ asset('images/rgb.jpg') }}">RGB</option>
                                <option value="cb" data-src="{{ asset('images/cb.jpg') }}">CB</option>
                            </select>
                        </div>
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
            <div class="content-body">

                <section id="nav-tabs-aligned">
                    <div class="row match-height">
                        <!-- Centered Aligned Tabs starts -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <ul class="nav nav-tabs justify-content-center" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link" id="home-tab-center" data-bs-toggle="tab" href="#home-center" aria-controls="home-center" role="tab" aria-selected="true">AI Generator</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link active" id="service-tab-center" data-bs-toggle="tab" href="#service-center" aria-controls="service-center" role="tab" aria-selected="false">AI Summarizer</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="account-tab-center" data-bs-toggle="tab" href="#account-center" aria-controls="account-center" role="tab" aria-selected="false">Chatbot</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane" id="home-center" aria-labelledby="home-tab-center" role="tabpanel">
                                            <div class="row">
                                                <div class="col-sm-12 col-xl-12">
                                                    @if($detailData->visualization_type === 'Tableau')
                                                    <div class="col-12" style="width:1520px; height:840px;">
                                                        <div id='tableauViz'></div>
                                                    </div>
                                                    @else
                                                    <!-- Tampilkan embed_url sesuai kebutuhan PowerBI -->
                                                    <div class="col-12 mx-auto mb-4">
                                                        {!! $detailData->embed_url !!}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane active" id="service-center" aria-labelledby="service-tab-center" role="tabpanel">
                                            <div class="row match-height">
                                                <!-- Centered Aligned Tabs starts -->
                                                <div class="col-xl-12 col-lg-12">
                                                    <div class="card">
                                                        <img class="card-img-top" id="selectedImage" src="" alt="Card image cap" style="display: none;" />
                                                    </div>
                                                </div>

                                                <div class="col-xl-12 col-lg-12">
                                                    <div id="questionContainer">
                                                        <!-- Di sini akan ditampilkan daftar pertanyaan -->
                                                    </div>
                                                </div>


                                                <div class="col-xl-12 col-lg-12">
                                                    <div id="textareaContainer" class="ml-4">
                                                        <textarea id="question" class="form-control">Explain the meaning of the picture and give me a neat 3 point summary.</textarea>
                                                    </div>
                                                </div>

                                                <div class="col-xl-2 col-lg-12 mt-1">
                                                    <button class="btn btn-sm btn-outline-primary" id="summarizeButton">
                                                        <span id="spinner" class="spinner" style="display: none;"></span>
                                                        <span id="buttonText">Summarize...</span>
                                                    </button>

                                                </div>



                                                <div class="col-xl-12 col-lg-12 mt-2">
                                                    <div class="card" id="cardResult" style="background-color: #333333; color: white;">
                                                        <div class="card-body">
                                                            <p class="card-text">
                                                            <div class="col-sm-12 col-xl-12">
                                                                <span id="result-container"></span>
                                                            </div>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Centered Aligned Tabs ends -->
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="account-center" aria-labelledby="account-tab-center" role="tabpanel">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Centered Aligned Tabs ends -->
                    </div>
                </section>

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/charts/apexcharts.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('app-assets/js/core/app.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('app-assets/js/scripts/pages/dashboard-ecommerce.js') }}"></script>
    <!-- END: Page JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/forms/form-select2.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/jszip.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <script src="{{ asset('app-assets/js/scripts/pages/page-account-settings-account.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/pages/modal-share-project.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/components/components-dropdowns.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/components/components-navs.js') }}"></script>

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

    <!-- <script>
        // Fungsi untuk mengetik ulang (typing effect)
        async function typeWriter(content, element) {
            let i = 0;
            const typingEffect = async () => {
                if (i < content.length) {
                    element.innerText += content.charAt(i);
                    if (content.charAt(i) === " ") {
                        element.innerText += "\u00A0"; // Add a non-breaking space for spaces
                    }
                    i++;
                    await sleep(20); // Mengatur kecepatan pengetikan (dalam milidetik)
                    typingEffect();
                }
            };
            typingEffect();
        }


        // Fungsi untuk mengatur waktu jeda
        function sleep(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }

        // Select element dari HTML
        var imageSelector = document.getElementById('imageSelector');
        var summarizeButton = document.getElementById('summarizeButton');
        var selectElement = document.getElementById('imageSelector');
        var imageElement = document.getElementById('selectedImage');

        // Tambahkan event listener untuk perubahan pada select
        selectElement.addEventListener('change', function() {
            var selectedOption = selectElement.options[selectElement.selectedIndex];
            var imageUrl = selectedOption.getAttribute('data-src');

            if (imageUrl) {
                imageElement.src = imageUrl;
                imageElement.style.display = 'block'; // Tampilkan gambar jika ada URL
            } else {
                imageElement.style.display = 'none'; // Sembunyikan gambar jika tidak ada URL
            }
        });

        // Tambahkan event listener untuk tombol "Summarize"
        summarizeButton.addEventListener('click', function() {
            var spinner = document.getElementById('spinner');
            var buttonText = document.getElementById('buttonText');
            var questionText = document.getElementById('question').value;
            var selectedOption = imageSelector.options[imageSelector.selectedIndex];
            var imageUrl = selectedOption.getAttribute('data-src');
            var imageName = selectedOption.value + '.jpg'; // Nama file
            var blob = null;

            if (!imageUrl) {
                // Tampilkan pesan error menggunakan toastr jika tidak ada gambar yang dipilih
                toastr.error('Please select an image.');
                return; // Keluar dari fungsi jika tidak ada gambar yang dipilih
            }

            // Tampilkan spinner dan ubah teks tombol saat proses dimulai
            spinner.style.display = 'inline-block';
            buttonText.innerText = 'Summarizing...';

            if (questionText) {
                fetch(imageUrl)
                    .then(response => response.blob())
                    .then(blob => {
                        var file = new File([blob], imageName, {
                            type: 'image/jpeg'
                        });

                        var formData = new FormData();
                        formData.append('image', file);
                        formData.append('question', questionText);

                        fetch('http://127.0.0.1:8000/api/vision?question=' + encodeURIComponent(questionText), {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'Authorization': 'Bearer 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'
                                }
                            })
                            .then(response => {
                                if (response.ok) {
                                    return response.json();
                                } else {
                                    throw new Error('Server responded with non-OK status');
                                }
                            })
                            .then(data => {
                                const content = data.gpt.choices[0].message.content;
                                document.getElementById('result-container').innerText = '';
                                typeWriter(content, document.getElementById('result-container'));
                            })
                            .catch(error => {
                                console.error('Error:', error);
                            })
                            .finally(() => {
                                // Sembunyikan spinner dan kembalikan teks tombol saat proses selesai
                                spinner.style.display = 'none';
                                buttonText.innerText = 'Summarize...';
                            });
                    })
                    .catch(error => {
                        console.error('Error fetching image:', error);
                    });
            } else {
                toastr.error('Please provide a question text.'); // Tampilkan pesan error jika tidak ada teks pertanyaan
            }
        });
    </script> -->

    <script>
        // Fungsi untuk menampilkan atau menyembunyikan elemen
        function toggleElementVisibility(elementId, isVisible) {
            var element = document.getElementById(elementId);
            if (isVisible) {
                element.style.display = 'block';
            } else {
                element.style.display = 'none';
            }
        }

        // Fungsi untuk mengetik ulang (typing effect)
        async function typeWriter(content, element) {
            let i = 0;
            const typingEffect = async () => {
                if (i < content.length) {
                    element.innerText += content.charAt(i);
                    if (content.charAt(i) === " ") {
                        element.innerText += "\u00A0"; // Add a non-breaking space for spaces
                    }
                    i++;
                    await sleep(20); // Mengatur kecepatan pengetikan (dalam milidetik)
                    typingEffect();
                }
            };
            typingEffect();
        }

        // Fungsi untuk mengatur waktu jeda
        function sleep(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }

        // Select element dari HTML
        var imageSelector = document.getElementById('imageSelector');
        var summarizeButton = document.getElementById('summarizeButton');
        var selectElement = document.getElementById('imageSelector');
        var imageElement = document.getElementById('selectedImage');

        // Tambahkan event listener untuk perubahan pada select
        selectElement.addEventListener('change', function() {
            var selectedOption = selectElement.options[selectElement.selectedIndex];
            var imageUrl = selectedOption.getAttribute('data-src');

            if (imageUrl) {
                imageElement.src = imageUrl;
                imageElement.style.display = 'block'; // Tampilkan gambar jika ada URL
            } else {
                imageElement.style.display = 'none'; // Sembunyikan gambar jika tidak ada URL
            }
        });

        // Tambahkan event listener untuk tombol "Summarize"
        summarizeButton.addEventListener('click', function() {
            var spinner = document.getElementById('spinner');
            var buttonText = document.getElementById('buttonText');
            var questionText = document.getElementById('question').value;
            var selectedOption = imageSelector.options[imageSelector.selectedIndex];
            var imageUrl = selectedOption.getAttribute('data-src');
            var imageName = selectedOption.value + '.jpg'; // Nama file
            var blob = null;

            if (!imageUrl) {
                // Tampilkan pesan error menggunakan toastr jika tidak ada gambar yang dipilih
                toastr.error('Please select an image.');
                return; // Keluar dari fungsi jika tidak ada gambar yang dipilih
            }

            // Tampilkan spinner dan ubah teks tombol saat proses dimulai
            spinner.style.display = 'inline-block';
            buttonText.innerText = 'Loading...';

            if (questionText) {
                fetch(imageUrl)
                    .then(response => response.blob())
                    .then(blob => {
                        var file = new File([blob], imageName, {
                            type: 'image/jpeg'
                        });

                        var formData = new FormData();
                        formData.append('image', file);
                        formData.append('question', questionText);

                        fetch('http://127.0.0.1:8000/api/vision?question=' + encodeURIComponent(questionText), {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'Authorization': 'Bearer'
                                }
                            })
                            .then(response => {
                                if (response.ok) {
                                    return response.json();
                                } else {
                                    throw new Error('Server responded with non-OK status');
                                }
                            })
                            .then(data => {
                                const content = data.gpt.choices[0].message.content;
                                // Tampilkan kartu dengan hasil respons
                                toggleElementVisibility('cardResult', true);
                                document.getElementById('result-container').innerText = '';
                                typeWriter(content, document.getElementById('result-container'));
                            })
                            .catch(error => {
                                console.error('Error:', error);
                            })
                            .finally(() => {
                                // Sembunyikan spinner dan kembalikan teks tombol saat proses selesai
                                spinner.style.display = 'none';
                                buttonText.innerText = 'Summarize...';
                            });
                    })
                    .catch(error => {
                        console.error('Error fetching image:', error);
                    });
            } else {
                toastr.error('Please provide a question text.'); // Tampilkan pesan error jika tidak ada teks pertanyaan
            }
        });
    </script>


</body>
<!-- END: Body-->

</html>