<div>
    <div class="row mb-3">
        <div class="col-sm-6">
            <input wire:model.live="search" type="text"  placeholder="Search Order Booker" class="form-control">
        </div> 
        <div class="col-sm-6 text-end">
            <a href="{{ route('order-bookers.create') }}" class="btn btn-danger text-white">
                <i class="fas fa-plus me-2"></i>
                Add Order Booker
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
                                <th class="border-top-0  text-dark">Name</th>
                                <th class="border-top-0  text-dark">Mobile</th>
                                <th class="border-top-0  text-dark">Area</th>
                                <th class="border-top-0  text-dark">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderBookers as $booker)                            
                            <tr wire:key = "{{ $booker->sku_code }}">
                                <td>
                                    <a href="{{ route('order-bookers.show', $booker->id) }}">{{ $booker->name }}</a>
                                </td>
                                <td>{{ $booker->mobile }}</td>
                                <td>{{ $booker->area }}</td>
                                <td>
                                    <a href="{{ route('order-bookers.edit', $booker->id) }}" class="btn btn-primary">
                                        <i class=" fas fa-pencil-alt me-2"></i>
                                        Edit
                                    </a>                                    
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                            
                {{ $orderBookers->links() }}
            </div>
        </div>
    </div>

</div>
