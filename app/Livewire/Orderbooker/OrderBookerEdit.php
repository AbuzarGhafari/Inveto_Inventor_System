<?php

namespace App\Livewire\Orderbooker;

use Livewire\Component;
use App\Models\OrderBooker;
use App\Livewire\Forms\OrderBookerForm;

class OrderBookerEdit extends Component
{    
    public OrderBookerForm $form;

    public OrderBooker $orderBooker;

    public function mount(OrderBooker $orderBooker)
    {
        $this->orderBooker = $orderBooker;

        $this->form->setOrderBooker($orderBooker);  
    }

    public function save()
    { 
        $validated = $this->validate();

        $this->orderBooker->update($this->form->all());

        return redirect()->route('order-bookers.index');
    }


    public function render()
    {
        return view('livewire.orderbooker.order-booker-edit');
    }
}
