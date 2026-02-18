<div>
        <div class="modal fade" tabindex="2" id="okay" wire:ignore.self>
          <div class="modal-dialog">
            <div class="modal-content">
                
              <!-- Modal body -->
              <div class="modal-body text-center">
                @if (count($errors) > 0)
                    <img src="{{ asset('storage/app/public/images/cross.gif') }}" width="100%">
                    <br>Please fill all the fields before submit.
                @else
                    <img src="{{ asset('storage/app/public/images/check.gif') }}" width="100%">
                    <br>Request successfully sent.!!<br>We will send you email about the information as soon as possible.
                @endif
              </div>

              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
              </div>
              
            </div>
          </div>
        </div>
        <!-- The Modal -->
        <div class="modal fade" tabindex="-1" id="formQuestion" wire:ignore.self>
          <div class="modal-dialog">
            <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Send Me Information</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>

              <form wire:submit.prevent="saveInformation" method="POST">
              @csrf
              <!-- Modal body -->
              <div class="modal-body">
                  <div class="form-group mb-3">
                    <label class="col-form-label" for="name">Customer Name</label>
                    <input type="text" class="form-control" id="name" name="name" wire:model.defer="name">
                    @error('name') <div><p style="color: red;">{{ $message }}</p></div> @enderror
                  </div>
                  <div class="form-group mb-3">
                    <label class="col-form-label" for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" wire:model.defer="email">
                    @error('email') <div><p style="color: red;">{{ $message }}</p></div> @enderror
                  </div>
                  <div class="form-group mb-3">
                    <label class="col-form-label" for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" wire:model.defer="phone">
                    @error('phone') <div><p style="color: red;">{{ $message }}</p></div> @enderror
                  </div>
                  <div class="form-group mb-3">
                    <label class="col-form-label" for="about">Send me</label>
                    <textarea class="form-control" id="about" name="about" wire:model.defer="about"></textarea>
                    @error('about') <div><p style="color: red;">{{ $message }}</p></div> @enderror
                  </div>
              </div>

              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" onclick="hide()" data-bs-toggle="modal" data-bs-target="#okay">Submit</button>
              </div>
              </form>
            </div>
          </div>
        </div>
    <div class="container" style="padding: 115px 0 0 0;">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb float-right">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('/tour/all')}}">Tour Packages</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail</li>
          </ol>
        </nav>
        <div class="content-content">
            <!-- Packages Start -->
            @foreach($detail as $detail)
            <div class="container-fluid py-5">
                <div class="container">
                    <div class="section-title">
                        <span>{{$detail->tourTitle}}</span>
                        <h2>{{$detail->tourTitle}}</h2>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="pb-3">
                                <div class="blog-item">
                                    <div class="position-relative">
                                        <img class="img-fluid w-100" src="{{ asset('storage/app/public/tour/'.$detail->tourImage) }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="package-item bg-light mb-2">
                                <!-- <img class="img-fluid" src="assets/img/destination-1.jpg" alt=""> -->
                                <div class="p-4 content-item">
                                    <h5>Tour Package Details</h5>
                                    <div class="d-flex justify-content-between mb-3">
                                        <small class="m-0"><i class="fa fa-map-marker-alt text-primary mr-2"></i>{{$detail->countryCityName}}</small>
                                        <small class="m-0"><i class="fa fa-calendar-alt text-primary mr-2"></i>{{$detail->tourLongOfStay}} days</small>
                                        <small class="m-0"><i class="fa fa-plane text-primary mr-2"></i>{{$detail->flightName}}</small>
                                    </div>
                                    <p>
                                        <span class="h5 text-decoration-none" href=""><i class="fa fa-info-circle text-primary"></i> Includes</span>
                                        <p>
                                            {!! $detail->tourInclude !!}
                                            
                                        </p>
                                        <span class="h5 text-decoration-none" href=""><i class="fa fa-warning text-primary"></i> Excludes</span>
                                        <p>
                                            {!! $detail->tourExclude !!}
                                        </p>
                                        <hr style="border: 1px solid gray;">
                                        <span class="h5 text-decoration-none" href="">START FROM<br><b>Rp <span style="text-align:right;">{{number_format($detail->tourPrice, 2, ",", ".")}}/pax</b></span>
                                        <span class="text-danger text-justify" style="font-size: 0.8em;"><br>* NOTE : Price can be changed any time</span>
                                    </p>
                                    <div class="border-top mt-4 pt-4">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="button" class="btn btn-block btn-primary" data-bs-toggle="modal" data-bs-target="#formQuestion" wire:click="resetFields('{{$detail->tourTitle}}')"><b><i class="fa fa-paper-plane" aria-hidden="true"></i>  BOOK</b></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <b>Description</b>
                                </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    {!! $detail->tourDescription !!}
                                </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <b>Pricelist</b>
                                </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    {!! $detail->tourPricelist !!}
                                </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <b>Other Additional Activities</b>
                                </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    {!! $detail->tourAddActivities !!}
                                </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    <b>Terms and Conditions</b>
                                </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    {!! $detail->tourTermCondition !!}
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Packages End -->
            @endforeach
        </div>
    </div>
</div>
<script>
    function hide(){
        @if (count($errors) > 0)
            $('#formQuestion').modal('show');
        @else
            $('#formQuestion').modal('hide');
        @endif
    }
</script>