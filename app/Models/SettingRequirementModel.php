<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingRequirementModel extends Model
{
    use HasFactory;
    
    /**
     * @var string $table
     */
    protected $table = 'tds_requirement';

    /**
     * @var array $fillable
     */
    protected $fillable = [
        'countryCityId',
        'countryFlag',
        'countryEmbassyAddress',
        'countryRequirement',
        'countryCautions',
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;
}
