<div>
    
    <div class="row mb-3">
        <div class="col-sm-6">
            <input wire:model.live="search" type="text"  placeholder="Search Bill" class="form-control">
        </div> 
        <div class="col-sm-6 text-end">
            <a href="{{ route('bills.create') }}" class="btn btn-dark">
                <i class="fas fa-plus me-2"></i>
                Generate Bill
            </a>
        </div>
    </div>


</div>
