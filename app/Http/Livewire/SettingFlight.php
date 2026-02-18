<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\SettingFlightModel;
use Illuminate\Pagination\Paginator;
use Livewire\WithPagination;

class SettingFlight extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name, $listFlight;
    public $action, $no=1, $flightId;
    public $flagPage, $pageSize, $fname;

    public function mount(){
        $this->name = '';
        $this->fname = '';
    }

    public function render()
    {
        $listFlight = SettingFlightModel::select("*")
        ->when($this->fname != '', function ($query) {
            return $query->where('flightName', 'like', '%'.$this->fname.'%');
        })
        ->orderBy('flightName')
        ->get();

        // pagination : start
        $list = $listFlight->toArray();
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
        $this->listFlight = array_map(function($array){
            return (object)$array;
        }, $itemsForCurPage);
        // pagination
        $qData = new \Illuminate\Pagination\LengthAwarePaginator($itemsForCurPage, count($list), $this->pageSize, $this->page);
        // pagination : end
        
        return view('livewire.setting-flight', compact('qData'))
        ->layout('layouts.app-admin');
    }

    public function open($act){
        $this->action = $act;
        $this->name = '';
        $this->fname = '';
    }

    public function addData(){
        $this->validate([
            'name' => 'required'
        ]);
        try {
            $dataInput = [
                'flightName' => $this->name,
                'created_at'   => Carbon::now()->format('Y-m-d'),
                'updated_at'   => Carbon::now()->format('Y-m-d'),
            ];

            SettingFlightModel::create($dataInput);
            //redirect
            return redirect(url('/setting-flight'))->with(['success' => 'Flight successfully inserted.']);
        } catch (\Exception $ex) {
            return redirect(url('/setting-flight'))->with(['error' => 'Something goes wrong!!']);
        }
    }   
    
    public function resetFields(){
        $this->action = '';
        $this->name = '';
        $this->fname = '';
    }

    public function back(){
        $this->resetFields();
        $this->redirect(url('/setting-flight'));
    }

    public function edit($id){
        try {
            $findData = SettingFlightModel::find($id);
            if (!$findData) {
                return redirect(url('/setting-flight'))->with(['error' => 'Flight is not found.']);
            } else {
                $this->flightId = $findData->id;
                $this->name = $findData->flightName;
                $this->action = "edit";
            }
        } catch (\Exception $ex) {
            return redirect(url('/setting-flight'))->with(['error' => 'Something goes wrong!!']);
        }
    }

    public function editData(){
        $this->validate([
            'name' => 'required'
        ]);
        
        $dataUpdate = [
                'flightName'   => $this->name,
                'updated_at'   => Carbon::now()->format('Y-m-d'),
            ];

        try {
            SettingFlightModel::whereId($this->flightId)->update($dataUpdate);
            $this->resetFields();
            //redirect
            return redirect(url('/setting-flight'))->with(['success' => 'Flight successfully updated.']);
        } catch (\Exception $ex) {
            return redirect(url('/setting-flight'))->with(['error' => 'Something goes wrong!!']);
        }
    }

    public function delete($id){
        $this->flightId = $id;
    }

    public function destroy(){
        try{
            SettingFlightModel::find($this->flightId)->delete();
            $this->resetFields();
            //redirect
            return redirect(url('/setting-flight'))->with(['success' => 'Flight successfully deleted.']);
        }catch(\Exception $e){
            return redirect(url('/setting-flight'))->with(['error' => 'Something goes wrong!!']);
        }
    }
}
