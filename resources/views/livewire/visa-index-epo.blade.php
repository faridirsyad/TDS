@extends('layouts.app')

@section('content')
<div>
    <div class="container" style="padding: 115px 0 0 0;">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb float-right">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('/home')}}#about">Documents</a></li>
            <li class="breadcrumb-item"><a href="{{url('/indonesian-visa')}}">Indonesian Visa</a></li>
            <li class="breadcrumb-item active" aria-current="page">EPO</li>
          </ol>
        </nav>
        <div class="content-content">
            <!-- Packages Start -->
            <div class="container-fluid py-5">
                <div class="container">
                    <div class="section-title">
                        <span>Exit Only Permit (EPO)</span>
                        <h2>Exit Only Permit (EPO)</h2>
                        <h3>Cancellation of Work Authorization</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                                                        <table class="table table-bordered table-hover text-center" width="75%">
                                                            <tr>
                                                                <th class="p-0"></th>
                                                                <th class="p-1">Required Documents</th>
                                                                <th class="p-1">Steps</th>
                                                            </tr>
                                                            <tr>
                                                                <td class="p-0" rowspan="2"><b>From the Company</b></td>
                                                                <td class="p-1 text-justify" rowspan="2"><ul>
                                                                    <li>Signed sponsor letter</li>
                                                                    <li>Copy of ID card of signatory</li>
                                                                </ul></td>
                                                                <td class="p-1 text-justify">1<sup>st</sup> EPO ITAS</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="p-1 text-justify">2<sup>nd</sup> EPO Notifikasi</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="p-0"><b>From the Asignee</b></td>
                                                                <td class="p-1 text-justify"><ul>
                                                                    <li>Original passport</li>
                                                                    <li>Original SKTT</li>
                                                                    <li>Original DPKK receipt</li>
                                                                    <li>Color scan Notifikasi</li>
                                                                    <li>Copy RPTKA</li>
                                                                    <li>Copy scan E-ITAS</li>
                                                                    <li>Copy ticket flight out of the country</li>
                                                                </ul></td>
                                                                <td class="p-1 text-justify">2<sup>nd</sup> EPO SKTT</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="p-0"><b>From the Family (Dependents)</b></td>
                                                                <td class="p-1 text-justify"><ul>
                                                                    <li>Original passport</li>
                                                                    <li>Copy ticket flight out of the country</li>
                                                                    <li>Original SKTT</li>
                                                                    <li>Copy of marriage certificate (for spouse) or birth certificate (for children)</li>
                                                                </ul></td>
                                                                <td class="p-1 text-justify"></td>
                                                            </tr>
                                                        </table>
                                                        <br><br>
                                                        <strong><h5 class="text-center text-primary">Processing Time</h5></strong>
                                                        <table class="table table-bordered table-hover text-center" width="75%">
                                                            <tr>
                                                                <th class="p-1">Process</th>
                                                                <th class="p-1">Processing Time</th>
                                                            </tr>
                                                            <tr>
                                                                <td class="p-1" rowspan="2">EPO ITAS</td>
                                                                <td class="p-1 text-justify">3~4 working days (regular)</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="p-1 text-justify">2 working days (express)</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="p-1">EPO Notifikasi</td>
                                                                <td class="p-1 text-justify">7 working days</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="p-1">EPO SKTT</td>
                                                                <td class="p-1 text-justify">3 working days</td>
                                                            </tr>
                                                        </table>
                                                        <br><br>
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