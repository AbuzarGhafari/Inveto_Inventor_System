<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Product;
use Livewire\Attributes\Rule;

class ProductForm extends Form
{
    #[Rule('required|unique:products,sku_code|regex:/^([0-9]*)$/|min:0', as: 'SKU Code')]
    public $sku_code = '';

    #[Rule('required', as: 'Product Name')]
    public $name = '';

    #[Rule('sometimes:required', as: 'Product Description')]
    public $desc = '';

    #[Rule('required|integer|min:0', as: 'Pack Size')]
    public $pack_size;
    
    #[Rule('required|regex:/^\d*\.?\d+$/|min:0', as: 'Distributor Price')]
    public $distributor_prices;


    public function setProduct(Product $product)
    {
        $this->sku_code = $product->sku_code;
        $this->name = $product->name;
        $this->desc = $product->desc;
        $this->pack_size = $product->pack_size;
        $this->distributor_prices = $product->distributor_prices;
    }

}
