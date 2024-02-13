<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
   <title>User Management </title>
   <link rel="icon" type="image/x-icon" href="https://upload.wikimedia.org/wikipedia/commons/b/bc/Telkomsel_2021_icon.svg" />
   <link href="{{ asset('other/assets/css/loader.css') }}" rel="stylesheet" type="text/css" />
   <script src="{{ asset('other/assets/js/loader.js') }}"></script>

   <!-- BEGIN GLOBAL MANDATORY STYLES -->
   <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
   <link href="{{ asset('other/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
   <link href="{{ asset('other/assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
   <!-- END GLOBAL MANDATORY STYLES -->

   <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
   <link href="{{ asset('other/plugins/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
   <link href="{{ asset('other/assets/css/dashboard/dash_2.css') }}" rel="stylesheet" type="text/css" />
   <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

   <link href="{{ asset('other/assets/css/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
   <link href="{{ asset('other/assets/css/components/tabs-accordian/custom-tabs.css') }}" rel="stylesheet" type="text/css" />

   <!-- BEGIN PAGE LEVEL STYLES -->
   <link rel="stylesheet" type="text/css" href="{{ asset('other/plugins/table/datatable/datatables.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('other/plugins/table/datatable/dt-global_style.css') }}">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
   <link href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.css" rel="stylesheet">
   <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js"></script>
   <!-- END PAGE LEVEL STYLES -->

</head>

<body class="alt-menu sidebar-noneoverflow">
   <!-- BEGIN LOADER -->
   <div id="load_screen">
      <div class="loader">
         <div class="loader-content">
            <div class="spinner-grow align-self-center"></div>
         </div>
      </div>
   </div>
   <!--  END LOADER -->

   <!--  BEGIN NAVBAR  -->
   <div class="header-container">
      <header class="header navbar navbar-expand-sm">

         <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu">
               <line x1="3" y1="12" x2="21" y2="12"></line>
               <line x1="3" y1="6" x2="21" y2="6"></line>
               <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg></a>

         <div class="nav-logo align-self-center">
            <img alt="logo" src="{{ asset('tsel.png') }}" width="170">
         </div>

         <ul class="navbar-item flex-row mr-auto">
            <li class="nav-item align-self-center search-animated">

            </li>
         </ul>

         <ul class="navbar-item flex-row nav-dropdowns">

            @if(Auth::check())
            <li class="nav-item dropdown user-profile-dropdown order-lg-0 order-1">
               <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="user-profile-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <div class="media">
                     <div class="media-body align-self-center">
                        <h6>Hi, {{ Auth::user()->name }}</h6>
                        @if (Auth::user()->role_id == 1)
                        <p>Administrator</p>
                        @elseif (Auth::user()->role_id == 2)
                        @if (Auth::user()->job_title)
                        <p>{{ Auth::user()->job_title }}</p>
                        @else
                        <p>Users</p>
                        @endif
                        @endif
                     </div>
                  </div>
               </a>

               <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">

                  <div class="dropdown-item">
                     <a href="{{ url('/settings') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                           <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                           <circle cx="12" cy="7" r="4"></circle>
                        </svg> <span> Log History</span>
                     </a>
                  </div>
                  <div class="dropdown-item mb-2">
                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                     </form>
                     <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out">
                           <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                           <polyline points="16 17 21 12 16 7"></polyline>
                           <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg> <span>Log Out</span>
                     </a>
                  </div>
               </div>
            </li>
            @endif
         </ul>
      </header>
   </div>
   <!--  END NAVBAR  -->

   <!--  BEGIN MAIN CONTAINER  -->
   <div class="main-container" id="container">

      <div class="overlay"></div>
      <div class="search-overlay"></div>

      <!--  BEGIN TOPBAR  -->
      <div class="topbar-nav header navbar" role="banner">
         <nav id="topbar">


            <ul class="list-unstyled menu-categories" id="topAccordion">

               <li class="menu single-menu">
                  <a href="{{ url('/home') }}">
                     <div class="">
                        <svg class="svg-icon" viewBox="0 0 20 20">
                           <path d="M18.121,9.88l-7.832-7.836c-0.155-0.158-0.428-0.155-0.584,0L1.842,9.913c-0.262,0.263-0.073,0.705,0.292,0.705h2.069v7.042c0,0.227,0.187,0.414,0.414,0.414h3.725c0.228,0,0.414-0.188,0.414-0.414v-3.313h2.483v3.313c0,0.227,0.187,0.414,0.413,0.414h3.726c0.229,0,0.414-0.188,0.414-0.414v-7.042h2.068h0.004C18.331,10.617,18.389,10.146,18.121,9.88 M14.963,17.245h-2.896v-3.313c0-0.229-0.186-0.415-0.414-0.415H8.342c-0.228,0-0.414,0.187-0.414,0.415v3.313H5.032v-6.628h9.931V17.245z M3.133,9.79l6.864-6.868l6.867,6.868H3.133z"></path>
                        </svg>
                        <span>Home</span>
                     </div>
                  </a>
               </li>

               @if(Auth::user()->role_id == 1)
               <li class="menu single-menu">
                  <a href="#components" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                     <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box">
                           <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                           <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                           <line x1="12" y1="22.08" x2="12" y2="12"></line>
                        </svg>
                        <span>Content Management</span>
                     </div>
                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                        <polyline points="6 9 12 15 18 9"></polyline>
                     </svg>
                  </a>
                  <ul class="collapse submenu list-unstyled" id="components" data-parent="#topAccordion">
                     <li>
                        <a href="{{ url('/categories') }}"> Categories List </a>
                     </li>
                     <li>
                        <a href="{{ url('/content-dashboard') }}"> Dashboard List </a>
                     </li>
                     <li>
                        <a href="{{ url('/service-interruption') }}"> Under Maintenance </a>
                     </li>
                  </ul>
               </li>

               @php
               $pendingRequestsCount = DB::table('permission_request')->where('request_status', 0)->count();
               @endphp

               <li class="menu single-menu">
                  <a href="{{ url('/permission') }}" class="position-relative d-flex align-items-center">
                     <div>
                        <svg class="svg-icon" viewBox="0 0 20 20">
                           <path d="M14.38,3.467l0.232-0.633c0.086-0.226-0.031-0.477-0.264-0.559c-0.229-0.081-0.48,0.033-0.562,0.262l-0.234,0.631C10.695,2.38,7.648,3.89,6.616,6.689l-1.447,3.93l-2.664,1.227c-0.354,0.166-0.337,0.672,0.035,0.805l4.811,1.729c-0.19,1.119,0.445,2.25,1.561,2.65c1.119,0.402,2.341-0.059,2.923-1.039l4.811,1.73c0,0.002,0.002,0.002,0.002,0.002c0.23,0.082,0.484-0.033,0.568-0.262c0.049-0.129,0.029-0.266-0.041-0.377l-1.219-2.586l1.447-3.932C18.435,7.768,17.085,4.676,14.38,3.467 M9.215,16.211c-0.658-0.234-1.054-0.869-1.014-1.523l2.784,0.998C10.588,16.215,9.871,16.447,9.215,16.211 M16.573,10.27l-1.51,4.1c-0.041,0.107-0.037,0.227,0.012,0.33l0.871,1.844l-4.184-1.506l-3.734-1.342l-4.185-1.504l1.864-0.857c0.104-0.049,0.188-0.139,0.229-0.248l1.51-4.098c0.916-2.487,3.708-3.773,6.222-2.868C16.187,5.024,17.489,7.783,16.573,10.27"></path>
                        </svg>
                        <span>Roles & Permission</span>
                     </div>
                     @if ($pendingRequestsCount > 0)
                     <span class="badge badge-pills badge-danger badge-sm text-white position-absolute top-0 end-0 translate-middle" style="font-size: 0.75rem;">{{ $pendingRequestsCount }}</span>
                     @endif
                  </a>
               </li>


               <li class="menu single-menu">
                  <a href="{{ url('/user-management') }}">
                     <div class="">
                        <svg class="svg-icon" viewBox="0 0 20 20">
                           <path d="M15.573,11.624c0.568-0.478,0.947-1.219,0.947-2.019c0-1.37-1.108-2.569-2.371-2.569s-2.371,1.2-2.371,2.569c0,0.8,0.379,1.542,0.946,2.019c-0.253,0.089-0.496,0.2-0.728,0.332c-0.743-0.898-1.745-1.573-2.891-1.911c0.877-0.61,1.486-1.666,1.486-2.812c0-1.79-1.479-3.359-3.162-3.359S4.269,5.443,4.269,7.233c0,1.146,0.608,2.202,1.486,2.812c-2.454,0.725-4.252,2.998-4.252,5.685c0,0.218,0.178,0.396,0.395,0.396h16.203c0.218,0,0.396-0.178,0.396-0.396C18.497,13.831,17.273,12.216,15.573,11.624 M12.568,9.605c0-0.822,0.689-1.779,1.581-1.779s1.58,0.957,1.58,1.779s-0.688,1.779-1.58,1.779S12.568,10.427,12.568,9.605 M5.06,7.233c0-1.213,1.014-2.569,2.371-2.569c1.358,0,2.371,1.355,2.371,2.569S8.789,9.802,7.431,9.802C6.073,9.802,5.06,8.447,5.06,7.233 M2.309,15.335c0.202-2.649,2.423-4.742,5.122-4.742s4.921,2.093,5.122,4.742H2.309z M13.346,15.335c-0.067-0.997-0.382-1.928-0.882-2.732c0.502-0.271,1.075-0.429,1.686-0.429c1.828,0,3.338,1.385,3.535,3.161H13.346z"></path>
                        </svg>
                        <span>User Management</span>
                     </div>
                  </a>
               </li>
               @endif
            </ul>
         </nav>
      </div>
      <!--  END TOPBAR  -->

      <!--  BEGIN CONTENT PART  -->
      <div id="content" class="main-content">
         <div class="layout-px-spacing">
            <!-- <div class="page-header">
               <div class="dropdown filter custom-dropdown-icon">
                  <a class="dropdown-toggle btn" href="#" role="button" id="filterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="text"><span>Show</span> : Daily Analytics</span> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                        <polyline points="6 9 12 15 18 9"></polyline>
                     </svg></a>

                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="filterDropdown">
                     <a class="dropdown-item" data-value="<span>Show</span> : Daily Analytics" href="javascript:void(0);">Daily Analytics</a>
                     <a class="dropdown-item" data-value="<span>Show</span> : Weekly Analytics" href="javascript:void(0);">Weekly Analytics</a>
                     <a class="dropdown-item" data-value="<span>Show</span> : Monthly Analytics" href="javascript:void(0);">Monthly Analytics</a>
                     <a class="dropdown-item" data-value="Download All" href="javascript:void(0);">Download All</a>
                     <a class="dropdown-item" data-value="Share Statistics" href="javascript:void(0);">Share Statistics</a>
                  </div>
               </div>
            </div> -->
            <br>
            <div class="row layout-top-spacing">

               <div class="col-xl-4 col-lg-6 col-md-6 layout-spacing">
                  <div class="widget widget-card-four">
                     <div class="widget-content">
                        <div class="w-header">
                           <div class="w-info">
                              <h6 class="value">Dashboard</h6>
                           </div>
                        </div>

                        <div class="w-content">

                           <div class="w-info">
                              <p class="value">{{ $activeDashboardsCount }} <span>Active</span> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trending-up">
                                    <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                    <polyline points="17 6 23 6 23 12"></polyline>
                                 </svg></p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="col-xl-4 col-lg-6 col-md-6 layout-spacing">
                  <div class="widget widget-card-four">
                     <div class="widget-content">
                        <div class="w-header">
                           <div class="w-info">
                              <h6 class="value">Recipient</h6>
                           </div>
                        </div>

                        <div class="w-content">
                           <div class="w-info">
                              <p class="value">{{ $activeRecipientCount }} <span>Active</span>
                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trending-up">
                                    <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                    <polyline points="17 6 23 6 23 12"></polyline>
                                 </svg>
                              </p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="col-xl-4 col-lg-6 col-md-6 layout-spacing">
                  <div class="widget widget-card-four">
                     <div class="widget-content">
                        <h4>
                           <center><strong>Coming Soon</strong>
                        </h4>
                        <center><img src="{{ asset('mindset.svg') }}" alt="" width="88">
                     </div>
                  </div>
               </div>

               <div class="col-lg-12 col-12 layout-spacing">
                  <div class="statbox widget box box-shadow">
                     <div class="widget-header">
                        <div class="row">
                           <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                              <h4>User Overview</h4>
                           </div>
                        </div>
                     </div>
                     <div class="widget-content widget-content-area animated-underline-content">

                        <ul class="nav nav-tabs" id="animateLine" role="tablist">
                           <li class="nav-item">
                              <a class="nav-link active" id="animated-underline-home-tab" data-toggle="tab" href="#animated-underline-home" role="tab" aria-controls="animated-underline-home" aria-selected="true">
                                 <strong>Recipient List</strong>
                              </a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" id="animated-underline-profile-tab" data-toggle="tab" href="#animated-underline-profile" role="tab" aria-controls="animated-underline-profile" aria-selected="false">
                                 <strong>Dashboard List</strong>
                              </a>
                           </li>
                        </ul>

                        <div class="tab-content" id="animateLineContent-4">
                           <div class="tab-pane fade show active" id="animated-underline-home" role="tabpanel" aria-labelledby="animated-underline-home-tab">
                              <a href="{{ url('/add-recipient') }}" class="btn btn-primary mb-2 mt-3 mr-3" style="float: right;">
                                 <svg class="svg-icon" viewBox="0 0 20 20">
                                    <path d="M14.613,10c0,0.23-0.188,0.419-0.419,0.419H10.42v3.774c0,0.23-0.189,0.42-0.42,0.42s-0.419-0.189-0.419-0.42v-3.774H5.806c-0.23,0-0.419-0.189-0.419-0.419s0.189-0.419,0.419-0.419h3.775V5.806c0-0.23,0.189-0.419,0.419-0.419s0.42,0.189,0.42,0.419v3.775h3.774C14.425,9.581,14.613,9.77,14.613,10 M17.969,10c0,4.401-3.567,7.969-7.969,7.969c-4.402,0-7.969-3.567-7.969-7.969c0-4.402,3.567-7.969,7.969-7.969C14.401,2.031,17.969,5.598,17.969,10 M17.13,10c0-3.932-3.198-7.13-7.13-7.13S2.87,6.068,2.87,10c0,3.933,3.198,7.13,7.13,7.13S17.13,13.933,17.13,10" fill="white"></path>
                                 </svg>&nbsp; Add Recipient
                              </a>

                              <table id="zero-config" class="table table-striped" style="width:100%">
                                 <thead>
                                    <tr>
                                       <th>Recipient</th>
                                       <th>Job Title</th>
                                       <th class="no-content">Total Dashboard</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @foreach ($recipients as $recipient)
                                    <tr>
                                       <td><strong>{{ $recipient->email }}</strong></td>
                                       <td>{{ $recipient->job_title }}</td>
                                       <td>
                                          <a href="{{ route('recipient_dashboards', ['recipient_id' => $recipient->recipient_id]) }}" class="text-primary">
                                             <i class="fas fa-eye"></i>&nbsp; <strong>{{ $recipient->total_dashboards }}&nbsp; Dashboards</strong>
                                          </a>
                                       </td>

                                    </tr>
                                    @endforeach

                                 </tbody>
                              </table>
                           </div>


                           <div class="tab-pane fade" id="animated-underline-profile" role="tabpanel" aria-labelledby="animated-underline-profile-tab">
                              <a href="{{ url('/add-dashboards') }}" class="btn btn-primary mb-2 mt-3 mr-3" style="float: right;">
                                 <svg class="svg-icon" viewBox="0 0 20 20">
                                    <path d="M14.613,10c0,0.23-0.188,0.419-0.419,0.419H10.42v3.774c0,0.23-0.189,0.42-0.42,0.42s-0.419-0.189-0.419-0.42v-3.774H5.806c-0.23,0-0.419-0.189-0.419-0.419s0.189-0.419,0.419-0.419h3.775V5.806c0-0.23,0.189-0.419,0.419-0.419s0.42,0.189,0.42,0.419v3.775h3.774C14.425,9.581,14.613,9.77,14.613,10 M17.969,10c0,4.401-3.567,7.969-7.969,7.969c-4.402,0-7.969-3.567-7.969-7.969c0-4.402,3.567-7.969,7.969-7.969C14.401,2.031,17.969,5.598,17.969,10 M17.13,10c0-3.932-3.198-7.13-7.13-7.13S2.87,6.068,2.87,10c0,3.933,3.198,7.13,7.13,7.13S17.13,13.933,17.13,10" fill="white"></path>
                                 </svg>&nbsp; Add Dashboard
                              </a>

                              <table id="zero-config2" class="table table-striped" style="width:100%">
                                 <thead>
                                    <tr>
                                       <th>Dasboard</th>
                                       <th>Description</th>
                                       <th>PIC</th>
                                       <th class="no-content">Total Recipient</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @foreach($dashboards as $dashboard)
                                    <td><strong>{{ $dashboard->name }}</strong></td>
                                    <td>{{ $dashboard->description }}</td>
                                    <td>{{ $dashboard->pic }}</td>
                                    <td>
                                       <a href="{{ route('dashboard.recipients', ['id' => $dashboard->id]) }}" class="text-primary">
                                          <i class="fas fa-eye"></i>&nbsp; <strong>{{ $dashboard->total_recipient }}&nbsp; Recipient</strong>
                                       </a>
                                    </td>
                                    </tr>
                                    @endforeach
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

            </div>

         </div>
      </div>
      <!--  END CONTENT PART  -->

   </div>
   <!-- END MAIN CONTAINER -->

   <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
   <script src="{{ asset('other/assets/js/libs/jquery-3.1.1.min.js') }}">
   </script>
   <script src="{{ asset('other/bootstrap/js/popper.min.js') }}"></script>
   <script src="{{ asset('other/bootstrap/js/bootstrap.min.js') }}"></script>
   <script src="{{ asset('other/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
   <script src="{{ asset('other/assets/js/app.js') }}"></script>
   <script>
      $(document).ready(function() {
         App.init();
      });
   </script>
   <script src="{{ asset('other/assets/js/custom.js') }}"></script>
   <!-- END GLOBAL MANDATORY SCRIPTS -->

   <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
   <script src="{{ asset('other/plugins/apex/apexcharts.min.js') }}"></script>
   <script src="{{ asset('other/assets/js/dashboard/dash_2.js') }}"></script>
   <script src="{{ asset('other/plugins/highlight/highlight.pack.js') }}"></script>
   <script src="{{ asset('other/assets/js/scrollspyNav.js') }}"></script>
   <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
   <!-- BEGIN PAGE LEVEL SCRIPTS -->
   <script src="{{ asset('other/plugins/table/datatable/datatables.js') }}"></script>
   <script>
      $('#zero-config').DataTable({
         "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
            "<'table-responsive'tr>" +
            "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
         "oLanguage": {
            "oPaginate": {
               "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
               "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
            },
            "sInfo": "Showing page _PAGE_ of _PAGES_",
            "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
            "sSearchPlaceholder": "Search...",
            "sLengthMenu": "Results :  _MENU_",
         },
         "stripeClasses": [],
         "lengthMenu": [7, 10, 20, 50],
         "pageLength": 7
      });
   </script>

   <script>
      $('#zero-config2').DataTable({
         "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
            "<'table-responsive'tr>" +
            "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
         "oLanguage": {
            "oPaginate": {
               "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
               "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
            },
            "sInfo": "Showing page _PAGE_ of _PAGES_",
            "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
            "sSearchPlaceholder": "Search...",
            "sLengthMenu": "Results :  _MENU_",
         },
         "stripeClasses": [],
         "lengthMenu": [7, 10, 20, 50],
         "pageLength": 7
      });
   </script>
   <!-- END PAGE LEVEL SCRIPTS -->

   @if(Session::has('success'))
   <script>
      Swal.fire({
         icon: 'success',
         title: 'Success',
         text: '{!! Session::get("success") !!}',
         timer: 2000,
         timerProgressBar: true,
         showConfirmButton: false
      });
   </script>
   @endif

</body>

</html>