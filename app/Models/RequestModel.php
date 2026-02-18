<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestModel extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'tds_pertanyaan';

    /**
     * @var array $fillable
     */
    protected $fillable = [
        'customerName',
        'tanggal',
        'alamatEmail',
        'nomorTelepon',
        'pertanyaan',
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;
}
