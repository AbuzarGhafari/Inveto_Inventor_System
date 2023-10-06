
<div class="row mb-3">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <form class="form-horizontal form-material" wire:submit="save">
                    @csrf

                    <div class="row mb-4">
                        <div class="col-sm-4">
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Shop Name</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="text" wire:model.live="form.shop_name"  class="form-control p-0 border-0" > 
                                </div>
                                @error('form.shop_name')<div class="alert alert-danger p-2">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Shopkeeper Name</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="text" wire:model.live="form.shopkeeper_name"  class="form-control p-0 border-0" > 
                                </div>
                                @error('form.shopkeeper_name')<div class="alert alert-danger p-2">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Shopkeeper Mobile</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="text" wire:model.live="form.shopkeeper_mobile"  class="form-control p-0 border-0" > 
                                </div>
                                @error('form.shopkeeper_mobile')<div class="alert alert-danger p-2">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-4">
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">City</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="text" wire:model.live="form.city"  class="form-control p-0 border-0" > 
                                </div>
                                @error('form.city')<div class="alert alert-danger p-2">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Address</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="text" wire:model.live="form.address"  class="form-control p-0 border-0" > 
                                </div>
                                @error('form.address')<div class="alert alert-danger p-2">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Channel</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="text" wire:model.live="form.channel"  class="form-control p-0 border-0" > 
                                </div>
                                @error('form.channel')<div class="alert alert-danger p-2">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

 
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Shop Main Type</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="text" wire:model.live="form.shop_type"  class="form-control p-0 border-0" > 
                                </div>
                                @error('form.shop_type')<div class="alert alert-danger p-2">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Shop Sub Type</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="text" wire:model.live="form.shop_sub_type"  class="form-control p-0 border-0" > 
                                </div>
                                @error('form.shop_sub_type')<div class="alert alert-danger p-2">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <div class="form-group mb-4"> 
                                <label class="col-md-12 p-0">Route (Main Area)</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <select  wire:model.live="form.main_area"   class="form-control p-0 border-0" >
                                        <option value="">Select Area</option>
                                        @foreach ($areas as $area)
                                            <option value="{{ $area->id }}">{{ $area->name }}</option>
                                        @endforeach 
                                    </select>
                                </div>
                                @error('form.main_area')<div class="alert alert-danger p-2">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-sm-6"> 
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Location (Sub Area)</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <select  wire:model.live="form.sub_area" class="form-control p-0 border-0" >
                                        <option value="">Select Sub Area</option>
                                        @foreach ($subAreas as $sa)
                                            <option value="{{ $sa->id }}">{{ $sa->name }}</option>
                                        @endforeach 
                                    </select>
                                </div>
                                @error('form.sub_area')<div class="alert alert-danger p-2">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <div class="col-sm-12">
                            <button class="btn btn-success" type="submit">Add Shop</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
