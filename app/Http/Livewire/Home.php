<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Home extends Component
{
    public $settingHomepage, $listPromo, $listFavourite, $listRecommendation, $listTour, $listPartner, $listTestimony, $listCarousel, $isMobile;

    public function render()
    {
        $this->settingHomepage = DB::table('tds_homepage')->get()->toArray();
        $this->listPromo = DB::table('tds_promo')
        ->where('isDisplayed','=','1')
        ->orderBy('id','desc')
        ->offset(0)->limit(3)
        ->get();
        $this->listFavourite = DB::table('tds_tour')->where('isDisplayFavourite','=','1')
        ->orderBy('tourPromotionYear','desc')
        ->orderBy('tourPromotionMonthId','desc')
        ->offset(0)->limit(3)
        ->get();
        $this->listRecommendation = DB::table('tds_tour')
        ->join('tds_ref_country_city','tds_ref_country_city.id','=','tds_tour.tourCountryCityId')
        ->where('isDisplayRecommendation','=','1')
        ->orderBy('tourPromotionYear','desc')
        ->orderBy('tourPromotionMonthId','desc')        
        ->offset(0)->limit(4)
        ->get(['tds_tour.*','tds_ref_country_city.countryCityName'])->toArray();
        $this->listTour = DB::table('tds_tour')
        ->selectRaw('count(tds_tour.id) as cntTour, categoryName, image, tds_ref_country_category.slug')
        ->join('tds_ref_country_city','tds_ref_country_city.id','=','tds_tour.tourCountryCityId')
        ->join('tds_ref_country_category','tds_ref_country_category.id','=','tds_ref_country_city.countryCategoryId')
        ->groupBy('tds_ref_country_city.countryCategoryId','categoryName','image','tds_ref_country_category.slug')
        ->get();
        $this->listPartner = DB::table('tds_partner')->get();
        $this->listTestimony = DB::table('tds_testimoni')->get();
        $this->listCarousel = DB::table('tds_carousel')->get();
        
        return view('livewire.home')
        ->extends('layouts.app',['listCarousel'=>$this->listCarousel])
        ->section('content');
    }
}
