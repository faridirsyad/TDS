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
            <h4 class="card-title">Setting Testimony</h4>
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
            <label for="fname" class="col-form-label">Customer Name:</label>
            <input type="text" class="form-control text-black" id="fname" wire:model="fname" placeholder="Write customer name here">
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
                             <th class="text-start">Customer Name</th>
                             <th class="text-start">Testimony</th>
                             <th class="text-start">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @if(($listTesti!=null)&&(count($listTesti)>0))
                           @foreach($listTesti as $val)
                            <tr>
                            <td class="text-center">{{ ($page-1) * $pageSize + $loop->index + 1 }}</td>
                            <td>{{$val->testimoniCustomerName}}</td>
                            <td>{!! substr($val->testimoniContent,0,35) !!}</td>
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
                        <label for="name" class="col-sm-3 col-form-label">Customer name</label>
                        <div class="col-sm-9"><input type="text" class="form-control text-black" id="name" wire:model="name" placeholder="Write customer name here">
                        </div>
                        @error('name') <div class="col-sm-3"></div><div class="col-sm-9"><p style="color: red;">{{ $message }}</p></div> @enderror
                      </div>
                      <div class="form-group row">
                        <label for="content" class="col-sm-3 col-form-label">Testimony</label>
                        <div class="col-sm-9 form-floating" wire:ignore>
                          {{-- <textarea class="form-control" placeholder="Write testimony here" id="content" wire:model="content" style="height: 125px">{{$content}}</textarea> --}}
                          <trix-editor
                              class="formatted-content"
                              x-data
                              x-on:trix-change="$dispatch('input', event.target.value)"
                              x-ref="trix"
                              wire:model.debounce.60s="content"
                              wire:key="uniqueKeyContent"
                          ></trix-editor>
                        </div>
                        <input
                            id="contentContent"
                            type="hidden"
                            wire:model="content"
                        >
                        @error('content') <div class="col-sm-3"></div><div class="col-sm-9"><p style="color: red;">{{ $message }}</p></div> @enderror
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