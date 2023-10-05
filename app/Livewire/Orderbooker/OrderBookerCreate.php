<?php

namespace App\Livewire\Orderbooker;
use Livewire\Component;
use App\Models\OrderBooker;
use App\Livewire\Forms\OrderBookerForm;

class OrderBookerCreate extends Component
{

    public OrderBookerForm $form;

    public function save()
    {
        $validated = $this->validate();

        OrderBooker::create($this->form->all());

        return redirect()->route('order-booker.index');
    }
  
    public function render()
    {
        return view('livewire.orderbooker.order-booker-create');
    }
}
