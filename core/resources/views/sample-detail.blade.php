<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="tivo admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Tivo admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{ asset('assets/tsel_ico.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/tsel_ico.png') }}" type="image/x-icon">
    <title>Dashboard Generator</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('gpt/css/vendors/font-awesome.css') }}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('gpt/css/vendors/icofont.css') }}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('gpt/css/vendors/themify.css') }}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('gpt/css/vendors/flag-icon.css') }}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('gpt/css/vendors/feather-icon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('gpt/css/vendors/scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('gpt/css/vendors/date-picker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('gpt/css/vendors/owlcarousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('gpt/css/vendors/prism.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('gpt/css/vendors/whether-icon.css') }}">
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('gpt/css/vendors/bootstrap.css') }}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('gpt/css/style.css') }}">
    <link id="color" rel="stylesheet" href="{{ asset('gpt/css/color-1.css') }}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('gpt/css/responsive.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.4/sweetalert2.min.js" integrity="sha512-AXRSg1bk/WYB9XiMgxJJS+jsAuMyS46bL0NZUo0tc2luqTAtDC3zI7UumzsQvFR07j+h2hG37FD9s8RcHTBApA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.4/sweetalert2.all.js" integrity="sha512-3Nqc7XqFok0aQ4QwMhbaBs9/QtKMgvY49WTRVNJwc5gq6Icgiw2ROwK5oVcNR1L5undxFQPLIKgTWSi2a92MFA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

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
</head>

<style>
    /* Tambahkan gaya CSS sesuai kebutuhan Anda */
    .hidden {
        display: none;
    }

    .text-bold {
        font-weight: bold;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .spinner-container {
        display: flex;
        align-items: center;
    }

    .spinner-wrapper {
        display: flex;
        /* Membuat flex container agar elemen anak berada dalam satu baris */
        align-items: center;
        /* Posisi elemen anak secara vertikal di tengah */
    }

    .spinner {
        border: 4px solid rgba(0, 0, 0, 0.1);
        border-left: 4px solid blue;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        animation: spin 1s linear infinite;
        margin-right: 5px;
    }

    /* Tambahkan gaya untuk efek loading */
    .loading-overlay {
        display: flex;
        align-items: center;
        justify-content: center;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.8);
        z-index: 999;
    }

    /* Tambahkan gaya untuk elemen spinner (icon) */
    .spinner-con {
        display: flex;
        align-items: center;
        justify-content: center;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.8);
        z-index: 999;
    }

    /* Tambahkan gaya untuk ikon */
    .fa-person-running {
        margin-left: 8px;
        font-size: 16px;
        color: #3498db;
        animation: pulse 1s infinite alternate;
        /* Tambahkan efek animasi pulsasi */
    }

    /* Tambahkan gaya untuk teks */
    .loading-text {
        margin-left: 10px;
        font-size: 14px;
        animation: pulse 1s infinite alternate;
        /* Tambahkan efek animasi pulsasi */
    }

    /* Animasi pulsasi */
    @keyframes pulse {
        0% {
            opacity: 0.5;
        }

        100% {
            opacity: 1;
        }
    }

    /* Tambahkan gaya untuk elemen konten */
    #myProjectBox {
        display: none;
    }

    #cardImage {
        display: none;
    }
</style>

<body>
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- Loader starts-->
    <div class="loader-wrapper">
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"> </div>
        <div class="dot"></div>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        <div class="page-header">
            <div class="header-wrapper row m-0">
                <div class="header-logo-wrapper col-auto p-0">
                    <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
                    <div class="logo-header-main"><a href="index.html"><img src="{{ asset('tsel.png') }}" width="140" alt=""></a></div>
                </div>
                <div class="left-header col horizontal-wrapper ps-0">

                </div>
                <div class="nav-right col-6 pull-right right-header p-0">
                    <ul class="nav-menus">
                        <li class="maximize"><a href="#!" onclick="javascript:toggleFullScreen()"></a></li>

                        @if(Auth::check())
                        <li class="profile-nav onhover-dropdown">
                            <div class="account-user"><i data-feather="user"></i></div>
                            <ul class="profile-dropdown onhover-show-div">
                                <li><a href="user-profile.html"><i data-feather="help-circle"></i><span>Log History</span></a></li>
                                <li><a href="login.html"><i data-feather="power"></i><span>Log out</span></a></li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                </div>
                <script class="result-template" type="text/x-handlebars-template">
                    <div class="ProfileCard u-cf">                        
            <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
            <div class="ProfileCard-details">
            <div class="ProfileCard-realName"></div>
            </div>
            </div>
          </script>
                <script class="empty-template" type="text/x-handlebars-template"><div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div></script>
            </div>
        </div>
        <!-- Page Header Ends-->
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            <div class="sidebar-wrapper mt-2">
                <div>
                    <div class="logo-wrapper"><a href="index.html"><img class="img-fluid for-light" src="../assets/images/logo/logo.png" alt=""></a>
                        <div class="back-btn"><i data-feather="grid"></i></div>
                        <div class="toggle-sidebar icon-box-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
                    </div>
                    <div class="logo-icon-wrapper"><a href="index.html">
                            <div class="icon-box-sidebar"><i data-feather="grid"></i></div>
                        </a></div>
                    <nav class="sidebar-main">
                        <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
                        <div id="sidebar-menu">
                            <ul class="sidebar-links" id="simple-bar">
                                <li class="back-btn">
                                    <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                                </li>
                                <li class="pin-title sidebar-list">
                                    <h6>Pinned</h6>
                                </li>
                                <hr>
                                <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="{{ url('/home') }}"><i data-feather="home"></i><span>Dashboard</span></a></li>
                                @if(Auth::user()->role_id == 1)
                                <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#"><i data-feather="package"></i><span>Content Management</span></a>
                                    <ul class="sidebar-submenu">
                                        <li>
                                            <a class="submenu-title" href="{{ url('/categories') }}">&nbsp;Categories List<span class="sub-arrow"></span></a>
                                        </li>
                                        <li>
                                            <a class="submenu-title" href="{{ url('/content-dashboard') }}">&nbsp;Dashboard List<span class="sub-arrow"></span></a>
                                        </li>
                                        <li>
                                            <a class="submenu-title" href="{{ url('/service-interruption') }}">&nbsp;Maintenance<span class="sub-arrow"></span></a>
                                        </li>
                                    </ul>
                                </li>
                                @php
                                $pendingRequestsCount = DB::table('permission_request')->where('request_status', 0)->count();
                                @endphp
                                <li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
                                    <a class="sidebar-link sidebar-title" href="{{ url('/permission') }}">
                                        @if ($pendingRequestsCount > 0)
                                        <span class="badge rounded-pill bg-danger badge-up small-badge">{{ $pendingRequestsCount }}</span>
                                        @endif
                                        <i data-feather="shield"></i>
                                        <span> Roles &amp; Permission</span>
                                    </a>
                                </li>

                                <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="{{ url('/user-management') }}"><i data-feather="users"></i><span>User Management</span></a></li>
                                @endif
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
            <!-- Page Sidebar Ends-->
            <div class="page-body">
                <div class="container-fluid general-widget">
                    <div class="row">
                        <div class="col-sm-12 col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <ul class="nav nav-pills nav-dark justify-content-center" id="pills-successtab" role="tablist">
                                        <li class="nav-item"><a class="nav-link" id="pills-successhome-tab" data-bs-toggle="pill" href="#pills-successhome" role="tab" aria-controls="pills-successhome" aria-selected="true"><i class="fa-solid fa-chart-bar"></i> AI Generator</a></li>
                                        <li class="nav-item"><a class="nav-link active" id="pills-successprofile-tab" data-bs-toggle="pill" href="#pills-successprofile" role="tab" aria-controls="pills-successprofile" aria-selected="false"><i class="fa-solid fa-chart-simple"></i> AI Summarizer</a></li>
                                        <li class="nav-item"><a class="nav-link" id="pills-successcontact-tab" data-bs-toggle="pill" href="#pills-successcontact" role="tab" aria-controls="pills-successcontact" aria-selected="false"><i class="fa-brands fa-rocketchat"></i> Chatbot</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-xl-12">
                            <div class="tab-content" id="pills-successtabContent">

                                <!-- tab generator -->
                                <div class="tab-pane fade show" id="pills-successhome" role="tabpanel" aria-labelledby="pills-successhome-tab">
                                    <div class="row">
                                        <div class="col-sm-12 col-xl-12">
                                            @if($detailData->visualization_type === 'Tableau')
                                            <?php
                                            // Get the ticket from the Tableau API
                                            $response = Http::get('http://10.2.114.197:8000/ticket');
                                            $ticket = $response->json();

                                            // Get the view_name from the detailData
                                            $viewName = $detailData->view_name;

                                            // Combine embed_url, 'trusted', ticket, and view_name to form the final URL
                                            $tableauUrl = "https://tabfire.telkomsel.co.id/trusted/{$ticket}/views/{$viewName}";
                                            ?>
                                            <div class="col-12" style="width:1520px; height:840px;">
                                                <div id='tableauViz' data-url="{{ $tableauUrl }}"></div>
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

                                <!-- tab insighter -->
                                <div class="tab-pane fade show active mb-5" id="pills-successprofile" role="tabpanel" aria-labelledby="pills-successprofile-tab">
                                    <div class="row">
                                        <div class="col-sm-12 col-xl-12">
                                            <div class="card" id="cardImage">
                                                <div class="card-body">
                                                    <!-- Gambar di tengah card body -->
                                                    <div class="text-center">
                                                        <img src="" alt="Image" class="img-fluid">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-sm-12 col-xl-12 mb-4">
                                            <button id="regenerateButton" class="btn btn-sm btn-outline-light txt-dark" style="background-color: #FFFFFF; border: 1px solid #dbd8d8;" type="button" onclick="regenerateQuestions()">
                                                <i class="fa-solid fa-arrows-rotate text-primary"></i>&nbsp; Re-generate question
                                            </button>
                                        </div>

                                        <div id="loadingContainer" class="spinner-container mb-4 mt-2">
                                            <i class="fa-solid fa-person-running"></i>
                                            <div class="loading-text">
                                                Looking for questions
                                            </div>
                                        </div>

                                        <div id="myProjectBox" class="col-xxl-12 col-lg-12 box-col-33 col-md-12 mt-2">
                                            <div class="project-box" style="background-color: #FFFFFF; border: 1px solid #dbd8d8;">
                                                <span class="badge badge-light text-dark toggle-icon" onclick="toggleProjectBox()"><i class="fa-solid fa-chevron-up"></i></span>
                                                <h6 style="margin-bottom: 30px;">Show random questions :</h6>
                                                <div class="content">
                                                    <div id="questionsContainer" class="col-12 mt-3">
                                                        <!-- Questions will be dynamically added here -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-xl-12 mb-1">
                                            <button class="btn btn-sm btn-outline-light txt-dark hidden" style="background-color: #FFFFFF; border: 1px solid #dbd8d8;" type="button" id="showButton" onclick="showProjectBox()">Show Sample Question</button>
                                        </div>


                                        <div class="col-sm-12 col-xl-12 mt-3">
                                            <div class="d-flex mb-2">
                                                <div class="flex-grow-1 ml-5 mr-5">
                                                    <div class="form-check form-switch ml-4">
                                                        <input class="form-check-input" id="flexSwitchCheckDefault" type="checkbox" onchange="toggleElements()">
                                                        <label class="form-check-label" for="flexSwitchCheckDefault">
                                                            <span id="switchStatusText">Edit prompt</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="ml-4">
                                                <input type="file" class="form-control" id="image">
                                            </div>

                                            <div id="textareaContainer" class="ml-4 mt-3">
                                                <textarea id="question" class="form-control">Explain the meaning of the picture and give me a neat 3 point summary</textarea>
                                            </div>
                                        </div>

                                        <!-- HTML part -->
                                        <div class="col-sm-12 col-xl-12 mt-3">
                                            <button class="btn btn-sm btn-outline-light txt-dark" style="background-color: #FFFFFF; border: 1px solid #dbd8d8; display: flex; align-items: center;" type="button" onclick="submitForm()">
                                                <div id="loadingSpinner" class="spinner-container ml-2" style="display: none;">
                                                    <div class="spinner-wrapper">
                                                        <div class="spinner"></div>
                                                    </div>
                                                </div>
                                                &nbsp;&nbsp;<span class="ml-4" id="buttonText">Summarize...</span>
                                            </button>
                                        </div>


                                        <div id="projectBox" class="container col-12 mt-3" style="display: none;">
                                            <div class="col-xxl-12 col-lg-12 box-col-33 col-md-12 mt-3">
                                                <div class="project-box" style="background-color: #FFFFFF; border: 1px solid #dbd8d8;">
                                                    <div class="content">
                                                        <div class="col-12 mt-1">
                                                            <div>
                                                                <span id="result-container"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>

                                <!-- tab chatbot -->
                                <div class="tab-pane fade" id="pills-successcontact" role="tabpanel" aria-labelledby="pills-successcontact-tab">

                                </div>
                            </div>
                        </div>



                    </div>
                </div>
                <!-- Container-fluid Ends-->
            </div>
            <!-- footer start-->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 p-0 footer-left">
                            <p class="mb-0">Copyright © 2023 <font color="red">PT Telekomunikasi Selular</font>. All rights reserved.</p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!-- latest jquery-->
    <script src="{{ asset('gpt/js/jquery-3.6.0.min.js') }}"></script>
    <!-- Bootstrap js-->
    <script src="{{ asset('gpt/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <!-- feather icon js-->
    <script src="{{ asset('gpt/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('gpt/js/icons/feather-icon/feather-icon.js') }}"></script>
    <!-- scrollbar js-->
    <script src="{{ asset('gpt/js/scrollbar/simplebar.js') }}"></script>
    <script src="{{ asset('gpt/js/scrollbar/custom.js') }}"></script>
    <!-- Sidebar jquery-->
    <script src="{{ asset('gpt/js/config.js') }}"></script>
    <script src="{{ asset('gpt/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('gpt/js/prism/prism.min.js') }}"></script>
    <script src="{{ asset('gpt/js/clipboard/clipboard.min.js') }}"></script>
    <script src="{{ asset('gpt/js/counter/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('gpt/js/counter/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('gpt/js/counter/counter-custom.js') }}"></script>
    <script src="{{ asset('gpt/js/custom-card/custom-card.js') }}"></script>
    <script src="{{ asset('gpt/js/datepicker/date-picker/datepicker.js') }}"></script>
    <script src="{{ asset('gpt/js/datepicker/date-picker/datepicker.en.js') }}"></script>
    <script src="{{ asset('gpt/js/datepicker/date-picker/datepicker.custom.js') }}"></script>
    <script src="{{ asset('gpt/js/owlcarousel/owl.carousel.js') }}"></script>
    <script src="{{ asset('gpt/js/general-widget.js') }}"></script>
    <script src="{{ asset('gpt/js/height-equal.js') }}"></script>
    <!-- Template js-->
    <script src="{{ asset('gpt/js/script.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- login js-->

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- kode js API Vision -->
    <script>
        async function submitForm() {
            const question = document.getElementById('question').value;
            const imageInput = document.getElementById('image');
            const image = imageInput.files[0];

            // Check if both question and image are filled
            if (!question && !image) {
                // Display toastr alert for both fields not filled
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "showDuration": "200",
                    "hideDuration": "800",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "slideDown",
                    "hideMethod": "slideUp",
                };
                toastr.error('', 'Please fill in both question and image fields.', {
                    "progressBar": true,
                    "timeOut": 5000
                });
                return; // Stop further execution if not filled
            }

            // Check if question or image is not filled
            if (!question || !image) {
                // Build the toastr message dynamically based on missing fields
                let errorMessage = 'Please fill in the following field ';
                if (!question) {
                    errorMessage += 'question ';
                }
                if (!image) {
                    errorMessage += 'image ';
                }

                // Display toastr alert
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "showDuration": "200",
                    "hideDuration": "800",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "slideDown",
                    "hideMethod": "slideUp",
                };
                toastr.error('', errorMessage, {
                    "progressBar": true,
                    "timeOut": 5000
                });
                return; // Stop further execution if not filled
            }

            const formData = new FormData();
            formData.append('image', image);

            // Read image file as binary string
            const reader = new FileReader();
            reader.readAsBinaryString(image);
            reader.onloadend = function() {
                const binaryData = reader.result;

                // Append binary data to FormData
                formData.append('image_binary', binaryData);

                // Tampilkan loader spinner dan ubah teks tombol
                const buttonText = document.getElementById('buttonText');
                const loadingSpinner = document.getElementById('loadingSpinner');

                buttonText.textContent = 'Summarizing process...';
                loadingSpinner.style.display = 'inline-block'; // Menampilkan spinner

                // Send the request
                sendRequest(question, formData);
            };
        }

        async function sendRequest(question, formData) {
            try {
                const response = await fetch(`http://127.0.0.1:8000/api/vision?question=${encodeURIComponent(question)}`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Authorization': 'Bearer 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',
                    },
                });

                if (response.ok) {
                    const result = await response.json();
                    displayResults(result);
                } else {
                    console.error('Error:', response.status);
                }
            } catch (error) {
                console.error('Error:', error.message);
            }
        }

        async function displayResults(result) {
            const resultContainer = document.getElementById('result-container');
            const cardImage = document.getElementById('cardImage');
            const buttonText = document.getElementById('buttonText');
            const loadingSpinner = document.getElementById('loadingSpinner');
            const projectBox = document.getElementById('projectBox');

            // Extracting the "choices" array from the "gpt" object
            const choices = result.gpt.choices;

            // Extracting the content from the first choice
            const content = choices[0].message.content;

            // Update the image source inside the card
            const cardImageElement = cardImage.querySelector('img');
            cardImageElement.src = result.base64_image;
            cardImageElement.alt = 'Uploaded Image';

            // Show the cardImage element
            cardImage.style.display = 'block';

            // Clear previous content
            resultContainer.innerHTML = '';

            // Display projectBox
            projectBox.style.display = 'block';

            // Tampilkan pertanyaan
            resultContainer.innerHTML += `<h6>${result.question}</h6>`;

            // Mengetik ulang (typing effect) pada content
            await typeWriter(content, resultContainer);

            // Sembunyikan loader spinner setelah hasil ditampilkan
            loadingSpinner.style.display = 'none';

            // Kembalikan teks tombol ke kondisi awal
            buttonText.textContent = 'Summarize...';

            // Tampilkan hasil setelah jawaban sudah ada
            resultContainer.classList.remove('result-hidden');
        }

        // Fungsi untuk mengetik ulang (typing effect)
        async function typeWriter(text, element) {
            for (let i = 0; i < text.length; i++) {
                element.innerHTML += text.charAt(i);
                await sleep(20); // Mengatur kecepatan pengetikan (dalam milidetik)
            }
        }

        // Fungsi untuk mengatur waktu jeda
        function sleep(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }
    </script>

    <!-- kode js menampilkan sample question -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Show loading container initially
            const loadingContainer = document.getElementById('loadingContainer');
            const myProjectBox = document.getElementById('myProjectBox');

            // Hide myProjectBox initially
            myProjectBox.style.display = 'none';

            setTimeout(function() {
                // Hide loading container after 2 seconds
                loadingContainer.style.display = 'none';

                // Show myProjectBox after hiding loading container
                myProjectBox.style.display = 'block';
            }, 5000); // 2000 milliseconds = 2 seconds
        });

        function toggleProjectBox() {
            // Toggle the visibility of myProjectBox
            const myProjectBox = document.getElementById('myProjectBox');
            myProjectBox.style.display = myProjectBox.style.display === 'none' ? 'block' : 'none';
        }
    </script>

    <!-- kode js hidden sample quest -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            displayRandomQuestions(10);
        });

        function toggleProjectBox() {
            const projectBox = document.getElementById('myProjectBox');
            const toggleIcon = document.querySelector('.toggle-icon');
            const showButton = document.getElementById('showButton');

            if (projectBox.style.display === 'none') {
                projectBox.style.display = 'block';
                toggleIcon.innerHTML = '<i class="fa-solid fa-chevron-up"></i>';
                showButton.classList.add('hidden');
            } else {
                projectBox.style.display = 'none';
                toggleIcon.innerHTML = '<i class="fa-solid fa-chevron-down"></i>';
                showButton.classList.remove('hidden');
            }
        }

        function showProjectBox() {
            const projectBox = document.getElementById('myProjectBox');
            const toggleIcon = document.querySelector('.toggle-icon');
            const showButton = document.getElementById('showButton');

            projectBox.style.display = 'block';
            toggleIcon.innerHTML = '<i class="fa-solid fa-chevron-up"></i>';
            showButton.classList.add('hidden');
        }

        function regenerateQuestions() {
            // Ubah teks tombol menjadi "Re-generate Process"
            document.getElementById('regenerateButton').innerHTML = '<i class="fa-solid fa-spinner fa-spin text-primary"></i>&nbsp; Re-generate Process';

            // Sembunyikan myProjectBox dan showButton selama 3 detik
            document.getElementById('myProjectBox').style.display = 'none';
            document.getElementById('showButton').style.display = 'none';

            // Proses yang memakan waktu (misalnya, pengaturan nilai default)
            setTimeout(function() {
                // Setelah 3 detik, tampilkan kembali myProjectBox dan showButton
                document.getElementById('myProjectBox').style.display = 'block';

                // Ubah teks tombol kembali ke "Re-generate sample question"
                document.getElementById('regenerateButton').innerHTML = '<i class="fa-solid fa-arrows-rotate text-primary"></i>&nbsp; Re-generate sample question';

                // Tampilkan 10 pertanyaan acak
                displayRandomQuestions(10);
            }, 3000); // Waktu dalam milidetik (3000 milidetik = 3 detik)
        }

        function displayRandomQuestions(numQuestions) {
            const questionsContainer = document.getElementById('questionsContainer');
            questionsContainer.innerHTML = '';

            const allQuestions = [
                "Bagaimana ringkasan performa top region untuk paket internet Superseru?",
                "Berapa total penjualan harian dalam satu minggu terakhir?",
                "Seberapa besar kontribusi pendapatan harian untuk setiap region?",
                "Apa saja fitur unggulan yang ditawarkan dalam paket Superseru?",
                "Berikan summary dari daily trend revenue diatas?",
                "Apakah Superseru menawarkan kecepatan internet yang tinggi?",
                "Apa jenis bonus atau tambahan yang bisa saya dapatkan dengan menggunakan produk Superseru?",
                "Bagaimana cara mengaktifkan atau menonaktifkan fitur tertentu pada Superseru?",
                "Adakah pilihan tambahan atau upgrade yang dapat saya lakukan pada paket Superseru?",
                "Apakah Superseru memberikan keuntungan khusus bagi pelanggan setia Telkomsel?",
                "Bagaimana cara mendapatkan bantuan atau dukungan pelanggan terkait produk Superseru?",
                "Apakah ada program reward atau promo khusus untuk pengguna Superseru?",
                "Bagaimana cara melakukan pembayaran tagihan untuk paket Superseru?",
                "Apakah Superseru memiliki jangkauan sinyal yang luas di seluruh Indonesia?",
                "Apa yang membedakan Superseru dari produk serupa di pasaran?",
                "Bagaimana cara melakukan migrasi atau upgrade paket ke Superseru?",
                "Adakah fitur keamanan atau proteksi khusus yang disertakan dalam Superseru?",
                "Apakah Superseru dapat digunakan untuk keperluan bisnis atau hanya untuk penggunaan pribadi?",
                "Bagaimana cara mengakses konten eksklusif yang mungkin disertakan dalam Superseru?",
                "Apa kebijakan Telkomsel terkait privasi pengguna Superseru?",
                "Bagaimana cara memperpanjang masa aktif atau masa berlaku paket Superseru?",
                // Pertanyaan terkait pendapatan, MoM, dan data berdasarkan channel, paket, serta jumlah pelanggan
                "Bagaimana performa pendapatan MoM untuk paket Superseru?",
                "Apakah terdapat perbedaan pendapatan antara saluran distribusi yang berbeda?",
                "Bagaimana kontribusi pendapatan dari setiap paket Superseru?",
                "Berapa total jumlah pelanggan (subscriber) yang tercatat untuk paket Superseru?",
                "Apakah terdapat tren pertumbuhan pelanggan Superseru dalam beberapa bulan terakhir?",
                // Pertanyaan summary untuk beberapa region dan paket tertentu
                "Bagaimana performa penjualan untuk region Jawa Timur (Jatim)?",
                "Seberapa besar kontribusi pendapatan dari Superseru 50K di region Sumatera Selatan (Sumbagsel)?",
                "Berapa jumlah pelanggan (subscriber) Superseru di Sumatera Utara (Sumbagut)?",
                "Bagaimana pendapatan harian dari paket Superseru di Western Jabodetabek?",
                "Apakah Superseru 100K memiliki kontribusi yang signifikan pada pendapatan?",
                // Pertanyaan berdasarkan channel
                "Bagaimana performa penjualan melalui saluran MyTelkomsel?",
                "Seberapa efektifnya saluran Digipos dalam mendistribusikan paket Superseru?",
                "Berapa kontribusi pendapatan dari saluran UMB (USSD Menu Browser)?",
                "Bagaimana performa paket Superseru yang dijual melalui saluran URP Modem?",
                // Pertanyaan berdasarkan paket
                "Berapa total pendapatan dari paket Superseru 50K?",
                "Apakah Superseru 75K memiliki tingkat penjualan yang baik di pasar?",
                "Bagaimana performa pendapatan dari paket Superseru 150K?",
                // Pertanyaan jumlah pelanggan (subscriber)
                "Berapa total pelanggan (subscriber) Superseru di akhir bulan terakhir?",
                "Seberapa besar pertumbuhan jumlah pelanggan (subscriber) Superseru dalam satu bulan terakhir?",
            ];

            const shuffledQuestions = shuffleArray(allQuestions);

            for (let i = 0; i < numQuestions; i++) {
                const questionDiv = document.createElement('div');
                questionDiv.innerHTML = `<span>${i + 1}. ${shuffledQuestions[i]}</span><div style="margin-bottom: 10px;"></div>`;
                questionsContainer.appendChild(questionDiv);
            }
        }

        function shuffleArray(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
            return array;
        }
    </script>

    <script>
        // Function to hide elements initially
        function hideElements() {
            var imageInput = document.getElementById('image');
            var textareaContainer = document.getElementById('textareaContainer');
            imageInput.style.display = 'none';
            textareaContainer.style.display = 'none';
        }

        // Function to toggle elements based on checkbox state
        function toggleElements() {
            var checkbox = document.getElementById('flexSwitchCheckDefault');
            var imageInput = document.getElementById('image');
            var textareaContainer = document.getElementById('textareaContainer');

            if (checkbox.checked) {
                // Jika checkbox dicentang, tampilkan kembali elemen imageInput dan textareaContainer
                imageInput.style.display = 'block';
                textareaContainer.style.display = 'block';
            } else {
                // Jika checkbox tidak dicentang, sembunyikan elemen imageInput dan textareaContainer
                imageInput.style.display = 'none';
                textareaContainer.style.display = 'none';
            }
        }

        // Call hideElements function when the page loads
        window.onload = hideElements;
    </script>



</body>

</html>