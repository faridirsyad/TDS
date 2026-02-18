<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\DB;

use Livewire\Component;

class DisplayVisaRequirement extends Component
{
    public $listCountryGroup, $listRequirement;

    public function render()
    {
        $this->listCountryGroup = DB::table('tds_ref_country_category')->where('id','!=',0)->get();
        $this->listRequirement = DB::table('tds_requirement')
        ->join('tds_ref_country_city','tds_requirement.countryCityId','!=','tds_ref_country_city.id')
        ->distinct()
        ->where('isVisaRequirement','=','1')
        ->orderBy('countryCityName')
        ->get(['tds_ref_country_city.countryCityName', 'tds_ref_country_city.countryFlag', 'countryCategoryId', 'tds_ref_country_city.slug']);

        return view('livewire.display-visa-requirement');
    }
}
