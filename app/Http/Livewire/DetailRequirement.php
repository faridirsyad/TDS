<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class DetailRequirement extends Component
{
    public $slug, $detail;

    public function mount($slug){
        $this->slug = $slug;
    }

    public function render()
    {
        $this->detail = DB::table('tds_requirement')
        ->join('tds_ref_country_city', 'tds_ref_country_city.id', '=', 'tds_requirement.countryCityId')
        ->where('slug','=',$this->slug)
        ->get(['tds_requirement.*','tds_ref_country_city.countryCityName']);

        return view('livewire.detail-requirement')
        ->extends('layouts.app')
        ->section('content');
    }
}
