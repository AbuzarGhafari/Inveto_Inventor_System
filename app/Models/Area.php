<?php

namespace App\Models;

use App\Models\Shop;
use App\Models\SubArea;
use App\Models\OrderBooker;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Area extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function subAreas(): HasMany
    {
        return $this->hasMany(SubArea::class);
    }
    
    public function shops(): HasMany
    {
        return $this->hasMany(Shop::class, 'main_area', 'id');
    }

    public function orderBookers(): BelongsToMany
    {
        return $this->belongsToMany(OrderBooker::class);
    }
}
