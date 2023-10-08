<?php

namespace App\Models;

use App\Models\Area;
use App\Models\Bill;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class OrderBooker extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function areas(): BelongsToMany
    {
        return $this->belongsToMany(Area::class, 'order_booker_areas', 'order_booker_id', 'area_id');
    }

    
    public function bills(): HasMany
    {
        return $this->hasMany(Bill::class);
    }
}
