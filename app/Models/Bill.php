<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Area;
use App\Models\Bill;
use App\Models\Shop;
use App\Models\OrderBooker;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bill extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function getBillsCountToday()
    {
        return Bill::whereDate('created_at', Carbon::today())->get()->count();
    }

    public function orderBooker(): BelongsTo
    {
        return $this->belongsTo(OrderBooker::class);
    }

    public function mainArea(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }

    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }
}
