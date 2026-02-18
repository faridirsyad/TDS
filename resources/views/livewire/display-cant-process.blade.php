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
                        <span>Can Not Processed Country</span>
                        <h2>Can Not Processed Country</h2>
                    </div>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6 row">
                            @if(($listCantProcess != null)&&(count($listCantProcess) > 0))
                                @foreach ($listCantProcess as $val)
                                    <div class="col-md-3">● {{$val->countryCityName}}</div>
                                @endforeach
                            @endif
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
            </div>
            <!-- Packages End -->
        </div>
    </div>
</div>
@endsection