<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisaIndex extends Component
{
    public $listCountry;

    public function render(Request $request)
    {
        $segment = $request->segment(1);
        if($segment=='visa-index-b211'){
            return view('livewire.visa-index-b211');
        }else if($segment=='visa-index-b213'){
            return view('livewire.visa-index-b213');
        }else if($segment=='visa-index-c312'){
            return view('livewire.visa-index-c312');
        }else if($segment=='visa-index-c3134'){
            return view('livewire.visa-index-c3134');
        }else if($segment=='visa-index-c317'){
            return view('livewire.visa-index-c317');
        }else if($segment=='visa-index-c318'){
            return view('livewire.visa-index-c318');
        }else if($segment=='visa-index-c319'){
            $this->listCountry = DB::table('tds_ref_country_city')
            ->where('isRetirementVisa','=','1')
            ->orderBy('countryCityName')
            ->get(['countryCityName']);

            return view('livewire.visa-index-c319');
        }else if($segment=='visa-index-d212'){
            return view('livewire.visa-index-d212');
        }else if($segment=='visa-index-epo'){
            return view('livewire.visa-index-epo');
        }else{
            $this->redirect(url('/indonesian-visa'));
        }
    }
}
