@extends('layouts.app')

@section('content')
<div>
    <div class="container" style="padding: 115px 0 0 0;">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb float-right">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('/home')}}#about">Documents</a></li>
            <li class="breadcrumb-item"><a href="{{url('/visa')}}">Visa</a></li>
            <li class="breadcrumb-item active" aria-current="page">Requirement</li>
          </ol>
        </nav>
        <div class="content-content">
            <!-- Packages Start -->
            <div class="container-fluid py-5">
                <div class="container">
                    <div class="section-title">
                        <span>Visa Requirement</span>
                        <h2>Visa Requirement</h2>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="accordion" id="accordionExample">
                                @if(($listCountryGroup != null)&&(count($listCountryGroup) > 0))
                                    <?php $no=0; ?>
                                    @foreach ($listCountryGroup as $val)
                                        <?php $no++; ?>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?=$no?>" aria-expanded="true" aria-controls="collapse<?=$no?>">
                                                <b>{{ strtoupper($val->categoryName) }}</b>
                                            </button>
                                            </h2>
                                            <div id="collapse<?=$no?>" class="accordion-collapse collapse <?php if($no!=1){ echo 'show';} ?>show" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        @if(($listRequirement != null)&&(count($listRequirement) > 0))
                                                            @foreach ($listRequirement as $item)
                                                                @if($item->countryCategoryId == $val->id)
                                                                    <div class="col-md-2 text-center"><a href="{{url('/visa-requirement/'.$item->slug)}}"><img class="shadow-lg bg-white rounded" src="{{ asset('storage/app/public/images/'.$item->countryFlag) }}" width="90" height="60"></a><br><h5>{{$item->countryCityName}}</h5></div>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                        {{-- <div class="col-md-2 text-center"><img class="flag-style" src="assets/img/flags/japan.png" width="90" height="60"><br><h5>Japan</h5></div>
                                                        <div class="col-md-2 text-center"><img class="flag-style" src="assets/img/flags/south-korea.png" width="90" height="60"><br><h5>South Korea</h5></div>
                                                        <div class="col-md-2 text-center"><img class="flag-style" src="assets/img/flags/taiwan.png" width="90" height="60"><br><h5>Taiwan</h5></div> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Packages End -->
        </div>
    </div>
</div>
@endsection