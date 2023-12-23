<div>
    
    <div class="row mb-3"> 
        <div class="col-sm-12 text-end">
            <button data-bs-toggle="modal" data-bs-target="#AddSubAreaModal" class="btn btn-dark text-white">
                <i class="fas fa-plus me-2"></i>
                Add Sub Area
            </button>
        </div>
    </div>
 
      
    <div class="row">
        <div class="col-sm-12"> 

            <div class="white-box">
                <div class="row">
                    <div class="col-sm-3">
                        <p class="border-top-0 text-dark fw-bold">Main Area Name</p>
                    </div>
                    <div class="col-sm-9">
                        <p>{{ $area->name }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="border-top-0  text-dark fw-bold">Sub Areas</p>
                    </div>
                    <div class="col-sm-9"> 
                        @foreach ($this->area->subAreas as $sa)
                            <span class="badge badge-secondary">{{ $sa->name }}</span>
                        @endforeach
                    </div>
                </div> 
    
            </div>
        </div>
    </div>
 
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                
                <table class="table text-nowrap hovered-action">
                    <thead>
                        <tr>
                            <th class="border-top-0 text-dark">#</th>
                            <th class="border-top-0  text-dark">Sub Main Areas</th>
                            <th class="border-top-0  text-dark text-end"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($this->area->subAreas as $sa)
                        <tr wire:key = "{{ $sa->id }}">
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                {{ $sa->name }}
                            </td> 
                            <td>
                                <div class="d-flex justify-content-end actions">
                                    <button data-bs-toggle="modal" wire:click="selectSubArea({{ $sa }})" data-bs-target="#EditSubAreaModal" class="btn btn-primary me-2">
                                        <i class=" fas fa-pencil-alt me-2"></i>
                                        Edit
                                    </button> 
                                    <button data-bs-toggle="modal" wire:click="selectSubArea({{ $sa }})" data-bs-target="#DeleteSubAreaModal" class="btn btn-danger text-white">
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
        </div>
    </div>
    



    
  <div  wire:ignore.self class="modal fade" id="AddSubAreaModal" tabindex="-1" aria-labelledby="AddAreaLabel" aria-hidden="true">
    <form wire:submit="addNewSubArea">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="AddAreaLabel">Add Sub Area</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">  
                @csrf
                <input type="text" class="form-control" wire:model.live="name" placeholder="Enter Sub Area Name">
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
  

  <div  wire:ignore.self class="modal fade" id="EditSubAreaModal" tabindex="-1" aria-labelledby="EditAreaLabel" aria-hidden="true">
    <form wire:submit="updateSubArea">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="EditAreaLabel">Edit Sub Area</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">  
                @csrf
                <input type="text" class="form-control" wire:model.live="name" placeholder="Enter Sub Area Name">
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


  <div  wire:ignore.self class="modal fade" id="DeleteSubAreaModal" tabindex="-1" aria-labelledby="DeleteAreaLabel" aria-hidden="true">
    
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="DeleteAreaLabel">Delete Sub Area</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">                  
                <p class="form-control bg-danger-light" >{{ $name }} </p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" wire:click="deleteSubArea">Save changes</button>
            </div>
        </div>
    </div> 
  </div>

 
</div>
