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
    public $listRequirement, $listCountry, $action, $no = 1, $requirementId;
    public $flagPage, $pageSize, $fcountry;

    public function mount()
    {
        $this->flag = '';
        $this->address = '';
        $this->requirement = '';
        $this->cautions = '';
        $this->fcountry = '';
        $this->action = '';
        $this->requirementId = null;
        $this->pageSize = 10;
    }

    public function render()
    {
        $listRequirement = SettingRequirementModel::join('tds_ref_country_city', 'tds_requirement.countryCityId', '=', 'tds_ref_country_city.id')
            ->join('tds_ref_country_category', 'tds_ref_country_category.id', '=', 'tds_ref_country_city.countryCategoryId')
            ->when($this->fcountry != '', function ($query) {
                return $query->where('tds_ref_country_city.id', '=', $this->fcountry);
            })
            ->get(['tds_requirement.*', 'tds_ref_country_city.countryCityName', 'tds_ref_country_category.categoryName']);

        $this->listCountry = SettingCountryModel::join('tds_ref_country_category', 'tds_ref_country_category.id', '=', 'tds_ref_country_city.countryCategoryId')
            ->where('tds_ref_country_city.isVisaRequirement', '=', '1')
            ->get(['tds_ref_country_city.id', 'tds_ref_country_city.countryCityName', 'tds_ref_country_category.categoryName']);

        // pagination : start
        $list = $listRequirement->toArray();

        if ($this->flagPage == true) {
            $this->page = 1;
            $this->flagPage = false;
        } else {
            $this->page = Paginator::resolveCurrentPage('page');
        }

        $this->pageSize = 10;
        $offset = ($this->page * $this->pageSize) - $this->pageSize;

        $itemsForCurPage = array_slice($list, $offset, $this->pageSize, true);

        $this->listRequirement = array_map(function ($array) {
            return (object)$array;
        }, $itemsForCurPage);

        $qData = new \Illuminate\Pagination\LengthAwarePaginator($itemsForCurPage, count($list), $this->pageSize, $this->page);
        // pagination : end

        return view('livewire.setting-requirement', compact('qData'))
            ->layout('layouts.app-admin');
    }

    public function open($act)
    {
        $this->resetValidation();
        $this->action = $act;

        $this->country = '';
        $this->flag = '';
        $this->address = '';
        $this->requirement = '';
        $this->cautions = '';
        $this->requirementId = null;

        // Reset isi Trix editor di UI
        $this->dispatchBrowserEvent('trix-set-values', [
            'address' => '',
            'requirement' => '',
            'cautions' => '',
        ]);
    }

    public function openFile($filename)
    {
        return response()->download(storage_path('app/public/images/' . $filename), $filename);
    }

    public function addData()
    {
        $this->resetValidation();

        $this->validate([
            'country'     => 'required',
            'address'     => 'required',
            'requirement' => 'required',
            'cautions'    => 'required',
        ]);

        $country = SettingRequirementModel::where('countryCityId', '=', $this->country)->get();
        if (count($country) > 0) {
            return redirect(url('/setting-requirement'))->with(['error' => 'Visa Requirement is already exist.']);
        }

        $dataInput = [
            'countryCityId' => $this->country,
            'countryEmbassyAddress' => (string) $this->address,
            'countryRequirement' => (string) $this->requirement,
            'countryCautions' => (string) $this->cautions,
            'created_at'   => Carbon::now()->format('Y-m-d'),
            'updated_at'   => Carbon::now()->format('Y-m-d'),
        ];

        SettingRequirementModel::create($dataInput);

        return redirect(url('/setting-requirement'))->with(['success' => 'Visa requirement successfully inserted.']);
    }

    public function edit($id)
    {
        try {
            $findData = SettingRequirementModel::find($id);
            if (!$findData) {
                return redirect(url('/setting-requirement'))->with(['error' => 'Visa requirement is not found.']);
            }

            $this->resetValidation();

            $this->country = $findData->countryCityId;
            $this->flag = $findData->countryFlag;
            $this->address = $findData->countryEmbassyAddress ?? '';
            $this->requirement = $findData->countryRequirement ?? '';
            $this->cautions = $findData->countryCautions ?? '';
            $this->requirementId = $id;
            $this->action = "edit";

            // Set isi Trix editor di UI
            $this->dispatchBrowserEvent('trix-set-values', [
                'address' => $this->address,
                'requirement' => $this->requirement,
                'cautions' => $this->cautions,
            ]);
        } catch (\Exception $ex) {
            return redirect(url('/setting-requirement'))->with(['error' => 'Something goes wrong!!']);
        }
    }

    public function editData()
    {
        $this->resetValidation();

        $this->validate([
            'country'     => 'required',
            'flag'        => 'nullable',
            'address'     => 'required',
            'requirement' => 'required',
            'cautions'    => 'required',
        ]);

        $dataUpdate = [
            'countryCityId' => $this->country,
            'countryEmbassyAddress' => (string) $this->address,
            'countryRequirement' => (string) $this->requirement,
            'countryCautions' => (string) $this->cautions,
            'updated_at'   => Carbon::now()->format('Y-m-d'),
        ];

        try {
            SettingRequirementModel::whereId($this->requirementId)->update($dataUpdate);
            $this->resetFields();

            return redirect(url('/setting-requirement'))->with(['success' => 'Visa requirement successfully updated.']);
        } catch (\Exception $ex) {
            return redirect(url('/setting-requirement'))->with(['error' => 'Something goes wrong!!']);
        }
    }

    public function resetFields()
    {
        $this->flag = '';
        $this->address = '';
        $this->requirement = '';
        $this->cautions = '';
        $this->country = '';
        $this->requirementId = null;
        $this->action = '';
        $this->fcountry = '';

        // Reset isi Trix editor di UI
        $this->dispatchBrowserEvent('trix-set-values', [
            'address' => '',
            'requirement' => '',
            'cautions' => '',
        ]);
    }

    public function back()
    {
        $this->resetFields();
        $this->redirect(url('/setting-requirement'));
    }

    public function delete($id)
    {
        $this->requirementId = $id;
    }

    public function destroy()
    {
        try {
            $item = SettingRequirementModel::find($this->requirementId);

            if ($item && $item->countryFlag != null) {
                $image_path = storage_path('app/public/images/' . $item->countryFlag);
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }

            SettingRequirementModel::find($this->requirementId)->delete();
            $this->resetFields();

            return redirect(url('/setting-requirement'))->with(['success' => 'Visa requirement successfully deleted.']);
        } catch (\Exception $e) {
            return redirect(url('/setting-requirement'))->with(['error' => 'Something goes wrong!!']);
        }
    }
}
