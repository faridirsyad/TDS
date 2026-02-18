<div>
    <div class="container" style="padding: 115px 0 0 0;">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb float-right">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('/home')}}#about">Documents</a></li>
            <li class="breadcrumb-item"><a href="{{url('/visa')}}">Visa</a></li>
            <li class="breadcrumb-item"><a href="{{url('/visa-requirement')}}">Requirement</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail</li>
          </ol>
        </nav>
        <div class="content-content">
            <!-- Packages Start -->
            @if(($detail != null)&&(count($detail) > 0))
                @foreach ($detail as $val)
                    <div class="container-fluid py-5">
                        <div class="container">
                            <div class="section-title">
                                <span>Visa Requirement - {{strtoupper($val->countryCityName)}}</span>
                                <h2>Visa Requirement - {{strtoupper($val->countryCityName)}}</h2>
                            </div>
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                    <strong><h5 class="text-primary">{{strtoupper($val->countryCityName)}} EMBASSY</h5></strong>
                                    <p>{!! $val->countryEmbassyAddress !!}</p>
                                    <br>
                                    <strong><h5 class="text-primary">REQUIREMENT</h5></strong>
                                    <p>{!! $val->countryRequirement !!}</p>
                                    <br>
                                    <strong><h5 class="text-primary">CAUTIONS</h5></strong>
                                    <p>{!! $val->countryCautions !!}</p>
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="container-fluid py-5">
                    <div class="container">
                        <div class="section-title">
                            NO DATA YET
                        </div>
                    </div>
                </div>
            @endif
            <!-- Packages End -->
        </div>
    </div>
</div>
