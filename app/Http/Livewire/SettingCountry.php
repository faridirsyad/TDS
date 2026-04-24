<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\SettingCountryModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class SettingCountry extends Component
{
    use WithFileUploads;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $countryCityName, $tourType, $freeVisaCountry, $longOfStay;
    public $aseanCountry, $canNotProcessVisaCountry, $visaOnArrivalCountry;
    public $typeVisaOnArrivalCountry, $retirementVisaCountry;
    public $countryCategoryId, $isVisaRequirement;
    public $flag, $flagFilename;

    public $listCountryCity, $listCountryCategory;
    public $action, $no = 1, $countryId;
    public $flagPage, $pageSize;
    public $fcountry, $fcategory, $ftype, $frequirement;

    public function mount()
    {
        $this->resetFields();
    }

    public function render()
    {
        $listCountryCity = SettingCountryModel::join(
            'tds_ref_country_category',
            'tds_ref_country_category.id',
            '=',
            'tds_ref_country_city.countryCategoryId'
        )
            ->when($this->fcountry != '', function ($query) {
                return $query->where('tds_ref_country_city.countryCityName', 'like', '%' . $this->fcountry . '%');
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
            ->get([
                'tds_ref_country_city.*',
                'tds_ref_country_category.categoryName'
            ]);

        $this->listCountryCategory = DB::table('tds_ref_country_category')->get();

        $list = $listCountryCity->toArray();

        if ($this->flagPage == true) {
            $this->page = 1;
            $this->flagPage = false;
        } else {
            $this->page = Paginator::resolveCurrentPage('page');
        }

        $this->pageSize = 10;
        $offset = ($this->page * $this->pageSize) - $this->pageSize;

        $itemsForCurPage = array_slice($list, $offset, $this->pageSize, true);

        $this->listCountryCity = array_map(function ($array) {
            return (object) $array;
        }, $itemsForCurPage);

        $qData = new \Illuminate\Pagination\LengthAwarePaginator(
            $itemsForCurPage,
            count($list),
            $this->pageSize,
            $this->page
        );

        return view('livewire.setting-country', compact('qData'))
            ->layout('layouts.app-admin');
    }

    public function open($act)
    {
        $this->resetFields();
        $this->action = $act;
    }

    public function openFile($filename)
    {
        $path = storage_path('app/public/images/' . $filename);

        if (!$filename || !file_exists($path)) {
            abort(404, 'File tidak ditemukan');
        }

        return response()->download($path, $filename);
    }

    private function uploadFlag()
    {
        if (!$this->flag) {
            return null;
        }

        $this->validate([
            'flag' => 'image|mimes:jpg,jpeg,png,webp,gif|max:2048',
        ]);

        $originalName = $this->flag->getClientOriginalName();

        $folderPath = storage_path('app/public/images');

        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0755, true);
        }

        if (file_exists($folderPath . '/' . $originalName)) {
            unlink($folderPath . '/' . $originalName);
        }

        $this->flag->storeAs('public/images', $originalName);

        return $originalName;
    }

    public function addData()
    {
        $this->validate([
            'flag' => 'required|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
            'countryCityName' => 'required',
            'tourType' => 'required',
            'freeVisaCountry' => 'required',
            'canNotProcessVisaCountry' => 'required',
            'visaOnArrivalCountry' => 'required',
            'retirementVisaCountry' => 'required',
            'aseanCountry' => 'required_if:freeVisaCountry,1',
            'longOfStay' => 'required_if:freeVisaCountry,1',
            'typeVisaOnArrivalCountry' => 'required_if:visaOnArrivalCountry,1',
            'countryCategoryId' => 'required',
            'isVisaRequirement' => 'required',
        ]);

        $country = SettingCountryModel::where('countryCityName', $this->countryCityName)->first();

        if ($country) {
            return redirect(url('/setting-country'))
                ->with(['error' => 'Country/City is already exist.']);
        }

        $flag = $this->uploadFlag();

        $this->flagFilename = $flag;

        $dataInput = [
            'countryFlag' => $this->flagFilename,
            'countryCityName' => $this->countryCityName,
            'tourType' => $this->tourType,
            'isFreeVisa' => $this->freeVisaCountry,
            'isCanNotProcessVisa' => $this->canNotProcessVisaCountry,
            'isVisaOnArrival' => $this->visaOnArrivalCountry,
            'isRetirementVisa' => $this->retirementVisaCountry,
            'isAsean' => $this->aseanCountry ?: null,
            'longOfStay' => $this->longOfStay,
            'typeVisaOnArrival' => $this->typeVisaOnArrivalCountry ?: null,
            'countryCategoryId' => $this->countryCategoryId ?: 0,
            'isVisaRequirement' => $this->isVisaRequirement,
            'slug' => Str::slug($this->countryCityName, '-'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        SettingCountryModel::create($dataInput);

        return redirect(url('/setting-country'))
            ->with(['success' => 'Country/City successfully inserted.']);
    }

    public function edit($id)
    {
        $findData = SettingCountryModel::find($id);

        if (!$findData) {
            return redirect(url('/setting-country'))
                ->with(['error' => 'Country/City is not found.']);
        }

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
        $this->action = 'edit';
    }

    public function editData()
    {
        $this->validate([
            'flag' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
            'countryCityName' => 'required',
            'tourType' => 'required',
            'freeVisaCountry' => 'required',
            'canNotProcessVisaCountry' => 'required',
            'visaOnArrivalCountry' => 'required',
            'retirementVisaCountry' => 'required',
            'aseanCountry' => 'required_if:freeVisaCountry,1',
            'longOfStay' => 'required_if:freeVisaCountry,1',
            'typeVisaOnArrivalCountry' => 'required_if:visaOnArrivalCountry,1',
            'countryCategoryId' => 'required',
            'isVisaRequirement' => 'required',
        ]);

        $edit = SettingCountryModel::find($this->countryId);

        if (!$edit) {
            return redirect(url('/setting-country'))
                ->with(['error' => 'Country/City is not found.']);
        }

        $dataUpdate = [
            'countryCityName' => $this->countryCityName,
            'tourType' => $this->tourType,
            'isFreeVisa' => $this->freeVisaCountry,
            'isCanNotProcessVisa' => $this->canNotProcessVisaCountry,
            'isVisaOnArrival' => $this->visaOnArrivalCountry,
            'isRetirementVisa' => $this->retirementVisaCountry,
            'isAsean' => $this->freeVisaCountry == 1 ? $this->aseanCountry : null,
            'longOfStay' => $this->freeVisaCountry == 1 ? $this->longOfStay : null,
            'typeVisaOnArrival' => $this->visaOnArrivalCountry == 1 ? $this->typeVisaOnArrivalCountry : null,
            'countryCategoryId' => $this->countryCategoryId ?: 0,
            'isVisaRequirement' => $this->isVisaRequirement,
            'slug' => Str::slug($this->countryCityName, '-'),
            'updated_at' => Carbon::now(),
        ];

        if ($this->flag) {
            $oldPath = storage_path('app/public/images/' . $edit->countryFlag);

            if ($edit->countryFlag && file_exists($oldPath)) {
                unlink($oldPath);
            }

            $newFlag = $this->uploadFlag();

            $dataUpdate['countryFlag'] = $newFlag;
            $this->flagFilename = $newFlag;
        }

        SettingCountryModel::whereId($this->countryId)->update($dataUpdate);

        $this->resetFields();

        return redirect(url('/setting-country'))
            ->with(['success' => 'Country/City successfully updated.']);
    }

    public function resetFields()
    {
        $this->flag = null;
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
        $this->countryId = null;
    }

    public function back()
    {
        $this->resetFields();

        return redirect(url('/setting-country'));
    }

    public function delete($id)
    {
        $this->countryId = $id;
    }

    public function destroy()
    {
        $item = SettingCountryModel::find($this->countryId);

        if (!$item) {
            return redirect(url('/setting-country'))
                ->with(['error' => 'Country/City is not found.']);
        }

        $imagePath = storage_path('app/public/images/' . $item->countryFlag);

        if ($item->countryFlag && file_exists($imagePath)) {
            unlink($imagePath);
        }

        $item->delete();

        $this->resetFields();

        return redirect(url('/setting-country'))
            ->with(['success' => 'Country/City successfully deleted.']);
    }
}
