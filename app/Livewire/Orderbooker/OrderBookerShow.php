<?php

namespace App\Livewire\Orderbooker;

use App\Models\Area;
use Livewire\Component;
use App\Models\OrderBooker;
use Livewire\Attributes\Rule;
use App\Models\OrderBookerArea;

class OrderBookerShow extends Component
{
    public OrderBooker $orderBooker;

    #[Rule('required', as: 'Main Area')]
    public $main_area = '';

    public $areas;

    public $name;

    public $detailsShown;

    public function mount(OrderBooker $orderBooker)
    {
        $this->orderBooker = OrderBooker::with('areas')->find($orderBooker->id);
        $this->detailsShown = false;
    }

    public function refresh()
    { 
        $this->orderBooker = OrderBooker::with('areas')->find($this->orderBooker->id);
    }

    public function selectArea(Area $area)
    {
        $this->name = $area->name;
        $this->main_area = $area->id;
    }
 

    public function assignAreaToOrderBooker()
    {        
        $validated = $this->validate();

        $this->orderBooker->areas()->syncWithoutDetaching($this->main_area);

        $this->refresh();

        $this->dispatch('closeModal'); 
 
    }

    public function unAssignAreaToOrderBooker()
    {        
        $validated = $this->validate();

        $this->orderBooker->areas()->detach($this->main_area);

        $this->refresh();

        $this->dispatch('closeModal'); 
 
    }

    public function toggleDetails()
    {
        $this->detailsShown = !$this->detailsShown;
    }

    public function render()
    {
        $this->areas = Area::all();
        
        return view('livewire.orderbooker.order-booker-show');
    }
}
