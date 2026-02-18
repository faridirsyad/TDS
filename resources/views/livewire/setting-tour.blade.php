<div>
    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="destroy">
                    <div class="modal-body">
                    Are you sure to delete this data?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-danger" onclick="hideModal()">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Setting Tour/Package</h4>
            @if(Session::has('success'))
            <div class="alert alert-success alert-block">
                <strong>{{ Session::get('success') }}</strong>
            </div>
            @endif
            @if(Session::has('error'))
            <div class="alert alert-danger alert-block">
                <strong>{{ Session::get('error') }}</strong>
            </div>
            @endif
            @if($action == '')
              <div class="row">
                <div class="col-md-2">
                  <label for="ftitle" class="col-form-label">Tour/Package Name:</label>
                  <input type="text" class="form-control text-black" id="ftitle" wire:model="ftitle" placeholder="Write tour/package name here">
                </div>
                <div class="col-md-2">
                  <label for="fdestination" class="col-form-label">Tour Destination:</label>
                  <select class="form-select text-black" id="fdestination" wire:model="fdestination">
                    <option value='' {{ $fdestination == '' ? 'selected' : ''}}>All destinations</option>
                    @if(($listCountry!=null)&&(count($listCountry)>0))
                      @foreach($listCountry as $val)
                        <option value="{{$val->id}}" {{ $fdestination == $val->id ? 'selected' : ''}}>{{$val->countryCityName}} - {{$val->categoryName}}</option>
                      @endforeach
                    @endif
                  </select>
                </div>
                <div class="col-md-2">
                  <label for="ftype" class="col-form-label">Tour Type:</label>
                  <select class="form-select text-black" id="ftype" wire:model="ftype">
                    <option value='' {{ $ftype == '' ? 'selected' : ''}}>All types</option>
                    @if(($listType!=null)&&(count($listType)>0))
                      @foreach($listType as $val)
                        <option value="{{$val->id}}" {{ $ftype == $val->id ? 'selected' : ''}}>{{$val->tourTypeName}}</option>
                      @endforeach
                    @endif
                  </select>
                </div>
                <div class="col-md-2">
                  <label for="fmonth" class="col-form-label">Promotion Month</label>
                  <select class="form-select text-black" id="fmonth" wire:model="fmonth">
                    <option value='' {{ $fmonth == '' ? 'selected' : ''}}>Show all</option>
                    @if(($listMonth!=null)&&(count($listMonth)>0))
                      @foreach($listMonth as $val)
                        <option value="{{$val->id}}" {{ $fmonth == $val->id ? 'selected' : ''}}>{{$val->monthName}}</option>
                      @endforeach
                    @endif
                  </select>
                </div>
                <div class="col-md-2">
                  <label for="fyear" class="col-form-label">Promotion Year</label>
                  <select class="form-select text-black" id="fyear" wire:model="fyear">
                    <option value='' {{ $fyear == '' ? 'selected' : ''}}>Show all</option>
                    @if(($listYear!=null)&&(count($listYear)>0))
                      @foreach($listYear as $val)
                        <option value="{{$val->tourPromotionYear}}" {{ $fyear == $val->tourPromotionYear ? 'selected' : ''}}>{{$val->tourPromotionYear}}</option>
                      @endforeach
                    @endif
                  </select>
                </div>
              </div>
            @endif
            @if($action != 'add')
              <div style="text-align: right;"><br><button class="btn btn-primary" wire:click="open('add')">Add Data</button></div>
            @endif
            @if($action == '')
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                             <th class="text-center">No</th>
                             <th class="text-center">Tour/Package Title</th>
                             <th class="text-center">Destination City/Country</th>
                             <th class="text-center">Long of Stay (Days)</th>
                             <th class="text-center">Flight</th>
                             <th class="text-center">Price</th> 
                             <th class="text-center">Promotion Month</th> 
                             <th class="text-center">Promotion Year</th> 
                             <th class="text-center">Tour Type</th>
                             <th class="text-center">Description</th>
                             <th class="text-center">Includes</th>
                             <th class="text-center">Excludes</th>
                             <th class="text-center">Pricelist</th>
                             <th class="text-center">Additional Activities</th>
                             <th class="text-center">Terms and Conditions</th>
                             <th class="text-center">Is Displayed as Recommendation in Homepage?</th>
                             <th class="text-center">Is Displayed as Favourite in Homepage?</th>
                             <th class="text-center">Tour/Package Image</th>
                             <th class="text-center">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @if(($listTour!=null)&&(count($listTour)>0))
                           @foreach($listTour as $val)
                            <tr>
                            <td class="text-center">{{ ($page-1) * $pageSize + $loop->index + 1 }}</td>
                            <td>{{$val->tourTitle}}</td>
                            <td>{{$val->countryCityName}}</td>
                            <td>{{$val->tourLongOfStay}}</td>
                            <td>{{$val->flightName}}</td>
                            <td>Rp.<span style="text-align:right;">{{number_format($val->tourPrice, 2, ",", ".")}}</span></td>
                            <td>{{$val->monthName}}</td>
                            <td>{{$val->tourPromotionYear}}</td>
                            <td>{{$val->tourTypeName}}</td>
                            <td>{!! substr($val->tourDescription,0,35) !!}</td>
                            <td>{!! substr($val->tourInclude,0,35) !!}</td>
                            <td>{!! substr($val->tourExclude,0,35) !!}</td>
                            <td>{!! substr($val->tourPricelist,0,35) !!}</td>
                            <td>{!! substr($val->tourAddActivities,0,35) !!}</td>
                            <td>{!! substr($val->tourTermCondition,0,35) !!}</td>
                            <td>
                                @if($val->isDisplayRecommendation=="1")
                                Yes
                                @elseif($val->isDisplayRecommendation=="0")
                                No
                                @else
                                Not Set
                                @endif
                            </td>
                            <td>
                                @if($val->isDisplayFavourite=="1")
                                Yes
                                @elseif($val->isDisplayFavourite=="0")
                                No
                                @else
                                Not Set
                                @endif
                            </td>
                            <td><img src="{{ asset('storage/app/public/tour/'.$val->tourImage) }}" wire:click.prevent="openFile('{{$val->tourImage}}')"></td>
                            <td>
                                <button type="button" class="btn btn-warning me-2" wire:click="edit({{$val->id}})">Edit</button>
                                <button type="button" class="btn btn-danger me-2" wire:click="delete({{$val->id}})" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button></td>
                              </tr>
                            @endforeach
                          @else
                          <tr><td class="text-center" colspan="19">No Data</td></tr>
                          @endif
                        </tbody>
                      </table>
                    </div>
                    <div><br>{!! $qData !!}</div>
            @else
                    <form class="forms-sample" wire:submit.prevent="{{ ($action=='add')?'addData':'editData'}}">
                    @csrf
                      <input type="hidden" id="tourId" wire:model="tourId">
                      <div class="form-group row">
                        <label for="title" class="col-sm-3 col-form-label">Tour/Package Title</label>
                        <div class="col-sm-9"><input type="text" class="form-control text-black" id="title" wire:model="title" placeholder="Write tour/package title here">
                        </div>
                        @error('title') <div class="col-sm-3"></div><div class="col-sm-9"><p style="color: red;">{{ $message }}</p></div> @enderror
                      </div>
                      <div class="form-group row">
                        <label for="country" class="col-sm-3 col-form-label">Destination City/Country</label>
                        <div class="col-sm-9">
                            <select class="form-select text-black" id="country" wire:model="country">
                                <option {{ $country == '' ? 'readonly' : 'disabled'}} selected>== Choose city/country ==</option>
                                @if(($listCountry!=null)&&(count($listCountry)>0))
                                  @foreach($listCountry as $val)
                                  <option value="{{$val->id}}">{{$val->countryCityName}} - {{$val->categoryName}}</option>
                                  @endforeach
                                @endif
                            </select>
                        </div>
                        @error('country') <div class="col-sm-3"></div><div class="col-sm-9"><p style="color: red;">{{ $message }}</p></div> @enderror
                      </div>
                      <div class="form-group row">
                        <label for="longOfStay" class="col-sm-3 col-form-label">Long of Stay (Days)</label>
                        <div class="col-sm-9">
                          <input type="number" class="form-control text-black" id="longOfStay" wire:model="longOfStay" placeholder="Write long of stay (days) here">
                        </div>
                        @error('longOfStay') <div class="col-sm-3"></div><div class="col-sm-9"><p style="color: red;">{{ $message }}</p></div> @enderror
                      </div>
                      <div class="form-group row">
                        <label for="flight" class="col-sm-3 col-form-label">Flight</label>
                        <div class="col-sm-9">
                            <select class="form-select text-black" id="flight" wire:model="flight">
                                <option {{ $flight == '' ? 'readonly' : 'disabled'}} selected>== Choose flight ==</option>
                                @if(($listFlight!=null)&&(count($listFlight)>0))
                                  @foreach($listFlight as $val)
                                  <option value="{{$val->id}}">{{$val->flightName}}</option>
                                  @endforeach
                                @endif
                            </select>
                        </div>
                        @error('flight') <div class="col-sm-3"></div><div class="col-sm-9"><p style="color: red;">{{ $message }}</p></div> @enderror
                      </div>
                      <div class="form-group row">
                        <label for="price" class="col-sm-3 col-form-label">Price</label>
                        <div class="col-sm-9">
                          <input type="number" class="form-control text-black" id="price" wire:model="price" placeholder="Write price here">
                        </div>
                        @error('price') <div class="col-sm-3"></div><div class="col-sm-9"><p style="color: red;">{{ $message }}</p></div> @enderror
                      </div>
                      <div class="form-group row">
                        <label for="month" class="col-sm-3 col-form-label">Promotion Month</label>
                        <div class="col-sm-9">
                            <select class="form-select text-black" id="month" wire:model="month">
                                <option {{ $month == '' ? 'readonly' : 'disabled'}} selected>== Choose month ==</option>
                                @if(($listMonth!=null)&&(count($listMonth)>0))
                                  @foreach($listMonth as $val)
                                  <option value="{{$val->id}}">{{$val->monthName}}</option>
                                  @endforeach
                                @endif
                            </select>
                        </div>
                        @error('month') <div class="col-sm-3"></div><div class="col-sm-9"><p style="color: red;">{{ $message }}</p></div> @enderror
                      </div>
                      <div class="form-group row">
                        <label for="year" class="col-sm-3 col-form-label">Promotion Year</label>
                        <div class="col-sm-9">
                          <input type="number" class="form-control text-black" id="year" wire:model="year" placeholder="Write promotion year here">
                        </div>
                        @error('year') <div class="col-sm-3"></div><div class="col-sm-9"><p style="color: red;">{{ $message }}</p></div> @enderror
                      </div>
                      <div class="form-group row">
                        <label for="type" class="col-sm-3 col-form-label">Tour Type</label>
                        <div class="col-sm-9">
                            <select class="form-select text-black" id="type" wire:model="type">
                                <option {{ $type == '' ? 'readonly' : 'disabled'}} selected>== Choose tour type ==</option>
                                @if(($listType!=null)&&(count($listType)>0))
                                  @foreach($listType as $val)
                                  <option value="{{$val->id}}">{{$val->tourTypeName}}</option>
                                  @endforeach
                                @endif
                            </select>
                        </div>
                        @error('type') <div class="col-sm-3"></div><div class="col-sm-9"><p style="color: red;">{{ $message }}</p></div> @enderror
                      </div>
                      <div class="form-group row">
                        <label for="description" class="col-sm-3 col-form-label">Tour Description</label>
                        <div class="col-sm-9 form-floating" wire:ignore>
                          {{-- <textarea class="form-control" placeholder="Write tour description here" id="description" wire:model="description" style="height: 125px">{{$description}}</textarea> --}}
                          <trix-editor
                              class="formatted-content"
                              x-data
                              x-on:trix-change="$dispatch('input', event.target.value)"
                              x-ref="trix"
                              wire:model.debounce.60s="description"
                              wire:key="uniqueKeyDescription"
                          ></trix-editor>
                        </div>
                        <input
                            id="descriptionContent"
                            type="hidden"
                            wire:model="description"
                        >
                        @error('description') <div class="col-sm-3"></div><div class="col-sm-9"><p style="color: red;">{{ $message }}</p></div> @enderror
                      </div>
                      <div class="form-group row">
                        <label for="include" class="col-sm-3 col-form-label">Tour Included Item</label>
                        <div class="col-sm-9 form-floating" wire:ignore>
                          {{-- <textarea class="form-control" placeholder="Write included item here" id="include" wire:model="include" style="height: 125px">{{$include}}</textarea> --}}
                          <trix-editor
                              class="formatted-content"
                              x-data
                              x-on:trix-change="$dispatch('input', event.target.value)"
                              x-ref="trix"
                              wire:model.debounce.60s="include"
                              wire:key="uniqueKeyInclude"
                          ></trix-editor>
                        </div>
                        <input
                            id="descriptionInclude"
                            type="hidden"
                            wire:model="include"
                        >
                        @error('include') <div class="col-sm-3"></div><div class="col-sm-9"><p style="color: red;">{{ $message }}</p></div> @enderror
                      </div>
                      <div class="form-group row">
                        <label for="exclude" class="col-sm-3 col-form-label">Tour Excluded Item</label>
                        <div class="col-sm-9 form-floating" wire:ignore>
                          {{-- <textarea class="form-control" placeholder="Write excluded item here" id="exclude" wire:model="exclude" style="height: 125px">{{$exclude}}</textarea> --}}
                          <trix-editor
                              class="formatted-content"
                              x-data
                              x-on:trix-change="$dispatch('input', event.target.value)"
                              x-ref="trix"
                              wire:model.debounce.60s="exclude"
                              wire:key="uniqueKeyExclude"
                          ></trix-editor>
                        </div>
                        <input
                            id="descriptionExclude"
                            type="hidden"
                            wire:model="exclude"
                        >
                        @error('exclude') <div class="col-sm-3"></div><div class="col-sm-9"><p style="color: red;">{{ $message }}</p></div> @enderror
                      </div>
                      <div class="form-group row">
                        <label for="pricelist" class="col-sm-3 col-form-label">Pricelist</label>
                        <div class="col-sm-9 form-floating" wire:ignore>
                          {{-- <textarea class="form-control" placeholder="Write pricelist here" id="pricelist" wire:model="pricelist" style="height: 125px">{{$pricelist}}</textarea> --}}
                          <trix-editor
                              class="formatted-content"
                              x-data
                              x-on:trix-change="$dispatch('input', event.target.value)"
                              x-ref="trix"
                              wire:model.debounce.60s="pricelist"
                              wire:key="uniqueKeyPricelist"
                          ></trix-editor>
                        </div>
                        <input
                            id="descriptionPricelist"
                            type="hidden"
                            wire:model="pricelist"
                        >
                        @error('pricelist') <div class="col-sm-3"></div><div class="col-sm-9"><p style="color: red;">{{ $message }}</p></div> @enderror
                      </div>
                      <div class="form-group row">
                        <label for="activities" class="col-sm-3 col-form-label">Additional Activities</label>
                        <div class="col-sm-9 form-floating" wire:ignore>
                          {{-- <textarea class="form-control" placeholder="Write additional activities here" id="activities" wire:model="activities" style="height: 125px">{{$activities}}</textarea> --}}
                          <trix-editor
                              class="formatted-content"
                              x-data
                              x-on:trix-change="$dispatch('input', event.target.value)"
                              x-ref="trix"
                              wire:model.debounce.60s="activities"
                              wire:key="uniqueKeyActivities"
                          ></trix-editor>
                        </div>
                        <input
                            id="descriptionActivities"
                            type="hidden"
                            wire:model="activities"
                        >
                        @error('activities') <div class="col-sm-3"></div><div class="col-sm-9"><p style="color: red;">{{ $message }}</p></div> @enderror
                      </div>
                      <div class="form-group row">
                        <label for="termcondition" class="col-sm-3 col-form-label">Term and Conditions</label>
                        <div class="col-sm-9 form-floating" wire:ignore>
                          {{-- <textarea class="form-control" placeholder="Write terms and conditions here" id="termcondition" wire:model="termcondition" style="height: 125px">{{$termcondition}}</textarea> --}}
                          <trix-editor
                              class="formatted-content"
                              x-data
                              x-on:trix-change="$dispatch('input', event.target.value)"
                              x-ref="trix"
                              wire:model.debounce.60s="termcondition"
                              wire:key="uniqueKeyTermcondition"
                          ></trix-editor>
                        </div>
                        <input
                            id="descriptionTermcondition"
                            type="hidden"
                            wire:model="termcondition"
                        >
                        @error('termcondition') <div class="col-sm-3"></div><div class="col-sm-9"><p style="color: red;">{{ $message }}</p></div> @enderror
                      </div>
                      <div class="form-group row">
                        <label for="isDisplayRecommendation" class="col-sm-3 col-form-label">Is Displayed as Recommendation in Homepage?</label>
                        <div class="col-sm-9">
                            <select class="form-select text-black" id="isDisplayRecommendation" wire:model="isDisplayRecommendation">
                                <option {{ $isDisplayRecommendation == '' ? 'readonly' : 'disabled'}} selected>== Choose the answer ==</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        @error('isDisplayRecommendation') <div class="col-sm-3"></div><div class="col-sm-9"><p style="color: red;">{{ $message }}</p></div> @enderror
                      </div>
                      <div class="form-group row">
                        <label for="isDisplayFavourite" class="col-sm-3 col-form-label">Is Displayed as Favourite in Homepage?</label>
                        <div class="col-sm-9">
                            <select class="form-select text-black" id="isDisplayFavourite" wire:model="isDisplayFavourite">
                                <option {{ $isDisplayFavourite == '' ? 'readonly' : 'disabled'}} selected>== Choose the answer ==</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        @error('isDisplayFavourite') <div class="col-sm-3"></div><div class="col-sm-9"><p style="color: red;">{{ $message }}</p></div> @enderror
                      </div>
                      <div class="form-group row">
                        <label for="tourImage" class="col-sm-3 col-form-label">Tour/Package Image 
                                        @if($action == 'add')
                                        <span class="text-primary">*Must be filled</span>
                                        @endif
                                        @if($action == 'edit')
                                        <span class="text-primary">*Leave it empty if you don't want to change image</span>
                                        @endif</label>
                        <div class="col-sm-9">
                                    @if($action == 'edit')
                                      @if(($tourImageName!=null)&&($tourImageName!=''))
                                      <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                                          <button class="btn btn-sm btn-outline-success" wire:click.prevent="openFile('{{$tourImageName}}')"><font size="2pt">Download</font></button>
                                      </div>
                                      @endif
                                    @endif
                                    <input class="form-control" type="file" wire:model="tourImage" id="tourImage">
                        </div>
                        @error('tourImage') <div class="col-sm-3"></div><div class="col-sm-9"><p style="color: red;">{{ $message }}</p></div> @enderror
                      </div>
                      @if($action=='add')
                      <button type="submit" class="btn btn-primary me-2">Add</button>
                      @else
                      <button type="submit" class="btn btn-warning me-2">Edit</button>
                      @endif
                      <button class="btn btn-light" wire:click="back">Cancel</button>
                    </form>
            @endif
        </div>
    </div>
</div>
