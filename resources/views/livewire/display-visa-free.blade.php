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
                        <span>Free Visa Country</span>
                        <h2>Free Visa Country</h2>
                    </div>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <strong><h5 class="text-center text-primary">ASEAN</h5></strong>
                            <table class="table table-bordered table-hover text-center" width="75%">
                                <tr>
                                    <th>No</th>
                                    <th>Country</th>
                                    <th>Long of Stays</th>
                                </tr>
                                <?php $no1 = 1; ?>
                                @if(($listFreeAsean != null)&&(count($listFreeAsean) > 0))
                                    @foreach ($listFreeAsean as $val)
                                        <tr>
                                            <td class="text-center"><?=$no1++;?></td>
                                            <td class="text-left">{{$val->countryCityName}}</td>
                                            <td>{{$val->longOfStay}} Days</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </table>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <br><br>
                            <strong><h5 class="text-center text-primary">NON ASEAN</h5></strong>
                            <table class="table table-bordered table-hover text-center" width="75%">
                                <tr>
                                    <th>No</th>
                                    <th>Country</th>
                                    <th>Long of Stays</th>
                                </tr>
                                <?php $no2 = 1; ?>
                                @if(($listFreeNonAsean != null)&&(count($listFreeNonAsean) > 0))
                                    @foreach ($listFreeNonAsean as $val)
                                        <tr>
                                            <td class="text-center"><?=$no2++;?></td>
                                            <td class="text-left">{{$val->countryCityName}}</td>
                                            <td>{{ ($val->longOfStay > 0) ? $val->longOfStay.' Days' : 'No Data' }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </table>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                </div>
            </div>
            <!-- Packages End -->
        </div>
    </div>
</div>
@endsection