<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\SettingHomepageModel;
use Carbon\Carbon;

class SettingHomepage extends Component
{
    public $alias, $menu, $isDisplayed, $listMenuHomepage;
    public $action, $no=1, $menuId;

    public function mount(){
        $this->alias = '';
        $this->menu = '';
        $this->isDisplayed = '';
    }

    public function render()
    {
        $this->listMenuHomepage = SettingHomepageModel::select("*")
        ->get();
        
        return view('livewire.setting-homepage')
        ->layout('layouts.app-admin');
    }

    public function open($act){
        $this->action = $act;
        $this->alias = '';
        $this->menu = '';
        $this->isDisplayed = '';
    }

    public function addData(){
        $this->validate([
            'alias' => 'required',
            'menu' => 'required',
            'isDisplayed' => 'required'
        ]);
        try {
            $dataInput = [
                'homepageMenu' => $this->menu,
                'homepageAlias' => $this->alias,
                'isDisplayed' => $this->isDisplayed,
                'created_at'   => Carbon::now()->format('Y-m-d'),
                'updated_at'   => Carbon::now()->format('Y-m-d'),
            ];

            SettingHomepageModel::create($dataInput);
            //redirect
            return redirect(url('/setting-homepage'))->with(['success' => 'Homepage Menu successfully inserted.']);
        } catch (\Exception $ex) {
            return redirect(url('/setting-homepage'))->with(['error' => 'Something goes wrong!!']);
        }
    }   
    
    public function resetFields(){
        $this->action = '';
        $this->alias = '';
        $this->menu = '';
        $this->isDisplayed = '';
    }

    public function back(){
        $this->resetFields();
        $this->redirect(url('/setting-homepage'));
    }

    public function edit($id){
        try {
            $findData = SettingHomepageModel::find($id);
            if (!$findData) {
                return redirect(url('/setting-homepage'))->with(['error' => 'Partner is not found.']);
            } else {
                $this->menuId = $findData->id;
                $this->alias = $findData->homepageAlias;
                $this->menu = $findData->homepageMenu;
                $this->isDisplayed = $findData->isDisplayed;
                $this->action = "edit";
            }
        } catch (\Exception $ex) {
            return redirect(url('/setting-homepage'))->with(['error' => 'Something goes wrong!!']);
        }
    }

    public function editData(){
        $this->validate([
            'alias' => 'required',
            'menu' => 'required',
            'isDisplayed' => 'required'
        ]);
        
        $dataUpdate = [
                'homepageMenu'   => $this->menu,
                'homepageAlias'   => $this->alias,
                'isDisplayed'   => $this->isDisplayed,
                'updated_at'   => Carbon::now()->format('Y-m-d'),
            ];

        try {
            SettingHomepageModel::whereId($this->menuId)->update($dataUpdate);
            $this->resetFields();
            //redirect
            return redirect(url('/setting-homepage'))->with(['success' => 'Homepage Menu successfully updated.']);
        } catch (\Exception $ex) {
            return redirect(url('/setting-homepage'))->with(['error' => 'Something goes wrong!!']);
        }
    }

    public function delete($id){
        $this->menuId = $id;
    }

    public function destroy(){
        try{
            SettingHomepageModel::find($this->menuId)->delete();
            $this->resetFields();
            //redirect
            return redirect(url('/setting-homepage'))->with(['success' => 'Homepage Menu successfully deleted.']);
        }catch(\Exception $e){
            return redirect(url('/setting-homepage'))->with(['error' => 'Something goes wrong!!']);
        }
    }
}
