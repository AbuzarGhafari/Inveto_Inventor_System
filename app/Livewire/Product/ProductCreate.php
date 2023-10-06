<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use App\Livewire\Forms\ProductForm;

class ProductCreate extends Component
{
    public ProductForm $form;

    public function save()
    {        
        $validated = $this->validate(); 

        Product::create($this->form->all());

        return redirect()->route('products.index');
    }
    
    public function render()
    {
        return view('livewire.product.product-create');
    }
}
