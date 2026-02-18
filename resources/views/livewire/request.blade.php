<div>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Permintaan Informasi</h4>
            
            <div class="row">
                <div class="col-md-3">
                    <label for="fmonth" class="col-form-label">Month:</label>
                    <select class="form-select text-black" id="fmonth" wire:model="fmonth">
                    <option value='' {{ $fmonth == '' ? 'selected' : ''}} selected>All months</option>
                    @foreach($listMonth as $val)
                        <option value="{{$val->id}}" {{ $fmonth == $val->id ? 'selected' : ''}}>{{$val->monthName}}</option>
                    @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="fyear" class="col-form-label">Year:</label>
                    <select class="form-select text-black" id="fyear" wire:model="fyear">
                    <option value='' {{ $fyear == '' ? 'selected' : ''}} selected>All years</option>
                    @foreach($listYear as $val)
                        <option value="{{$val->year}}" {{ $fyear == $val->year ? 'selected' : ''}}>{{$val->year}}</option>
                    @endforeach
                    </select>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-start">Tanggal</th>
                            <th class="text-start">Customer Name</th>
                            <th class="text-start">Email</th>
                            <th class="text-start">Phone</th>
                            <th class="text-start">Question</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(($listRequest!=null)&&(count($listRequest)>0))
                            @foreach($listRequest as $val)
                                <tr>
                                    <td class="text-center">{{ ($page-1) * $pageSize + $loop->index + 1 }}</td>
                                    <td>{{ $val->tanggal }}</td>
                                    <td>{{ $val->customerName }}</td>
                                    <td>{{ $val->alamatEmail }}</td>
                                    <td>{{ $val->nomorTelepon }}</td>
                                    <td style="word-wrap: break-word;">{{ $val->pertanyaan }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr><td class="text-center" colspan="5">No Data</td></tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div><br>{!! $qData !!}</div>
        </div>
    </div>
</div>