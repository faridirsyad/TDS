@extends('layouts.app')

@section('content')
<div>
    <div class="container" style="padding: 115px 0 0 0;">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb float-right">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('/home')}}#about">Documents</a></li>
            <li class="breadcrumb-item active" aria-current="page">Indonesian Visa</li>
          </ol>
        </nav>
        <div class="content-content">
            <!-- Packages Start -->
            <div class="container-fluid py-5">
                <div class="container">
                    <div class="section-title">
                        <span>Indonesian Visa</span>
                        <h2>Indonesian Visa</h2>
                    </div>
                    <div class="container">
                        <div class="row g-2">
                            <div class="col-12">
                                <div class="p-3"><a href="{{url('/visa-index-b211')}}"><button class="btn btn-primary btn-lg" type="button" style="border-radius: 25px; width: 100%;  height: 10vh;"><strong>Single Entry Visit Visa Index B211</strong></button></a></div>
                            </div>
                            <div class="col-12">
                                <div class="p-3"><a href="{{url('/visa-index-b213')}}"><button class="btn btn-primary btn-lg" type="button" style="border-radius: 25px; width: 100%;  height: 10vh;"><strong>Tourist Visa Index B213</strong></button></a></div>
                            </div>
                            <div class="col-12">
                                <div class="p-3"><a href="{{url('/visa-index-c312')}}"><button class="btn btn-primary btn-lg" type="button" style="border-radius: 25px; width: 100%;  height: 10vh;"><strong>Working Visa Index C312</strong></button></a></div>
                            </div>
                            <div class="col-12">
                                <div class="p-3"><a href="{{url('/visa-index-c3134')}}"><button class="btn btn-primary btn-lg" type="button" style="border-radius: 25px; width: 100%;  height: 10vh;"><strong>Investor Visa Index C313/C314</strong></button></a></div>
                            </div>
                            <div class="col-12">
                                <div class="p-3"><a href="{{url('/visa-index-c317')}}"><button class="btn btn-primary btn-lg" type="button" style="border-radius: 25px; width: 100%;  height: 10vh;"><strong>Spouse Visa Index C317</strong></button></a></div>
                            </div>
                            <div class="col-12">
                                <div class="p-3"><a href="{{url('/visa-index-c318')}}"><button class="btn btn-primary btn-lg" type="button" style="border-radius: 25px; width: 100%;  height: 10vh;"><strong>Stay Permit ex-WNI Visa Index C318</strong></button></a></div>
                            </div>
                            <div class="col-12">
                                <div class="p-3"><a href="{{url('/visa-index-c319')}}"><button class="btn btn-primary btn-lg" type="button" style="border-radius: 25px; width: 100%;  height: 10vh;"><strong>Retirement Visa Index C319</strong></button></a></div>
                            </div>
                            <div class="col-12">
                                <div class="p-3"><a href="{{url('/visa-index-d212')}}"><button class="btn btn-primary btn-lg" type="button" style="border-radius: 25px; width: 100%;  height: 10vh;"><strong>Multiple Entry Visit Visa Index D212</strong></button></a></div>
                            </div>
                            <div class="col-12">
                                <div class="p-3"><a href="{{url('/visa-index-epo')}}"><button class="btn btn-primary btn-lg" type="button" style="border-radius: 25px; width: 100%;  height: 10vh;"><strong>EPO</strong></button></a></div>
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