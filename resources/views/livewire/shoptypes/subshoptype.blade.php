<div>
    
    <div class="row mb-3"> 
        <div class="col-sm-12 text-end">
            <button data-bs-toggle="modal" data-bs-target="#AddSubShopTypeModal" class="btn btn-dark text-white">
                <i class="fas fa-plus me-2"></i>
                Add Sub Shop Type
            </button>
        </div>
    </div>
 
      
    <div class="row">
        <div class="col-sm-12"> 

            <div class="white-box">
                <div class="row">
                    <div class="col-sm-3">
                        <p class="border-top-0 text-dark fw-bold">Main Shop Type</p>
                    </div>
                    <div class="col-sm-9">
                        <p>{{ $shopType->name }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="border-top-0  text-dark fw-bold">Sub Shop Types</p>
                    </div>
                    <div class="col-sm-9"> 
                        @foreach ($this->shopType->subShopTypes as $sa)
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
                
                <div class="table-responsive">
                    <table class="table text-nowrap hovered-action">
                        <thead>
                            <tr>
                                <th class="border-top-0 text-dark">#</th>
                                <th class="border-top-0  text-dark">Sub Shop Types</th>
                                <th class="border-top-0  text-dark text-end"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($this->shopType->subShopTypes as $sa)
                            <tr wire:key = "{{ $sa->id }}">
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    {{ $sa->name }}
                                </td> 
                                <td>
                                    <div class="d-flex justify-content-end actions">
                                        <button data-bs-toggle="modal" wire:click="selectSubShopType({{ $sa }})" data-bs-target="#EditSubShopTypeModal" class="btn btn-primary me-2">
                                            <i class=" fas fa-pencil-alt me-2"></i>
                                            Edit
                                        </button> 
                                        <button data-bs-toggle="modal" wire:click="selectSubShopType({{ $sa }})" data-bs-target="#DeleteSubShopTypeModal" class="btn btn-danger text-white">
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
    </div>
    



    
  <div  wire:ignore.self class="modal fade" id="AddSubShopTypeModal" tabindex="-1" aria-labelledby="AddSubShopLabel" aria-hidden="true">
    <form wire:submit="addNewSubShopType">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="AddSubShopLabel">Add Sub Shop Type</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">  
                @csrf
                <input type="text" class="form-control" wire:model.live="name" placeholder="Enter Sub Shop Type Name">
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
  

  <div  wire:ignore.self class="modal fade" id="EditSubShopTypeModal" tabindex="-1" aria-labelledby="EditSubShopLabel" aria-hidden="true">
    <form wire:submit="updateSubShopType">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="EditSubShopLabel">Edit Sub Shop Type</h1>
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


  <div  wire:ignore.self class="modal fade" id="DeleteSubShopTypeModal" tabindex="-1" aria-labelledby="DeleteSubShopLabel" aria-hidden="true">
    
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="DeleteSubShopLabel">Delete Sub Shop Type</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">                  
                <p class="form-control bg-danger-light" >{{ $name }} </p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" wire:click="deleteSubShopType">Save changes</button>
            </div>
        </div>
    </div> 
  </div>

 
</div>
