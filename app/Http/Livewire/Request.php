<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\RequestModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Livewire\WithPagination;

class Request extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $listRequest, $listMonth, $listYear;
    public $action, $no=1;
    public $flagPage, $pageSize, $fmonth, $fyear;

    public function render()
    {
        $this->listMonth = DB::table('tds_ref_month')->select('*')->get();

        $this->listYear = RequestModel::selectRaw('extract(year FROM tanggal) AS year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->get();

        $listRequest = RequestModel::select("*")
        ->when($this->fmonth != '', function ($query) {
            return $query->whereRaw('MONTH(tanggal) = '.$this->fmonth);
        })
        ->when($this->fyear != '', function ($query) {
            return $query->whereRaw('YEAR(tanggal) = '.$this->fyear);
        })
        ->get();

        // pagination : start
        $list = $listRequest->toArray();
        // pagination parameter
        if($this->flagPage==true){
            $this->page = 1;
            $this->flagPage=false;
        }else{
            $this->page = Paginator::resolveCurrentPage('page');
        }
        $this->pageSize = 10;
        $offset = ($this->page * $this->pageSize) - $this->pageSize;
        // displayed data
        $itemsForCurPage = array_slice($list, $offset, $this->pageSize, true);
        $this->listRequest = array_map(function($array){
            return (object)$array;
        }, $itemsForCurPage);
        // pagination
        $qData = new \Illuminate\Pagination\LengthAwarePaginator($itemsForCurPage, count($list), $this->pageSize, $this->page);
        // pagination : end

        return view('livewire.request', compact('qData'))
        ->layout('layouts.app-admin');
    }
}
