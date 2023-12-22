<div>
    <div class="row mb-3">
        <div class="col-sm-6">
            <input wire:model.live="search" type="text"  placeholder="Search Shop" class="form-control">
        </div> 
        <div class="col-sm-6 text-end">
            <button data-bs-toggle="modal" data-bs-target="#AddShopTypeModal" class="btn btn-dark text-white">
                <i class="fas fa-plus me-2"></i>
                Add Shop Type
            </button>
        </div>
    </div>



    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
            
                <table class="table text-nowrap hovered-action">
                    <thead>
                        <tr>
                            <th class="border-top-0 text-dark">#</th>
                            <th class="border-top-0  text-dark">Main Shop Types</th>
                            <th class="border-top-0  text-dark">Sub Shop Types</th>
                            <th class="border-top-0  text-dark text-end"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($shopTypes as $st)                            
                        <tr wire:key = "{{ $st->id }}">
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                <a href="{{ route('shop-types.show', $st->id) }}">{{ $st->name }}</a>
                            </td>
                            <td>
                                <div class="sub-area-badges">
                                    @foreach ($st->subShopTypes as $sst)
                                        <span class="badge badge-secondary">{{ $sst->name }}</span> 
                                    @endforeach
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-wrap flex-gap-2 justify-content-end actions">
                                    <a class="btn btn-gray text-dark" href="{{ route('shop-types.show', $st->id) }}">
                                        <i class="fa fa-eye me-2" aria-hidden="true"></i>
                                        Show
                                    </a>

                                    <button data-bs-toggle="modal" wire:click="selectShopType({{ $st }})" data-bs-target="#EditShopTypeModal" class="btn btn-primary">
                                        <i class=" fas fa-pencil-alt me-2"></i>
                                        Edit
                                    </button> 

                                    <button data-bs-toggle="modal" wire:click="selectShopType({{ $st }})" data-bs-target="#DeleteShopTypeModal" class="btn btn-danger text-white">
                                        <i class=" fas fa-trash me-2"></i>
                                        Delete
                                    </button>
                                </div>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            
                {{ $shopTypes->links() }}
            </div>
        </div>
    </div>
    



    
  <!-- Modal -->
  
  <div  wire:ignore.self class="modal fade" id="AddShopTypeModal" tabindex="-1" aria-labelledby="AddAreaLabel" aria-hidden="true">
    <form wire:submit="addNewShopType">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="AddAreaLabel">Add Main Shop Type</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">  
                @csrf
                <input type="text"   class="form-control" wire:model.live="name" placeholder="Enter Main Shop Type Name">
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
  
  <div  wire:ignore.self class="modal fade" id="EditShopTypeModal" tabindex="-1" aria-labelledby="EditAreaLabel" aria-hidden="true">
    <form wire:submit="updateShopType">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="EditAreaLabel">Edit Main Shop Type Name</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">  
                @csrf
                <input type="text" class="form-control" wire:model.live="name" placeholder="Enter Main Shop Type Name">
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
  
  <div  wire:ignore.self class="modal fade" id="DeleteShopTypeModal" tabindex="-1" aria-labelledby="DeleteShopTypeLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="DeleteShopTypeLabel">Delete Main Shop Type</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">   
                <p class="form-control bg-danger-light" >{{ $name }} </p> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" wire:click="deleteShopType">Save changes</button>
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
