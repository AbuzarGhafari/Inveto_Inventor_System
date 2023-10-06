<div>
    
    <div class="row mb-3">
        <div class="col-sm-6">
            <input wire:model.live="search" type="text"  placeholder="Search Shop" class="form-control">
        </div> 
        <div class="col-sm-6 text-end">
            <a href="{{ route('shops.create') }}" class="btn btn-dark text-white">
                <i class="fas fa-plus me-2"></i>
                Add Shop
            </a>
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
                                <th class="border-top-0 text-dark">Shop Name</th>
                                <th class="border-top-0  text-dark">Shopkeeper Name</th>
                                <th class="border-top-0  text-dark">Mobile</th>
                                <th class="border-top-0  text-dark">Main Type</th>
                                <th class="border-top-0  text-dark">Area</th>
                                <th class="border-top-0  text-dark text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shops as $shop)                            
                            <tr wire:key = "{{ $shop->id }}">
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    <a href="{{ route('shops.show', $shop->id) }}">{{ $shop->shop_name }}</a>
                                </td>
                                <td>{{ $shop->shopkeeper_name }}</td>
                                <td>{{ $shop->shopkeeper_mobile }}</td>
                                <td>{{ $shop->shop_type }}</td>
                                <td>
                                    @isset($shop->area)
                                        {{ $shop->area->name }}
                                    @else
                                        <span class="badge text-light bg-secondary">--</span>
                                    @endisset
                                </td>
                                <td> 
                                    <div class="d-flex flex-wrap flex-gap-2 justify-content-end">
                                        <a class="btn btn-gray text-dark" href="{{ route('shops.show', $shop->id) }}">
                                            <i class="fa fa-eye me-2" aria-hidden="true"></i>
                                            Show
                                        </a>
                                        <a href="{{ route('shops.edit', $shop) }}" class="btn btn-primary">
                                            <i class=" fas fa-pencil-alt me-2"></i>
                                            Edit
                                        </a> 
                                        <button data-bs-toggle="modal" wire:click="selectShop({{ $shop }})" data-bs-target="#DeleteShopModal" class="btn btn-danger text-white">
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
 

                            
                {{ $shops->links() }}
            </div>
        </div>
    </div>


    
  <div  wire:ignore.self class="modal fade" id="DeleteShopModal" tabindex="-1" aria-labelledby="DeleteShopLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="DeleteShopLabel">Delete Shop</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">   
                <p class="form-control bg-danger-light" >{{ $shop->shop_name }} </p> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" wire:click="deleteShop">Save changes</button>
            </div>
        </div>
    </div>
  </div>

</div>
