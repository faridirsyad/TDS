<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-YEGJNL05D8"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'G-YEGJNL05D8');
    </script>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta http-equiv='cache-control' content='no-cache, no-store, must-revalidate'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
    <meta content="{{ csrf_token() }}" name="csrf-token" />

    <title>TDS International Indonesia - Tour & Travel</title>
    <meta content="" name="description" />
    <meta content="tds, tds travel, tds international, tds indonesia, tour, travel, visa, passport, indonesian visa, airport assistance" name="keywords" />

    <!-- Favicons -->
    <link href="{{asset('assets/img/tds_bg.png')}}" rel="icon" />
    <link href="{{asset('assets/img/tds_bg.png')}}" rel="apple-touch-icon" />

    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
      integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
      rel="stylesheet"
    />

    <!-- Vendor CSS Files -->
    <link
      href="{{asset('assets/vendors/bootstrap/css/bootstrap.min.css')}}"
      rel="stylesheet"
    />
    <link
      href="{{asset('assets/vendors/bootstrap-icons/bootstrap-icons.css')}}"
      rel="stylesheet"
    />
    <link href="{{asset('assets/vendors/boxicons/css/boxicons.min.css')}}" rel="stylesheet" />
    <link
      href="{{asset('assets/vendors/glightbox/css/glightbox.min.css')}}"
      rel="stylesheet"
    />
    <link href="{{asset('assets/vendors/remixicon/remixicon.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/vendors/swiper/swiper-bundle.min.css')}}" rel="stylesheet" />

    <!-- Template Main CSS File -->
    <link href="{{asset('assets/css/style3.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/style2.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/boxes.css')}}" rel="stylesheet" />

    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script> --}}

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- =======================================================
  * Template Name: MyBiz
  * Template URL: https://bootstrapmade.com/mybiz-free-business-bootstrap-theme/
  * Updated: Mar 17 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  @livewire('livewire-ui-modal')
  @livewireStyles
  </head>

  <style>
  #mapWrap {
      width: 100%;
      height: 400px; 
  }    
  </style>
  <style>
    .floating-menu {
      /* font-family: sans-serif; */
      background: rgb(50, 174, 205);
      opacity: 0.85;
      padding: 5px;
      width: 60px;
      z-index: 100;
      position: fixed;
      top: 50%;
      right: 0px;
      /* border: 2px solid rgb(6, 108, 155); */
      border-radius: 25px 0 0 25px;
    }

    .floating-menu a,
    .floating-menu h3 {
      font-size: 0.9em;
      display: block;
      margin: 0 0.5em;
      color: white;
    }

    .floating-menu a:hover {
      transform: scale(1.5);
    }
  </style>

  <style>
    .slide-track {
      width: 100%;
      display: flex;
      gap: 3em;
      overflow: hidden;
    }

    .slider {
      /* margin-top: 70px; */
      background-color: rgb(255, 255, 255);
      padding: 2em 2em;
    }

    .slider img {
      width: 100px;
      height: 100px;
      animation: scroll 60s linear infinite;
    }

    @keyframes scroll {
      0% {
        transform: translateX(0);
      }
      100% {
        transform: translatex(-1000%);
      }
    }
  </style>
  <style>
.zoom {
  padding: 10px;
  transition: transform .2s; /* Animation */
  width: 80%;
  height: 80%;
  margin: 0 auto;
}

.zoom:hover {
  transform: scale(1.5); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
}

.flag-style{
  box-shadow: 8px, 8px, 15px rgba(0,0,0.5) !important;
}
</style>
  <body>
    <!-- ======= Top Bar ======= -->
    <section id="topbar" class="fixed-top d-flex align-items-center">
      <div
        class="container d-flex justify-content-center justify-content-md-between"
      >
        <div class="contact-info d-flex align-items-center">
          <i class="bi bi-envelope d-flex align-items-center"
            ><a href="mailto:operation@tdsinternationalindonesia.com">operation@tdsinternationalindonesia.com</a></i
          >
          <i class="bi bi-phone d-flex align-items-center ms-4"
            ><span>+62 21 501 00235 / +62 21 503 00238</span></i
          >
        </div>
        <div class="social-links d-none d-md-flex">
        </div>
      </div>
    </section>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center">
      <div class="container d-flex align-items-center justify-content-between">
        <div class="logo">
          <h1>
            <a href="{{url('/')}}"><img src="{{asset("/assets/img/tds.png")}}" /></span></a>
          </h1>
        </div>

        <nav id="navbar" class="navmenu">
          <ul>
            <li><a class="nav-link scrollto active" href="{{url('/home')}}#hero">Home</a></li>
            <li><a class="nav-link scrollto" href="{{url('/home')}}#promotion">Services & Deals</a></li>
            <li><a class="nav-link scrollto" href="{{url('/home')}}#values">Tours & Travels</a></li>
            <li><a class="nav-link scrollto" href="{{url('/home')}}#about">Document Services</a></li>
            {{-- <li><a class="nav-link scrollto" href="{{url('/home')}}#mitra">Our Partners</a></li> --}}
            <li><a class="nav-link scrollto" href="{{url('/home')}}#contact">Contact Us</a></li>
          </ul>
          @if(preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]))
          <i class="bi bi-list mobile-nav-toggle"></i>
          @endif
        </nav>
        <!-- .navbar -->
      </div>
    </header>
    <!-- End Header -->
    
    @isset($listCarousel)
    {{--var_export($listCarousel)--}}
    <!-- ======= Hero Section ======= -->
    <section id="hero">
      <div class="hero-container">
        <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">
          <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

          <div class="carousel-inner" role="listbox">
            
            @if(count($listCarousel) > 0)
              @foreach($listCarousel as $key=>$val)
                @if($val->isDisplayed)
                  <!-- Slides -->
                  <div class="carousel-item {{ ($key==0) ? 'active' : '' }}" style="background-image: url({{ asset('storage/app/public/carousel/'.$val->carouselImage) }})">
                  </div>
                @endif
              @endforeach
            @endif
          </div>

          <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon ri-arrow-left-line" aria-hidden="true"></span>
          </a>

          <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon ri-arrow-right-line" aria-hidden="true"></span>
          </a>
        </div>
      </div>
    </section>
    <!-- End Hero -->
    <section id="searchbar">
      <!-- Booking Start -->
      <div class="container-fluid booking">
        <div class="container">
          <div class="bg-light shadow" style="padding: 30px">
            {{-- <form wire:submit.prevent="{{ url('/tour/all') }}">
              @csrf --}}
            <div class="row align-items-center" style="min-height: 60px">
              {{-- <div class="col-md-12 text-center">
                <h3>FIND INSPIRATION TO EXPLORE THE WORLD</h3>
                <br />
                Find and explore our best deals and tour destinations here.
              </div> --}}
              <div class="col-md-8">
                <div class="row">
                  <div class="col-md-12">
                    <div class="mb-5 mb-md-0 text-center">
                      <h3>FIND INSPIRATION TO EXPLORE THE WORLD</h3>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <a href="{{url('/home')}}#promotion"><button
                  class="btn btn-primary btn-block"
                  type="submit"
                  style="height: 47px; margin-top: -2px"
                >
                  Start
                </button></a>
              </div>
              {{-- <div class="col-md-10">
                <div class="row">
                  <div class="col-md-12">
                    <div class="mb-3 mb-md-0">
                      <input
                        type="text"
                        class="form-control p-4"
                        id="keyword"
                        name="keyword"
                        placeholder="Type Here..."
                        wire:model="keyword"
                      />
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-2">
                <a href="{{url('/tour/all')}}"><button
                  class="btn btn-primary btn-block"
                  type="submit"
                  style="height: 47px; margin-top: -2px"
                >
                  <i class="bi bi-search"></i> Search
                </button></a>
              </div> --}}
              {{-- <div class="col-md-12">
                <button
                  class="btn btn-primary btn-block"
                  type="submit"
                  style="height: 47px; margin-top: 20px"
                >
                  <i class="bi bi-search"></i> Search
                </button>
              </div> --}}
            </div>
            {{-- </form> --}}
          </div>
        </div>
      </div>
      <!-- Booking End -->
    </section>
    @endisset

    <main id="main">
      <div>
        @yield('content')
      </div>
    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">
      <div class="footer-top">
        <div class="container">
          <div class="row">
            <div class="col-lg-5 col-md-6">
              <div class="footer-info">
                <h3 class="text-white">TDS International Indonesia</h3>
                <p>
                  Treasury Tower, 16th floor<br>SCBD Kawasan District 8 Lot. 28, Jakarta Selatan, DKI Jakarta 12190 <br/><br>
                  Nucira Buiding, 1st floor<br>Jalan MT Haryono, Tebet Timur, Tebet, Jakarta Selatan, DKI Jakarta 12820<br/><br>
                  <strong>Phone:</strong> +62 21 501 00235 / +62 21 503 00238 <br/>
                  <strong>WhatsApp:</strong> +62 813-8784-8784 <br/>
                  <strong>Email:</strong><a href="mailto:operation@tdsinternationalindonesia.com"> operation@tdsinternationalindonesia.com</a><br />
                </p>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 footer-links">
              <h4>Useful Links</h4>
              <ul>
                <li>
                  <i class="bx bx-chevron-right"></i> <a href="https://www.imigrasi.go.id/">Direktorat Jenderal Imigrasi Kementrian Hukum dan HAM</a>
                </li>
                <li>
                  <i class="bx bx-chevron-right"></i> <a href="https://www.kemlu.go.id/portal/id/">Kementrian Luar Negeri Republik Indoensia</a>
                </li>
                {{-- <li>
                  <i class="bx bx-chevron-right"></i> <a href="https://evisa.imigrasi.go.id/">e-Visa</a>
                </li> --}}
              </ul>
            </div>

            <div class="col-lg-2 col-md-6 footer-newsletter">
              <h4>Follow Us</h4>

              <div class="social-links mt-3">
                <a href="https://wa.me/6281387848784?text=Welcome%20to%20TDS%20International%20Indonesia,%20your%20trusted%20tour%20and%20travel%20services." class="whatsapp"><i class="bx bxl-whatsapp"></i></a>
                <a href="https://www.instagram.com/tdsinternational/" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="https://www.linkedin.com/company/pt-tds-international-indonesia-tds-travel/posts/?feedView=all" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                <a href="https://www.tiktok.com/@tds.international?lang=id-ID" class="tiktok"><i class="bx bxl-tiktok"></i></a>
              </div>
            </div>

            {{-- <div class="col-lg-3 col-md-6 footer-newsletter">
              <h4>Members of</h4>

              <div class="mt-3">
                  <img src="{{ asset('assets/images/logo-ASITA.jpg') }}" 
                      alt="Logo ASITA" 
                      class="img-fluid" 
                      style="max-height: 60px;">
              </div>
              <div class="mt-3">
                  <img src="{{ asset('assets/images/logo-Astindo(2).png') }}" 
                      alt="Logo Astindo" 
                      class="img-fluid" 
                      style="max-height: 60px;">
              </div>
            </div> --}}
          </div>
        </div>
      </div>

      <div class="container">
        <div class="copyright">
          &copy; Copyright 2025.<strong>
            <span>TDS International Indonesia</span></strong
          >. All Rights Reserved.
        </div>
      </div>
    </footer>
    <!-- End Footer -->

    <a
      href="#"
      class="back-to-top d-flex align-items-center justify-content-center"
      ><i class="bi bi-arrow-up-short"></i
    ></a>

    <nav class="floating-menu">
      <a href="https://wa.me/6281387848784?text=Welcome%20to%20TDS%20International%20Indonesia,%20your%20trusted%20tour%20and%20travel%20services." class="twitter"><i class="bx bxl-whatsapp bx-md"></i></a>
    </nav>
  @livewireScripts
  </body>
</html>
    <!-- Vendor JS Files -->
    <script src="{{asset('assets/vendors/purecounter/purecounter_vanilla.js')}}"></script>
    <script src="{{asset('assets/vendors/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/vendors/glightbox/js/glightbox.min.js')}}"></script>
    <script src="{{asset('assets/vendors/isotope-layout/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('assets/vendors/swiper/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('assets/vendors/php-email-form/validate.js')}}"></script>
    <!-- Template Main JS File -->
    <script src="{{asset('assets/js/mains.js')}}"></script>