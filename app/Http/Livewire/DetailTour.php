<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class DetailTour extends Component
{
    public $slug, $detail;
    public $name, $email, $phone, $about;

    protected $listeners = [
        'refresh-component' => '$refresh'
    ];

    public function mount($slug){
        $this->slug = $slug;
    }

    public function render()
    {
        $this->detail = DB::table('tds_tour')
        ->join('tds_ref_country_city', 'tds_ref_country_city.id', '=', 'tds_tour.tourCountryCityId')
        ->join('tds_ref_flight', 'tds_ref_flight.id', '=', 'tds_tour.tourFlightId')
        ->where('tds_tour.slug','=',$this->slug)
        ->get(['tds_tour.*','tds_ref_country_city.countryCityName','tds_ref_flight.flightName']);

        return view('livewire.detail-tour')
        ->extends('layouts.app')
        ->section('content');
    }

    public function saveInformation(){
        $this->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'about' => 'required'
        ]);
        
        $data = [
            'tanggal' => Carbon::now()->format('Y-m-d'),
            'customerName' => $this->name,
            'alamatEmail' => $this->email,
            'nomorTelepon' => $this->phone,
            'pertanyaan' => $this->about,
            'created_at'   => Carbon::now(),
            'updated_at'   => Carbon::now(),
        ];
        // DB::table('tds_pertanyaan')->insert($data);
    }

    public function resetFields($tour){
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->about = 'Detail information and best deal of '.$tour;
        $this->emit('refresh-component');
        $this->resetErrorBag();
    }
}
