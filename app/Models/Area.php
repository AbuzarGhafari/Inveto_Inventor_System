<?php

namespace App\Models;

use App\Models\SubArea;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Area extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function subAreas(): HasMany
    {
        return $this->hasMany(SubArea::class);
    }
}
