<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingPromoModel extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'tds_promo';

    /**
     * @var array $fillable
     */
    protected $fillable = [
        'promoFlyer',
        'isDisplayed',
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;
}
