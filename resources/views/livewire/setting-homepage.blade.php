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
            <h4 class="card-title">Setting Homepage</h4>
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
        @if($action != 'add')
        {{-- <div style="text-align: right;"><button class="btn btn-primary" wire:click="open('add')">Add Data</button></div> --}}
        @endif
        @if($action == '')
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                             <th class="text-center">No</th>
                             <th class="text-start">Menu</th>
                             <th class="text-start">Alias</th>
                             <th class="text-start">Is Menu Displayed in Homepage?</th>
                             <th class="text-start">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @if(($listMenuHomepage!=null)&&(count($listMenuHomepage)>0))
                           @foreach($listMenuHomepage as $val)
                            <tr>
                            <td class="text-center">{{$no++}}</td>
                            <td>{{ $val->homepageMenu }}</td>
                            <td>{{ $val->homepageAlias }}</td>
                            <td>
                                @if($val->isDisplayed=="1")
                                Yes
                                @elseif($val->isDisplayed=="0")
                                No
                                @else
                                Not Set
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-warning me-2" wire:click="edit({{$val->id}})">Edit</button>
                                {{-- <button type="button" class="btn btn-danger me-2" wire:click="delete({{$val->id}})" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button> --}}
                            </td>
                            </tr>
                            @endforeach
                          @else
                          <tr><td class="text-center" colspan="5">No Data</td></tr>
                          @endif
                        </tbody>
                      </table>
                    </div>
        @else
                    <form class="forms-sample" wire:submit.prevent="{{ ($action=='add')?'addData':'editData'}}">
                    @csrf
                      <div class="form-group row">
                        <label for="menu" class="col-sm-3 col-form-label">Menu</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control text-black" id="menu" wire:model="menu" placeholder="Write menu name here">
                        </div>
                        @error('menu') <div class="col-sm-3"></div><div class="col-sm-9"><p style="color: red;">{{ $message }}</p></div> @enderror
                      </div>
                      <div class="form-group row">
                        <label for="alias" class="col-sm-3 col-form-label">Alias</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control text-black" id="alias" wire:model="alias" placeholder="Write alias name here" {{ $action == 'edit' ? 'disabled' : ''}} >
                        </div>
                        @error('alias') <div class="col-sm-3"></div><div class="col-sm-9"><p style="color: red;">{{ $message }}</p></div> @enderror
                      </div>
                      <div class="form-group row">
                        <label for="isDisplayed" class="col-sm-3 col-form-label">Is Menu Displayed in Homepage?</label>
                        <div class="col-sm-9">
                            <select class="form-select text-black" id="isDisplayed" wire:model="isDisplayed">
                                <option {{ $isDisplayed == '' ? 'readonly' : 'disabled'}} selected>== Choose the answer ==</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        @error('isDisplayed') <div class="col-sm-3"></div><div class="col-sm-9"><p style="color: red;">{{ $message }}</p></div> @enderror
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