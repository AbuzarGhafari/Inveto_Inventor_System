<?php

namespace App\Models;

use App\Models\Shop;
use App\Models\ShopSubType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShopType extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function subShopTypes(): HasMany
    {
        return $this->hasMany(ShopSubType::class);
    }

    
    public function shops(): HasMany
    {
        return $this->hasMany(Shop::class, 'id', 'shop_main_type');
    }
}
