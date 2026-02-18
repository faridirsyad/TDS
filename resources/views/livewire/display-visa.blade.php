@extends('layouts.app')

@section('content')
<div>
    <div class="container" style="padding: 115px 0 0 0;">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb float-right">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('/home')}}#about">Documents</a></li>
            <li class="breadcrumb-item active" aria-current="page">Visa</li>
          </ol>
        </nav>
        <div class="content-content">
            <!-- Packages Start -->
            <div class="container-fluid py-5">
                <div class="container">
                    <div class="section-title">
                        <span>Visa</span>
                        <h2>Visa</h2>
                    </div>
                    {{-- <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 3px; margin: auto; max-width: 75%; padding-bottom: 10vh;"> --}}
                    <div class="row">
                        <div class="col-md-4 mb-3"><a href="{{url('/visa-requirement')}}"><button class="btn btn-primary btn-lg" type="button" style="width: 100%; height: 10vh; border-radius: 25px;"><b>REQUIREMENT</b></button></a></div>
                        <div class="col-md-4 mb-3"><a href="{{url('/free-visa')}}"><button class="btn btn-primary btn-lg" type="button" style="width: 100%; height: 10vh; border-radius: 25px;"><b>FREE VISA COUNTRY</b></button></a></div>
                        <div class="col-md-4 mb-3"><a href="{{url('/visa-not-process')}}"><button class="btn btn-primary btn-lg" type="button" style="width: 100%; height: 10vh; border-radius: 25px;"><b>CANNOT PROCESSED VISA COUNTRY</b></button></a></div>
                    </div>
                </div>
            </div>
            <!-- Packages End -->
        </div>
    </div>
</div>
@endsection
