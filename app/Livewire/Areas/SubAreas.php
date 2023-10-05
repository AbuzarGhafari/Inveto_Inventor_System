<?php

namespace App\Livewire\Areas;

use App\Models\Area;
use App\Models\SubArea;
use Livewire\Component;
use Livewire\Attributes\Rule;

class SubAreas extends Component
{
    #[Rule('required', as: 'Sub Area Name')]
    #[Rule('unique:sub_areas')]
    public $name = ''; 
  
    public Area $area;
  
    public $area_id = 0;

    public $sub_area_id = 0;
  

    public function mount(Area $area)
    {
        $this->area = $area;
        $this->area_id = $area->id;
    }

    public function refresh()
    { 
        $this->area = Area::find($this->area_id);
    }
 
    public function addNewSubArea()
    { 
        $validated = $this->validate();

        SubArea::create($validated + ['area_id' => $this->area->id]);

        $this->refresh();

        $this->name = '';

        $this->dispatch('closeModal'); 
    }

    
    public function selectSubArea(SubArea $subArea)
    {          
        $this->sub_area_id = $subArea->id;

        $this->name = $subArea->name;    
    }

    
    public function updateSubArea()
    { 
        $validated = $this->validate();

        $sa = SubArea::find($this->sub_area_id);

        $sa->update($validated);

        $this->name = ''; 
        
        $this->refresh();

        $this->dispatch('closeModal'); 
    }
    
    public function deleteSubArea()
    {   
        SubArea::find($this->sub_area_id)->delete();

        $this->refresh(); 

        $this->dispatch('closeModal'); 
    }

    public function render()
    {
        return view('livewire.areas.sub-areas');
    }
}
