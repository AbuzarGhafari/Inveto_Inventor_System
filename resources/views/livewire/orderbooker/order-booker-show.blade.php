<div>

    <div class="white-box">
        <div class="d-flex justify-content-end mb-1"> 
            <button data-bs-toggle="modal" data-bs-target="#AssignAreaModal" class="btn btn-dark text-white">
                <i class="fas fa-plus me-2"></i>
                Assign Area
            </button>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="d-flex justify-content-between">
                    <p class="border-top-0 text-dark fw-bold">Name</p>
                    <p>{{ $orderBooker->name }}</p>
                </div>
                <div class="d-flex justify-content-between">
                    <p class="border-top-0  text-dark fw-bold">Mobile</p>
                    <p>{{ $orderBooker->mobile }}</p>
                </div>
                <div class="d-flex justify-content-between flex-wrap">
                    <p class="border-top-0  text-dark fw-bold">Assigned Main Areas</p>
                    <p class="d-flex justify-content-end flex-wrap flex-gap-2">
                        @foreach ($orderBooker->areas as $ar) 
                        <span class="badge badge-secondary">{{ $ar->name }}</span>  
                        @endforeach 
                    </p>
                </div> 
            </div>

            <div class="col-sm-6">
                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                            <tr>
                                <th class="border-top-0 text-dark">#</th>
                                <th class="border-top-0  text-dark">Assigned Main Areas</th>
                                <th class="border-top-0  text-dark text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderBooker->areas as $ob) 
                            <tr wire:key = "{{ $ob->id }}">
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    {{ $ob->name }}
                                </td> 
                                <td>
                                    <div class="d-flex justify-content-end"> 
                                        <button data-bs-toggle="modal" wire:click="selectArea({{ $ob }})" data-bs-target="#unassignAreaModal" class="btn btn-danger text-white">
                                            <i class=" fas fa-trash me-2"></i>
                                            Unassign Area
                                        </button> 
                                    </div>

                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
    </div>

    
        
    @livewire('bills.bills', ['order_booker_bills'=>true, 'order_booker_id' => $orderBooker->id, 'booker' => $orderBooker]) 




    
  <div  wire:ignore.self class="modal fade" id="AssignAreaModal" tabindex="-1" aria-labelledby="AssignAreaLabel" aria-hidden="true">
    <form wire:submit="assignAreaToOrderBooker">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="AssignAreaLabel">Assign Area to Order Booker</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">  
                @csrf
                <label class="col-md-12 p-0">Route (Main Area)</label>
                <div class="col-md-12 border-bottom p-0">
                    <select  wire:model.live="main_area"   class="form-control p-0 border-0" >
                        <option value="">Select Area</option>
                        @foreach ($areas as $area)
                            <option value="{{ $area->id }}">{{ $area->name }}</option>
                        @endforeach 
                    </select>
                </div>
                @error('main_area')<div class="alert alert-danger p-2">{{ $message }}</div>@enderror
                             

            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        </div>
    </form>
  </div>

  
  <div  wire:ignore.self class="modal fade" id="unassignAreaModal" tabindex="-1" aria-labelledby="unassignmAreaLabel" aria-hidden="true">
    
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="unassignmAreaLabel">Unassign Area to Order Booker</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">                  
                <p class="form-control bg-danger-light" >{{ $name }} </p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" wire:click="unAssignAreaToOrderBooker">Save changes</button>
            </div>
        </div>
    </div> 
  </div>

  

</div>
