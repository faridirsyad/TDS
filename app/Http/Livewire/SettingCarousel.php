<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\SettingCarouselModel;
use Illuminate\Pagination\Paginator;
use Livewire\WithPagination;

class SettingCarousel extends Component
{
    use WithFileUploads;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $image, $isDisplayed, $listCarousel, $imageFilename;
    public $action, $no=1, $carouselId;
    public $flagPage, $pageSize, $fdisplay;

    public function mount(){
        $this->image = '';
        $this->isDisplayed = '';
        $this->fdisplay = '';
        $this->imageFilename = null;
    }

    public function render()
    {
        $listCarousel = SettingCarouselModel::select("*")
        ->when($this->fdisplay != '', function ($query) {
            return $query->where('isDisplayed', '=', $this->fdisplay);
        })
        ->get();

        // pagination : start
        $list = $listCarousel->toArray();
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
        $this->listCarousel = array_map(function($array){
            return (object)$array;
        }, $itemsForCurPage);
        // pagination
        $qData = new \Illuminate\Pagination\LengthAwarePaginator($itemsForCurPage, count($list), $this->pageSize, $this->page);
        // pagination : end
        
        return view('livewire.setting-carousel', compact('qData'))
        ->layout('layouts.app-admin');
    }

    public function open($act){
        $this->action = $act;
        $this->image = '';
        $this->isDisplayed = '';
        $this->fdisplay = '';
        $this->imageFilename = null;
    }

    public function addData(){
        $this->validate([
            'image' => 'required|image|max:512',
            'isDisplayed' => 'required'
        ]);
        try {
            if($this->image->getClientOriginalName() != null){
                $image   = $this->image->getClientOriginalName();
                $this->image->storeAs(path: 'public/carousel', name: $image);
            }else{
                $image = null;
            }

            $dataInput = [
                'isDisplayed' => $this->isDisplayed,
                'carouselImage' => $image,
                'created_at'   => Carbon::now()->format('Y-m-d'),
                'updated_at'   => Carbon::now()->format('Y-m-d'),
            ];

            SettingCarouselModel::create($dataInput);
            //redirect
            return redirect(url('/setting-carousel'))->with(['success' => 'Carousel successfully inserted.']);
        } catch (\Exception $ex) {
            return redirect(url('/setting-carousel'))->with(['error' => 'Something goes wrong!!']);
        }
    }   
    
    public function resetFields(){
        $this->action = '';
        $this->image = '';
        $this->isDisplayed = '';
        $this->fdisplay = '';
        $this->imageFilename = null;
    }

    public function back(){
        $this->resetFields();
        $this->redirect(url('/setting-carousel'));
    }

    public function edit($id){
        try {
            $findData = SettingCarouselModel::find($id);
            if (!$findData) {
                return redirect(url('/setting-carousel'))->with(['error' => 'Carousel is not found.']);
            } else {
                $this->carouselId = $findData->id;
                $this->image = null;
                $this->imageFilename = $findData->carouselImage;
                $this->isDisplayed = $findData->isDisplayed;
                $this->action = "edit";
            }
        } catch (\Exception $ex) {
            return redirect(url('/setting-carousel'))->with(['error' => 'Something goes wrong!!']);
        }
    }

    public function editData(){
        $this->validate([
            'image' => 'nullable',
            'isDisplayed' => 'required'
        ]);
        
        $dataUpdate = [
                'isDisplayed'   => $this->isDisplayed,
                'updated_at'   => Carbon::now()->format('Y-m-d'),
            ];
            
        if(($this->image!=null)&&($this->image!="")){
            $edit = SettingCarouselModel::find($this->carouselId);
            if( !$edit->carouselImage ) {
                $image   = $this->image->getClientOriginalName();
                $this->image->storeAs(path: 'public/carousel', name: $image);
            } else {
                // delete previous image data
                $image_path = storage_path('app/public/carousel/'.$edit->carouselImage);
                unlink($image_path);
                // insert current image data
                $image   = $this->image->getClientOriginalName();
                $this->image->storeAs(path: 'public/carousel', name: $image);
            }
            $dataUpdate['carouselImage'] = $image;
        }

        try {
            SettingCarouselModel::whereId($this->carouselId)->update($dataUpdate);
            $this->resetFields();
            //redirect
            return redirect(url('/setting-carousel'))->with(['success' => 'Carousel successfully updated.']);
        } catch (\Exception $ex) {
            return redirect(url('/setting-carousel'))->with(['error' => 'Something goes wrong!!']);
        }
    }

    public function delete($id){
        $this->carouselId = $id;
    }

    public function destroy(){
        try{
            $item = SettingCarouselModel::find($this->carouselId);
            if( $item->carouselImage!=null ) {
                // delete previous image data
                $image_path = storage_path('app/public/carousel/'.$item->carouselImage);
                unlink($image_path);
            }
            SettingCarouselModel::find($this->carouselId)->delete();
            $this->resetFields();
            //redirect
            return redirect(url('/setting-carousel'))->with(['success' => 'Carousel successfully deleted.']);
        }catch(\Exception $e){
            return redirect(url('/setting-carousel'))->with(['error' => 'Something goes wrong!!']);
        }
    }

    public function openFile($filename){
        return response()->download(storage_path('app/public/carousel/'.$filename), $filename);
    }
}
