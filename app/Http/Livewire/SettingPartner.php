<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\SettingPartnerModel;
use Illuminate\Pagination\Paginator;
use Livewire\WithPagination;

class SettingPartner extends Component
{
    use WithFileUploads;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $image, $name, $listPartner, $imageFilename;
    public $action, $no=1, $partnerId;
    public $flagPage, $pageSize, $fname;

    public function mount(){
        $this->image = '';
        $this->name = '';
        $this->fname = '';
        $this->imageFilename = null;
    }

    public function render()
    {
        $listPartner = SettingPartnerModel::select("*")
        ->when($this->fname != '', function ($query) {
            return $query->where('partnerName', 'like', '%'.$this->fname.'%');
        })
        ->get();
        
        // pagination : start
        $list = $listPartner->toArray();
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
        $this->listPartner = array_map(function($array){
            return (object)$array;
        }, $itemsForCurPage);
        // pagination
        $qData = new \Illuminate\Pagination\LengthAwarePaginator($itemsForCurPage, count($list), $this->pageSize, $this->page);
        // pagination : end

        return view('livewire.setting-partner', compact('qData'))
        ->layout('layouts.app-admin');
    }

    public function open($act){
        $this->action = $act;
        $this->image = '';
        $this->name = '';
        $this->fname = '';
        $this->imageFilename = null;
    }

    public function addData(){
        $this->validate([
            'image' => 'required|image|max:512',
            'name' => 'required'
        ]);
        try {
            if($this->image->getClientOriginalName() != null){
                $image   = $this->image->getClientOriginalName();
                $this->image->storeAs(path: 'public/partner', name: $image);
            }else{
                $image = null;
            }

            $dataInput = [
                'partnerName' => $this->name,
                'partnerImage' => $image,
                'created_at'   => Carbon::now()->format('Y-m-d'),
                'updated_at'   => Carbon::now()->format('Y-m-d'),
            ];

            SettingPartnerModel::create($dataInput);
            //redirect
            return redirect(url('/setting-partner'))->with(['success' => 'Partner successfully inserted.']);
        } catch (\Exception $ex) {
            return redirect(url('/setting-partner'))->with(['error' => 'Something goes wrong!!']);
        }
    }   
    
    public function resetFields(){
        $this->action = '';
        $this->image = '';
        $this->name = '';
        $this->fname = '';
        $this->imageFilename = null;
    }

    public function back(){
        $this->resetFields();
        $this->redirect(url('/setting-partner'));
    }

    public function edit($id){
        try {
            $findData = SettingPartnerModel::find($id);
            if (!$findData) {
                return redirect(url('/setting-partner'))->with(['error' => 'Partner is not found.']);
            } else {
                $this->partnerId = $findData->id;
                $this->image = null;
                $this->imageFilename = $findData->partnerImage;
                $this->name = $findData->partnerName;
                $this->action = "edit";
            }
        } catch (\Exception $ex) {
            return redirect(url('/setting-partner'))->with(['error' => 'Something goes wrong!!']);
        }
    }

    public function editData(){
        $this->validate([
            'image' => 'nullable',
            'name' => 'required'
        ]);
        
        $dataUpdate = [
                'partnerName'   => $this->name,
                'updated_at'   => Carbon::now()->format('Y-m-d'),
            ];
            
        if(($this->image!=null)&&($this->image!="")){
            $edit = SettingPartnerModel::find($this->partnerId);
            if( !$edit->partnerImage ) {
                $image   = $this->image->getClientOriginalName();
                $this->image->storeAs(path: 'public/partner', name: $image);
            } else {
                // delete previous image data
                $image_path = storage_path('app/public/partner/'.$edit->partnerImage);
                unlink($image_path);
                // insert current image data
                $image   = $this->image->getClientOriginalName();
                $this->image->storeAs(path: 'public/partner', name: $image);
            }
            $dataUpdate['partnerImage'] = $image;
        }

        try {
            SettingPartnerModel::whereId($this->partnerId)->update($dataUpdate);
            $this->resetFields();
            //redirect
            return redirect(url('/setting-partner'))->with(['success' => 'Partner successfully updated.']);
        } catch (\Exception $ex) {
            return redirect(url('/setting-partner'))->with(['error' => 'Something goes wrong!!']);
        }
    }

    public function delete($id){
        $this->partnerId = $id;
    }

    public function destroy(){
        try{
            $item = SettingPartnerModel::find($this->partnerId);
            if( $item->partnerImage!=null ) {
                // delete previous image data
                $image_path = storage_path('app/public/partner/'.$item->partnerImage);
                unlink($image_path);
            }
            SettingPartnerModel::find($this->partnerId)->delete();
            $this->resetFields();
            //redirect
            return redirect(url('/setting-partner'))->with(['success' => 'Partner successfully deleted.']);
        }catch(\Exception $e){
            return redirect(url('/setting-partner'))->with(['error' => 'Something goes wrong!!']);
        }
    }

    public function openFile($filename){
        return response()->download(storage_path('app/public/partner/'.$filename), $filename);
    }
}
