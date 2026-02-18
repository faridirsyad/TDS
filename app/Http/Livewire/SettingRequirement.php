<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\SettingCountryModel;
use App\Models\SettingRequirementModel;
use Illuminate\Pagination\Paginator;
use Livewire\WithPagination;

class SettingRequirement extends Component
{
    use WithFileUploads;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $country, $flag, $address, $requirement, $cautions;
    public $listRequirement, $listCountry, $action, $no=1, $requirementId;
    public $flagPage, $pageSize, $fcountry;

    public function mount(){
        $this->flag = '';
        $this->address = '';
        $this->requirement = '';
        $this->cautions = '';
        $this->fcountry = '';
    }
    
    public function render()
    {
        $listRequirement = SettingRequirementModel::join('tds_ref_country_city','tds_requirement.countryCityId', '=', 'tds_ref_country_city.id')
        ->join('tds_ref_country_category','tds_ref_country_category.id', '=', 'tds_ref_country_city.countryCategoryId')
        ->when($this->fcountry != '', function ($query) {
            return $query->where('tds_ref_country_city.id', '=', $this->fcountry);
        })
        ->get(['tds_requirement.*','tds_ref_country_city.countryCityName','tds_ref_country_category.categoryName']);
        $this->listCountry = SettingCountryModel::join('tds_ref_country_category','tds_ref_country_category.id', '=', 'tds_ref_country_city.countryCategoryId')
        ->where('tds_ref_country_city.isVisaRequirement','=','1')
        ->get(['tds_ref_country_city.id','tds_ref_country_city.countryCityName','tds_ref_country_category.categoryName']);

        // pagination : start
        $list = $listRequirement->toArray();
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
        $this->listRequirement = array_map(function($array){
            return (object)$array;
        }, $itemsForCurPage);
        // pagination
        $qData = new \Illuminate\Pagination\LengthAwarePaginator($itemsForCurPage, count($list), $this->pageSize, $this->page);
        // pagination : end

        return view('livewire.setting-requirement', compact('qData'))
        ->layout('layouts.app-admin');
    }

    public function open($act){
        $this->action = $act;
        $this->flag = '';
        $this->address = '';
        $this->requirement = '';
        $this->cautions = '';
        $this->fcountry = '';
    }
    
    public function openFile($filename){
        return response()->download(storage_path('app/public/images/'.$filename), $filename);
    }

    public function addData(){
        $this->validate([
            'country' => 'required',
            'flag' => 'required|image|max:512',
            'address' => 'required',
            'requirement' => 'required',
            'cautions' => 'required',
        ]);

        $country = SettingRequirementModel::where('countryCityId','=',$this->country)->get();
        if(count($country)>0){
            //flash message
            return redirect(url('/setting-requirement'))->with(['error' => 'Visa Requirement is already exist.']);
        }else{
            // if($this->flag==null){
            //     $flag = null;
            // }else{
            //     if($this->flag->getClientOriginalName() != null){
            //         $flag   = $this->flag->getClientOriginalName();
            //         $this->flag->storeAs(path: 'public/images', name: $flag);
            //     }else{
            //         $flag = null;
            //     }
            // }
            
            $dataInput = [
                'countryCityId' => $this->country,
                // 'countryFlag' => $flag,
                'countryEmbassyAddress' => $this->address,
                'countryRequirement' => $this->requirement,
                'countryCautions' => $this->cautions,
                'created_at'   => Carbon::now()->format('Y-m-d'),
                'updated_at'   => Carbon::now()->format('Y-m-d'),
            ];
            SettingRequirementModel::create($dataInput);
            //redirect
            return redirect(url('/setting-requirement'))->with(['success' => 'Visa requirement successfully inserted.']);
        }
    }

    public function edit($id){
        try {
            $findData = SettingRequirementModel::find($id);
            if (!$findData) {
                return redirect(url('/setting-requirement'))->with(['error' => 'Visa requirement is not found.']);
            } else {
                $this->country = $findData->countryCityId;
                $this->flag = $findData->countryFlag;
                $this->address = $findData->countryEmbassyAddress;
                $this->requirement = $findData->countryRequirement;
                $this->cautions = $findData->countryCautions;
                $this->requirementId = $id;
                $this->action = "edit";
            }
        } catch (\Exception $ex) {
            return redirect(url('/setting-requirement'))->with(['error' => 'Something goes wrong!!']);
        }
    }

    public function editData(){
        $this->validate([
            'country' => 'required',
            'flag' => 'nullable',
            'address' => 'required',
            'requirement' => 'required',
            'cautions' => 'required',
        ]);
        
        $dataUpdate = [
                'countryCityId' => $this->country,
                'countryEmbassyAddress' => $this->address,
                'countryRequirement' => $this->requirement,
                'countryCautions' => $this->cautions,
                'updated_at'   => Carbon::now()->format('Y-m-d'),
            ];
            // dd($this->address);
        // if(($this->flag!=null)&&($this->flag!="")){
        //     $edit = SettingRequirementModel::find($this->requirementId);
        //     if( !$edit->countryFlag ) {
        //         $flag   = $this->flag->getClientOriginalName();
        //         $this->flag->storeAs(path: 'public/images', name: $flag);
        //     } else {
        //         // delete previous image data
        //         $image_path = storage_path('app/public/images/'.$edit->countryFlag);
        //         unlink($image_path);
        //         // insert current image data
        //         $flag   = $this->flag->getClientOriginalName();
        //         $this->flag->storeAs(path: 'public/images', name: $flag);
        //     }
            // $dataUpdate['countryFlag'] = $flag;
        // }

        try {
            SettingRequirementModel::whereId($this->requirementId)->update($dataUpdate);
            $this->resetFields();
            //redirect
            return redirect(url('/setting-requirement'))->with(['success' => 'Visa requirement successfully updated.']);
        } catch (\Exception $ex) {
            return redirect(url('/setting-requirement'))->with(['error' => 'Something goes wrong!!']);
        }
    }

    public function resetFields(){
        $this->flag = '';
        $this->address = '';
        $this->requirement = '';
        $this->cautions = '';
        $this->action = '';
        $this->fcountry = '';
    }

    public function back(){
        $this->resetFields();
        $this->redirect(url('/setting-requirement'));
    }

    public function delete($id){
        $this->requirementId = $id;
    }

    public function destroy(){
        try{
            $item = SettingRequirementModel::find($this->requirementId);
            if( $item->countryFlag!=null ) {
                // delete previous image data
                $image_path = storage_path('app/public/images/'.$item->countryFlag);
                unlink($image_path);
            }
            SettingRequirementModel::find($this->requirementId)->delete();
            $this->resetFields();
            //redirect
            return redirect(url('/setting-requirement'))->with(['success' => 'Visa requirement successfully deleted.']);
        }catch(\Exception $e){
            return redirect(url('/setting-requirement'))->with(['error' => 'Something goes wrong!!']);
        }
    }

}
