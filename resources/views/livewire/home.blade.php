<div>
  @foreach($settingHomepage as $val)
    @if(($val->homepageAlias == 'promo')&&($val->isDisplayed == 1))
      <!-- Promotion Section -->
      <section id="promotion" class="promotion">
        <div class="container">
          <div class="section-title">
            <span>Our Services and Deals</span>
            <h2>Our Services and Deals</h2>
            <p>Our best deal for your unforgettable journey</p>
            <p class="text-primary text-right">
              <a href="{{url('/service-deal')}}">Show all</a><br />
            </p>
          </div>
          <!-- End Section Title -->

          <div id="carouselExampleInterval" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
              @if(($listPromo != null)&&(count($listPromo) > 0))
                @foreach ($listPromo as $item)
                  <div class="carousel-item active" data-bs-interval="3000">
                    <div class="row gy-4">
                      <div class="col-xl-1 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100"></div>
                      <div class="col-xl-10 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
                        <div class="promotion-item position-relative">
                          <img class="img-fluid" src="{{asset('storage/app/public/promo/'.$item->promoFlyer)}}" alt="" style="object-fit: contain"/>
                        </div>
                      </div>
                      <div class="col-xl-1 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100"></div>
                    </div>
                  </div>
                @endforeach
              @endif
            </div>
          </div>
        </div>
      </section>
      <!-- /Promotion Section -->
    @endif

    @if(($val->homepageAlias == 'favourite')&&($val->isDisplayed == 1))
      <!-- ======= Values Section ======= -->
      <section id="values" class="values">
        <div class="container">
          <div class="section-title">
            <span>Favourites</span>
            <h2>Favourites</h2>
            <p>Our customer's most favourite tour destinations</p>
            <p class="text-primary text-right"><a href="{{url('/tour/favourite')}}">Show all</a></p>
          </div>
          <div class="row">
            @if(($listFavourite != null)&&(count($listFavourite) > 0))
              @foreach ($listFavourite as $item)
                <div class="boxes col-md-4">
                  <figure>
                    <div><img src="{{asset('storage/app/public/tour/'.$item->tourImage)}}" alt="" /></div>
                    <div class="topright">Click for detail</div>
                    <figcaption>
                      <h3>{{substr($item->tourTitle,0,25)}}</h3>
                      {!! substr($item->tourDescription,0,100) !!}
                      <br /><br /><a href="{{url('/tour/detail/'.$item->slug)}}" class="btn">Details</a>
                    </figcaption>
                  </figure>
                </div>
              @endforeach
            @endif
          </div>
        </div>
      </section>
      <!-- End Values Section -->
    @endif

    @if(($val->homepageAlias == 'recommendation')&&($val->isDisplayed == 1))
      <!-- ======= Team Section ======= -->
      <section id="recom" class="recom">
        <div class="container">
          <div class="section-title">
            <span>Recommendations</span>
            <h2>Recommendations</h2>
            <p>Our recommendations for your best tour experiences</p>
            <p class="text-dark text-right"><a href="{{url('/tour/recommendation')}}">Show all</a><br /></p>
          </div>

          <div class="row" data-aos="fade-left">
            <div class="col-lg-1"></div>
         
            @isset($listRecommendation[0])
              <div class="col-lg-5 col-md-6">
                <div class="member" data-aos="zoom-in" data-aos-delay="100">
                  <a href="{{url('/tour/detail/'.$listRecommendation[0]->slug)}}">
                    <div class="pic">
                      <img src="{{asset('storage/app/public/tour/'.$listRecommendation[0]->tourImage)}}" class="img-fluid" alt=""/>
                    </div>
                    <div class="member-info">
                      <strong><h4>{{$listRecommendation[0]->tourTitle}}</h4></strong>
                      <span>{{$listRecommendation[0]->countryCityName}}; Rp {{number_format($listRecommendation[0]->tourPrice, 2, ",", ".")}}/pax</span>
                    </div>
                  </a>
                </div>
              </div>
            @endisset
            @isset($listRecommendation[1])
            <div class="col-lg-5 col-md-6 mt-5 mt-md-0">
              <div class="member" data-aos="zoom-in" data-aos-delay="200">
                <a href="{{url('/tour/detail/'.$listRecommendation[1]->slug)}}">
                  <div class="pic">
                    <img src="{{asset('storage/app/public/tour/'.$listRecommendation[1]->tourImage)}}" class="img-fluid" alt=""/>
                  </div>
                  <div class="member-info">
                    <strong><h4>{{$listRecommendation[1]->tourTitle}}</h4></strong>
                      <span>{{$listRecommendation[1]->countryCityName}}; Rp {{number_format($listRecommendation[1]->tourPrice, 2, ",", ".")}}/pax</span>
                  </div>
                </a>
              </div>
            </div>
            @endisset
            @isset($listRecommendation[2])
            <div class="col-lg-1"></div>
            <div class="col-lg-1"></div>

            <div class="col-lg-5 col-md-6 mt-5 mt-lg-0">
              <div class="member" data-aos="zoom-in" data-aos-delay="300">
                <a href="{{url('/tour/detail/'.$listRecommendation[2]->slug)}}">
                  <div class="pic">
                    <img src="{{asset('storage/app/public/tour/'.$listRecommendation[2]->tourImage)}}" class="img-fluid" alt=""/>
                  </div>
                  <div class="member-info">
                    <strong><h4>{{$listRecommendation[2]->tourTitle}}</h4></strong>
                      <span>{{$listRecommendation[2]->countryCityName}}; Rp {{number_format($listRecommendation[2]->tourPrice, 2, ",", ".")}}/pax</span>
                  </div>
                </a>
              </div>
            </div>
            @endisset
            @isset($listRecommendation[3])
            <div class="col-lg-5 col-md-6 mt-5 mt-lg-0">
              <div class="member" data-aos="zoom-in" data-aos-delay="400">
                <a href="{{url('/tour/detail/'.$listRecommendation[3]->slug)}}">
                  <div class="pic">
                    <img src="{{asset('storage/app/public/tour/'.$listRecommendation[3]->tourImage)}}" class="img-fluid" alt=""/>
                  </div>
                  <div class="member-info">
                    <strong><h4>{{$listRecommendation[3]->tourTitle}}</h4></strong>
                      <span>{{$listRecommendation[3]->countryCityName}}; Rp {{number_format($listRecommendation[3]->tourPrice, 2, ",", ".")}}/pax</span>
                  </div>
                </a>
              </div>
            </div>
            @endisset

            <div class="col-lg-1"></div>
          </div>
        </div>
      </section>
      <!-- End Team Section -->
    @endif

    @if(($val->homepageAlias == 'tour')&&($val->isDisplayed == 1))
      <section id="destination" class="destination">
        <!-- Destination Start -->
        <div class="container">
          <div class="section-title">
            <span>Tour Packages</span>
            <h2>Tour Packages</h2>
            <p>All of our special tour packages</p>
            <p class="text-primary text-right">
              <a href="{{url('/tour/all')}}">Show all</a><br />
            </p>
          </div>
          <div class="row">
            @if(($listTour != null)&&(count($listTour) > 0))
            @foreach ($listTour as $item)
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="destination-item position-relative overflow-hidden mb-2">
                <img class="img-fluid" src="{{asset('storage/app/public/continent/'.$item->image)}}" style="height: 30vh !important;" alt=""/>
                <a class="destination-overlay text-white text-decoration-none" href="{{url('/tour/'.$item->slug)}}">
                  <h5 class="text-white">{{$item->categoryName}}</h5>
                  <span>{{$item->cntTour}} destinations</span>
                </a>
              </div>
            </div>
            @endforeach
            @endif
          </div>
        </div>
        <!-- Destination Start -->
      </section>
    @endif

    @if(($val->homepageAlias == 'document')&&($val->isDisplayed == 1))
      <!-- ======= About Section ======= -->
      <section id="about" class="about">
        <div class="container">
          <div class="row content">
            <div class="col-lg-5 left text-center">
              <h2>Document<br />Services</h2>
            </div>
            <div class="col-lg-7 pt-4 pt-lg-0">
              <div class="row">
                <div class="col-md-12 d-flex align-items-stretch mt-4" data-aos="fade-up" data-aos-delay="200">
                  <div class="card" style="background-image: url(assets/img/passport.jpg)">
                    <div class="card-body-2">
                      <a href="{{url('/passport')}}">
                        <h5 class="card-title-2">
                          <strong>PASSPORT</strong>
                        </h5>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col-md-12 d-flex align-items-stretch mt-4" data-aos="fade-up" data-aos-delay="200">
                  <div class="card" style="background-image: url(assets/img/visa.jpg)">
                    <div class="card-body-2">
                      <a href="{{url('/visa')}}">
                        <h5 class="card-title-2">
                          <strong>VISA</strong>
                        </h5>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col-md-12 d-flex align-items-stretch mt-4" data-aos="fade-up" data-aos-delay="200">
                  <div class="card" style="background-image: url(assets/img/visa-indonesia.jpg)">
                    <div class="card-body-2">
                      <a href="{{url('/indonesian-visa')}}">
                        <h5 class="card-title-2">
                          <strong>INDONESIAN VISA</strong>
                        </h5>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- End About Section -->
    @endif

    @if(($val->homepageAlias == 'partner')&&($val->isDisplayed == 1))
      <!-- ======= Mitra Section ======= -->
      <section id="mitra">
        <div class="section-title">
          <span>Our Partners</span>
          <h2>Our Partners</h2>
        </div>
        {{-- <div class="slider"> --}}
          {{-- <div class="slide-track"> --}}
            <marquee behavior="scroll" direction="left">
            @if(($listPartner != null)&&(count($listPartner) > 0))
            @foreach ($listPartner as $item)
            {{-- <div class="slide"> --}}
              <img class="mx-3" src="{{asset('storage/app/public/partner/'.$item->partnerImage)}}" alt="" height="75px" />
            {{-- </div> --}}
            @endforeach
            @endif
            </marquee>
          {{-- </div> --}}
        {{-- </div> --}}
      </section>
      <!-- End Testimonials Section -->
    @endif

    @if(($val->homepageAlias == 'testimony')&&($val->isDisplayed == 1))
      <!-- ======= Testimonials Section ======= -->
      <section id="testimonials" class="testimonials">
        <div class="container position-relative">
          <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper-wrapper">
              @if(($listTestimony != null)&&(count($listTestimony) > 0))
                @foreach ($listTestimony as $item)
                <div class="swiper-slide">
                  <div class="testimonial-item">
                    <h3>{{$item->testimoniCustomerName}}</h3>
                    <p>
                      <i class="bx bxs-quote-alt-left quote-icon-left"></i>{!! $item->testimoniContent !!}<i class="bx bxs-quote-alt-right quote-icon-right"></i>
                    </p>
                  </div>
                </div>
                @endforeach
              @endif
              <!-- End testimonial item -->
            </div>
            <div class="swiper-pagination"></div>
          </div>
        </div>
      </section>
      <!-- End Testimonials Section -->
    @endif
  @endforeach
      <!-- ======= Contact Section ======= -->
      <section id="contact" class="contact">
        <div class="container">
          <div class="section-title">
            <span>Contact Us</span>
            <h2>Contact Us</h2>
            <p>For further information, please contact us on below address</p>
          </div>
        </div>

        {{-- <div class="map"> --}}
          {{-- <iframe
            style="border: 0; width: 100%; height: 350px"
            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621"
            frameborder="0"
            allowfullscreen
          ></iframe> --}}
          {{-- <iframe width="1920" height="500" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" id="gmap_canvas" src="https://maps.google.com/maps?width=1920&amp;height=350&amp;hl=en&amp;q=Nucira%20Building,%20Jalan%20MT%20Haryono%20No.27,%20RT.8/RW.9,%20Tebet%20Timur,%20Tebet,%20Jakarta%20Selatan,%20Jakarta%20Jakarta+(Nucira%20Building)&amp;t=&amp;z=12&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe> <a href='https://doktorarbeitschreiben.com/'>Doktorarbeit schreiben lassen</a> <script type='text/javascript' src='https://embedmaps.com/google-maps-authorization/script.js?id=84de5a5af6f4bb31e79e6e74bc8130890c469c41'></script> --}}
          
        {{-- </div> --}}
        <div id="mapWrap"></div>

        <div class="container">
          <div class="info-wrap mt-5">
            <div class="row">
              <div class="col-lg-4 info">
                <i class="ri-map-pin-line"></i>
                <h4>Location:</h4>
                <p>Treasury Tower, 16<sup>th</sup> floor<br>SCBD Kawasan District 8 Lot. 28, <br>Jakarta Selatan, DKI Jakarta 12190</p>
                <br>
                <p>Nucira Buiding, 1<sup>st</sup> floor<br>Jalan MT Haryono, Tebet Timur, Tebet, <br>Jakarta Selatan, DKI Jakarta 12820</p>
              </div>

              <div class="col-lg-4 info mt-4 mt-lg-0">
                <i class="ri-mail-line"></i>
                <h4>Email:</h4>
                <p><a href="mailto:operation@tdsinternationalindonesia.com">operation@tdsinternationalindonesia.com</a></p>
              </div>

              <div class="col-lg-4 info mt-4 mt-lg-0">
                <i class="ri-phone-line"></i>
                <h4>Call:</h4>
                <p>+62 21 501 00235 / +62 21 503 00238</p>
              </div>
            </div>
          </div>
          {{-- <div class="php-email-form">
            <h5>Kantor Cabang Kami</h5>
            <p>xxx</p>
          </div> --}}
        </div>
      </section>
      <!-- End Contact Section -->
</div>
{{-- <script>
// Define latitude, longitude and zoom level
const latitude = -6.2278412915517345;
const longitude = 106.80616668875015;
const zoom = 14;

// Set DIV element to embed map
var mymap = L.map('mapWrap');

// Add initial marker & popup window
var mmr = L.marker([0,0]);
mmr.bindPopup('0,0');
mmr.addTo(mymap);

// Add copyright attribution
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png?{foo}', {
    foo: 'bar',
    attribution:'&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'}
).addTo(mymap);

// Set lat lng position and zoom level of map 
mmr.setLatLng(L.latLng(latitude, longitude));
mymap.setView([latitude, longitude], zoom);

// Set popup window content
// mmr.setPopupContent('Latitude: '+latitude+' <br /> Longitude: '+longitude).openPopup();
mmr.setPopupContent('Treasury Tower<br>SCBD Kawasan District 8 Lot. 28, Jakarta Selatan, DKI Jakarta 12190').openPopup();

// Set marker onclick event
mmr.on('click', openPopupWindow);

// Marker click event handler
function openPopupWindow(e) {
    mmr.setPopupContent('Latitude: '+e.latlng.lat+' <br /> Longitude: '+e.latlng.lng).openPopup();
}
</script> --}}

<script>
// Define latitude, longitude and zoom level
const latitude1 = -6.2278412915517345;
const longitude1 = 106.80616668875015;

const latitude2 = -6.2423281762896865;
const longitude2 = 106.85685843760581;

const zoom = 10; // zoom lebih jauh (lebih kecil = lebih luas)

// Set DIV element to embed map
var mymap = L.map('mapWrap');

// Add copyright attribution
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png?{foo}', {
    foo: 'bar',
    attribution:'&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(mymap);

// ======================
// MARKER 1
// ======================
var marker1 = L.marker([latitude1, longitude1]).addTo(mymap);

marker1.bindPopup(
    '<strong>Treasury Tower</strong><br>SCBD Kawasan District 8 Lot. 28, Jakarta Selatan, DKI Jakarta 12190'
);

// ======================
// MARKER 2
// ======================
var marker2 = L.marker([latitude2, longitude2]).addTo(mymap);

marker2.bindPopup(
    '<strong>Nucira Building</strong><br>Jalan MT Haryono, Tebet Timur, Tebet, Jakarta Selatan, DKI Jakarta 12820'
);

// ======================
// Auto fit kedua marker + padding
// ======================
var group = new L.featureGroup([marker1, marker2]);
mymap.fitBounds(group.getBounds(), {
    padding: [60, 60]
});

// ======================
// Otomatis buka popup saat load
// ======================
mymap.whenReady(function() {
    marker1.openPopup();
});

// ======================
// Event klik marker
// ======================
marker1.on('click', function(e) {
    marker1.setPopupContent(
        '<strong>Treasury Tower</strong><br>SCBD Kawasan District 8 Lot. 28, Jakarta Selatan, DKI Jakarta 12190<br>' + 
        '<br>Latitude: ' + e.latlng.lat + 
        '<br />Longitude: ' + e.latlng.lng
    ).openPopup();
});

marker2.on('click', function(e) {
    marker2.setPopupContent(
        '<strong>Nucira Building</strong><br>Jalan MT Haryono, Tebet Timur, Tebet, Jakarta Selatan, DKI Jakarta 12820<br>' +
        '<br>Latitude: ' + e.latlng.lat + 
        '<br />Longitude: ' + e.latlng.lng
    ).openPopup();
});

</script>
