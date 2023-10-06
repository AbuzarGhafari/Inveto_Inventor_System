<?php

namespace App\Models;

use App\Models\Shop;
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

    
    public function shops(): HasMany
    {
        return $this->hasMany(Shop::class, 'id', 'main_area');
    }
}
