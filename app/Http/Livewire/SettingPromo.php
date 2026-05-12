<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\SettingPromoModel;
use Illuminate\Pagination\Paginator;
use Livewire\WithPagination;

class SettingPromo extends Component
{
    use WithFileUploads;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $flyer, $isDisplayed, $listPromo, $flyerFilename;
    public $action, $no = 1, $promoId;
    public $flagPage, $pageSize, $fdisplay;

    public function mount()
    {
        $this->flyer = '';
        $this->isDisplayed = '';
        $this->fdisplay = '';
        $this->flyerFilename = null;
    }

    public function render()
    {
        $listPromo = SettingPromoModel::select("*")
            ->when($this->fdisplay != '', function ($query) {
                return $query->where('isDisplayed', '=', $this->fdisplay);
            })
            ->get();

        // pagination : start
        $list = $listPromo->toArray();
        // pagination parameter
        if ($this->flagPage == true) {
            $this->page = 1;
            $this->flagPage = false;
        } else {
            $this->page = Paginator::resolveCurrentPage('page');
        }
        $this->pageSize = 10;
        $offset = ($this->page * $this->pageSize) - $this->pageSize;
        // displayed data
        $itemsForCurPage = array_slice($list, $offset, $this->pageSize, true);
        $this->listPromo = array_map(function ($array) {
            return (object)$array;
        }, $itemsForCurPage);
        // pagination
        $qData = new \Illuminate\Pagination\LengthAwarePaginator($itemsForCurPage, count($list), $this->pageSize, $this->page);
        // pagination : end

        return view('livewire.setting-promo', compact('qData'))
            ->layout('layouts.app-admin');
    }

    public function open($act)
    {
        $this->action = $act;
        $this->flyer = '';
        $this->isDisplayed = '';
        $this->fdisplay = '';
        $this->flyerFilename = null;
    }

    public function addData()
    {
        $this->validate([
            'flyer' => 'required|image|max:512',
            'isDisplayed' => 'required'
        ]);
        try {
            if ($this->flyer->getClientOriginalName() != null) {
                $flyer   = $this->flyer->getClientOriginalName();
                $this->flyer->storeAs(path: 'public/promo', name: $flyer);
            } else {
                $flyer = null;
            }

            $dataInput = [
                'isDisplayed' => $this->isDisplayed,
                'promoFlyer' => $flyer,
                'created_at'   => Carbon::now()->format('Y-m-d'),
                'updated_at'   => Carbon::now()->format('Y-m-d'),
            ];

            SettingPromoModel::create($dataInput);
            //redirect
            return redirect(url('/setting-service-deal'))->with(['success' => 'Promo successfully inserted.']);
        } catch (\Exception $ex) {
            return redirect(url('/setting-service-deal'))->with(['error' => 'Something goes wrong!!']);
        }
    }

    public function resetFields()
    {
        $this->action = '';
        $this->flyer = '';
        $this->isDisplayed = '';
        $this->fdisplay = '';
        $this->flyerFilename = null;
    }

    public function back()
    {
        $this->resetFields();
        $this->redirect(url('/setting-service-deal'));
    }

    public function edit($id)
    {
        try {
            $findData = SettingPromoModel::find($id);
            if (!$findData) {
                return redirect(url('/setting-service-deal'))->with(['error' => 'Promo is not found.']);
            } else {
                $this->promoId = $findData->id;
                $this->flyer = null;
                $this->flyerFilename = $findData->promoFlyer;
                $this->isDisplayed = $findData->isDisplayed;
                $this->action = "edit";
            }
        } catch (\Exception $ex) {
            return redirect(url('/setting-service-deal'))->with(['error' => 'Something goes wrong!!']);
        }
    }

    public function editData()
    {
        $this->validate([
            'flyer' => 'nullable',
            'isDisplayed' => 'required'
        ]);

        $dataUpdate = [
            'isDisplayed'   => $this->isDisplayed,
            'updated_at'   => Carbon::now()->format('Y-m-d'),
        ];

        if (($this->flyer != null) && ($this->flyer != "")) {
            $edit = SettingPromoModel::find($this->promoId);
            if (!$edit->promoFlyer) {
                $flyer   = $this->flyer->getClientOriginalName();
                $this->flyer->storeAs(path: 'public/promo', name: $flyer);
            } else {
                // delete previous image data
                $image_path = storage_path('app/public/promo/' . $edit->promoFlyer);
                unlink($image_path);
                // insert current image data
                $flyer   = $this->flyer->getClientOriginalName();
                $this->flyer->storeAs(path: 'public/promo', name: $flyer);
            }
            $dataUpdate['promoFlyer'] = $flyer;
        }

        try {
            SettingPromoModel::whereId($this->promoId)->update($dataUpdate);
            $this->resetFields();
            //redirect
            return redirect(url('/setting-service-deal'))->with(['success' => 'Promo successfully updated.']);
        } catch (\Exception $ex) {
            return redirect(url('/setting-service-deal'))->with(['error' => 'Something goes wrong!!']);
        }
    }

    public function delete($id)
    {
        $this->promoId = $id;
    }

    public function destroy()
    {
        $item = SettingPromoModel::find($this->promoId);

        if (!$item) {
            return redirect(url('/setting-service-deal'))
                ->with(['error' => 'Promo is not found.']);
        }

        $imagePath = storage_path('app/public/promo/' . $item->promoFlyer);

        if ($item->promoFlyer && file_exists($imagePath)) {
            unlink($imagePath);
        }

        $item->delete();

        $this->resetFields();

        return redirect(url('/setting-service-deal'))
            ->with(['success' => 'Promo successfully deleted.']);
    }

    public function openFile($filename)
    {
        return response()->download(storage_path('app/public/promo/' . $filename), $filename);
    }
}
