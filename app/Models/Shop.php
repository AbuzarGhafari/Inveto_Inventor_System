<?php

namespace App\Models;

use App\Models\Area;
use App\Models\SubArea;
use App\Models\ShopType;
use App\Models\ShopSubType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shop extends Model
{
    use HasFactory;

    protected $guarded = [];

    
    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class, 'main_area', 'id');
    }

    public function subarea(): BelongsTo
    {
        return $this->belongsTo(SubArea::class, 'sub_area', 'id');
    }

    
    public function shopMainType(): BelongsTo
    {
        return $this->belongsTo(ShopType::class, 'shop_type', 'id');
    }

    public function shopSubType(): BelongsTo
    {
        return $this->belongsTo(ShopSubType::class, 'shop_sub_type', 'id');
    }
}
