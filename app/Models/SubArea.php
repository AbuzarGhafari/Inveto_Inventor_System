<?php

namespace App\Models;

use App\Models\Area;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubArea extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }
    
    public function shops(): HasMany
    {
        return $this->hasMany(Shop::class, 'sub_area', 'id');
    }
}
