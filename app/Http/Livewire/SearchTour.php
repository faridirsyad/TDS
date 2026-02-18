<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class SearchTour extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshComponent' => '$refresh'];

    public $listTour, $listType, $listCountry, $listMonth, $listYear, $listTypes, $listFlight;
    public $flagPage, $pageSize, $fprice, $fcountry, $fdestination, $fmonth, $fyear, $fduration, $ftype, $fflight;
    public $fpricemin, $fpricemax, $sort, $sortBy, $segment, $lowest, $highest, $shortest, $longest;
    public $pricemin, $pricemax, $filter, $keyword;

    public function mount($keyword){
        $this->keyword = $keyword;
        $this->fpricemin = '';
        $this->fpricemax = '';
        $this->fcountry = '';
        $this->fdestination = '';
        $this->fmonth = '';
        $this->fyear = '';
        $this->fduration = '';
        $this->ftype = '';
        $this->fflight = '';
        $this->sortBy = '';
    }

    public function render(Request $request)
    { //tds_ref_tour_type
        $this->listCountry = DB::table('tds_ref_country_city')
        ->join('tds_tour','tds_tour.tourCountryCityId','=','tds_ref_country_city.id')
        ->when($this->fdestination == '0', function ($query) {
            return $query->where('tourType', '=', 1);
        })
        ->when($this->fdestination == '1', function ($query) {
            return $query->where('tourType', '=', 2);
        })
        ->get('tds_ref_country_city.*');
        $this->listMonth = DB::table('tds_ref_month')->select('*')->get();
        $this->listYear = DB::table('tds_tour')
        ->distinct()
        ->orderBy('tourPromotionYear', 'desc')
        ->get('tourPromotionYear');
        $this->listTypes = DB::table('tds_ref_tour_type')->get();
        $this->listFlight = DB::table('tds_ref_flight')
        ->join('tds_tour', 'tourFlightId','=','tds_ref_flight.id')
        ->orderBy('flightName')->get('tds_ref_flight.*');
        
        $listTour = DB::table('tds_tour')
            ->join('tds_ref_country_city','tds_tour.tourCountryCityId','=','tds_ref_country_city.id')
            ->join('tds_ref_flight','tds_tour.tourFlightId','=','tds_ref_flight.id')
            ->when($this->fpricemin != '', function ($query) {
                return $query->where('tourPrice', '>', $this->fpricemin);
            })
            ->when($this->fpricemax != '', function ($query) {
                return $query->where('tourPrice', '<', $this->fpricemax);
            })
            ->when($this->fdestination == "0", function ($query) {
                return $query->where('tds_ref_country_city.tourType', '=', 1);
            })
            ->when($this->fdestination == "1", function ($query) {
                return $query->where('tds_ref_country_city.tourType', '=', 2);
            })
            ->when($this->fcountry != "", function ($query) {
                return $query->where('tds_ref_country_city.id', '=', $this->fcountry);
            })
            ->when($this->fmonth != "", function ($query) {
                return $query->where('tourPromotionMonthId', '=', $this->fmonth);
            })
            ->when($this->fyear != "", function ($query) {
                return $query->where('tourPromotionYear', '=', $this->fyear);
            })
            ->when($this->fduration == "ten", function ($query) {
                return $query->where('tourLongOfStay', '<=', 10);
            })
            ->when($this->fduration == "more_ten", function ($query) {
                return $query->where('tourLongOfStay', '>', 10);
            })
            ->when($this->fflight != "", function ($query) {
                return $query->where('tourFlightId', '=', $this->fflight);
            })
            ->when($this->sortBy == 'lowest', function ($query) {
                return $query->orderBy('tourPrice', 'asc');
            })
            ->when($this->sortBy == 'highest', function ($query) {
                return $query->orderBy('tourPrice', 'desc');
            })
            ->when($this->sortBy == 'shortest', function ($query) {
                return $query->orderBy('tourLongOfStay', 'asc');
            })
            ->when($this->sortBy == 'longest', function ($query) {
                return $query->orderBy('tourLongOfStay', 'desc');
            })
            ->orderBy('tourPromotionYear','desc')
            ->orderBy('tourPromotionMonthId','desc')  
            ->orderBy('countryCityName')
            ->get(['countryCityName','tourTitle','tourLongOfStay','flightName','tourPrice','tourImage','tds_tour.slug']);

        // pagination : start
        $list = $listTour->toArray();
        // pagination parameter
        if($this->flagPage==true){
            $this->page = 1;
            $this->flagPage=false;
        }else{
            $this->page = Paginator::resolveCurrentPage('page');
        }
        $this->pageSize = 2;
        $offset = ($this->page * $this->pageSize) - $this->pageSize;
        // displayed data
        $itemsForCurPage = array_slice($list, $offset, $this->pageSize, true);
        $this->listTour = array_map(function($array){
            return (object)$array;
        }, $itemsForCurPage);
        // pagination
        $qData = new \Illuminate\Pagination\LengthAwarePaginator($itemsForCurPage, count($list), $this->pageSize, $this->page);
        // pagination : end
        
        return view('livewire.tour', compact('qData'))
        ->extends('layouts.app')
        ->section('content');
    }

    public function sortList(){
        $this->emit('refreshComponent');
        $this->resetPage();
    }

    public function filterList(){
        $this->emit('refreshComponent');
        $this->resetPage();
    }

}
