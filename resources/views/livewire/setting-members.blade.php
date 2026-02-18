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
            <h4 class="card-title">Setting Partner</h4>
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
            <label for="fname" class="col-form-label">Partner Name:</label>
            <input type="text" class="form-control text-black" id="fname" wire:model="fname" placeholder="Write partner name here">
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
                             <th class="text-start">Partner Name</th>
                             <th class="text-start">Partner Image</th>
                             <th class="text-start">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @if(($listPartner!=null)&&(count($listPartner)>0))
                           @foreach($listPartner as $val)
                            <tr>
                            <td class="text-center">{{ ($page-1) * $pageSize + $loop->index + 1 }}</td>
                            <td>{{$val->partnerName}}</td>
                            <td><img src="{{ asset('storage/app/public/partner/'.$val->partnerImage) }}" wire:click.prevent="openFile('{{$val->partnerImage}}')"></td>
                            <td>
                                <button type="button" class="btn btn-warning me-2" wire:click="edit({{$val->id}})">Edit</button>
                                <button type="button" class="btn btn-danger me-2" wire:click="delete({{$val->id}})" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button></td></tr>
                            @endforeach
                          @else
                          <tr><td class="text-center" colspan="4">No Data</td></tr>
                          @endif
                        </tbody>
                      </table>
                    </div>
                    <div><br>{!! $qData !!}</div>
        @else
                    <form class="forms-sample" wire:submit.prevent="{{ ($action=='add')?'addData':'editData'}}">
                    @csrf
                      <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Partner Name</label>
                        <div class="col-sm-9"><input type="text" class="form-control text-black" id="name" wire:model="name" placeholder="Write partner name here">
                        </div>
                        @error('name') <div class="col-sm-3"></div><div class="col-sm-9"><p style="color: red;">{{ $message }}</p></div> @enderror
                      </div>
                      <div class="form-group row">
                        <label for="flag" class="col-sm-3 col-form-label">Partner Image 
                                        @if($action == 'add')
                                        <span class="text-primary">*Must be filled</span>
                                        @endif
                                        @if($action == 'edit')
                                        <span class="text-primary">*Leave it empty if you don't want to change image</span>
                                        @endif</label>
                        <div class="col-sm-9">
                                    @if($action == 'edit')
                                      @if(($imageFilename!=null)&&($imageFilename!=''))
                                      <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                                          <button class="btn btn-sm btn-outline-success" wire:click.prevent="openFile('{{$imageFilename}}')"><font size="2pt">Download</font></button>
                                      </div>
                                      @endif
                                    @endif
                                    <input class="form-control" type="file" wire:model="image" id="image">
                        </div>
                        @error('image') <div class="col-sm-3"></div><div class="col-sm-9"><p style="color: red;">{{ $message }}</p></div> @enderror
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