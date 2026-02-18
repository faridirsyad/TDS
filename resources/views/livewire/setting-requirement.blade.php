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
            <h4 class="card-title">Setting Visa Requirement</h4>
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
          <div class="col-md-3">
            <label for="fcountry" class="col-form-label">Country:</label>
            <select class="form-select text-black" id="fcountry" wire:model="fcountry">
              <option value='' {{ $fcountry == '' ? 'selected' : ''}} selected>All country</option>
              @foreach($listCountry as $val)
                <option value="{{$val->id}}" {{ $fcountry == $val->id ? 'selected' : ''}}>{{$val->countryCityName}} - {{$val->categoryName}}</option>
              @endforeach
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
                             <th class="text-center">Country Name</th>
                             {{-- <th class="text-center">Country Flag</th> --}}
                             <th class="text-center">Country Category</th>
                             <th class="text-center">Embassy Address</th>
                             <th class="text-center">Visa Requirement</th> 
                             <th class="text-center">Visa Cautions</th>
                             <th class="text-center">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @if(($listRequirement!=null)&&(count($listRequirement)>0))
                           @foreach($listRequirement as $val)
                            <tr>
                            <td class="text-center">{{ ($page-1) * $pageSize + $loop->index + 1 }}</td>
                            <td>{{$val->countryCityName}}</td>
                            {{-- <td><img src="{{ asset('storage/images/'.$val->countryFlag) }}" wire:click.prevent="openFile('{{$val->countryFlag}}')"></td> --}}
                            <td>{{$val->categoryName}}</td>
                            <td>{!! substr($val->countryEmbassyAddress,0,35) !!}</td>
                            <td>{!! substr($val->countryRequirement,0,35) !!}</td>
                            <td>{!! substr($val->countryCautions,0,35) !!}</td>
                            <td>
                                <button type="button" class="btn btn-warning me-2" wire:click="edit({{$val->id}})">Edit</button>
                                <button type="button" class="btn btn-danger me-2" wire:click="delete({{$val->id}})" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button></td></tr>
                            @endforeach
                          @else
                          <tr><td class="text-center" colspan="8">No Data</td></tr>
                          @endif
                        </tbody>
                      </table>
                    </div>
                    <div><br>{!! $qData !!}</div>
        @else
                    <form class="forms-sample" wire:submit.prevent="{{ ($action=='add')?'addData':'editData'}}">
                    @csrf
                      <input type="hidden" id="requirementId" wire:model="requirementId">
                      <div class="form-group row">
                        <label for="country" class="col-sm-3 col-form-label">Country Name</label>
                        <div class="col-sm-9">
                            <select class="form-select text-black" id="country" wire:model="country">
                                <option {{ $country == '' ? 'readonly' : 'disabled'}} selected>== Choose country ==</option>
                                @foreach($listCountry as $val)
                                <option value="{{$val->id}}">{{$val->countryCityName}} - {{$val->categoryName}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('country') <div class="col-sm-3"></div><div class="col-sm-9"><p style="color: red;">{{ $message }}</p></div> @enderror
                      </div>
                      {{-- <div class="form-group row">
                        <label for="flag" class="col-sm-3 col-form-label">Country Flag 
                                        @if($action == 'add')
                                        <span class="text-primary">*Must be filled</span>
                                        @endif
                                        @if($action == 'edit')
                                        <span class="text-primary">*Leave it empty if you don't want to change image</span>
                                        @endif</label>
                        <div class="col-sm-9">
                                    @if($action == 'edit')
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                                        <button class="btn btn-sm btn-outline-success" wire:click.prevent="openFile('{{$flag}}')"><font size="2pt">Download</font></button>
                                    </div>
                                    @endif
                                    <input class="form-control" type="file" wire:model="flag" id="flag">
                        </div>
                        @error('flag') <div class="col-sm-3"></div><div class="col-sm-9"><p style="color: red;">{{ $message }}</p></div> @enderror
                      </div> --}}
                      <div class="form-group row">
                        <label for="address" class="col-sm-3 col-form-label">Embassy Address</label>
                        <div class="col-sm-9 form-floating" wire:ignore>
                          {{-- <textarea class="form-control" placeholder="Write embassy address here" id="address" wire:model="address" style="height: 125px">{{$address}}</textarea>
                          <trix-editor input="address"></trix-editor> --}}
                          <trix-editor
                              class="formatted-content"
                              x-data
                              x-on:trix-change="$dispatch('input', event.target.value)"
                              x-ref="trix"
                              wire:model.debounce.60s="address"
                              wire:key="uniqueKeyAddress"
                          ></trix-editor>
                        </div>
                        <input
                            id="addressContent"
                            type="hidden"
                            wire:model="address"
                        >
                        {{-- <input id="x" wire.model="editing.description" type="hidden"> --}}
	                      
                        @error('address') <div class="col-sm-3"></div><div class="col-sm-9"><p style="color: red;">{{ $message }}</p></div> @enderror
                      </div>
                      <div class="form-group row">
                        <label for="requirement" class="col-sm-3 col-form-label">Visa Requirement</label>
                        <div class="col-sm-9 form-floating">
                          {{-- <textarea class="form-control" placeholder="Write visa requirement here" id="requirement" wire:model="requirement" style="height: 125px">{{$requirement}}</textarea> --}}
                          <trix-editor
                              class="formatted-content"
                              x-data
                              x-on:trix-change="$dispatch('input', event.target.value)"
                              x-ref="trix"
                              wire:model.debounce.60s="requirement"
                              wire:key="uniqueKeyRequirement"
                          ></trix-editor>
                        </div>
                        <input
                            id="requirementContent"
                            type="hidden"
                            wire:model="requirement"
                        >
                        @error('requirement') <div class="col-sm-3"></div><div class="col-sm-9"><p style="color: red;">{{ $message }}</p></div> @enderror
                      </div>
                      <div class="form-group row">
                        <label for="cautions" class="col-sm-3 col-form-label">Visa Cautions</label>
                        <div class="col-sm-9 form-floating" wire:ignore>
                          {{-- <textarea class="form-control" placeholder="Write visa cautions here" id="cautions" wire:model="cautions" style="height: 125px">{{$cautions}}</textarea> --}}
                          <trix-editor
                              class="formatted-content"
                              x-data
                              x-on:trix-change="$dispatch('input', event.target.value)"
                              x-ref="trix"
                              wire:model.debounce.60s="cautions"
                              wire:key="uniqueKeyCautions"
                          ></trix-editor>
                        </div>
                        <input
                            id="cautionsContent"
                            type="hidden"
                            wire:model="cautions"
                        >
                        @error('cautions') <div class="col-sm-3"></div><div class="col-sm-9"><p style="color: red;">{{ $message }}</p></div> @enderror
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