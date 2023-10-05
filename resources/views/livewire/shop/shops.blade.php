<div>
    
    <div class="row mb-3">
        <div class="col-sm-6">
            <input wire:model.live="search" type="text"  placeholder="Search Shop" class="form-control">
        </div> 
        <div class="col-sm-6 text-end">
            <a href="{{ route('shops.create') }}" class="btn btn-danger text-white">
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
                                <th class="border-top-0 text-dark">Shop Name</th>
                                <th class="border-top-0  text-dark">Shopkeeper Name</th>
                                <th class="border-top-0  text-dark">Mobile</th>
                                <th class="border-top-0  text-dark">Shop Main Type</th>
                                <th class="border-top-0  text-dark">Shop Sub Type</th>
                                <th class="border-top-0  text-dark">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shops as $shop)                            
                            <tr wire:key = "{{ $shop->id }}">
                                <td>
                                    <a href="{{ route('shops.show', $shop->id) }}">{{ $shop->shop_name }}</a>
                                </td>
                                <td>{{ $shop->shopkeeper_name }}</td>
                                <td>{{ $shop->shopkeeper_mobile }}</td>
                                <td>{{ $shop->shop_type }}</td>
                                <td>{{ $shop->shop_sub_type }}</td>
                                <td>
                                    <a href="{{ route('shops.edit', $shop) }}" class="btn btn-primary">
                                        <i class=" fas fa-pencil-alt me-2"></i>
                                        Edit
                                    </a>
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

</div>
