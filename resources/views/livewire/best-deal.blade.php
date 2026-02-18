<div>
    <div class="container" style="padding: 115px 0 0 0;">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb float-right">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Our Services and</li>
          </ol>
        </nav>
        <div class="content-content">
            <!-- Packages Start -->
            <div class="container-fluid py-5">
                <div class="container">
                    <div class="section-title">
                        <span>Our Services and Deals</span>
                        <h2>Our Services and Deals</h2>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">Amazing experiences. Various places. Affordable price.<br>Discount?? <a href="https://wa.me/6281387848784?text=Welcome%20to%20TDS%20International%20Indonesia,%20your%20trusted%20tour%20and%20travel%20services.">>>CLICK HERE<<</a><br><br></div>
                        @if(($qData!=null)&&(count($qData)>0))
                            @foreach($qData as $val)
                                <div class="col-md-12 text-center">
                                    <img class="zoom" src="{{asset('storage/app/public/promo/'.$val->promoFlyer)}}" alt="" style="object-fit: contain"/>
                                </div>
                            @endforeach
                        @endif
                        <div class="col-md-12 text-center"><br>{!! $qData !!}</div>
                    </div>
                </div>
            </div>
            <!-- Packages End -->
        </div>
    </div>
</div>
