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


    
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                
                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                            <tr> 
                                <th class="border-top-0  text-dark">#</th>
                                <th class="border-top-0  text-dark">Bill Number</th>
                                <th class="border-top-0  text-dark">Order Booker</th>
                                <th class="border-top-0  text-dark">Area</th>
                                <th class="border-top-0  text-dark">Shop</th>
                                <th class="border-top-0  text-dark">Bill Amount</th> 
                                <th class="border-top-0  text-dark">Recovered</th> 
                                <th class="border-top-0  text-dark text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bills as $bill)                            
                            <tr wire:key = "{{ $bill->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td><a href="{{ route('order-bookers.show', $bill->id) }}">{{ $bill->bill_number }}</a></td>
                                <td>{{ $bill->orderBooker->name }}</td>
                                <td>{{ $bill->mainArea->name }}</td>
                                <td>{{ $bill->shop->shop_name }}</td>
                                <td>{{ $bill->final_price }}</td>
                                <td>{{ $bill->recovered_amount }}</td>
                                <td>
                                    <div class="d-flex justify-content-end flex-gap-2">
                                        <a href="{{ route('bills.show', $bill->id) }}" class="btn btn-secondary">
                                            <i class=" fas fa-eye me-2"></i>
                                            Show
                                        </a>                                    
                                        {{-- <a href="{{ route('bills.edit', $bill->id) }}" class="btn btn-primary">
                                            <i class=" fas fa-pencil-alt me-2"></i>
                                            Edit
                                        </a>                                     --}}
                                    </div>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                            
                {{ $bills->links() }}
            </div>
        </div>
    </div>

</div>
