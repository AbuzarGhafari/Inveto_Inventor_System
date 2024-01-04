<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function soldStock($row)
    {
        $product = Product::find($row['product_id']);
        
        $product->no_of_cottons -= $row['no_of_cottons'];

        if ($row['no_of_pieces'] > 0) {
            
            while ($product->no_of_pieces < $row['no_of_pieces'] && $product->no_of_cottons > 0) {
                
                $product->no_of_cottons--;

                $product->no_of_pieces += $product->pack_size;
            }
            
            $product->no_of_pieces -= $row['no_of_pieces'];
        }

        $product->save();
    }

    public static function returnStock($row)
    {
        $product = Product::find($row['product_id']);
        
        $product->no_of_cottons += $row['no_of_cottons'];

        $product->no_of_pieces += $row['no_of_pieces'];

        while ($product->no_of_pieces >= $product->pack_size) {

            $product->no_of_cottons++;
    
            $product->no_of_pieces -= $product->pack_size;
            
        }

        $product->save();
    }

    public function getTotalPriceAttribute()
    {
        $totalCottonPrice = $this->distributor_prices * $this->no_of_cottons;
        
        $totalPiecesPrice = $this->no_of_pieces * ($this->distributor_prices / $this->pack_size);

        return $totalCottonPrice + $totalPiecesPrice;
    }

    public function getStockCountAttribute()
    {
        return $this->no_of_cottons * $this->pack_size + $this->no_of_pieces;
    }
}
