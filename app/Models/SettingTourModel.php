<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingTourModel extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'tds_tour';

    /**
     * @var array $fillable
     */
    protected $fillable = [
        'tourTitle',
        'tourCountryCityId',
        'tourPromotionMonthId',
        'tourPromotionYear',
        'tourLongOfStay',
        'tourFlightId',
        'tourPrice',
        'tourType',
        'tourInclude',
        'tourExclude',
        'tourDescription',
        'tourPricelist',
        'tourAddActivities',
        'tourTermCondition',
        'isDisplayRecommendation',
        'isDisplayFavourite',
        'tourImage',
        'slug',
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;
}
