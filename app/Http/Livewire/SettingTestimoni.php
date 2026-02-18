<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\SettingTestimoniModel;
use Illuminate\Pagination\Paginator;
use Livewire\WithPagination;

class SettingTestimoni extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $content, $name, $listTesti;
    public $action, $no=1, $testiId;
    public $flagPage, $pageSize, $fname;

    public function mount(){
        $this->content = '';
        $this->name = '';
        $this->fname = '';
    }

    public function render()
    {
        $listTesti = SettingTestimoniModel::select("*")
        ->when($this->fname != '', function ($query) {
            return $query->where('testimoniCustomerName', 'like', '%'.$this->fname.'%');
        })
        ->get();

        // pagination : start
        $list = $listTesti->toArray();
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
        $this->listTesti = array_map(function($array){
            return (object)$array;
        }, $itemsForCurPage);
        // pagination
        $qData = new \Illuminate\Pagination\LengthAwarePaginator($itemsForCurPage, count($list), $this->pageSize, $this->page);
        // pagination : end
        
        return view('livewire.setting-testimoni', compact('qData'))
        ->layout('layouts.app-admin');
    }

    public function open($act){
        $this->action = $act;
        $this->content = '';
        $this->name = '';
        $this->fname = '';
    }

    public function addData(){
        $this->validate([
            'content' => 'required',
            'name' => 'required'
        ]);
        try {
            $dataInput = [
                'testimoniCustomerName' => $this->name,
                'testimoniContent' => $this->content,
                'created_at'   => Carbon::now()->format('Y-m-d'),
                'updated_at'   => Carbon::now()->format('Y-m-d'),
            ];

            SettingTestimoniModel::create($dataInput);
            //redirect
            return redirect(url('/setting-testimony'))->with(['success' => 'Testimony successfully inserted.']);
        } catch (\Exception $ex) {
            return redirect(url('/setting-testimony'))->with(['error' => 'Something goes wrong!!']);
        }
    }   
    
    public function resetFields(){
        $this->action = '';
        $this->content = '';
        $this->name = '';
        $this->fname = '';
    }

    public function back(){
        $this->resetFields();
        $this->redirect(url('/setting-testimony'));
    }

    public function edit($id){
        try {
            $findData = SettingTestimoniModel::find($id);
            if (!$findData) {
                return redirect(url('/setting-testimony'))->with(['error' => 'Testimony is not found.']);
            } else {
                $this->testiId = $findData->id;
                $this->content = $findData->testimoniContent;
                $this->name = $findData->testimoniCustomerName;
                $this->action = "edit";
            }
        } catch (\Exception $ex) {
            return redirect(url('/setting-testimony'))->with(['error' => 'Something goes wrong!!']);
        }
    }

    public function editData(){
        $this->validate([
            'content' => 'required',
            'name' => 'required'
        ]);
        
        $dataUpdate = [
                'testimoniCustomerName'   => $this->name,
                'testimoniContent'   => $this->content,
                'updated_at'   => Carbon::now()->format('Y-m-d'),
            ];

        try {
            SettingTestimoniModel::whereId($this->testiId)->update($dataUpdate);
            $this->resetFields();
            //redirect
            return redirect(url('/setting-testimony'))->with(['success' => 'Testimony successfully updated.']);
        } catch (\Exception $ex) {
            return redirect(url('/setting-testimony'))->with(['error' => 'Something goes wrong!!']);
        }
    }

    public function delete($id){
        $this->testiId = $id;
    }

    public function destroy(){
        try{
            SettingTestimoniModel::find($this->testiId)->delete();
            $this->resetFields();
            //redirect
            return redirect(url('/setting-testimony'))->with(['success' => 'Testimony successfully deleted.']);
        }catch(\Exception $e){
            return redirect(url('/setting-testimony'))->with(['error' => 'Something goes wrong!!']);
        }
    }
}
