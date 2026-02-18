<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingTestimoniModel extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'tds_testimoni';

    /**
     * @var array $fillable
     */
    protected $fillable = [
        'testimoniCustomerName',
        'testimoniContent',
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;
}
