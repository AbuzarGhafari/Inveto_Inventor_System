<?php

namespace App\Livewire\Orderbooker;
use App\Models\Area;
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

        return redirect()->route('order-bookers.index');
    }
  
    public function render()
    {
        $areas = Area::all();
        
        return view('livewire.orderbooker.order-booker-create',[
            'areas' => $areas
        ]);
    }
}
