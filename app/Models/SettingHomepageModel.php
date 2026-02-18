<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingHomepageModel extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'tds_homepage';

    /**
     * @var array $fillable
     */
    protected $fillable = [
        'homepageMenu',
        'homepageAlias',
        'isDisplayed',
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;
}
