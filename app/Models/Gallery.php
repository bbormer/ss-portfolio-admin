<?php

namespace App\Models;

use App\Enums\AvailabilityStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $casts = [
        'availability' => AvailabilityStatus::class,
    ];

    protected $fillable = [
        'startTime',
        'endTime',
        'seq-no',
        'image',
        'title-ja',
        'title-en',
        'desc-ja',
        'desc-en',
        'url',
        'amount',
        'shipping',
        'availability',
        'details-ja',
        'details-en',
    ];
}
