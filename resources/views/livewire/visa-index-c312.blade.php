@extends('layouts.app')

@section('content')
<div>
    <div class="container" style="padding: 115px 0 0 0;">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb float-right">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('/home')}}#about">Documents</a></li>
            <li class="breadcrumb-item"><a href="{{url('/indonesian-visa')}}">Indonesian Visa</a></li>
            <li class="breadcrumb-item active" aria-current="page">Index C312</li>
          </ol>
        </nav>
        <div class="content-content">
            <!-- Packages Start -->
            <div class="container-fluid py-5">
                <div class="container">
                    <div class="section-title">
                        <span>Working Visa</span>
                        <h2>Working Visa</h2>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-justify">
                            <p>
                                A work visa or so-called index 312, is a visa for work purposes. The duration of the work visa varies from one month to 12 months depending on the company's request to employ foreign workers in Indonesia through the Foreign Worker Utilization Plan called RPTKA (Foreign Worker Placement Plan). After the RPTK is issued, a notification letter from the Ministry of Manpower must be submitted online. With the issuance of the notification letter, the Ministry of Manpower will give the company 5 days to transfer the DPKK (Skill & Development Fund) fee payments to the designated Indonesian banks.
                                <br><br>
                                After the DPKK fees are transferred for payment, the Ministry of Manpower will issue an RPTKA Ratification (IMTA) and there will be an online notification letter regarding further instructions for transferring government fee payments (PNBP: Non-Tax State Payments) prior to the issuance of eVisa index 312.
                                <br><br>
                                After the issuance of eVisa 312, the applicant will be given 90 days to enter Indonesia using the visa. Applicant must perform biometrics (single line photo & fingerprint) at the airport upon arrival.
                                <br><br>
                                E-ITAS & MERP (Multiple Exit Re-Entry Permit) stamps for work visas will be issued at Indonesian Airport Immigration when the applicant enters Indonesia using a work visa. As for family members, the E-itas & MERP stamp will be issued at the local Immigration office where they live in Indonesia.
                                <br><br>
                                For complete procedures, steps and time consumes in processing the working visa, please check information about PERMIT PROCESS & PERMIT TIMELINE below:
                                <div class="accordion" id="accordionExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <b>PERMIT PROCESS & PERMIT TIMELINE</b>
                                        </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                
                                                <ol>
                                                    <li>New Working Visa Index 312<br>
                                                        <table class="table table-bordered table-hover text-center" width="75%">
                                                            <tr>
                                                                <th style="width:7%;height: 7vh;">No</th>
                                                                <th style="height: 7vh;">Process</th>
                                                                <th style="height: 7vh;">Timeline</th>
                                                            </tr>
                                                            <tr>
                                                                <td class="p-1">1</td>
                                                                <td class="p-1 text-justify">Recommendation from BKPM</td>
                                                                <td class="p-1 text-justify">Please <a href="https://wa.me/6281387848784?text=Welcome%20to%20TDS%20International%20Indonesia,%20your%20trusted%20tour%20and%20travel%20services.">contact us</a> for detail information about BKPM process and timeline</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="p-1">2</td>
                                                                <td class="p-1 text-justify">Results of the Feasibility Assessment (Hasil Penilaian Kelayakan)</td>
                                                                <td class="p-1 text-justify">5 days</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="p-1">3</td>
                                                                <td class="p-1 text-justify">Uploading the data of prospective foreign workers (Mengunggah data calon TKA)</td>
                                                                <td class="p-1 text-justify">1 day</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="p-1">4</td>
                                                                <td class="p-1 text-justify">Verify the data of prospective foreign workers (Verifikasi data calon TKA)</td>
                                                                <td class="p-1 text-justify">5 days</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="p-1">5</td>
                                                                <td class="p-1 text-justify">Payment DKPTKA (Pembayaran DPKK)</td>
                                                                <td class="p-1 text-justify">Within 5 days to be paid</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="p-1">6</td>
                                                                <td class="p-1 text-justify">RPTKA approval (Penerbitan RPTKA)</td>
                                                                <td class="p-1 text-justify">1-2 days</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="p-1">7</td>
                                                                <td class="p-1 text-justify">E-Visa</td>
                                                                <td class="p-1 text-justify">6~10 working days</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="p-1">8</td>
                                                                <td class="p-1 text-justify">ITAS & MERP</td>
                                                                <td class="p-1 text-justify">10~12 working days</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="p-1">9</td>
                                                                <td class="p-1 text-justify">STM</td>
                                                                <td class="p-1 text-justify">3~4 working days</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="p-1">10</td>
                                                                <td class="p-1 text-justify">SKTT</td>
                                                                <td class="p-1 text-justify">5~15 working days</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="p-1">11</td>
                                                                <td class="p-1 text-justify">Lapada</td>
                                                                <td class="p-1 text-justify">5~7 working days</td>
                                                            </tr>
                                                        </table>
                                                    </li>
                                                    <li>Renewal Working Visa Index 312<br>
                                                        <table class="table table-bordered table-hover text-center" width="75%">
                                                            <tr>
                                                                <th style="width:7%;height: 7vh;">No</th>
                                                                <th style="height: 7vh;">Process</th>
                                                                <th style="height: 7vh;">Timeline</th>
                                                            </tr>
                                                            <tr>
                                                                <td class="p-1">1</td>
                                                                <td class="p-1 text-justify">Results of the Feasibility Assessment (Hasil Penilaian Kelayakan)</td>
                                                                <td class="p-1 text-justify">5 days</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="p-1">2</td>
                                                                <td class="p-1 text-justify">Uploading the data of prospective foreign workers (Mengunggah data calon TKA)</td>
                                                                <td class="p-1 text-justify">1 day</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="p-1">3</td>
                                                                <td class="p-1 text-justify">Verify the data of prospective foreign workers (Verifikasi data calon TKA)</td>
                                                                <td class="p-1 text-justify">5 days</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="p-1">4</td>
                                                                <td class="p-1 text-justify">Payment DKPTKA (Pembayaran DPKK)</td>
                                                                <td class="p-1 text-justify">Within 5 days to be paid</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="p-1">5</td>
                                                                <td class="p-1 text-justify">RPTKA approval (Penerbitan RPTKA)</td>
                                                                <td class="p-1 text-justify">1-2 days</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="p-1">6</td>
                                                                <td class="p-1 text-justify">ITAS & MERP</td>
                                                                <td class="p-1 text-justify">10~12 working days</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="p-1">7</td>
                                                                <td class="p-1 text-justify">STM</td>
                                                                <td class="p-1 text-justify">3~4 working days</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="p-1">8</td>
                                                                <td class="p-1 text-justify">SKTT</td>
                                                                <td class="p-1 text-justify">5~15 working days</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="p-1">9</td>
                                                                <td class="p-1 text-justify">Lapada</td>
                                                                <td class="p-1 text-justify">5~7 working days</td>
                                                            </tr>
                                                        </table>
                                                    </li>
                                                </ol>
                                                <b>NOTES: for further information, please <a href="https://wa.me/6281387848784?text=Welcome%20to%20TDS%20International%20Indonesia,%20your%20trusted%20tour%20and%20travel%20services.">contact us</a>.</b><br>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Packages End -->
        </div>
    </div>
</div>
@endsection