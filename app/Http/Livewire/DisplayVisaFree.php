<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class DisplayVisaFree extends Component
{
    public $listFreeAsean, $listFreeNonAsean;

    public function render()
    {
        $this->listFreeAsean = DB::table('tds_ref_country_city')
        ->where('isFreeVisa','=','1')
        ->where('isAsean','=','1')
        ->orderBy('countryCityName')
        ->get(['countryCityName', 'longOfStay']);

        $this->listFreeNonAsean = DB::table('tds_ref_country_city')
        ->where('isFreeVisa','=','1')
        ->where('isAsean','!=','1')
        ->orderBy('countryCityName')
        ->get(['countryCityName', 'longOfStay']);

        return view('livewire.display-visa-free');
    }
}
