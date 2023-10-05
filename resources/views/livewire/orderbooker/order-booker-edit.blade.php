<div class="row mb-3">
    <div class="col-sm-12">
        
        <div class="card">
            <div class="card-body">
                <form class="form-horizontal form-material" wire:submit="save">
                    @csrf
                    <div class="form-group mb-4">
                        <label class="col-md-12 p-0">Order Booker Name</label>
                        <div class="col-md-12 border-bottom p-0">
                            <input type="text" wire:model.live="form.name" class="form-control p-0 border-0" > 
                        </div>
                        @error('form.name')<div class="alert alert-danger p-2">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group mb-4">
                        <label class="col-md-12 p-0">Order Booker Mobile Number</label>
                        <div class="col-md-12 border-bottom p-0">
                            <input type="text"  wire:model.live="form.mobile" class="form-control p-0 border-0"  > 
                        </div>
                        @error('form.mobile')<div class="alert alert-danger p-2">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group mb-4">
                        <label class="col-md-12 p-0">Order Booker Area</label>
                        <div class="col-md-12 border-bottom p-0">
                            <input type="text"  wire:model.live="form.area" class="form-control p-0 border-0" > 
                        </div>
                        @error('form.area')<div class="alert alert-danger p-2">{{ $message }}</div>@enderror
                    </div>
                                        
                    <div class="form-group mb-4">
                        <div class="col-sm-12">
                            <button class="btn btn-success" type="submit">Update Order Booker</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>