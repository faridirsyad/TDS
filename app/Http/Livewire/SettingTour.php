<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\SettingTourModel;
use App\Models\SettingCountryModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class SettingTour extends Component
{
    use WithFileUploads;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $title, $country, $month, $year, $longOfStay, $flight, $price, $type, $qType, $include, $exclude, $description, $pricelist, $activities, $termcondition, $isDisplayRecommendation, $isDisplayFavourite, $tourImage, $tourImageName;
    public $listCountry, $listMonth, $listYear, $listFlight, $listType, $listTour, $action, $no=1, $tourId;
    public $flagPage, $pageSize, $ftitle, $fdestination, $ftype, $fmonth, $fyear;

    public function mount(){
        $this->title = '';
        $this->country = '';
        $this->month = Carbon::now()->format('n');
        $this->year = Carbon::now()->format('Y');
        $this->longOfStay = '';
        $this->flight = '';
        $this->price = '';
        $this->type = '';
        $this->include = '';
        $this->exclude = '';
        $this->description = '';
        $this->pricelist = '';
        $this->activities = '';
        $this->termcondition = '';
        $this->isDisplayRecommendation = '';
        $this->isDisplayFavourite = '';
        $this->tourImage = '';
        $this->tourImageName = null;
        $this->ftitle = "";
        $this->fdestination = "";
        $this->ftype = "";
        $this->fmonth = '';
        $this->fyear = Carbon::now()->format('Y');
    }

    public function render()
    {
        $this->listCountry = SettingCountryModel::join('tds_ref_country_category','tds_ref_country_city.countryCategoryId','=','tds_ref_country_category.id')
        ->orderBy('tds_ref_country_category.id')
        ->get(['tds_ref_country_city.id','countryCityName','categoryName']);
        $this->listMonth = DB::table('tds_ref_month')->select('*')->get();
        $this->listYear = DB::table('tds_tour')
        ->distinct()
        ->orderBy('tourPromotionYear', 'desc')
        ->get('tourPromotionYear');
        $this->listFlight = DB::table('tds_ref_flight')->select('*')->orderBy('flightName')->get();
        $this->listType = DB::table('tds_ref_tour_type')->select('*')->get();
        $listTour = SettingTourModel::join('tds_ref_country_city', 'tds_ref_country_city.id', '=', 'tds_tour.tourCountryCityId')
        ->join('tds_ref_month', 'tds_ref_month.id', '=', 'tds_tour.tourPromotionMonthId')
        ->join('tds_ref_flight', 'tds_ref_flight.id', '=', 'tds_tour.tourFlightId')
        ->join('tds_ref_tour_type', 'tds_ref_tour_type.id', '=', 'tds_tour.tourType')
        ->when($this->ftitle != "", function ($query) {
            return $query->where('tourTitle', 'like', '%'.$this->ftitle.'%');
        })
        ->when($this->fdestination != "", function ($query) {
            return $query->where('tourCountryCityId', '=', $this->fdestination);
        })
        ->when($this->ftype != "", function ($query) {
            return $query->where('tds_tour.tourType', '=', $this->ftype);
        })
        ->when($this->fmonth != "", function ($query) {
            return $query->where('tourPromotionMonthId', '=', $this->fmonth);
        })
        ->when($this->fyear != "", function ($query) {
            return $query->where('tourPromotionYear', '=', $this->fyear);
        })
        ->get(['tds_tour.*','tds_ref_country_city.countryCityName','tds_ref_month.monthName','tds_ref_flight.flightName','tds_ref_tour_type.tourTypeName']);

        // pagination : start
        $list = $listTour->toArray();
        // pagination parameter
        if($this->flagPage==true){
            $this->page = 1;
            $this->flagPage=false;
        }else{
            $this->page = Paginator::resolveCurrentPage('page');
        }
        $this->pageSize = 10;
        $offset = ($this->page * $this->pageSize) - $this->pageSize;
        // displayed data
        $itemsForCurPage = array_slice($list, $offset, $this->pageSize, true);
        $this->listTour = array_map(function($array){
            return (object)$array;
        }, $itemsForCurPage);
        // pagination
        $qData = new \Illuminate\Pagination\LengthAwarePaginator($itemsForCurPage, count($list), $this->pageSize, $this->page);
        // pagination : end
        
        return view('livewire.setting-tour', compact('qData'))
        ->layout('layouts.app-admin');
    }

    public function open($act){
        $this->action = $act;
        $this->title = '';
        $this->country = '';
        $this->month = Carbon::now()->format('n');
        $this->year = Carbon::now()->format('Y');
        $this->longOfStay = '';
        $this->flight = '';
        $this->price = '';
        $this->type = '';
        $this->include = '';
        $this->exclude = '';
        $this->description = '';
        $this->pricelist = '';
        $this->activities = '';
        $this->termcondition = '';
        $this->isDisplayRecommendation = '';
        $this->isDisplayFavourite = '';
        $this->tourImage = '';
        $this->tourImageName = null;
    }

    public function addData(){
        $this->validate([
            'title' => 'required',
            'country' => 'required',
            'month' => 'required',
            'year' => 'required',
            'longOfStay' => 'required',
            'flight' => 'required',
            'price' => 'required',
            'type' => 'required',
            'include' => 'required',
            'exclude' => 'nullable',
            'description' => 'required',
            'pricelist' => 'nullable',
            'activities' => 'nullable',
            'termcondition' => 'nullable',
            'isDisplayRecommendation' => 'nullable',
            'isDisplayFavourite' => 'nullable',
            'tourImage' => 'required|image|max:512',
        ]);
        try {
            if($this->tourImage->getClientOriginalName() != null){
                $tourImage   = $this->tourImage->getClientOriginalName();
                $this->tourImage->storeAs(path: 'public/tour', name: $tourImage);
            }else{
                $tourImage = null;
            }

            $dataInput = [
                'tourTitle' => $this->title,
                'tourCountryCityId' => $this->country,
                'tourPromotionMonthId' => $this->month,
                'tourPromotionYear' => $this->year,
                'tourLongOfStay' => $this->longOfStay,
                'tourFlightId' => $this->flight,
                'tourPrice' => $this->price,
                'tourType' => $this->type,
                'tourInclude' => $this->include,
                'tourExclude' => $this->exclude,
                'tourDescription' => $this->description,
                'tourPricelist' => $this->pricelist,
                'tourAddActivities' => $this->activities,
                'tourTermCondition' => $this->termcondition,
                'tourImage' => $tourImage,
                'isDisplayRecommendation' => $this->isDisplayRecommendation,
                'isDisplayFavourite' => $this->isDisplayFavourite,
                'created_at'   => Carbon::now()->format('Y-m-d'),
                'updated_at'   => Carbon::now()->format('Y-m-d'),
            ];
            $dataInput['slug'] = Str::slug($this->title, '-');

            SettingTourModel::create($dataInput);
            //redirect
            return redirect(url('/setting-tour'))->with(['success' => 'Tour/package successfully inserted.']);
        } catch (\Exception $ex) {
            return redirect(url('/setting-tour'))->with(['error' => 'Something goes wrong!!']);
        }
    }   
    
    public function resetFields(){
        $this->action = '';
        $this->title = '';
        $this->country = '';
        $this->month = Carbon::now()->format('n');
        $this->year = Carbon::now()->format('Y');
        $this->longOfStay = '';
        $this->flight = '';
        $this->price = '';
        $this->type = '';
        $this->include = '';
        $this->exclude = '';
        $this->description = '';
        $this->pricelist = '';
        $this->activities = '';
        $this->termcondition = '';
        $this->isDisplayRecommendation = '';
        $this->isDisplayFavourite = '';
        $this->tourImage = '';
        $this->tourImageName = '';
    }

    public function back(){
        $this->resetFields();
        $this->redirect(url('/setting-tour'));
    }

    public function edit($id){
        try {
            $findData = SettingTourModel::find($id);
            if (!$findData) {
                return redirect(url('/setting-tour'))->with(['error' => 'Tour/package is not found.']);
            } else {
                $this->tourId = $findData->id;
                $this->title = $findData->tourTitle;
                $this->country = $findData->tourCountryCityId;
                $this->month = $findData->tourPromotionMonthId;
                $this->year = $findData->tourPromotionYear;
                $this->longOfStay = $findData->tourLongOfStay;
                $this->flight = $findData->tourFlightId;
                $this->price = $findData->tourPrice;
                $this->type = $findData->tourType;
                $this->include = $findData->tourInclude;
                $this->exclude = $findData->tourExclude;
                $this->description = $findData->tourDescription;
                $this->pricelist = $findData->tourPricelist;
                $this->activities = $findData->tourAddActivities;
                $this->termcondition = $findData->tourTermCondition;
                $this->isDisplayRecommendation = $findData->isDisplayRecommendation;
                $this->isDisplayFavourite = $findData->isDisplayFavourite;
                $this->tourImage = null;
                $this->tourImageName = $findData->tourImage;
                $this->action = "edit";
            }
        } catch (\Exception $ex) {
            return redirect(url('/setting-tour'))->with(['error' => 'Something goes wrong!!']);
        }
    }

    public function editData(){
        $this->validate([
            'title' => 'required',
            'country' => 'required',
            'month' => 'required',
            'year' => 'required',
            'longOfStay' => 'required',
            'flight' => 'required',
            'price' => 'required',
            'type' => 'required',
            'include' => 'required',
            'exclude' => 'required',
            'description' => 'required',
            'pricelist' => 'required',
            'activities' => 'required',
            'termcondition' => 'required',
            'isDisplayRecommendation' => 'required',
            'isDisplayFavourite' => 'required',
            'tourImage' => 'nullable',
        ]);
        
        $dataUpdate = [
                'tourTitle' => $this->title,
                'tourCountryCityId' => $this->country,
                'tourPromotionMonthId' => $this->month,
                'tourPromotionYear' => $this->year,
                'tourLongOfStay' => $this->longOfStay,
                'tourFlightId' => $this->flight,
                'tourPrice' => $this->price,
                'tourType' => $this->type,
                'tourInclude' => $this->include,
                'tourExclude' => $this->exclude,
                'tourDescription' => $this->description,
                'tourPricelist' => $this->pricelist,
                'tourAddActivities' => $this->activities,
                'tourTermCondition' => $this->termcondition,
                'isDisplayRecommendation' => $this->isDisplayRecommendation,
                'isDisplayFavourite' => $this->isDisplayFavourite,
                'updated_at'   => Carbon::now()->format('Y-m-d'),
            ];
            $dataUpdate['slug'] = Str::slug($this->title, '-');
            
        if(($this->tourImage!=null)&&($this->tourImage!="")){
            $edit = SettingTourModel::find($this->tourId);
            if( !$edit->tourImage ) {
                $tourImage   = $this->tourImage->getClientOriginalName();
                $this->tourImage->storeAs(path: 'public/tour', name: $tourImage);
            } else {
                // delete previous image data
                $image_path = storage_path('app/public/tour/'.$edit->tourImage);
                unlink($image_path);
                // insert current image data
                $tourImage   = $this->tourImage->getClientOriginalName();
                $this->tourImage->storeAs(path: 'public/tour', name: $tourImage);
            }
            $dataUpdate['tourImage'] = $tourImage;
        }

        try {
            SettingTourModel::whereId($this->tourId)->update($dataUpdate);
            $this->resetFields();
            //redirect
            return redirect(url('/setting-tour'))->with(['success' => 'Tour/package successfully updated.']);
        } catch (\Exception $ex) {
            return redirect(url('/setting-tour'))->with(['error' => 'Something goes wrong!!']);
        }
    }

    public function delete($id){
        $this->tourId = $id;
    }

    public function destroy(){
        try{
            $item = SettingTourModel::find($this->tourId);
            if( $item->tourImage!=null ) {
                // delete previous image data
                $image_path = storage_path('app/public/tour/'.$item->tourImage);
                unlink($image_path);
            }
            SettingTourModel::find($this->tourId)->delete();
            $this->resetFields();
            //redirect
            return redirect(url('/setting-tour'))->with(['success' => 'Tour/package successfully deleted.']);
        }catch(\Exception $e){
            return redirect(url('/setting-tour'))->with(['error' => 'Something goes wrong!!']);
        }
    }

    public function openFile($filename){
        return response()->download(storage_path('app/public/tour/'.$filename), $filename);
    }
}
