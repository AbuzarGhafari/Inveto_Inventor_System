<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    
    use WithPagination;
    
    public $search = '';

    public $product;

    public $sku_code;

    public $product_name;

    public $cartons_qty = 0;

    public function render()
    {
        $products = Product::where('sku_code','LIKE', "%".$this->search."%")
                    ->orWhere('name','LIKE', "%".$this->search."%")
                    ->paginate(10);

        return view('livewire.products', [ 
            'products' => $products,
        ]);
    }

    public function selectProduct($id)
    {
        $this->product = Product::find($id);
        $this->sku_code = $this->product->sku_code;
        $this->product_name = $this->product->name;
    }

    public function addStock()
    {
        if($this->product){

            $this->product->stock_quantity += $this->cartons_qty;
            $this->product->save();
        }
        $this->cartons_qty = 0;
        $this->product = null;
        $this->dispatch('closeModal'); 
    }
}
