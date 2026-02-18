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
            <h4 class="card-title">Setting Country / City</h4>
            @if(Session::has('success'))
            <div class="alert alert-success alert-block">
                <strong>{{ Session::get('success') }}</strong>
            </div>
            @endif
            @if (Session::has('error'))
            <div class="alert alert-danger alert-block">
                <strong>{{ Session::get('error') }}</strong>
            </div>
            @endif
        @if($action == '')
        <div class="row">
          <div class="col-md-3">
            <label for="fcountry" class="col-form-label">Country:</label>
            <input type="text" class="form-control text-black" id="fcountry" wire:model="fcountry" placeholder="Write country/city name here">
          </div>
          <div class="col-md-3">
            <label for="ftype" class="col-form-label">Tour Type:</label>
            <select class="form-select text-black" id="ftype" wire:model="ftype">
              <option value='' {{ $ftype == '' ? 'selected' : ''}} selected>All types</option>
              <option value="1">Domestic</option>
              <option value="2">International</option>
            </select>
          </div>
          <div class="col-md-3">
            <label for="fcategory" class="col-form-label">Country Category:</label>
            <select class="form-select text-black" id="fcategory" wire:model="fcategory">
              <option value='' {{ $fcategory == '' ? 'selected' : ''}} selected>All categories</option>
              @foreach($listCountryCategory as $val)
                <option value="{{$val->id}}" {{ $fcategory == $val->id ? 'selected' : ''}}>{{$val->categoryName}}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-3">
            <label for="fcategory" class="col-form-label">Write Visa Requirement?</label>
            <select class="form-select text-black" id="frequirement" wire:model="frequirement">
              <option value='' {{ $frequirement == '' ? 'selected' : ''}} selected>Show all</option>
              <option value="1">Yes</option>
              <option value="0">No</option>
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
                             <th class="text-center">Country/City Name</th>
                             <th class="text-center">Country Flag</th>
                             <th class="text-center">Tour Type</th>
                             <th class="text-center">Country Category</th>
                             <th class="text-center">Write Visa Requirement?</th> 
                             <th class="text-center">Is Free Visa Country?</th>
                             <th class="text-center">Is ASEAN Country?</th>
                             <th class="text-center">Long of Stay</th>
                             <th class="text-center">Is Can Not Process Visa Country?</th>
                             <th class="text-center">Is Visa-On-Arrival Country?</th>
                             <th class="text-center">Type of Visa-On-Arrival</th>
                             <th class="text-center">Is Retirement Visa Country?</th>
                             <th class="text-center">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @if(($listCountryCity!=null)&&(count($listCountryCity)>0))
                           @foreach($listCountryCity as $val)
                            <tr>
                            <td class="text-center">{{ ($page-1) * $pageSize + $loop->index + 1 }}</td>
                            <td>{{$val->countryCityName}}</td>
                            <td><img src="{{ asset('storage/app/public/images/'.$val->countryFlag) }}" wire:click.prevent="openFile('{{$val->countryFlag}}')"></td>
                            <td>
                              @if($val->tourType == 2)
                              International
                              @elseif($val->tourType == 1)
                              Domestic
                              @else
                              Not Set
                              @endif
                            </td>
                            <td>{{$val->categoryName}}</td>
                            <td class="text-center">
                              @if($val->isVisaRequirement == '0')
                              No
                              @elseif($val->isVisaRequirement == '1')
                              Yes
                              @else
                              Not Set
                              @endif
                            </td>
                            <td class="text-center">
                              @if($val->isFreeVisa == '0')
                              No
                              @elseif($val->isFreeVisa == '1')
                              Yes
                              @else
                              Not Set
                              @endif
                            </td>
                            <td class="text-center">
                              @if($val->isAsean == '0')
                              No
                              @elseif($val->isAsean == '1')
                              Yes
                              @else
                              Not Set
                              @endif
                            </td>
                            <td class="text-center">{{$val->longOfStay}}</td>
                            <td class="text-center">
                              @if($val->isCanNotProcessVisa == '0')
                              No
                              @elseif($val->isCanNotProcessVisa == '1')
                              Yes
                              @else
                              Not Set
                              @endif
                            </td>
                            <td class="text-center">
                              @if($val->isVisaOnArrival == '0')
                              No
                              @elseif($val->isVisaOnArrival == '1')
                              Yes
                              @else
                              Not Set
                              @endif
                            </td>
                            <td>
                                @if($val->typeVisaOnArrival == null)
                                -
                                @else
                                {{($val->typeVisaOnArrival == 1) ? 'Seaport' : 'Airport' }}
                                @endif
                            </td>
                            <td class="text-center">
                              @if($val->isRetirementVisa == '0')
                              No
                              @elseif($val->isRetirementVisa == '1')
                              Yes
                              @else
                              Not Set
                              @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-warning me-2" wire:click="edit({{$val->id}})">Edit</button>
                                <button type="button" class="btn btn-danger me-2" wire:click="delete({{$val->id}})" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button></td></tr>
                            @endforeach
                          @else
                          <tr><td class="text-center" colspan="13">No Data</td></tr>
                          @endif
                        </tbody>
                      </table>
                    </div>
                    <div><br>{!! $qData !!}</div>
        @else
                    <form class="forms-sample" wire:submit.prevent="{{ ($action=='add')?'addData':'editData'}}">
                    @csrf
                      <div class="form-group row">
                        <input type="hidden" id="countryId" wire:model="countryId">
                        <label for="countryCityName" class="col-sm-3 col-form-label">Country/City Name</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control text-black" id="countryCityName" wire:model="countryCityName" placeholder="Write country/city name here">
                        </div>
                        @error('countryCityName') <div class="col-sm-3"></div><div class="col-sm-9"><p style="color: red;">{{ $message }}</p></div> @enderror
                      </div>
                      <div class="form-group row">
                        <label for="flag" class="col-sm-3 col-form-label">Country Flag 
                                        @if($action == 'add')
                                        <span class="text-primary">*Must be filled</span>
                                        @endif
                                        @if($action == 'edit')
                                        <span class="text-primary">*Leave it empty if you don't want to change image</span>
                                        @endif</label>
                        <div class="col-sm-9">
                                    @if($action == 'edit')
                                      @if(($flagFilename!=null)&&($flagFilename!=''))
                                      <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                                          <button class="btn btn-sm btn-outline-success" wire:click.prevent="openFile('{{$flagFilename}}')"><font size="2pt">Download</font></button>
                                      </div>
                                      @endif
                                    @endif
                                    <input class="form-control" type="file" wire:model="flag" id="flag">
                        </div>
                        @error('flag') <div class="col-sm-3"></div><div class="col-sm-9"><p style="color: red;">{{ $message }}</p></div> @enderror
                      </div>
                      <div class="form-group row">
                        <label for="tourType" class="col-sm-3 col-form-label">Tour Type</label>
                        <div class="col-sm-9">
                            <select class="form-select text-black" id="tourType" wire:model="tourType">
                                <option {{ $tourType == '' ? 'readonly' : 'disabled'}} selected>== Choose tour type ==</option>
                                <option value="1">Domestic</option>
                                <option value="2">International</option>
                            </select>
                        </div>
                        @error('tourType') <div class="col-sm-3"></div><div class="col-sm-9"><p style="color: red;">{{ $message }}</p></div> @enderror
                      </div>
                      <div class="form-group row">
                        <label for="countryCategoryId" class="col-sm-3 col-form-label">Country Category</label>
                        <div class="col-sm-9">
                            <select class="form-select text-black" id="countryCategoryId" wire:model="countryCategoryId">
                                <option {{ $countryCategoryId == '' ? 'readonly' : 'disabled'}} selected>== Choose tour type ==</option>
                                @foreach($listCountryCategory as $val)
                                <option value="{{$val->id}}">{{$val->categoryName}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('countryCategoryId') <div class="col-sm-3"></div><div class="col-sm-9"><p style="color: red;">{{ $message }}</p></div> @enderror
                      </div>
                      <div class="form-group row">
                        <label for="isVisaRequirement" class="col-sm-3 col-form-label">Write Visa Requirement?</label>
                        <div class="col-sm-9">
                            <select class="form-select text-black" id="isVisaRequirement" wire:model="isVisaRequirement">
                                <option {{ $isVisaRequirement == '' ? 'readonly' : 'disabled'}} selected>== Choose the answer ==</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        @error('isVisaRequirement') <div class="col-sm-3"></div><div class="col-sm-9"><p style="color: red;">{{ $message }}</p></div> @enderror
                      </div>
                      <div class="form-group row">
                        <label for="freeVisaCountry" class="col-sm-3 col-form-label">Is Free Visa Country?</label>
                        <div class="col-sm-9">
                            <select class="form-select text-black" id="freeVisaCountry" wire:model="freeVisaCountry">
                                <option {{ $freeVisaCountry == '' ? 'readonly' : 'disabled'}} selected>== Choose the answer ==</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        @error('freeVisaCountry') <div class="col-sm-3"></div><div class="col-sm-9"><p style="color: red;">{{ $message }}</p></div> @enderror
                      </div>
                      @if($freeVisaCountry == 1)
                      <div class="form-group row">
                        <label for="aseanCountry" class="col-sm-3 col-form-label">&nbsp;&nbsp;&nbsp;Is ASEAN Country?</label>
                        <div class="col-sm-9">
                            <select class="form-select text-black" id="aseanCountry" wire:model="aseanCountry">
                                <option {{ $aseanCountry == '' ? 'readonly' : 'disabled'}} selected>== Choose the answer ==</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        @error('aseanCountry') <div class="col-sm-3"></div><div class="col-sm-9"><p style="color: red;">{{ $message }}</p></div> @enderror
                      </div>
                      <div class="form-group row">
                        <label for="longOfStay" class="col-sm-3 col-form-label">&nbsp;&nbsp;&nbsp;Long of Stay</label>
                        <div class="col-sm-9">
                          <input type="number" class="form-control text-black" id="longOfStay" wire:model="longOfStay" placeholder="Write long of stay (days) here">
                        </div>
                        @error('longOfStay') <div class="col-sm-3"></div><div class="col-sm-9"><p style="color: red;">{{ $message }}</p></div> @enderror
                      </div>
                      @endif
                      <div class="form-group row">
                        <label for="canNotProcessVisaCountry" class="col-sm-3 col-form-label">Is Can Not Process Visa Country?</label>
                        <div class="col-sm-9">
                            <select class="form-select text-black" id="canNotProcessVisaCountry" wire:model="canNotProcessVisaCountry">
                                <option {{ $canNotProcessVisaCountry == '' ? 'readonly' : 'disabled'}} selected>== Choose the answer ==</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        @error('canNotProcessVisaCountry') <div class="col-sm-3"></div><div class="col-sm-9"><p style="color: red;">{{ $message }}</p></div> @enderror
                      </div>
                      <div class="form-group row">
                        <label for="visaOnArrivalCountry" class="col-sm-3 col-form-label">Is Visa-On-Arrival Country?</label>
                        <div class="col-sm-9">
                            <select class="form-select text-black" id="visaOnArrivalCountry" wire:model="visaOnArrivalCountry">
                                <option {{ $visaOnArrivalCountry == '' ? 'readonly' : 'disabled'}} selected>== Choose the answer ==</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        @error('visaOnArrivalCountry') <div class="col-sm-3"></div><div class="col-sm-9"><p style="color: red;">{{ $message }}</p></div> @enderror
                      </div>
                      @if($visaOnArrivalCountry == 1)
                      <div class="form-group row">
                        <label for="typeVisaOnArrivalCountry" class="col-sm-3 col-form-label">&nbsp;&nbsp;&nbsp;Type of Visa-On-Arrival</label>
                        <div class="col-sm-9">
                            <select class="form-select text-black" id="typeVisaOnArrivalCountry" wire:model="typeVisaOnArrivalCountry">
                                <option {{ $typeVisaOnArrivalCountry == '' ? 'readonly' : 'disabled'}} selected>== Choose the answer ==</option>
                                <option value="1">Seaport</option>
                                <option value="2">Airport</option>
                            </select>
                        </div>
                        @error('typeVisaOnArrivalCountry') <div class="col-sm-3"></div><div class="col-sm-9"><p style="color: red;">{{ $message }}</p></div> @enderror
                      </div>
                      @endif
                      <div class="form-group row">
                        <label for="retirementVisaCountry" class="col-sm-3 col-form-label">Is Retirement Visa Country?</label>
                        <div class="col-sm-9">
                            <select class="form-select text-black" id="retirementVisaCountry" wire:model="retirementVisaCountry">
                                <option {{ $retirementVisaCountry == '' ? 'readonly' : 'disabled'}} selected>== Choose the answer ==</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        @error('retirementVisaCountry') <div class="col-sm-3"></div><div class="col-sm-9"><p style="color: red;">{{ $message }}</p></div> @enderror
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