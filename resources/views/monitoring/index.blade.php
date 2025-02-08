
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Homy</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('style/dist/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style/dist/assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('style/dist/assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('style/dist/assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{asset('style/dist/assets/vendors/font-awesome/css/font-awesome.min.css')}}" />
    <link rel="stylesheet" href="{{asset('style/dist/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset('style/dist/assets/css/style.css')}}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{asset('style/dist/assets/images/favicon.png')}}" />
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
          <a class="navbar-brand brand-logo" href="index.html"><img src="{{asset('style/dist/assets/images/homy-logo.png')}}" alt="logo" /></a>
          <a class="navbar-brand brand-logo-mini" href="index.html"><img src="{{asset('style/dist/assets/images/logo-mini.svg')}}" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item d-none d-lg-block full-screen-link">
              <a class="nav-link">
                <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
              </a>
            </li>
            <li class="nav-item nav-logout d-none d-lg-block">
              <form method="POST" action="{{ route('logout') }}" id="logout-form">
                  @csrf
                  <a class="nav-link" href="#" onclick="document.getElementById('logout-form').submit(); return false;">
                      <i class="mdi mdi-power"></i> Logout
                  </a>
              </form>
          </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link" href="/home" aria-expanded="false" aria-controls="charts">
                <span class="menu-title">Control Page</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/monitoring" aria-expanded="false" aria-controls="charts">
                <span class="menu-title">Monitoring</span>
                <i class="mdi mdi-chart-bar menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/users" aria-expanded="false" aria-controls="charts">
                <span class="menu-title">Users</span>
                {{-- <i class="menu-arrow"></i> --}}
                <i class="mdi mdi-lock menu-icon"></i>
              </a>
            </li>
          </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Monitoring Page
              </h3>
            </div>      
                    
            <div class="row">
              <div class="col-md-7 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="clearfix">
                      <h4 class="card-title float-start">Living Room Temperature</h4>
                    </div>
                    <canvas id="visit-sale-chart" class="mt-4"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-md-5 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Rain Status</h4>
                    <div class="doughnutjs-wrapper d-flex justify-content-center">
                      <!-- Image for rain/sun status -->
                      <img id="rain-status-image" src="" alt="Rain or Sun Image" style="display: none; width: 200px; height: 200px;margin-top: 40px;">
                    </div>
                    <!-- Container for No Data text or other content -->
                    <div id="rain-status-container" class="text-center pt-4"></div>
                  </div>
                </div>
              </div>              
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2025 <a href="https://www.bootstrapdash.com/" target="_blank">BootstrapDash</a>. All rights reserved.</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Laila Khoirunnisa Nurul Imani <i class="mdi mdi-heart text-danger"></i></span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{asset('style/dist/assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{asset('style/dist/assets/vendors/chart.js/chart.umd.js')}}"></script>
    <script src="{{asset('style/dist/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{asset('style/dist/assets/js/off-canvas.js')}}"></script>
    <script src="{{asset('style/dist/assets/js/misc.js')}}"></script>
    <script src="{{asset('style/dist/assets/js/settings.js')}}"></script>
    <script src="{{asset('style/dist/assets/js/todolist.js')}}"></script>
    <script src="{{asset('style/dist/assets/js/jquery.cookie.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>
    <script src="{{asset('style/dist/assets/js/dashboard.js')}}"></script>
    <script src="{{asset('style/dist/assets/js/custom.js')}}"></script>
    <!-- End custom js for this page -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById("visit-sale-chart").getContext("2d");
    
        // Initialize the chart with empty data
        const visitSaleChart = new Chart(ctx, {
          type: "line",
          data: {
            labels: [], // Empty labels initially
            datasets: [
              {
                label: "Temp",
                data: [], // Empty data initially
                borderColor: "#9C27B0",
                backgroundColor: "rgba(156, 39, 176, 0.2)",
                fill: true,
                tension: 0.4,
                pointBorderColor: "#9C27B0",
                pointBackgroundColor: "#FFFFFF",
                pointBorderWidth: 2,
              },
            ],
          },
          options: {
            responsive: true,
            plugins: {
              legend: {
                display: true,
                position: "top",
              },
              tooltip: {
                enabled: true,
              },
            },
            scales: {
              x: {
                title: {
                  display: true,
                  text: "Time",
                },
              },
              y: {
                title: {
                  display: true,
                  text: "Temperature",
                },
                beginAtZero: true,
              },
            },
          },
        });
      });
    </script>
    <script>
      // Simulate the rainStatus value (false for no rain)
      const rainStatus = null; // Change this to `true` or `null` to simulate different scenarios

      const rainStatusImage = document.getElementById('rain-status-image');
      const rainStatusContainer = document.getElementById('rain-status-container');

      if (rainStatus === null) {
        // Display "No Data" if rainStatus is null
        rainStatusImage.style.display = 'none';
        rainStatusContainer.innerHTML = '<p>No Data</p>';
      } else {
        // Clear any "No Data" text
        rainStatusContainer.innerHTML = ''; 
        rainStatusImage.style.display = 'block'; 

        if (rainStatus) {
          // Rain image if rainStatus is true
          rainStatusImage.src = "{{ asset('images/rain.png') }}"; 
        } else {
          // Sun image if rainStatus is false
          rainStatusImage.src = "{{ asset('images/sun.png') }}";  
        }
      }
    </script>
  </body>
</html>