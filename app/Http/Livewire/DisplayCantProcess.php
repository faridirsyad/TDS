<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class DisplayCantProcess extends Component
{
    public $listCantProcess;
    public function render()
    {
        $this->listCantProcess = DB::table('tds_ref_country_city')
        ->where('isCanNotProcessVisa','=','1')
        ->orderBy('countryCityName')
        ->get('countryCityName');

        return view('livewire.display-cant-process');
    }
}
