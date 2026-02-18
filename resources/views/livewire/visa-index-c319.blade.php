@extends('layouts.app')

@section('content')
<div>
    <div class="container" style="padding: 115px 0 0 0;">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb float-right">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('/home')}}#about">Documents</a></li>
            <li class="breadcrumb-item"><a href="{{url('/indonesian-visa')}}">Indonesian Visa</a></li>
            <li class="breadcrumb-item active" aria-current="page">Index C319</li>
          </ol>
        </nav>
        <div class="content-content">
            <!-- Packages Start -->
            <div class="container-fluid py-5">
                <div class="container">
                    <div class="section-title">
                        <span>Retirement Visa</span>
                        <h2>Retirement Visa</h2>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-justify">
                                Retiring on an exotic island surrounded by sun, sea and sand is a dream for many people. Indonesia is a stunning archipelago comprising thousands of islands all with their own character and charm. Therefore, it is no wonder why every year, people decide to enjoy their retirement years on one of Indonesia's island.
                                <br><br>
                                As of 22<sup>nd</sup> August 2023, the Ministry of Immigration Indonesia released a new regulation that allows expatriates seeking to retire in Indonesia to be able to extend their stay up to 5 years.
                                <br><br>
                                As of 31<sup>st</sup> August 2006, there are changes in Ministry of Justice Law #M.04-IZ.01.02, year of 1998 which tells that expatriates from below coutries may apply for an Indonesian retirement visa:
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8 row">
                                        @if(($listCountry != null)&&(count($listCountry) > 0))
                                            @foreach ($listCountry as $val)
                                                <div class="col-md-4">● {{$val->countryCityName}}</div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <br><strong><h5 class="text-justify text-primary">The retirement visa requirements are:</h5></strong>
                                <ol>
                                    <li>Must be at least 55 years old</li>
                                    <li>Color scan passport full pages (including the cover), minimum validity 18 months and 3 blank pages</li>
                                    <li>Color scan Indonesian ID Card (e-KTP) of maid/driver – 2 persons</li>
                                    <li>Color scan Curiculum Vitae (CV)</li>
                                    <li>Color scan health insurance</li>
                                    <li>Color scan life insurance</li>
                                    <li>Color scan 3<sup>rd</sup>liability insurance</li>
                                    <li>Color scan pension statement with minimum pension fund of USD 1.500/month or USD 18.000/year</li>
                                    <li>Color scan saving account statement for last 3 (three) months</li>
                                    <li>Photo (soft file, red background)</li>
                                </ol>
                                A retirement visa can be extended 5 times without having to leave the country. Each extension is valid for 1 year.
                                <br><br>
                                <strong><h5 class="text-justify text-primary">A retirement visa holder will receive complete permits in a well organized folder comprising the following documents - valid for 1 year:</h5></strong>
                                <ol>
                                    <li>E-Visa Index 319</li>
                                    <li>Retirement E-ITAS and MERP</li>
                                    <li>SKTT/green card</li>
                                    <li>STM/resort police report</li>
                                </ol>
                                <br>
                                <b>NOTES: for further information, please <a href="https://wa.me/6281387848784?text=Welcome%20to%20TDS%20International%20Indonesia,%20your%20trusted%20tour%20and%20travel%20services.">contact us</a>.</b><br>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Packages End -->
        </div>
    </div>
</div>
@endsection