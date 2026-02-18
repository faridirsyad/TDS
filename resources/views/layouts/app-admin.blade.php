<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ADMIN - TDS International Indonesia</title>
    <!-- Favicons -->
    <link href="{{asset('assets/img/tds_bg.png')}}" rel="icon" />
    <link href="{{asset('assets/img/tds_bg.png')}}" rel="apple-touch-icon" />
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset("/assets/vendors/feather/feather.css")}}">
    <link rel="stylesheet" href="{{asset("/assets/vendors/mdi/css/materialdesignicons.min.css")}}">
    <link rel="stylesheet" href="{{asset("/assets/vendors/ti-icons/css/themify-icons.css")}}">
    <link rel="stylesheet" href="{{asset("/assets/vendors/font-awesome/css/font-awesome.min.css")}}">
    <link rel="stylesheet" href="{{asset("/assets/vendors/typicons/typicons.css")}}">
    <link rel="stylesheet" href="{{asset("/assets/vendors/simple-line-icons/css/simple-line-icons.css")}}">
    <link rel="stylesheet" href="{{asset("/assets/vendors/css/vendor.bundle.base.css")}}">
    <link rel="stylesheet" href="{{asset("/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css")}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{asset("/assets/vendors/font-awesome/css/font-awesome.min.css")}}" />
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset("/assets/css/style.css")}}">
    <link rel="stylesheet" href="{{asset("/assets/css/style3.css")}}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{asset("/assets/img/tds_bg.png")}}" />

    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>

    @livewireStyles
  </head>
  
  <body>
    <div class="container-scroller">
      <!-- partial:../../partials/_navbar.html -->
      <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
          <div class="me-3">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
              <span class="icon-menu"></span>
            </button>
          </div>
          <div>
            <a class="navbar-brand brand-logo" href="{{url("/")}}">
              <img src="{{asset("/assets/img/tds.png")}}" alt="logo" />
            </a>
            <a class="navbar-brand brand-logo-mini" href="{{url("/")}}">
              <img src="{{asset("/assets/img/tds.png")}}" alt="logo" />
            </a>
          </div>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-top">
          {{-- <ul class="navbar-nav">
            <li class="nav-item fw-semibold d-none d-lg-block ms-0">
              <h1 class="welcome-text">Good Morning, <span class="text-black fw-bold">John Doe</span></h1>
              <h3 class="welcome-sub-text">Your performance summary this week </h3>
            </li>
          </ul> --}}
          <ul class="navbar-nav ms-auto">
            {{-- <li class="nav-item dropdown d-none d-lg-block">
              <a class="nav-link dropdown-bordered dropdown-toggle dropdown-toggle-split" id="messageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false"> Select Category </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="messageDropdown">
                <a class="dropdown-item py-3">
                  <p class="mb-0 fw-medium float-start">Select category</p>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-item-content flex-grow py-2">
                    <p class="preview-subject ellipsis fw-medium text-dark">Bootstrap Bundle </p>
                    <p class="fw-light small-text mb-0">This is a Bundle featuring 16 unique dashboards</p>
                  </div>
                </a>
                <a class="dropdown-item preview-item">
                  <div class="preview-item-content flex-grow py-2">
                    <p class="preview-subject ellipsis fw-medium text-dark">Angular Bundle</p>
                    <p class="fw-light small-text mb-0">Everything you’ll ever need for your Angular projects</p>
                  </div>
                </a>
                <a class="dropdown-item preview-item">
                  <div class="preview-item-content flex-grow py-2">
                    <p class="preview-subject ellipsis fw-medium text-dark">VUE Bundle</p>
                    <p class="fw-light small-text mb-0">Bundle of 6 Premium Vue Admin Dashboard</p>
                  </div>
                </a>
                <a class="dropdown-item preview-item">
                  <div class="preview-item-content flex-grow py-2">
                    <p class="preview-subject ellipsis fw-medium text-dark">React Bundle</p>
                    <p class="fw-light small-text mb-0">Bundle of 8 Premium React Admin Dashboard</p>
                  </div>
                </a>
              </div>
            </li>
            <li class="nav-item d-none d-lg-block">
              <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
                <span class="input-group-addon input-group-prepend border-right">
                  <span class="icon-calendar input-group-text calendar-icon"></span>
                </span>
                <input type="text" class="form-control">
              </div>
            </li>
            <li class="nav-item">
              <form class="search-form" action="#">
                <i class="icon-search"></i>
                <input type="search" class="form-control" placeholder="Search Here" title="Search here">
              </form>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link count-indicator" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                <i class="icon-bell"></i>
                <span class="count"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="notificationDropdown">
                <a class="dropdown-item py-3 border-bottom">
                  <p class="mb-0 fw-medium float-start">You have 4 new notifications </p>
                  <span class="badge badge-pill badge-primary float-end">View all</span>
                </a>
                <a class="dropdown-item preview-item py-3">
                  <div class="preview-thumbnail">
                    <i class="mdi mdi-alert m-auto text-primary"></i>
                  </div>
                  <div class="preview-item-content">
                    <h6 class="preview-subject fw-normal text-dark mb-1">Application Error</h6>
                    <p class="fw-light small-text mb-0"> Just now </p>
                  </div>
                </a>
                <a class="dropdown-item preview-item py-3">
                  <div class="preview-thumbnail">
                    <i class="mdi mdi-lock-outline m-auto text-primary"></i>
                  </div>
                  <div class="preview-item-content">
                    <h6 class="preview-subject fw-normal text-dark mb-1">Settings</h6>
                    <p class="fw-light small-text mb-0"> Private message </p>
                  </div>
                </a>
                <a class="dropdown-item preview-item py-3">
                  <div class="preview-thumbnail">
                    <i class="mdi mdi-airballoon m-auto text-primary"></i>
                  </div>
                  <div class="preview-item-content">
                    <h6 class="preview-subject fw-normal text-dark mb-1">New user registration</h6>
                    <p class="fw-light small-text mb-0"> 2 days ago </p>
                  </div>
                </a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link count-indicator" id="countDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="icon-mail icon-lg"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="countDropdown">
                <a class="dropdown-item py-3">
                  <p class="mb-0 fw-medium float-start">You have 7 unread mails </p>
                  <span class="badge badge-pill badge-primary float-end">View all</span>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="{{asset("/assets/images/faces/face10.jpg")}}" alt="image" class="img-sm profile-pic">
                  </div>
                  <div class="preview-item-content flex-grow py-2">
                    <p class="preview-subject ellipsis fw-medium text-dark">Marian Garner </p>
                    <p class="fw-light small-text mb-0"> The meeting is cancelled </p>
                  </div>
                </a>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="{{asset("/assets/images/faces/face12.jpg")}}" alt="image" class="img-sm profile-pic">
                  </div>
                  <div class="preview-item-content flex-grow py-2">
                    <p class="preview-subject ellipsis fw-medium text-dark">David Grey </p>
                    <p class="fw-light small-text mb-0"> The meeting is cancelled </p>
                  </div>
                </a>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="{{asset("/assets/images/faces/face1.jpg")}}" alt="image" class="img-sm profile-pic">
                  </div>
                  <div class="preview-item-content flex-grow py-2">
                    <p class="preview-subject ellipsis fw-medium text-dark">Travis Jenkins </p>
                    <p class="fw-light small-text mb-0"> The meeting is cancelled </p>
                  </div>
                </a>
              </div>
            </li> --}}
            <li class="nav-item dropdown d-none d-lg-block user-dropdown">
              <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <img class="img-xs rounded-circle" src="{{asset("/assets/img/user.png")}}" alt="Profile image"> </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                <div class="dropdown-header text-center">
                  <img class="img-md rounded-circle" src="{{asset("/assets/img/user.png")}}" alt="Profile image" width="50px">
                  <p class="mb-1 mt-3 fw-semibold">{{ Auth::user()->username }}</p>
                  <p class="fw-light text-muted mb-0">{{ Auth::user()->email }}</p>
                </div>
                <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My Profile</a>
                {{-- <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-message-text-outline text-primary me-2"></i> Messages</a>
                <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-calendar-check-outline text-primary me-2"></i> Activity</a>
                <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-help-circle-outline text-primary me-2"></i> FAQ</a> --}}
                <a class="dropdown-item" href="{{url('/logout')}}"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-category">Setting</li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('/setting-country')}}">
                <i class="menu-icon mdi mdi-city"></i>
                <span class="menu-title">Country/City</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('/setting-requirement')}}">
                <i class="menu-icon mdi mdi-format-list-bulleted"></i>
                <span class="menu-title">Visa Requirement</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('/setting-tour')}}">
                <i class="menu-icon mdi mdi-nature-people"></i>
                <span class="menu-title">Tour/Package</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('/setting-service-deal')}}">
                <i class="menu-icon mdi mdi-ticket-percent"></i>
                <span class="menu-title">Service & Deal</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('/setting-partner')}}">
                <i class="menu-icon mdi mdi-account-multiple"></i>
                <span class="menu-title">Partner</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('/setting-testimony')}}">
                <i class="menu-icon mdi mdi-message-processing"></i>
                <span class="menu-title">Testimony</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('/setting-carousel')}}">
                <i class="menu-icon mdi mdi-image-area"></i>
                <span class="menu-title">Carousel</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('/setting-homepage')}}">
                <i class="menu-icon mdi mdi-home-variant"></i>
                <span class="menu-title">Homepage</span>
              </a>
            </li>
            <li class="nav-item nav-category">Reference</li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('/setting-flight')}}">
                <i class="menu-icon mdi mdi-airplane-takeoff"></i>
                <span class="menu-title">Flight</span>
              </a>
            </li>
            <li class="nav-item nav-category">Data</li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('/request')}}">
                <i class="menu-icon mdi mdi-comment-question-outline"></i>
                <span class="menu-title">Permintaan Informasi</span>
              </a>
            </li>
          </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-lg-12 grid-margin">
                {{$slot}}
              </div>
            </div>
          </div>
          <!-- partial:../../partials/_footer.html -->
          {{-- <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash.</span>
              <span class="float-none float-sm-end d-block mt-1 mt-sm-0 text-center">Copyright © 2023. All rights reserved.</span>
            </div>
          </footer> --}}
          <!-- partial -->
        </div>
      </div>
    </div>
    <!-- plugins:js -->
    <script src="{{asset("/assets/vendors/js/vendor.bundle.base.js")}}"></script>
    <script src="{{asset("/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js")}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{asset("/assets/js/off-canvas.js")}}"></script>
    <script src="{{asset("/assets/js/template.js")}}"></script>
    <script src="{{asset("/assets/js/settings.js")}}"></script>
    <script src="{{asset("/assets/js/hoverable-collapse.js")}}"></script>
    <script src="{{asset("/assets/js/todolist.js")}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <!-- End custom js for this page-->
    @livewireScripts
  </body>
</html>
<script>
  function hideModal(){
    $('#exampleModal').modal('hide');
  }
</script>