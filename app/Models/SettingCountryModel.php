<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingCountryModel extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'tds_ref_country_city';

    /**
     * @var array $fillable
     */
    protected $fillable = [
        'countryCityName',
        'tourType',
        'isFreeVisa',
        'isCanNotProcessVisa',
        'isVisaOnArrival',
        'isRetirementVisa',
        'isAsean',
        'longOfStay',
        'typeVisaOnArrival',
        'countryCategoryId',
        'isVisaRequirement',
        'slug',
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;
}
