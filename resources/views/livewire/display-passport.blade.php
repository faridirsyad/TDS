@extends('layouts.app')

@section('content')
<div>
    <div class="container" style="padding: 115px 0 0 0;">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb float-right">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('/home')}}#about">Documents</a></li>
            <li class="breadcrumb-item active" aria-current="page">Passport</li>
          </ol>
        </nav>
        <div class="content-content">
            <!-- Packages Start -->
            <div class="container-fluid py-5">
                <div class="container">
                    <div class="section-title">
                        <span>Passport</span>
                        <h2>Passport</h2>
                    </div>
                    <div class="row">
                        <!-- <div class="col-lg-12">
                            <div class="pb-3">
                                <div class="blog-item">
                                    <div class="position-relative">
                                        <img class="img-fluid w-100" src="assets/img/destination-2.jpg" alt="">
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <!-- <div class="col-lg-4 col-md-6 mb-4">
                            <div class="package-item bg-light mb-2">
                                <div class="p-4 content-item">
                                    <h5>Tour Package Details</h5>
                                    <div class="d-flex justify-content-between mb-3">
                                        <small class="m-0"><i class="fa fa-map-marker-alt text-primary mr-2"></i>Thailand</small>
                                        <small class="m-0"><i class="fa fa-calendar-alt text-primary mr-2"></i>3 days</small>
                                        <small class="m-0"><i class="fa fa-plane text-primary mr-2"></i>Turkish Airlines</small>
                                    </div>
                                    <p>
                                        <span class="h5 text-decoration-none" href=""><i class="fa fa-info-circle text-primary"></i> Includes</span>
                                        <span>
                                            <br>- Tiket masuk ke Pulau XXX
                                            <br>- Tiket penerbangan (PP)
                                            <br>- Akomodasi selama berada di Pulau XXX
                                            <br>- Transportasi dari bandara ke Pulau XXX
                                        </span>
                                        <span class="h5 text-decoration-none" href=""><br><br><i class="fa fa-warning text-primary"></i> Excludes</span>
                                        <span>
                                            <br>- Tiket ragam aktivitas tambahan
                                        </span>
                                        <hr style="border: 1px solid gray;">
                                        <span class="h5 text-decoration-none" href="">START FROM<br><b>Rp 3.000.000,00/pax</b></span>
                                        <span class="text-danger text-justify" style="font-size: 0.8em;"><br>* Catatan : Price can be changed any time</span>
                                    </p>
                                    <div class="border-top mt-4 pt-4">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button class="btn btn-block btn-primary"><b><i class="fa fa-paper-plane" aria-hidden="true"></i>  BOOK</b></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="col-md-12">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <b>REQUIREMENT : Adult</b>
                                    </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <table class="table table-bordered table-hover" width="75%">
                                                <tr>
                                                    <th class="text-center align-middle"rowspan="2">No</th>
                                                    <th class="text-center align-middle"rowspan="2">Requirements</th>
                                                    <th class="text-center align-middle"colspan="2">New Passport</th>
                                                    <th class="text-center align-middle"colspan="2">Extend</th>
                                                    <th class="text-center align-middle"rowspan="2">Notes</th>
                                                </tr>
                                                <tr>
                                                    <th class="text-center align-middle">Original</th>
                                                    <th class="text-center align-middle">Copy</th>
                                                    <th class="text-center align-middle">Original</th>
                                                    <th class="text-center align-middle">Copy</th>
                                                </tr>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Old Passport</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td><strong><i class="bi bi-check"></i></strong></td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Birth Certificate</td>
                                                    <td>-</td>
                                                    <td><strong><i class="bi bi-check"></i></strong></td>
                                                    <td>-</td>
                                                    <td><strong><i class="bi bi-check"></i></strong></td>
                                                    <td>-</td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Family Card</td>
                                                    <td>-</td>
                                                    <td><strong><i class="bi bi-check"></i></strong></td>
                                                    <td>-</td>
                                                    <td><strong><i class="bi bi-check"></i></strong></td>
                                                    <td>-</td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>e-KTP / e-KTP record receipt from<br>Civil Registry Service Office (Disdukcapil)</td>
                                                    <td>-</td>
                                                    <td><strong><i class="bi bi-check"></i></strong></td>
                                                    <td>-</td>
                                                    <td><strong><i class="bi bi-check"></i></strong></td>
                                                    <td>-</td>
                                                </tr>
                                                <tr>
                                                    <td>5</td>
                                                    <td>Marriage Certificate</td>
                                                    <td>-</td>
                                                    <td><strong><i class="bi bi-check"></i></strong></td>
                                                    <td>-</td>
                                                    <td><strong><i class="bi bi-check"></i></strong></td>
                                                    <td>If you are married</td>
                                                </tr>
                                                <tr>
                                                    <td>6</td>
                                                    <td>WNI letter / change of name letter</td>
                                                    <td>-</td>
                                                    <td><strong><i class="bi bi-check"></i></strong></td>
                                                    <td>-</td>
                                                    <td><strong><i class="bi bi-check"></i></strong></td>
                                                    <td>If you are a descendant</td>
                                                </tr>
                                                <tr>
                                                    <td>7</td>
                                                    <td>Sponsorship letter</td>
                                                    <td><strong><i class="bi bi-check"></i></strong></td>
                                                    <td>-</td>
                                                    <td><strong><i class="bi bi-check"></i></strong></td>
                                                    <td>-</td>
                                                    <td>If you are working</td>
                                                </tr>
                                            </table>
                                            <p>Notes:<br>
                                                <ul>
                                                    <li>Schedule to take photo at immigration office will be given within 2-3 days after documents are received by TDS International Indonesia.</li>
                                                    <li>All original documents <b>MUST</b> be brought to immigration office when taking photo for passport </li>
                                                    <li>Schedule to take photo at immigration office <b>CAN NOT</b> be rescheduled.</li>
                                                    <li>For further information, please <a href="https://wa.me/081387848784?text=Welcome%20to%20TDS%20International%20Indonesia,%20your%20trusted%20tour%20and%20travel%20services.">contact us</a>.</li>
                                                </ul>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                        <b>REQUIREMENT : Child (under 17 years old)</b>
                                    </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                           <table class="table table-bordered table-hover" width="75%">
                                                <tr>
                                                    <th class="text-center align-middle" rowspan="2">No</th>
                                                    <th class="text-center align-middle" rowspan="2">Requirements</th>
                                                    <th class="text-center align-middle" colspan="2">New Passport</th>
                                                    <th class="text-center align-middle" colspan="2">Extend</th>
                                                    <th class="text-center align-middle" rowspan="2">Notes</th>
                                                </tr>
                                                <tr>
                                                    <th class="text-center align-middle" >Original</th>
                                                    <th class="text-center align-middle" >Copy</th>
                                                    <th class="text-center align-middle" >Original</th>
                                                    <th class="text-center align-middle" >Copy</th>
                                                </tr>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Old Passport</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td><strong><i class="bi bi-check"></i></strong></td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Birth Certificate</td>
                                                    <td>-</td>
                                                    <td><strong><i class="bi bi-check"></i></strong></td>
                                                    <td>-</td>
                                                    <td><strong><i class="bi bi-check"></i></strong></td>
                                                    <td>-</td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Family Card</td>
                                                    <td>-</td>
                                                    <td><strong><i class="bi bi-check"></i></strong></td>
                                                    <td>-</td>
                                                    <td><strong><i class="bi bi-check"></i></strong></td>
                                                    <td>-</td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>Parents' e-KTP</td>
                                                    <td>-</td>
                                                    <td><strong><i class="bi bi-check"></i></strong></td>
                                                    <td>-</td>
                                                    <td><strong><i class="bi bi-check"></i></strong></td>
                                                    <td>-</td>
                                                </tr>
                                                <tr>
                                                    <td>5</td>
                                                    <td>Parents' Passport</td>
                                                    <td>-</td>
                                                    <td><strong><i class="bi bi-check"></i></strong></td>
                                                    <td>-</td>
                                                    <td><strong><i class="bi bi-check"></i></strong></td>
                                                    <td>-</td>
                                                </tr>
                                                <tr>
                                                    <td>6</td>
                                                    <td>Parents' marrieage certificate</td>
                                                    <td>-</td>
                                                    <td><strong><i class="bi bi-check"></i></strong></td>
                                                    <td>-</td>
                                                    <td><strong><i class="bi bi-check"></i></strong></td>
                                                    <td>-</td>
                                                </tr>
                                                <tr>
                                                    <td>7</td>
                                                    <td>WNI letter / change of name letter</td>
                                                    <td><strong><i class="bi bi-check"></i></strong></td>
                                                    <td>-</td>
                                                    <td><strong><i class="bi bi-check"></i></strong></td>
                                                    <td>-</td>
                                                    <td>If you are a descendant</td>
                                                </tr>
                                                <tr>
                                                    <td>8</td>
                                                    <td>Divorce letter / custody letter</td>
                                                    <td><strong><i class="bi bi-check"></i></strong></td>
                                                    <td>-</td>
                                                    <td><strong><i class="bi bi-check"></i></strong></td>
                                                    <td>-</td>
                                                    <td>If parents divorce</td>
                                                </tr>
                                            </table>
                                            <p>Notes:<br>
                                                <ul>
                                                    <li>Both parents <b>MUST</b> be present during the interview and take photo at the immigration office and if one party cannot attend, a statement <b>MUST</b> be made.</li>
                                                    <li>For further information, please <a href="https://wa.me/081387848784?text=Welcome%20to%20TDS%20International%20Indonesia,%20your%20trusted%20tour%20and%20travel%20services.">contact us</a>.</li>
                                                </ul>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                        <b>PROCESSING TIME</b>
                                    </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <table class="table table-bordered table-hover" width="75%">
                                                <tr>
                                                    <th class="text-center align-middle" style="height: 7vh;">No</th>
                                                    <th class="text-center align-middle" style="height: 7vh;">Area</th>
                                                    <th class="text-center align-middle" style="height: 7vh;">Product Type</th>
                                                    <th class="text-center align-middle" style="height: 7vh;">Processing Time</th>
                                                    <!-- <th class="text-center align-middle" style="height: 7vh;">Price</th> -->
                                                </tr>
                                                <tr>
                                                    <td rowspan="5">1</td>
                                                    <td rowspan="5"><b>West Jakarta</b></td>
                                                </tr>
                                                <tr>
                                                    <td>Regular Passport Express</td>
                                                    <td>5 workdays</td>
                                                    <!-- <td class="text-left">&nbsp;Rp<span style="float: right;">1.600.000,00&nbsp;</span></td> -->
                                                </tr>
                                                <tr>
                                                    <td>Regular Passport</td>
                                                    <td>7-10 workdays</td>
                                                    <!-- <td class="text-left">&nbsp;Rp<span style="float: right;">1.200.000,00&nbsp;</span></td> -->
                                                </tr>
                                                <tr>
                                                    <td><b>Regular e-Passport</b></td>
                                                    <td><b>7-10 workdays</b></td>
                                                    <!-- <td class="text-left">&nbsp;<b>Rp<span style="float: right;">1.750.000,00</b>&nbsp;</span></td> -->
                                                </tr>
                                                <tr>
                                                    <td>Polycarbonate e-Passport</td>
                                                    <td>7-10 workdays</td>
                                                    <!-- <td class="text-left">&nbsp;Rp<span style="float: right;">2.200.000,00&nbsp;</span></td> -->
                                                </tr>
                                                <tr>
                                                    <td rowspan="4">2</td>
                                                    <td rowspan="4"><b>Central Jakarta</b></td>
                                                </tr>
                                                <tr>
                                                    <td>Regular Passport Express</td>
                                                    <td>5 workdays</td>
                                                    <!-- <td class="text-left">&nbsp;Rp<span style="float: right;">1.600.000,00&nbsp;</span></td> -->
                                                </tr>
                                                <tr>
                                                    <td>Regular Passport</td>
                                                    <td>7-10 workdays</td>
                                                    <!-- <td class="text-left">&nbsp;Rp<span style="float: right;">1.200.000,00&nbsp;</span></td> -->
                                                </tr>
                                                <tr>
                                                    <td><b>Regular e-Passport</b></td>
                                                    <td><b>7-10 workdays</b></td>
                                                    <!-- <td class="text-left">&nbsp;<b>Rp<span style="float: right;">1.750.000,00</b>&nbsp;</span></td> -->
                                                </tr>
                                                <tr>
                                                    <td rowspan="3">3</td>
                                                    <td rowspan="3"><b>South Jakarta</b></td>
                                                </tr>
                                                <tr>
                                                    <td>Regular Passport</td>
                                                    <td>7 workdays</td>
                                                    <!-- <td class="text-left">&nbsp;Rp<span style="float: right;">1.150.000,00&nbsp;</span></td> -->
                                                </tr>
                                                <tr>
                                                    <td>Polycarbonate e-Passport</td>
                                                    <td>7-10 workdays</td>
                                                    <!-- <td class="text-left">&nbsp;Rp<span style="float: right;">2.100.000,00&nbsp;</span></td> -->
                                                </tr>
                                            </table>
                                            <p>Notes:<br>
                                                <ul>
                                                    <!-- <li>*) Price <b>INCLUDES</b> photo fee</li> -->
                                                    <!-- <li>*) Price <b>NOT INCLUDES</b> VAT 1.1%</li> -->
                                                    <li>For price and any other information, please <a href="https://wa.me/081387848784?text=Welcome%20to%20TDS%20International%20Indonesia,%20your%20trusted%20tour%20and%20travel%20services.">contact us</a>.</li>
                                                </ul>
                                            </p>
                                    </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                        <b>IMMIGRATION OFFICES</b>
                                    </button>
                                    </h2>
                                    <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="text-center text-primary mb-3" style="margin:auto; max-width: 75%; padding-top: 3vh;">
                                                <h4><b>JAKARTA</b></h4>
                                            </div>
                                            <div class="row row-cols-1 row-cols-md-2 g-4" style="margin:auto; max-width: 95%;">
                                                <div class="col">
                                                    <div class="card border-info mb-3" style="margin:auto;">
                                                        <!-- <div class="card-header">Header</div> -->
                                                        <div class="card-body">
                                                            <h5 class="card-title text-primary"><b>Kantor Imigrasi Kelas I Khusus Soekarno Hatta</b></h5>
                                                            <p class="card-text"><b>Address</b>: Jl. Bandar Udara Internasional Soekarno Hatta, Kel. Pajang, Kec. Benda Tangerang, Banten, 19110<br>
                                                            <b>Phone</b>: 021-5507185, 5507231-32<br>
                                                            <b>Fax</b>: 021-5507187</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="card border-info mb-3" style="margin:auto;">
                                                        <!-- <div class="card-header">Header</div> -->
                                                        <div class="card-body">
                                                            <h5 class="card-title text-primary"><b>Kantor Imigrasi Kelas I Khusus Jakarta Pusat</b></h5>
                                                            <p class="card-text"><b>Address</b>: Jl. Merpati Blok B12 No. 3, Kel. Gunung Sahari Selatan, Kec. Kemayoran Jakarta Pusat 10720<br>
                                                            <b>Phone</b>: 021-6541209, 6541211, 6541214<br>
                                                            <b>Fax</b>: 021-6541210</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="card border-info mb-3" style="margin:auto;">
                                                        <!-- <div class="card-header">Header</div> -->
                                                        <div class="card-body">
                                                            <h5 class="card-title text-primary"><b>​Kantor Imigrasi Kelas I Khusus Jakarta Selatan</b></h5>
                                                            <p class="card-text"><b>Address</b>: Jl. Warung Buncit Raya No. 207 RT 001 RW 001 Kel. Duren Tiga, Kec Pancoran Jakarta Selatan 12760<br>
                                                            <b>Phone</b>: 021-79170912, 79170910<br>
                                                            <b>Fax</b>: 021-79170907</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="card border-info mb-3" style="margin:auto;">
                                                        <!-- <div class="card-header">Header</div> -->
                                                        <div class="card-body">
                                                            <h5 class="card-title text-primary"><b>Kantor Imigrasi Kelas I Jakarta Utara</b></h5>
                                                            <p class="card-text"><b>Address</b>: Jl. Boulevard Artha Gading Blok A No. 5-7, 22-24, Kel. Kelapa Gading Barat, Kec. Kelapa Gading Jakarta Utara 14240<br>
                                                            <b>Phone</b>: 021-45850340<br>
                                                            <b>Fax</b>: 021-45847160</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="card border-info mb-3" style="margin:auto;">
                                                        <!-- <div class="card-header">Header</div> -->
                                                        <div class="card-body">
                                                            <h5 class="card-title text-primary"><b>Kantor Imigrasi Kelas I Khusus Jakarta Barat</b></h5>
                                                            <p class="card-text"><b>Address</b>: Jl. Pos Kota No. 4 RT 004 RW 006 Kel. Taman Sari Jakarta Barat 11110<br>
                                                            <b>Phone</b>: 021-6904795, 6904845<br>
                                                            <b>Fax</b>: 021-6930544</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="card border-info mb-3" style="margin:auto;">
                                                        <!-- <div class="card-header">Header</div> -->
                                                        <div class="card-body">
                                                            <h5 class="card-title text-primary"><b>Kantor Imigrasi Kelas I Jakarta Timur</b></h5>
                                                            <p class="card-text"><b>Address</b>: Jl. Bekasi Timur Raya No. 169 RT 08 RW 14 Kel. Cipinang Besar Utara, Kec. Jatinegara Jakarta Timur 13410<br>
                                                            <b>Phone</b>: 021-8509104-05, 8503896<br>
                                                            <b>Fax</b>: 021-8509105, 850396</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="card border-info mb-3" style="margin:auto;">
                                                        <!-- <div class="card-header">Header</div> -->
                                                        <div class="card-body">
                                                            <h5 class="card-title text-primary"><b>Kantor Imigrasi Kelas I Tanjung Priok</b></h5>
                                                            <p class="card-text"><b>Address</b>: Jl. Melati No. 124 A Jakarta Utara 14230<br>
                                                            <b>Phone</b>: 021-494909, 4301080<br>
                                                            <b>Fax</b>: 021-4352253</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center text-primary mb-3" style="margin:auto; max-width: 95%;">
                                                <hr style="border: solid 2px;">
                                            </div>
                                            <div class="text-center text-primary mb-3" style="margin:auto; max-width: 75%; padding-top: 2vh;">
                                                <h4><b>OTHERS</b></h4>
                                            </div>
                                            <div class="row row-cols-1 row-cols-md-2 g-4" style="margin:auto; max-width: 95%;">
                                                <div class="col">
                                                    <div class="card border-info mb-3" style="margin:auto;">
                                                        <!-- <div class="card-header">Header</div> -->
                                                        <div class="card-body">
                                                            <h5 class="card-title text-primary"><b>Kantor Imigrasi Kelas I Serang</b></h5>
                                                            <p class="card-text"><b>Address</b>: Jl. Warung Jaud No. 82, Kaligandu Serang 42151<br>
                                                            <b>Phone</b>: 0254-209489<br>
                                                            <b>Fax</b>: 0254-209440</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="card border-info mb-3" style="margin:auto;">
                                                        <!-- <div class="card-header">Header</div> -->
                                                        <div class="card-body">
                                                            <h5 class="card-title text-primary"><b>Kantor Imigrasi Kelas I Tangerang</b></h5>
                                                            <p class="card-text"><b>Address</b>: Jl. Taman Makam Pahlawan Taruna No 10 Tangerang 15118
Ground Floor, Suite 102<br>
                                                            <b>Phone</b>: 021-55790871, 55790872<br>
                                                            <b>Fax</b>: 021-55771874</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="card border-info mb-3" style="margin:auto;">
                                                        <!-- <div class="card-header">Header</div> -->
                                                        <div class="card-body">
                                                            <h5 class="card-title text-primary"><b>Kantor Imigrasi Kelas II Depok</b></h5>
                                                            <p class="card-text"><b>Address</b>: Jl. Boulevard Raya, Komp. Perkantoran Pemda Depok Grand Depok City, Depok<br>
                                                            <b>Phone</b>: 021-77820580<br>
                                                            <b>Fax</b>: 021-77820580</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="card border-info mb-3" style="margin:auto;">
                                                        <!-- <div class="card-header">Header</div> -->
                                                        <div class="card-body">
                                                            <h5 class="card-title text-primary"><b>Kantor Imigrasi Kelas II Bogor</b></h5>
                                                            <p class="card-text"><b>Address</b>: Jl. Jend. A. Yani No. 65 Bogor 16161<br>
                                                            <b>Phone</b>: 0251-338074, 332870<br>
                                                            <b>Fax</b>: 0251-332870</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="card border-info mb-3" style="margin:auto;">
                                                        <!-- <div class="card-header">Header</div> -->
                                                        <div class="card-body">
                                                            <h5 class="card-title text-primary"><b>Kantor Imigrasi Kelas II Cilegon</b></h5>
                                                            <p class="card-text"><b>Address</b>: Jl. Raya Merak KM 116 Cilegon 42436<br>
                                                            <b>Phone</b>: 0254-574033<br>
                                                            <b>Fax</b>: 021-572978</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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