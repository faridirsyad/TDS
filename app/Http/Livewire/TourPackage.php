<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Livewire\WithPagination;

class TourPackage extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $listTour, $slug, $listType, $listCountry, $listMonth, $listYear, $listTypes, $listFlight;
    public $flagPage, $pageSize, $fprice, $fcountry, $fdestination, $fmonth, $fyear, $fduration, $ftype, $fflight;

    public function mount($slug){
        $this->slug = $slug;
        $this->fprice = '';
        $this->fcountry = '';
        $this->fdestination = '';
        $this->fmonth = '';
        $this->fyear = '';
        $this->fduration = '';
        $this->ftype = '';
        $this->fflight = '';
    }

    public function render()
    {
        $this->listCountry = DB::table('tds_ref_country_city')
        ->when($this->fdestination == '0', function ($query) {
            return $query->where('countryCategoryId', '=', $this->fdestination);
        })
        ->when($this->fdestination == '1', function ($query) {
            return $query->where('countryCategoryId', '!=', '0');
        })
        ->get();
        $this->listMonth = DB::table('tds_ref_month')->select('*')->get();
        $this->listYear = DB::table('tds_tour')
        ->distinct()
        ->orderBy('tourPromotionYear', 'desc')
        ->get('tourPromotionYear');
        $this->listTypes = DB::table('tds_ref_tour_type')->get();
        $this->listFlight = DB::table('tds_ref_flight')->orderBy('flightName')->get();

        $listTour = DB::table('tds_tour')
        ->join('tds_ref_country_city','tds_tour.tourCountryCityId','=','tds_ref_country_city.id')
        ->join('tds_ref_flight','tds_tour.tourFlightId','=','tds_ref_flight.id')
        ->join('tds_ref_country_category','tds_ref_country_category.id','=','tds_ref_country_city.countryCategoryId')
        ->where('tds_ref_country_category.slug','=',$this->slug)
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
        $this->pageSize = 3;
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
}
