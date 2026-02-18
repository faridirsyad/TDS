<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingPartnerModel extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'tds_partner';

    /**
     * @var array $fillable
     */
    protected $fillable = [
        'partnerName',
        'partnerImage',
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;
}
