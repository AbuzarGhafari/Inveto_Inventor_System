<?php

namespace App\Livewire\Product;

use PDF;
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

    public $no_of_pieces = 0;

    public $total_stock_amount = 0.0;

    public function render()
    {
        $products = Product::where('sku_code','LIKE', "%".$this->search."%")
                    ->orWhere('name','LIKE', "%".$this->search."%")
                    ->paginate(50);

        $productsList = Product::where('sku_code','LIKE', "%".$this->search."%")
                        ->orWhere('name','LIKE', "%".$this->search."%")->get();

        $this->total_stock_amount = $productsList->sum('total_price');;

        return view('livewire.product.products', [ 
            'products' => $products,
            'productsCount' => $productsList->count(),
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
            $this->product->no_of_pieces += $this->no_of_pieces;
            $this->product->save();
        }
        $this->no_of_cottons = 0;
        $this->no_of_pieces = 0;
        $this->product = null;
        $this->dispatch('closeModal'); 
    }

    public function resetStock()
    {
        if($this->product){

            $this->product->no_of_cottons = $this->no_of_cottons;
            $this->product->no_of_pieces = $this->no_of_pieces;
            $this->product->save();
        }
        $this->no_of_cottons = 0;
        $this->no_of_pieces = 0;
        $this->product = null;
        $this->dispatch('closeModal'); 
    }

    public function deleteProduct()
    {
        $this->product->delete();
        $this->product = new Product();
        $this->dispatch('closeModal');
    }

    public function stockPDF()
    {
        $products = Product::all();
        $data = [
            'products' => $products
        ];

        $pdf = PDF::loadView('products.stock_list', $data);

        $filename = 'stock_list.pdf';
        $path = storage_path('app/public/' . $filename);
        $pdf->save($path);

        $link = asset('storage/' . $filename);

        return redirect()->to($link);

        return $pdf->stream($filename);
    }
}
