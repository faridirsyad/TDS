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
                            <option value="">All country</option>
                            @foreach($listCountry as $val)
                                <option value="{{$val->id}}">
                                    {{$val->countryCityName}} - {{$val->categoryName}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif

            @if($action != 'add')
                <div style="text-align: right;"><br>
                    <button class="btn btn-primary" wire:click="open('add')">Add Data</button>
                </div>
            @endif

            @if($action == '')
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Country Name</th>
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
                                    <td>{{$val->categoryName}}</td>
                                    <td>{!! substr($val->countryEmbassyAddress,0,35) !!}</td>
                                    <td>{!! substr($val->countryRequirement,0,35) !!}</td>
                                    <td>{!! substr($val->countryCautions,0,35) !!}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning me-2" wire:click="edit({{$val->id}})">Edit</button>
                                        <button type="button" class="btn btn-danger me-2" wire:click="delete({{$val->id}})" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr><td class="text-center" colspan="7">No Data</td></tr>
                        @endif
                        </tbody>
                    </table>
                </div>

                <div><br>{!! $qData !!}</div>
            @else

                <form class="forms-sample" wire:submit.prevent="{{ ($action=='add') ? 'addData' : 'editData' }}">
                    @csrf

                    <input type="hidden" id="requirementId" wire:model="requirementId">

                    <div class="form-group row">
                        <label for="country" class="col-sm-3 col-form-label">Country Name</label>
                        <div class="col-sm-9">
                            <select class="form-select text-black" id="country" wire:model="country">
                                <option value="">== Choose country ==</option>
                                @foreach($listCountry as $val)
                                    <option value="{{ $val->id }}">
                                        {{ $val->countryCityName }} - {{ $val->categoryName }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('country')
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9"><p style="color:red;">{{ $message }}</p></div>
                        @enderror
                    </div>

                    {{-- Embassy Address --}}
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Embassy Address</label>
                        <div class="col-sm-9">
                            {{-- hidden input harus di luar wire:ignore --}}
                            <input id="addressContent" type="hidden" wire:model.defer="address">
                            <div wire:ignore>
                                <trix-editor input="addressContent" class="formatted-content"></trix-editor>
                            </div>
                        </div>
                        @error('address')
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9"><p style="color:red;">{{ $message }}</p></div>
                        @enderror
                    </div>

                    {{-- Visa Requirement --}}
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Visa Requirement</label>
                        <div class="col-sm-9">
                            <input id="requirementContent" type="hidden" wire:model.defer="requirement">
                            <div wire:ignore>
                                <trix-editor input="requirementContent" class="formatted-content"></trix-editor>
                            </div>
                        </div>
                        @error('requirement')
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9"><p style="color:red;">{{ $message }}</p></div>
                        @enderror
                    </div>

                    {{-- Visa Cautions --}}
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Visa Cautions</label>
                        <div class="col-sm-9">
                            <input id="cautionsContent" type="hidden" wire:model.defer="cautions">
                            <div wire:ignore>
                                <trix-editor input="cautionsContent" class="formatted-content"></trix-editor>
                            </div>
                        </div>
                        @error('cautions')
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9"><p style="color:red;">{{ $message }}</p></div>
                        @enderror
                    </div>

                    @if($action=='add')
                        <button type="submit" class="btn btn-primary me-2">Add</button>
                    @else
                        <button type="submit" class="btn btn-warning me-2">Edit</button>
                    @endif

                    <button type="button" class="btn btn-light" wire:click="back">Cancel</button>
                </form>
            @endif
        </div>
    </div>

    <script>
    // tiap perubahan di Trix -> trigger input untuk Livewire
    document.addEventListener('trix-change', function (e) {
        const inputId = e.target.getAttribute('input');
        if (!inputId) return;

        const hiddenInput = document.getElementById(inputId);
        if (!hiddenInput) return;

        hiddenInput.dispatchEvent(new Event('input', { bubbles: true }));
    });

    // helper: set value ke hidden input + paksa Trix render ulang
    function setTrixValue(inputId, html) {
        const hiddenInput = document.getElementById(inputId);
        if (!hiddenInput) return;

        const value = html ?? '';

        // update hidden input (untuk Livewire)
        hiddenInput.value = value;
        hiddenInput.dispatchEvent(new Event('input', { bubbles: true }));

        // Data Tampil Saat Edit
        const trix = document.querySelector(`trix-editor[input="${inputId}"]`);
        if (trix && trix.editor) {
        trix.editor.loadHTML(value);
        }
    }

    // event dari Livewire untuk set nilai saat open add / edit
    window.addEventListener('trix-set-values', (e) => {
        const d = e.detail || {};

        // kasih delay dikit supaya trix-editor sudah siap (penting!)
        setTimeout(() => {
        setTrixValue('addressContent', d.address);
        setTrixValue('requirementContent', d.requirement);
        setTrixValue('cautionsContent', d.cautions);
        }, 0);
    });
    </script>

</div>
