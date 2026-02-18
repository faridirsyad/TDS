<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingCarouselModel extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'tds_carousel';

    /**
     * @var array $fillable
     */
    protected $fillable = [
        'carouselImage',
        'isDisplayed',
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;
}
