<div class="row mb-3">
    <div class="col-sm-12">
        
        <div class="card">
            <div class="card-body">
                <form class="form-horizontal form-material" wire:submit="save">
                    @csrf
                    <div class="form-group mb-4">
                        <label class="col-md-12 p-0">SKU Code</label>
                        <div class="col-md-12 border-bottom p-0">
                            <input type="text" wire:model.live="form.sku_code" class="form-control p-0 border-0" > 
                        </div>
                        @error('form.sku_code')<div class="alert alert-danger p-2">{{ $message }}</div>@enderror
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Product Name</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="text" class="form-control p-0 border-0" wire:model.live="form.name" > 
                                </div>
                                @error('form.name')<div class="alert alert-danger p-2">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Product Description</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="text" class="form-control p-0 border-0" wire:model.live="form.desc" > 
                                </div>
                                @error('form.desc')<div class="alert alert-danger p-2">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Pack Size</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="number" class="form-control p-0 border-0" wire:model.live="form.pack_size" > 
                                </div>
                                @error('form.pack_size')<div class="alert alert-danger p-2">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Distributor Price</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="text" class="form-control p-0 border-0" wire:model.live="form.distributor_prices" > 
                                </div>
                                @error('form.distributor_prices')<div class="alert alert-danger p-2">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                    
                                        
                    <div class="form-group mb-4">
                        <div class="col-sm-12">
                            <button class="btn btn-success" type="submit">Add Product</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>