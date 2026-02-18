<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Livewire\WithPagination;

class BestDeal extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $promo;
    public $flagPage, $pageSize;

    public function render()
    {
        $promo = DB::table('tds_promo')
        ->orderBy('id','desc')
        ->get();

        // pagination : start
        $list = $promo->toArray();
        // pagination parameter
        if($this->flagPage==true){
            $this->page = 1;
            $this->flagPage=false;
        }else{
            $this->page = Paginator::resolveCurrentPage('page');
        }
        $this->pageSize = 5;
        $offset = ($this->page * $this->pageSize) - $this->pageSize;
        // displayed data
        $itemsForCurPage = array_slice($list, $offset, $this->pageSize, true);
        $this->promo = array_map(function($array){
            return (object)$array;
        }, $itemsForCurPage);
        // pagination
        $qData = new \Illuminate\Pagination\LengthAwarePaginator($itemsForCurPage, count($list), $this->pageSize, $this->page);
        // pagination : end

        return view('livewire.best-deal', compact('qData'))
        ->extends('layouts.app')
        ->section('content');
    }
}
