<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\SettingTourModel;
use App\Models\SettingCountryModel;

class SettingTour extends Component
{
    use WithFileUploads, WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $title = '';
    public $country = '';
    public $month = '';
    public $year = '';
    public $longOfStay = '';
    public $flight = '';
    public $price = '';
    public $type = '';
    public $qType = '';
    public $include = '';
    public $exclude = '';
    public $description = '';
    public $pricelist = '';
    public $activities = '';
    public $termcondition = '';
    public $isDisplayRecommendation = '';
    public $isDisplayFavourite = '';
    public $tourImage = null;
    public $tourImageName = null;

    public $listCountry = [];
    public $listMonth = [];
    public $listYear = [];
    public $listFlight = [];
    public $listType = [];
    public $listTour = [];
    public $action = '';
    public $no = 1;
    public $tourId = null;

    public $flagPage = false;
    public $pageSize = 10;

    public $ftitle = '';
    public $fdestination = '';
    public $ftype = '';
    public $fmonth = '';
    public $fyear = '';

    protected $listeners = [
        'setDescription' => 'setDescription',
        'setInclude' => 'setInclude',
        'setExclude' => 'setExclude',
        'setPricelist' => 'setPricelist',
        'setActivities' => 'setActivities',
        'setTermcondition' => 'setTermcondition',
    ];

    public function mount()
    {
        $this->resetForm();
        $this->ftitle = '';
        $this->fdestination = '';
        $this->ftype = '';
        $this->fmonth = '';
        $this->fyear = Carbon::now()->format('Y');
    }

    public function render()
    {
        $this->listCountry = SettingCountryModel::join(
            'tds_ref_country_category',
            'tds_ref_country_city.countryCategoryId',
            '=',
            'tds_ref_country_category.id'
        )
            ->orderBy('tds_ref_country_category.id')
            ->get(['tds_ref_country_city.id', 'countryCityName', 'categoryName']);

        $this->listMonth = DB::table('tds_ref_month')->orderBy('id')->get();

        $this->listYear = DB::table('tds_tour')
            ->distinct()
            ->orderBy('tourPromotionYear', 'desc')
            ->get(['tourPromotionYear']);

        $this->listFlight = DB::table('tds_ref_flight')
            ->orderBy('flightName')
            ->get();

        $this->listType = DB::table('tds_ref_tour_type')
            ->orderBy('tourTypeName')
            ->get();

        $listTour = SettingTourModel::join('tds_ref_country_city', 'tds_ref_country_city.id', '=', 'tds_tour.tourCountryCityId')
            ->join('tds_ref_month', 'tds_ref_month.id', '=', 'tds_tour.tourPromotionMonthId')
            ->join('tds_ref_flight', 'tds_ref_flight.id', '=', 'tds_tour.tourFlightId')
            ->join('tds_ref_tour_type', 'tds_ref_tour_type.id', '=', 'tds_tour.tourType')
            ->when($this->ftitle !== '', function ($query) {
                $query->where('tourTitle', 'like', '%' . $this->ftitle . '%');
            })
            ->when($this->fdestination !== '', function ($query) {
                $query->where('tourCountryCityId', $this->fdestination);
            })
            ->when($this->ftype !== '', function ($query) {
                $query->where('tds_tour.tourType', $this->ftype);
            })
            ->when($this->fmonth !== '', function ($query) {
                $query->where('tourPromotionMonthId', $this->fmonth);
            })
            ->when($this->fyear !== '', function ($query) {
                $query->where('tourPromotionYear', $this->fyear);
            })
            ->get([
                'tds_tour.*',
                'tds_ref_country_city.countryCityName',
                'tds_ref_month.monthName',
                'tds_ref_flight.flightName',
                'tds_ref_tour_type.tourTypeName'
            ]);

        $list = $listTour->toArray();

        if ($this->flagPage === true) {
            $this->page = 1;
            $this->flagPage = false;
        } else {
            $this->page = Paginator::resolveCurrentPage('page');
        }

        $this->pageSize = 10;
        $offset = ($this->page * $this->pageSize) - $this->pageSize;
        $itemsForCurPage = array_slice($list, $offset, $this->pageSize, true);

        $this->listTour = array_map(function ($array) {
            return (object) $array;
        }, $itemsForCurPage);

        $qData = new \Illuminate\Pagination\LengthAwarePaginator(
            $itemsForCurPage,
            count($list),
            $this->pageSize,
            $this->page
        );

        return view('livewire.setting-tour', compact('qData'))
            ->layout('layouts.app-admin');
    }

    public function resetForm()
    {
        $this->title = '';
        $this->country = '';
        $this->month = Carbon::now()->format('n');
        $this->year = Carbon::now()->format('Y');
        $this->longOfStay = '';
        $this->flight = '';
        $this->price = '';
        $this->type = '';
        $this->include = '';
        $this->exclude = '';
        $this->description = '';
        $this->pricelist = '';
        $this->activities = '';
        $this->termcondition = '';
        $this->isDisplayRecommendation = '';
        $this->isDisplayFavourite = '';
        $this->tourImage = null;
        $this->tourImageName = null;
        $this->tourId = null;
    }

    public function open($act)
    {
        $this->resetValidation();
        $this->resetForm();
        $this->action = $act;

        $this->dispatchBrowserEvent('trix-reset');
    }

    public function back()
    {
        $this->resetValidation();
        $this->resetForm();
        $this->action = '';

        $this->dispatchBrowserEvent('trix-reset');
    }

    public function setDescription($value)
    {
        $this->description = $value ?? '';
    }

    public function setInclude($value)
    {
        $this->include = $value ?? '';
    }

    public function setExclude($value)
    {
        $this->exclude = $value ?? '';
    }

    public function setPricelist($value)
    {
        $this->pricelist = $value ?? '';
    }

    public function setActivities($value)
    {
        $this->activities = $value ?? '';
    }

    public function setTermcondition($value)
    {
        $this->termcondition = $value ?? '';
    }

    protected function cleanTrixValue($value)
    {
        if ($value === null) {
            return '';
        }

        $trimmed = trim($value);

        if ($trimmed === '' || $trimmed === '<div><br></div>' || $trimmed === '<br>') {
            return '';
        }

        return $trimmed;
    }

    protected function getValidatedData($isEdit = false)
    {
        $this->description = $this->cleanTrixValue($this->description);
        $this->include = $this->cleanTrixValue($this->include);
        $this->exclude = $this->cleanTrixValue($this->exclude);
        $this->pricelist = $this->cleanTrixValue($this->pricelist);
        $this->activities = $this->cleanTrixValue($this->activities);
        $this->termcondition = $this->cleanTrixValue($this->termcondition);

        $rules = [
            'title' => 'required|string|max:255',
            'country' => 'required',
            'month' => 'required',
            'year' => 'required|numeric',
            'longOfStay' => 'required|numeric',
            'flight' => 'required',
            'price' => 'required|numeric',
            'type' => 'required',
            'include' => 'required',
            'exclude' => 'nullable',
            'description' => 'required',
            'pricelist' => 'nullable',
            'activities' => 'nullable',
            'termcondition' => 'nullable',
            'isDisplayRecommendation' => 'nullable',
            'isDisplayFavourite' => 'nullable',
            'tourImage' => $isEdit ? 'nullable|image|max:512' : 'required|image|max:512',
        ];

        return $this->validate($rules);
    }

    protected function saveUploadedImage($uploadedFile)
    {
        if (!$uploadedFile) {
            return null;
        }

        $filename = time() . '_' . Str::slug(pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $uploadedFile->getClientOriginalExtension();
        $uploadedFile->storeAs('public/tour', $filename);

        return $filename;
    }

    public function addData()
    {
        $this->getValidatedData(false);

        try {
            $tourImage = $this->saveUploadedImage($this->tourImage);

            $dataInput = [
                'tourTitle' => $this->title,
                'tourCountryCityId' => $this->country,
                'tourPromotionMonthId' => $this->month,
                'tourPromotionYear' => $this->year,
                'tourLongOfStay' => $this->longOfStay,
                'tourFlightId' => $this->flight,
                'tourPrice' => $this->price,
                'tourType' => $this->type,
                'tourInclude' => $this->include,
                'tourExclude' => $this->exclude,
                'tourDescription' => $this->description,
                'tourPricelist' => $this->pricelist,
                'tourAddActivities' => $this->activities,
                'tourTermCondition' => $this->termcondition,
                'isDisplayRecommendation' => $this->isDisplayRecommendation !== '' ? $this->isDisplayRecommendation : null,
                'isDisplayFavourite' => $this->isDisplayFavourite !== '' ? $this->isDisplayFavourite : null,
                'tourImage' => $tourImage,
                'slug' => Str::slug($this->title, '-'),
            ];

            SettingTourModel::create($dataInput);

            $this->resetForm();
            $this->action = '';

            return redirect(url('/setting-tour'))->with([
                'success' => 'Tour/package successfully inserted.'
            ]);
        } catch (\Exception $ex) {
            return redirect(url('/setting-tour'))->with([
                'error' => 'Something goes wrong!! ' . $ex->getMessage()
            ]);
        }
    }

    public function edit($id)
    {
        try {
            $findData = SettingTourModel::find($id);

            if (!$findData) {
                return redirect(url('/setting-tour'))->with([
                    'error' => 'Tour/package is not found.'
                ]);
            }

            $this->tourId = $findData->id;
            $this->title = $findData->tourTitle;
            $this->country = $findData->tourCountryCityId;
            $this->month = $findData->tourPromotionMonthId;
            $this->year = $findData->tourPromotionYear;
            $this->longOfStay = $findData->tourLongOfStay;
            $this->flight = $findData->tourFlightId;
            $this->price = $findData->tourPrice;
            $this->type = $findData->tourType;
            $this->include = $findData->tourInclude ?? '';
            $this->exclude = $findData->tourExclude ?? '';
            $this->description = $findData->tourDescription ?? '';
            $this->pricelist = $findData->tourPricelist ?? '';
            $this->activities = $findData->tourAddActivities ?? '';
            $this->termcondition = $findData->tourTermCondition ?? '';
            $this->isDisplayRecommendation = $findData->isDisplayRecommendation ?? '';
            $this->isDisplayFavourite = $findData->isDisplayFavourite ?? '';
            $this->tourImage = null;
            $this->tourImageName = $findData->tourImage;
            $this->action = 'edit';

            $this->dispatchBrowserEvent('trix-fill', [
                'description' => $this->description,
                'include' => $this->include,
                'exclude' => $this->exclude,
                'pricelist' => $this->pricelist,
                'activities' => $this->activities,
                'termcondition' => $this->termcondition,
            ]);
        } catch (\Exception $ex) {
            return redirect(url('/setting-tour'))->with([
                'error' => 'Something goes wrong!! ' . $ex->getMessage()
            ]);
        }
    }

    public function editData()
    {
        $this->getValidatedData(true);

        try {
            $dataUpdate = [
                'tourTitle' => $this->title,
                'tourCountryCityId' => $this->country,
                'tourPromotionMonthId' => $this->month,
                'tourPromotionYear' => $this->year,
                'tourLongOfStay' => $this->longOfStay,
                'tourFlightId' => $this->flight,
                'tourPrice' => $this->price,
                'tourType' => $this->type,
                'tourInclude' => $this->include,
                'tourExclude' => $this->exclude,
                'tourDescription' => $this->description,
                'tourPricelist' => $this->pricelist,
                'tourAddActivities' => $this->activities,
                'tourTermCondition' => $this->termcondition,
                'isDisplayRecommendation' => $this->isDisplayRecommendation !== '' ? $this->isDisplayRecommendation : null,
                'isDisplayFavourite' => $this->isDisplayFavourite !== '' ? $this->isDisplayFavourite : null,
                'slug' => Str::slug($this->title, '-'),
            ];

            if ($this->tourImage) {
                $edit = SettingTourModel::findOrFail($this->tourId);

                if (!empty($edit->tourImage)) {
                    $oldImagePath = storage_path('app/public/tour/' . $edit->tourImage);
                    if (File::exists($oldImagePath)) {
                        File::delete($oldImagePath);
                    }
                }

                $dataUpdate['tourImage'] = $this->saveUploadedImage($this->tourImage);
            }

            SettingTourModel::where('id', $this->tourId)->update($dataUpdate);

            $this->resetForm();
            $this->action = '';

            return redirect(url('/setting-tour'))->with([
                'success' => 'Tour/package successfully updated.'
            ]);
        } catch (\Exception $ex) {
            return redirect(url('/setting-tour'))->with([
                'error' => 'Something goes wrong!! ' . $ex->getMessage()
            ]);
        }
    }

    public function delete($id)
    {
        $this->tourId = $id;
    }

    public function destroy()
    {
        try {
            $item = SettingTourModel::findOrFail($this->tourId);

            if (!empty($item->tourImage)) {
                $imagePath = storage_path('app/public/tour/' . $item->tourImage);
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }

            $item->delete();

            $this->resetForm();
            $this->action = '';

            return redirect(url('/setting-tour'))->with([
                'success' => 'Tour/package successfully deleted.'
            ]);
        } catch (\Exception $e) {
            return redirect(url('/setting-tour'))->with([
                'error' => 'Something goes wrong!! ' . $e->getMessage()
            ]);
        }
    }

    public function openFile($filename)
    {
        return response()->download(storage_path('app/public/tour/' . $filename), $filename);
    }
}
