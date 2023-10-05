
<div class="row mb-3">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <form class="form-horizontal form-material" wire:submit="save">
                    @csrf

                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Shop Name</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="text" wire:model.live="shop_name"  class="form-control p-0 border-0" > 
                                </div>
                                @error('shop_name')<div class="alert alert-danger p-2">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Shopkeeper Name</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="text" wire:model.live="shopkeeper_name"  class="form-control p-0 border-0" > 
                                </div>
                                @error('shopkeeper_name')<div class="alert alert-danger p-2">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Shopkeeper Mobile</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="text" wire:model.live="shopkeeper_mobile"  class="form-control p-0 border-0" > 
                                </div>
                                @error('shopkeeper_mobile')<div class="alert alert-danger p-2">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">City</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="text" wire:model.live="city"  class="form-control p-0 border-0" > 
                                </div>
                                @error('city')<div class="alert alert-danger p-2">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Address</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="text" wire:model.live="address"  class="form-control p-0 border-0" > 
                                </div>
                                @error('address')<div class="alert alert-danger p-2">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Route (Main Area)</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="text" wire:model.live="route_main_area"  class="form-control p-0 border-0" > 
                                </div>
                                @error('route_main_area')<div class="alert alert-danger p-2">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Location (Sub Area)</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="text" wire:model.live="location_sub_area"  class="form-control p-0 border-0" > 
                                </div>
                                @error('location_sub_area')<div class="alert alert-danger p-2">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Channel</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="text" wire:model.live="channel"  class="form-control p-0 border-0" > 
                                </div>
                                @error('channel')<div class="alert alert-danger p-2">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Shop Main Type</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="text" wire:model.live="shop_type"  class="form-control p-0 border-0" > 
                                </div>
                                @error('shop_type')<div class="alert alert-danger p-2">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Shop Sub Type</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="text" wire:model.live="shop_sub_type"  class="form-control p-0 border-0" > 
                                </div>
                                @error('shop_sub_type')<div class="alert alert-danger p-2">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <div class="col-sm-12">
                            <button class="btn btn-success" type="submit">Update Shop</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
