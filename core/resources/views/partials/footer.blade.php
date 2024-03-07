  <!-- BEGIN: Footer-->

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


  <script>
      $(document).ready(function() {
          $('#example').DataTable({

          });
      });
  </script>

  <script>
      $(document).ready(function() {
          $('#examples').DataTable({

          });
      });
  </script>

  <script>
      $(document).ready(function() {
          $('#reject').DataTable({

          });
      });
  </script>

  <script>
      $(document).ready(function() {
          $('#exampless').DataTable({
              "lengthMenu": [5, 10, 25, 50], // Menampilkan pilihan jumlah data per halaman
              "pageLength": 5, // Default tampilan 5 data per halaman
              // Tambahan opsi atau pengaturan lain yang mungkin Anda butuhkan
          });
      });
  </script>

  <script>
      $(document).ready(function() {
          $('[id^="dataTables_"]').DataTable({
              "lengthMenu": [5, 10, 25, 50],
              "pageLength": 5,
              // Opsi atau pengaturan lain yang mungkin Anda butuhkan
          });
      });
  </script>


  <script>
      $(document).ready(function() {
          $('#permissionss').DataTable({
              "lengthMenu": [5, 10, 25, 50], // Menampilkan pilihan jumlah data per halaman
              "pageLength": 5, // Default tampilan 5 data per halaman
              // Tambahan opsi atau pengaturan lain yang mungkin Anda butuhkan
          });
      });
  </script>


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

  <script>
      document.addEventListener('DOMContentLoaded', function() {
          const uploadInput = document.getElementById('account-upload');
          const imagePreview = document.getElementById('account-upload-img');
          const resetButton = document.getElementById('account-reset');

          // Event listener for file input change
          uploadInput.addEventListener('change', function() {
              const file = this.files[0];
              if (file) {
                  const reader = new FileReader();

                  // FileReader onload event, called when file is read
                  reader.onload = function(e) {
                      const imgSrc = e.target.result;
                      // Update image preview with selected image
                      imagePreview.src = imgSrc;
                  };

                  // Read the file as a data URL (base64 encoded image)
                  reader.readAsDataURL(file);
              }
          });

          // Event listener for reset button click
          resetButton.addEventListener('click', function() {
              // Clear the file input and reset image to the default
              uploadInput.value = '';
              imagePreview.src = "{{ asset('no-img.png') }}";
          });
      });
  </script>

  <script>
      $(document).ready(function() {
          $('#filterBtn').on('click', function() {
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

              var formData = $('#filterForm').serialize();

              $.ajax({
                  url: "{{ route('filter.category') }}",
                  type: "POST",
                  data: formData,
                  success: function(response) {
                      updateCards(response);

                      setTimeout(function() {
                          Swal.close();
                      }, 1000);
                  },
                  error: function(error) {
                      console.error('Error:', error);

                      setTimeout(function() {
                          Swal.close();
                      }, 1000);
                  }
              });
          });

          function updateCards(data) {
              var dashboardContainer = $('#dashboardContainer');
              dashboardContainer.empty();

              if (data.length === 0) {
                  var noDataHtml = `
          <center><img src="{{ asset('no-data.svg') }}" width="600" alt="Card image cap" /><br><br><br>
          <span class="mt-4">
            <strong>
              <h4>Oops, the data you were looking for was not found.</h4>
            </strong>
          </span>
        `;
                  dashboardContainer.append(noDataHtml);
              } else {
                  $.each(data, function(index, row) {
                      var dashboardNameSlug = encodeURIComponent(row.dashboard_name.replace(/\s+/g, '-'));
                      var detailButton = '';

                      if (row.dashboard_status === 0) {
                          detailButton = `<a href="#" class="btn btn-danger mt-2 btn-under-maintenance">Under Maintenance</a>`;
                      } else if (row.is_allowed) {
                          if (row.permission_type === 0) {
                              // If permission_type is 0, display "Suspend" button
                              detailButton = `<button class="btn btn-danger mt-2">Access revoked</button>`;
                          } else {
                              // Otherwise, display "Detail Dashboard" button
                              detailButton = `<a href="/portaldashboardv2/detail/${dashboardNameSlug}" class="btn btn-relief-primary mt-2">View Dashboard</a>`;
                          }
                      } else {
                          var permissionType = row.permission_type || 0; // default to 0 if permission_type is null
                          if (row.request_status === 0) {
                              detailButton = `<button class="btn btn-warning mt-2">Waiting for permit approval</button>`;
                          } else {
                              if (permissionType === 0) {
                                  detailButton = `<button class="btn btn-danger mt-2">Access revoked</button>`;
                              } else {
                                  detailButton = `
                  <div class="not-allowed">
                    <button class="btn btn-success mt-2" data-bs-toggle="modal" data-bs-target="#editCategoryModal${row.dashboard_id}">
                      Request access
                    </button>
                  </div>`;
                              }
                          }
                      }

                      var cardHtml = `
            <div class="col-md-6 col-lg-4" id="dashboard${row.dashboard_id}">
              <div class="card text-center">
                <img class="card-img-top" src="{{ asset('core/uploads/') }}/${row.image}" alt="Card image cap" />
                <div class="card-body">
                  <h4 class="card-title">${row.dashboard_name}</h4>
                  <p class="card-text">${row.description}</p>
                  ${detailButton}
                </div>
              </div>
            </div>
          `;

                      dashboardContainer.append(cardHtml);
                  });
              }
          }
      });
  </script>


  <script>
      function showPleaseWaitAlertAndMaintenance() {
          Swal.fire({
              title: 'Please wait',
              text: 'Process requests...',
              icon: 'info',
              showConfirmButton: false,
              timer: 1000, // 1 detik
              timerProgressBar: true,
              didOpen: () => {
                  Swal.showLoading();
                  // Setelah 1 detik, tampilkan SweetAlert "Under Maintenance"
                  setTimeout(() => {
                      Swal.fire({
                          title: 'Under Maintenance',
                          text: 'This dashboard is currently under maintenance.',
                          icon: 'warning',
                          confirmButtonText: 'Close',
                      });
                  }, 1000);
              }
          });
      }

      $(document).ready(function() {
          // Tangkap event saat tombol "Under Maintenance" di-klik
          $(document).on('click', '.btn-under-maintenance', function(event) {
              event.preventDefault();
              showPleaseWaitAlertAndMaintenance();
          });

          // ... (kode lainnya)
      });
  </script>

  @if(Session::has('success'))
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
      toastr.success('{!! Session::get("success") !!}', 'Success', {
          "progressBar": true,
          "timeOut": 5000
      });
  </script>
  @endif

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


  <script>
      // Function to show Toastr error alert
      function showToastr() {
          toastr.error('This feature will be coming soon.', 'Oopss..', {
              "progressBar": true,
              "timeOut": 5000
          });
      }
  </script>

  <script>
      document.addEventListener('DOMContentLoaded', function() {
          var showIpLinks = document.querySelectorAll('.show-ip');

          showIpLinks.forEach(function(link) {
              link.addEventListener('click', function(e) {
                  e.preventDefault();
                  var ip = this.getAttribute('data-ip');

                  // Jika IP adalah '::1', ganti dengan '127.0.0.1'
                  if (ip === '::1') {
                      ip = '127.0.0.1';
                  }

                  Swal.fire({
                      title: 'Please wait',
                      text: 'Looking for your IP Address...',
                      allowOutsideClick: false,
                      allowEscapeKey: false,
                      allowEnterKey: false,
                      showConfirmButton: false,
                      willOpen: () => {
                          Swal.showLoading();
                      }
                  });

                  setTimeout(() => {
                      Swal.update({
                          title: 'IP Address',
                          text: 'IP Address: ' + ip,
                          icon: 'info',
                          allowOutsideClick: true,
                          allowEscapeKey: true,
                          allowEnterKey: true,
                          showConfirmButton: true
                      });
                      // Hapus ikon "Loading" setelah notifikasi tampil
                      Swal.hideLoading();
                  }, 1000); // Menunggu 1 detik sebelum menampilkan IP Address
              });
          });
      });
  </script>

  <script>
      $(document).ready(function() {
          // Mengubah status ke Maintenance atau Active saat tombol diklik
          $('.set-maintenance, .set-active').on('click', function() {
              var dashboardId = $(this).data('dashboard-id');
              var setStatus = $(this).hasClass('set-maintenance') ? 'maintenance' : 'active';
              var statusText = setStatus.charAt(0).toUpperCase() + setStatus.slice(1);

              // Tampilkan alert "Please wait" dengan penundaan selama 1 detik
              Swal.fire({
                  title: 'Please wait',
                  text: 'Changing dashboard status...',
                  icon: 'info',
                  showConfirmButton: false,
                  timer: 2000, // 1 detik
                  timerProgressBar: true,
                  didOpen: () => {
                      Swal.showLoading();
                  }
              }).then(() => {
                  // Kirim permintaan ke server untuk mengubah status dashboard
                  $.ajax({
                      url: "{{ route('change-status') }}",
                      type: "POST",
                      data: {
                          dashboardId: dashboardId,
                          status: setStatus,
                          _token: '{{ csrf_token() }}'
                      },
                      success: function(response) {
                          // Jika berhasil, ubah status visual di dalam tabel
                          var newStatus = statusText === 'Active' ? 'badge bg-success' : 'badge bg-danger';
                          var buttonText = statusText === 'Active' ? 'Set to Maintenance' : 'Set to Active';
                          $('.set-maintenance[data-dashboard-id="' + dashboardId + '"]').removeClass('set-maintenance').addClass('set-active').text(buttonText);
                          $('.badge[data-dashboard-id="' + dashboardId + '"]').removeClass().addClass(newStatus).text(statusText);

                          // Tampilkan alert success
                          Swal.fire({
                              title: 'Success',
                              text: 'Dashboard status changed to ' + statusText,
                              icon: 'success',
                              showCancelButton: false,
                              confirmButtonText: 'OK'
                          }).then((result) => {
                              if (result.isConfirmed) {
                                  // Refresh halaman setelah menekan tombol OK
                                  location.reload();
                              }
                          });
                      },
                      error: function(error) {
                          console.error('Error:', error);
                          Swal.fire('Error', 'An error occurred while changing dashboard status', 'error');
                      }
                  });
              });
          });
      });
  </script>


  <script>
      // Menangkap tautan dengan ID
      const maintenanceLink = document.getElementById('maintenance-link');

      // Menambahkan event listener untuk tautan
      maintenanceLink.addEventListener('click', function(event) {
          event.preventDefault(); // Mencegah perilaku default dari tautan

          // Menampilkan SweetAlert "Please wait"
          Swal.fire({
              title: 'Please wait',
              text: 'Process requests...',
              icon: 'info',
              showConfirmButton: false,
              timer: 1000, // 1 detik
              timerProgressBar: true,
              didOpen: () => {
                  Swal.showLoading();
                  // Setelah 1 detik, munculkan pemberitahuan
                  setTimeout(() => {
                      Swal.fire({
                          title: 'Under Maintenance',
                          text: 'This dashboard is currently under maintenance.',
                          icon: 'warning',
                          confirmButtonText: 'Close',
                      });
                  }, 1000);
              }
          });
      });
  </script>

  <script>
      function togglePasswordVisibility(inputId, toggleBtnId) {
          const input = document.getElementById(inputId);
          const toggleBtn = document.getElementById(toggleBtnId);

          if (input.type === "password") {
              input.type = "text";
              toggleBtn.innerHTML = '<i data-feather="eye-off"></i>';
          } else {
              input.type = "password";
              toggleBtn.innerHTML = '<i data-feather="eye"></i>';
          }
      }

      feather.replace(); // Initialize Feather icons (assuming you're using Feather icons library)
  </script>

  <script>
      $(document).ready(function() {
          $('#selectPlatform').change(function() {
              var selectedPlatform = $(this).val();

              // Hide all fields initially
              $('#embedUrlContainer, #viewNameContainer').hide();

              // Show fields based on selected platform
              if (selectedPlatform === 'Tableau') {
                  $('#embedUrlContainer').show();
                  $('#viewNameContainer').show();
              } else if (selectedPlatform === 'PowerBI') {
                  $('#embedUrlContainer').show();
              }
          });
      });
  </script>





  </body>
  <!-- END: Body-->

  </html>