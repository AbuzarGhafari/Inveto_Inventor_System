<?php

namespace App\Livewire\Product;

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

    public $product_id;

    public $no_of_cottons = 0;

    public $total_stock_amount = 0.0;

    public function render()
    {
        $products = Product::where('sku_code','LIKE', "%".$this->search."%")
                    ->orWhere('name','LIKE', "%".$this->search."%")
                    ->paginate(20);

        $productsCount = Product::where('sku_code','LIKE', "%".$this->search."%")
                        ->orWhere('name','LIKE', "%".$this->search."%")->count();

        $this->total_stock_amount = 0;
        foreach ($products as $product){
            $this->total_stock_amount += $product->total_price;
        }

        return view('livewire.product.products', [ 
            'products' => $products,
            'productsCount' => $productsCount,
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

            $this->product->no_of_cottons += $this->no_of_cottons;
            $this->product->save();
        }
        $this->no_of_cottons = 0;
        $this->product = null;
        $this->dispatch('closeModal'); 
    }

    public function deleteProduct()
    {
        $this->product->delete();
        $this->product = new Product();
        $this->dispatch('closeModal');
    }
}
