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
   <link rel="stylesheet" type="text/css" href="{{ asset('other/assets/css/widgets/modules-widgets.css') }}">
   <link href="{{ asset('other/assets/css/apps/contacts.css') }}" rel="stylesheet" type="text/css" />
   <link href="{{ asset('other/assets/css/users/account-setting.css') }}" rel="stylesheet" type="text/css" />
   <link rel="stylesheet" type="text/css" href="{{ asset('other/assets/css/forms/switches.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('other/plugins/select2/select2.min.css') }}">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
   <link href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.css" rel="stylesheet">
   <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js"></script>
   <!-- END PAGE LEVEL STYLES -->

</head>

<style>
   /* CSS untuk mengatur garis horizontal menjadi dashed */
   hr.dashed {
      border-style: dashed;
      border-width: 1px;
      border-color: #ccc;
   }

   /* CSS untuk mengatur input berbentuk bulat (rounded) */
   .rounded-input {
      border-radius: 20px;
      /* Sesuaikan radius sesuai keinginan Anda */
   }
</style>

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
            <br>
            <div class="page-header">
               <nav class="breadcrumb-one" aria-label="breadcrumb">
                  <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="{{ url('/user-management') }}">User Management</a></li>
                     <li class="breadcrumb-item active" aria-current="page"><a class="text-muted">Add Recipient</a></li>
                  </ol>
               </nav>
            </div>
            <div class="row layout-top-spacing">

               <div class="col-xl-8 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                  <div class="account-settings-container layout-top-spacing">
                     <!-- <div class="row mt-2">
                        <div class="col-xl-12 col-lg-12 col-md-8 mt-md-0 mt-4">
                           <div class="form">
                              <div class="row">
                                 <div class="col-sm-12">
                                    <div class="form-group">
                                       <div class="input-group">
                                          <input type="text" class="form-control rounded-input" id="searchInput" autocomplete="off" placeholder="Search by Recipient" aria-label="notification" aria-describedby="basic-addon2">
                                          <div class="input-group-append">
                                             <span class="input-group-text" id="clearResults">
                                                <i class="fas fa-times"></i>
                                             </span>
                                          </div>
                                       </div>
                                       <div class="card mt-3" id="searchResults" style="display: none; max-height: 300px; overflow-y: auto;"></div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div> -->
                     <form id="general-info" class="section general-info" action="{{ route('user.store') }}" method="post">
                        @csrf
                        <div class="account-content">
                           <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                              <div class="row">
                                 <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <div class="info">
                                       <div class="row">
                                          <div class="col-lg-12 mx-auto">
                                             <div class="row mt-2">
                                                <div class="col-xl-12 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                   <div class="form">
                                                      <div class="row">
                                                         <div class="col-sm-6">
                                                            <div class="form-group">
                                                               <label for="fullName">Name <span class="text-danger">*</span></label>
                                                               <input type="text" name="name" class="form-control" id="fullName" placeholder="Enter Name">
                                                            </div>
                                                         </div>
                                                         <div class="col-sm-6">
                                                            <div class="form-group">
                                                               <label for="email">Email <span class="text-danger">*</span></label>
                                                               <input type="text" name="email" class="form-control" id="email" placeholder="Enter Email">
                                                            </div>
                                                         </div>
                                                      </div>


                                                      <div class="row">
                                                         <div class="col-sm-10">
                                                            <div class="form-group">
                                                               <label for="fullName">Job Title <span class="text-danger">*</span></label>
                                                               <input type="text" name="job_title" class="form-control" id="jobTitle" placeholder="Enter Job Title">
                                                            </div>
                                                         </div>


                                                         <div class="col-sm-2">
                                                            <div class="form-group">
                                                               <label>Is Active <span class="text-danger">*</span></label><br>
                                                               <label class="switch s-icons s-outline s-outline-primary mt-2">
                                                                  <input type="checkbox" name="is_active" checked> <!-- Menambahkan atribut name="is_active" -->
                                                                  <span class="slider round"></span>
                                                               </label>
                                                            </div>
                                                         </div>
                                                      </div>

                                                      <hr>

                                                      <div class="row">
                                                         <div class="col-sm-5">
                                                            <div class="form-group">
                                                               <label for="fullName">Dashboard <span class="text-danger">*</span></label>
                                                               <select name="dashboards[]" class="form-control basic" multiple="multiple">
                                                                  @foreach ($dashboards as $dashboard)
                                                                  <option value="{{ $dashboard->id }}">{{ $dashboard->name }}</option>
                                                                  @endforeach
                                                               </select>
                                                            </div>
                                                         </div>

                                                         <div class="col-sm-5">
                                                            <div class="form-group">
                                                               <label for="fullName">Recipient <span class="text-danger">*</span></label>
                                                               <select name="recipients[]" class="form-control recipient">
                                                                  <option hidden>Please Select</option>
                                                                  @foreach ($recipients as $recipient)
                                                                  <option value="{{ $recipient->id }}">{{ $recipient->email }}</option>
                                                                  @endforeach
                                                               </select>
                                                            </div>
                                                         </div>

                                                         <div class="col-sm-2">
                                                            <div class="form-group">
                                                               <label for="fullName">Flag <span class="text-danger">*</span></label>
                                                               <select name="flag" class="form-control">
                                                                  <option value="to">to</option>
                                                                  <option value="cc">cc</option>
                                                                  <option value="bcc">bcc</option>
                                                               </select>
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <hr>
                                                      <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-floppy-disk"></i>&nbsp; Simpan</button>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>

               <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 mt-4 layout-spacing">
                  <div class="widget widget-account-invoice-three">


                     <div class="widget-content">

                        <div class="invoice-list">

                           <div class="inv-detail">
                              <div class="info-detail-1">
                                 <p><b>Upload File</b></p>
                              </div>
                           </div>

                           <hr>

                           <form action="{{ route('upload-recipients') }}" method="post" enctype="multipart/form-data">
                              @csrf
                              <div class="inv-action">
                                 <input type="file" name="file" class="form-control">
                              </div>
                              <hr>
                              <button type="submit" class="btn btn-primary btn-sm">Upload</button>
                           </form>

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
   <script src="{{ asset('other/assets/js/widgets/modules-widgets.js') }}"></script>
   <script src="{{ asset('other/assets/js/elements/custom-search.js') }}"></script>
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
   <script src="{{ asset('other/plugins/select2/select2.min.js') }}"></script>
   <script src="{{ asset('other/plugins/select2/custom-select2.js') }}"></script>

   <script>
      var ss = $(".recipient").select2({
         tags: true,
         language: {
            noResults: function() {
               return "Data not found";
            }
         },
         createTag: function(params) {
            // Prevent creation of new tags
            return null;
         }
      });
   </script>


   <script>
      $(document).ready(function() {
         var ss = $(".basic").select2({
            tags: true,
            multiple: true,
            language: {
               noResults: function() {
                  return "Data not found";
               }
            },
            createTag: function(params) {
               // Prevent creation of new tags
               return null;
            }
         });
      });
   </script>

   <script>
      $(document).ready(function() {
         const recipientSelect = $('.recipient');
         const nameInput = $('input[name="name"]');
         const emailInput = $('input[name="email"]');
         const jobTitleInput = $('input[name="job_title"]');

         recipientSelect.on('change', function() {
            const selectedRecipientId = $(this).val();

            $.ajax({
               url: "{{ route('search-recipients') }}",
               type: "GET",
               data: {
                  recipient_id: selectedRecipientId
               },
               dataType: 'json',
               success: function(response) {
                  if (response.success && response.results) {
                     const recipientDetails = response.results;
                     nameInput.val(recipientDetails.name);
                     emailInput.val(recipientDetails.email);
                     jobTitleInput.val(recipientDetails.job_title);
                  }
               },
               error: function(error) {
                  console.error('Error fetching recipient details:', error);
               }
            });
         });
      });
   </script>

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

   @if(Session::has('error'))
   <script>
      Swal.fire({
         icon: 'error',
         title: 'Oopss...',
         text: '{!! Session::get("error") !!}',
      });
   </script>
   @endif





</body>

</html>