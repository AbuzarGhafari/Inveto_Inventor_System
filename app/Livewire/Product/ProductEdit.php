<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use App\Livewire\Forms\ProductForm;
use App\Livewire\Forms\ProductEditForm;

class ProductEdit extends Component
{    
    public ProductEditForm $form;

    public Product $product;
    
    public function mount(Product $product)
    {
        $this->product = $product;

        $this->form->setProduct($product);  
    }

    public function save()
    {
        $validated = $this->validate(); 

        $this->product->update($this->form->all());

        return redirect()->route('products.index');
    }

    public function render()
    {
        return view('livewire.product.product-edit');
    }
}
