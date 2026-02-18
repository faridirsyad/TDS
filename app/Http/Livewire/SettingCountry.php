<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\SettingCountryModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class SettingCountry extends Component
{
    use WithFileUploads;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $countryCityName, $tourType, $freeVisaCountry, $longOfStay, $aseanCountry, $canNotProcessVisaCountry, $visaOnArrivalCountry, $typeVisaOnArrivalCountry, $retirementVisaCountry, $countryCategoryId, $isVisaRequirement, $flag, $flagFilename;
    public $listCountryCity, $listCountryCategory, $action, $no=1, $countryId;
    public $flagPage, $pageSize, $fcountry, $fcategory, $ftype, $frequirement;

    public function mount(){
        $this->flag = '';
        $this->countryCityName = '';
        $this->tourType = '';        
        $this->freeVisaCountry = ''; 
        $this->longOfStay = 0;
        $this->aseanCountry = '';
        $this->canNotProcessVisaCountry = '';
        $this->visaOnArrivalCountry = '';
        $this->typeVisaOnArrivalCountry = '';
        $this->retirementVisaCountry = '';
        $this->countryCategoryId = '';
        $this->isVisaRequirement = '';
        $this->action = '';
        $this->fcountry = '';
        $this->fcategory = '';
        $this->ftype = '';
        $this->frequirement = '';
        $this->flagFilename = null;
    }

    public function render()
    {
        $listCountryCity = SettingCountryModel::join('tds_ref_country_category','tds_ref_country_category.id', '=', 'tds_ref_country_city.countryCategoryId')
        ->when($this->fcountry != '', function ($query) {
            return $query->where('tds_ref_country_city.countryCityName', 'like', '%'.$this->fcountry.'%');
        })
        ->when($this->ftype != '', function ($query) {
            return $query->where('tds_ref_country_city.tourType', '=', $this->ftype);
        })
        ->when($this->fcategory != '', function ($query) {
            return $query->where('tds_ref_country_city.countryCategoryId', '=', $this->fcategory);
        })
        ->when($this->frequirement != '', function ($query) {
            return $query->where('tds_ref_country_city.isVisaRequirement', '=', $this->frequirement);
        })
        ->orderBy('tds_ref_country_category.categoryName')
        ->orderBy('tds_ref_country_city.countryCityName')
        ->get(['tds_ref_country_city.*','tds_ref_country_category.categoryName']);
        $this->listCountryCategory = DB::table('tds_ref_country_category')->get();

        // pagination : start
        $list = $listCountryCity->toArray();
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
        $this->listCountryCity = array_map(function($array){
            return (object)$array;
        }, $itemsForCurPage);
        // pagination
        $qData = new \Illuminate\Pagination\LengthAwarePaginator($itemsForCurPage, count($list), $this->pageSize, $this->page);
        // pagination : end

        return view('livewire.setting-country', compact('qData'))
        ->layout('layouts.app-admin');
    }

    public function open($act){
        $this->action = $act;
        $this->flag = '';
        $this->countryCityName = '';
        $this->tourType = '';
        $this->freeVisaCountry = ''; 
        $this->longOfStay = 0;
        $this->aseanCountry = '';
        $this->canNotProcessVisaCountry = '';
        $this->visaOnArrivalCountry = '';
        $this->typeVisaOnArrivalCountry = '';
        $this->retirementVisaCountry = '';
        $this->countryCategoryId = '';
        $this->isVisaRequirement = '';
        $this->fcountry = '';
        $this->fcategory = '';
        $this->ftype = '';
        $this->frequirement = '';
        $this->flagFilename = null;
    }

    public function openFile($filename){
        return response()->download(storage_path('app/public/images/'.$filename), $filename);
    }

    public function addData(){
        $this->validate([
            'flag' => 'nullable',
            'countryCityName'  => 'required',
            'tourType'         => 'required',
            'freeVisaCountry'  => 'required',
            'canNotProcessVisaCountry'  => 'required',
            'visaOnArrivalCountry'  => 'required',
            'retirementVisaCountry'  => 'required',
            'aseanCountry'      => 'required_if:freeVisaCountry,1',
            'longOfStay'        => 'required_if:freeVisaCountry,1',
            'typeVisaOnArrivalCountry'  => 'required_if:visaOnArrivalCountry,1',
            'countryCategoryId'=> 'required',
            'isVisaRequirement'=> 'required',
        ],[
            'aseanCountry.required_if' => 'The asean country field is required when free visa country is Yes.',
            'longOfStay.required_if' => 'The long of stay field is required when free visa country is Yes.',
            'longOfStay.numeric|gt:0' => 'The long of stay field must be greater than 0.',
            'typeVisaOnArrivalCountry.required_if' => 'The type visa on arrival country field is required when visa on arrival country is Yes.',
        ]);

        if($this->aseanCountry==''){
            $this->aseanCountry = null;
        }
        if($this->typeVisaOnArrivalCountry==''){
            $this->typeVisaOnArrivalCountry = null;
        }
        if($this->countryCategoryId==''){
            $this->countryCategoryId = 0;
        }
                
        $country = SettingCountryModel::where('countryCityName','=',$this->countryCityName)->get();
        if(count($country)>0){
            //flash message
            return redirect(url('/setting-country'))->with(['error' => 'Country/City is already exist.']);
        }else{
            if(($this->flag!=null)&&($this->flag!="")){
                if($this->flag->getClientOriginalName() != null){
                    $flag   = $this->flag->getClientOriginalName();
                    $this->flag->storeAs(path: 'public/images', name: $flag);
                }else{
                    $flag = null;
                }
            }else{
                $flag=null;
            }

            $dataInput = [
                'countryFlag' => $flag,
                'countryCityName'   => $this->countryCityName,
                'tourType'          => $this->tourType,
                'isFreeVisa'        => $this->freeVisaCountry,
                'isCanNotProcessVisa'   => $this->canNotProcessVisaCountry,
                'isVisaOnArrival'   => $this->visaOnArrivalCountry,
                'isRetirementVisa'  => $this->retirementVisaCountry,
                'isAsean'           => $this->aseanCountry,
                'longOfStay'        => $this->longOfStay,
                'typeVisaOnArrival' => $this->typeVisaOnArrivalCountry,
                'countryCategoryId' => $this->countryCategoryId,
                'isVisaRequirement' => $this->isVisaRequirement,
                'created_at'   => Carbon::now()->format('Y-m-d'),
                'updated_at'   => Carbon::now()->format('Y-m-d'),
            ];
            $dataInput['slug'] = Str::slug($this->countryCityName, '-');

            SettingCountryModel::create($dataInput);
            //redirect
            return redirect(url('/setting-country'))->with(['success' => 'Country/City successfully inserted.']);
        }
    }

    public function edit($id){
        try {
            $findData = SettingCountryModel::find($id);
            if (!$findData) {
                return redirect(url('/setting-country'))->with(['error' => 'Country/City is not found.']);
            } else {
                $this->flag = null;
                $this->flagFilename = $findData->countryFlag;
                $this->countryCityName = $findData->countryCityName;
                $this->tourType = $findData->tourType;
                $this->freeVisaCountry = $findData->isFreeVisa;
                $this->canNotProcessVisaCountry = $findData->isCanNotProcessVisa;
                $this->visaOnArrivalCountry = $findData->isVisaOnArrival;
                $this->retirementVisaCountry = $findData->isRetirementVisa;
                $this->aseanCountry = $findData->isAsean;
                $this->longOfStay = $findData->longOfStay;
                $this->typeVisaOnArrivalCountry = $findData->typeVisaOnArrival;
                $this->countryCategoryId = $findData->countryCategoryId;
                $this->isVisaRequirement = $findData->isVisaRequirement;
                $this->countryId = $id;
                $this->action = "edit";
            }
        } catch (\Exception $ex) {
            return redirect(url('/setting-country'))->with(['error' => 'Something goes wrong!!']);
        }
    }

    public function editData(){
        $this->validate([
            'flag' => 'nullable',
            'countryCityName'  => 'required',
            'tourType'         => 'required',
            'freeVisaCountry'  => 'required',
            'canNotProcessVisaCountry'  => 'required',
            'visaOnArrivalCountry'  => 'required',
            'retirementVisaCountry'  => 'required',
            'aseanCountry'      => 'required_if:freeVisaCountry,1',
            'longOfStay'        => 'required_if:freeVisaCountry,1',
            'typeVisaOnArrivalCountry'  => 'required_if:visaOnArrivalCountry,1',
            'countryCategoryId'=> 'required',
            'isVisaRequirement'=> 'required',
        ],[
            'aseanCountry.required_if' => 'The asean country field is required when free visa country is Yes.',
            'longOfStay.required_if' => 'The long of stay field is required when free visa country is Yes.',
            'longOfStay.numeric|gt:0' => 'The long of stay field must be greater than 0.',
            'typeVisaOnArrivalCountry.required_if' => 'The type visa on arrival country field is required when visa on arrival country is Yes.',
        ]);

        if($this->aseanCountry==''){
            $this->aseanCountry = null;
        }
        if($this->typeVisaOnArrivalCountry==''){
            $this->typeVisaOnArrivalCountry = null;
        }
        if($this->freeVisaCountry == 2){
            $this->aseanCountry = null;
            $this->longOfStay = null;
        }
        if($this->visaOnArrivalCountry == 2){
            $this->typeVisaOnArrivalCountry = null;
        }
        if($this->countryCategoryId == ''){
            $this->countryCategoryId = 0;
        }
                
        $dataUpdate = [
            'countryCityName'   => $this->countryCityName,
            'tourType'          => $this->tourType,
            'isFreeVisa'        => $this->freeVisaCountry,
            'isCanNotProcessVisa'   => $this->canNotProcessVisaCountry,
            'isVisaOnArrival'   => $this->visaOnArrivalCountry,
            'isRetirementVisa'  => $this->retirementVisaCountry,
            'isAsean'           => $this->aseanCountry,
            'longOfStay'        => $this->longOfStay,
            'typeVisaOnArrival' => $this->typeVisaOnArrivalCountry,
            'countryCategoryId' => $this->countryCategoryId,
            'isVisaRequirement' => $this->isVisaRequirement,
            'updated_at'   => Carbon::now()->format('Y-m-d'),
        ];
        $dataUpdate['slug'] = Str::slug($this->countryCityName, '-');

        if(($this->flag!=null)&&($this->flag!="")){
            $edit = SettingCountryModel::find($this->countryId);
            if( !$edit->countryFlag ) {
                $flag   = $this->flag->getClientOriginalName();
                $this->flag->storeAs(path: 'public/images', name: $flag);
            } else {
                // delete previous image data
                $image_path = storage_path('app/public/images/'.$edit->countryFlag);
                unlink($image_path);
                // insert current image data
                $flag   = $this->flag->getClientOriginalName();
                $this->flag->storeAs(path: 'public/images', name: $flag);
            }
            $dataUpdate['countryFlag'] = $flag;
        }

        try {
            SettingCountryModel::whereId($this->countryId)->update($dataUpdate);
            $this->resetFields();
            //redirect
            return redirect(url('/setting-country'))->with(['success' => 'Country/City successfully updated.']);
        } catch (\Exception $ex) {
            return redirect(url('/setting-country'))->with(['error' => 'Something goes wrong!!']);
        }
    }

    public function resetFields(){
        $this->flag = '';
        $this->countryCityName = '';
        $this->tourType = '';
        $this->freeVisaCountry = ''; 
        $this->longOfStay = 0;
        $this->aseanCountry = '';
        $this->canNotProcessVisaCountry = '';
        $this->visaOnArrivalCountry = '';
        $this->typeVisaOnArrivalCountry = '';
        $this->retirementVisaCountry = '';
        $this->countryCategoryId = '';
        $this->isVisaRequirement = '';
        $this->action = '';
        $this->fcountry = '';
        $this->fcategory = '';
        $this->ftype = '';
        $this->frequirement = '';
        $this->flagFilename = null;
    }

    public function back(){
        $this->resetFields();
        $this->redirect(url('/setting-country'));
    }

    public function delete($id){
        $this->countryId = $id;
    }

    public function destroy(){
        try{
            $item = SettingCountryModel::find($this->countryId);
            if( $item->countryFlag!=null ) {
                // delete previous image data
                $image_path = storage_path('app/public/images/'.$item->countryFlag);
                unlink($image_path);
            }

            SettingCountryModel::find($this->countryId)->delete();
            $this->resetFields();
            //redirect
            return redirect(url('/setting-country'))->with(['success' => 'Country/City successfully deleted.']);
        }catch(\Exception $e){
            return redirect(url('/setting-country'))->with(['error' => 'Something goes wrong!!']);
        }
    }
}
