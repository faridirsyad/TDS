<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingFlightModel extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'tds_ref_flight';

    /**
     * @var array $fillable
     */
    protected $fillable = [
        'flightName',
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;
}
