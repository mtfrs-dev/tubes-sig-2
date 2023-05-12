<?php

namespace App\Models;

use App\Models\Rating;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LocationObject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'address',
        'phone',
        'source',
        'asset_link',
        'asset_name',
        'asset_source',
        'latitude',
        'longitude',
        'geometry'
    ];

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }
}

