<div>
    <div class="row mb-3">
        <div class="col-sm-6">
            <input wire:model.live="search" type="text"  placeholder="Search Area" class="form-control">
        </div> 
        <div class="col-sm-6 text-end">
            <button data-bs-toggle="modal" data-bs-target="#AddAreaModal" class="btn btn-dark text-white">
                <i class="fas fa-plus me-2"></i>
                Add Area
            </button>
        </div>
    </div>



    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                
                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                            <tr>
                                <th class="border-top-0 text-dark">#</th>
                                <th class="border-top-0  text-dark">Main Areas</th>
                                <th class="border-top-0  text-dark">Sub Areas</th>
                                <th class="border-top-0  text-dark text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($areas as $area)                            
                            <tr wire:key = "{{ $area->id }}">
                                <td>
                                    <a href="{{ route('areas.show', $area->id) }}">{{ $area->id }}</a>
                                </td>
                                <td>
                                    <a href="{{ route('areas.show', $area->id) }}">{{ $area->name }}</a>
                                </td>
                                <td>
                                    <div class="sub-area-badges">
                                        @foreach ($area->subAreas as $subArea)
                                            <span class="badge badge-secondary">{{ $subArea->name }}</span> 
                                        @endforeach
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-wrap flex-gap-2 justify-content-end">
                                        <a class="btn btn-gray text-dark" href="{{ route('areas.show', $area->id) }}">
                                            <i class="fa fa-eye me-2" aria-hidden="true"></i>
                                            Show
                                        </a>

                                        <button data-bs-toggle="modal" wire:click="selectArea({{ $area }})" data-bs-target="#EditAreaModal" class="btn btn-primary">
                                            <i class=" fas fa-pencil-alt me-2"></i>
                                            Edit
                                        </button>
                                        {{-- <button data-bs-toggle="modal" wire:click="selectAreaForSubArea({{ $area }})" data-bs-target="#AddSubAreaModal" class="btn btn-warning text-dark">
                                            <i class=" fas fa-plus me-2"></i>
                                            Add Sub Area
                                        </button> --}}
                                        <button data-bs-toggle="modal" wire:click="selectArea({{ $area }})" data-bs-target="#DeleteAreaModal" class="btn btn-danger text-white">
                                            <i class=" fas fa-trash me-2"></i>
                                            Delete
                                        </button>
                                    </div>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                            
                {{ $areas->links() }}
            </div>
        </div>
    </div>
    



    
  <!-- Modal -->
  
  <div  wire:ignore.self class="modal fade" id="AddAreaModal" tabindex="-1" aria-labelledby="AddAreaLabel" aria-hidden="true">
    <form wire:submit="addNewArea">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="AddAreaLabel">Add Area</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">  
                @csrf
                <input type="text"   class="form-control" wire:model.live="name" placeholder="Enter Area Name">
                @error('name')<div class="alert alert-danger p-2">{{ $message }}</div>@enderror

            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        </div>
    </form>
  </div>
  
  <div  wire:ignore.self class="modal fade" id="EditAreaModal" tabindex="-1" aria-labelledby="EditAreaLabel" aria-hidden="true">
    <form wire:submit="updateArea">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="EditAreaLabel">Edit Area</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">  
                @csrf
                <input type="text" class="form-control" wire:model.live="name" placeholder="Enter Area Name">
                @error('name')<div class="alert alert-danger p-2">{{ $message }}</div>@enderror
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        </div>
    </form>
  </div>
  
  <div  wire:ignore.self class="modal fade" id="DeleteAreaModal" tabindex="-1" aria-labelledby="DeleteAreaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="DeleteAreaLabel">Delete Area</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">   
                <p class="form-control bg-danger-light" >{{ $name }} </p> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" wire:click="deleteArea">Save changes</button>
            </div>
        </div>
    </div>
  </div>

  {{-- <div  wire:ignore.self class="modal fade" id="AddSubAreaModal" tabindex="-1" aria-labelledby="AddSubAreaLabel" aria-hidden="true">
    <form wire:submit="addNewSubArea">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="AddSubAreaLabel">Add Sub Area</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">  
                @csrf
                <input type="text"   class="form-control" wire:model.live="name" placeholder="Enter Sub Area Name">
                @error('name')<div class="alert alert-danger p-2">{{ $message }}</div>@enderror

            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        </div>
    </form>
  </div> --}}
  

</div>
