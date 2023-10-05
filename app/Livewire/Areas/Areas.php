<?php

namespace App\Livewire\Areas;

use App\Models\Area;
use App\Models\SubArea;
use Livewire\Component;
use Livewire\Attributes\Rule;

class Areas extends Component
{
    #[Rule('required', as: 'Area Name')]
    #[Rule('unique:areas')]
    public $name = '';
  
    public $search = '';

    public Area $area;

    public function render()
    {
        $areas = Area::with('subAreas')->where('name','LIKE', "%".$this->search."%") 
                    ->paginate(10);
        return view('livewire.areas.areas',[
            'areas' => $areas
        ]);
    }

    public function addNewArea()
    {
        $validated = $this->validate();

        Area::create($validated);

        $this->name = '';

        $this->dispatch('closeModal'); 
 
    }

    public function selectArea(Area $area)
    {          
        $this->area = $area;
        $this->name = $area->name;    
    }

    public function selectAreaForSubArea(Area $area)
    {          
        $this->area = $area;
        $this->name = '';  
    }

    public function updateArea()
    { 
        $validated = $this->validate();

        $this->area->update($validated);

        $this->name = ''; 

        $this->dispatch('closeModal'); 
    }

    public function deleteArea()
    {
        $this->area->delete();
        
        $this->name = ''; 

        $this->dispatch('closeModal'); 
    }

}
