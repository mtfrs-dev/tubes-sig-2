<?php

namespace App\Models;

use App\Models\User;
use App\Models\LocationObject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'location_object_id',
        'score',
        'comment',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function location_object(): BelongsTo
    {
        return $this->belongsTo(LocationObject::class);
    }
}
