<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Area;
use App\Models\Bill;
use App\Models\Shop;
use App\Models\SubArea;
use App\Models\BillEntry;
use App\Models\OrderBooker;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

class Bill extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function getBillsCountToday()
    {
        return Bill::whereDate('created_at', Carbon::today())->get()->count();
    }

    public static function getUniqueBillNumber()
    {        
        $now = Carbon::now()->timezone('Asia/Karachi');
        $count = 1;
        $billCountToday = Bill::getBillsCountToday();
        while ($count != 0) {            
            $billCountToday = $billCountToday + 1;      
            $bill_number = $now->year . 'M' . $now->month . 'D' . $now->day . strtoupper($now->shortLocaleDayOfWeek) . ($billCountToday);
            $count = Bill::where('bill_number', $bill_number)->get()->count();
        }
        return $bill_number;
    }

    public function orderBooker(): BelongsTo
    {
        return $this->belongsTo(OrderBooker::class);
    }

    public function mainArea(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }

    public function subArea(): BelongsTo
    {
        return $this->belongsTo(SubArea::class);
    }

    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }
    
    public function billEntries(): HasMany
    {
        return $this->hasMany(BillEntry::class);
    }

    public function scopeRecovered(Builder $query): void
    {
        $query->where('is_recovered', true);
    }

    public function scopePending(Builder $query): void
    {
        $query->where('is_recovered', false);
    }

    public function getProfit()
    {
        
        $data = $this->billEntries->map(function($item, $key){
            
            $totalBuyAmount = ($item->product->distributor_prices * $item->no_of_cottons) + ($item->product->pack_size / $item->product->distributor_prices * $item->no_of_pieces);
            
            return [
                'totalBuyAmount' => $totalBuyAmount,
                'totalSellAmount' => $item->final_price
            ];

        });

        return [
            'totalBuyAmount' => $data->sum('totalBuyAmount'),
            'totalSellAmount' => $data->sum('totalSellAmount'),
            'totalProfitLoss' => $data->sum('totalSellAmount') - $data->sum('totalBuyAmount')
        ];
    }
    
}
