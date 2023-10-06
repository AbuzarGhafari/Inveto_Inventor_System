<?php

namespace App\Models;

use App\Models\Shop;
use App\Models\ShopType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShopSubType extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function shopType(): BelongsTo
    {
        return $this->belongsTo(ShopType::class);
    }
    
    public function shops(): HasMany
    {
        return $this->hasMany(Shop::class, 'id', 'shop_sub_type');
    }
}
