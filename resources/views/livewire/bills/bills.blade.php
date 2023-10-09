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
                                <th class="border-top-0  text-dark">Shop</th>
                                <th class="border-top-0  text-dark">Bill Amount</th> 
                                <th class="border-top-0  text-dark">Recovered</th> 
                                <th class="border-top-0  text-dark text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bills as $bill)                            
                            <tr class="{{ $bill->is_recovered ? 'bill-completed' : 'bill-pending' }}" wire:key = "{{ $bill->id }}">
                                <td>{{ $loop->iteration }} </td>
                                <td>
                                    <a href="{{ route('bills.show', $bill->id) }}">{{ $bill->bill_number }}</a> 
                                    @if ($bill->recover_bill)
                                        <span class="bill_alert"></span> 
                                    @endif 
                                    <br>
                                    <span class="date-sm">{{ \Carbon\Carbon::parse($bill->created_at)->format('d/m/Y g:i:s A')}}</span>
                                </td>
                                <td>
                                    {{ $bill->orderBooker->name }}
                                    <br>
                                    <span class="text-sm-light">{{ $bill->mainArea->name }}</span>
                                </td>
                                
                                <td>
                                    {{ $bill->shop->shop_name }} <br>
                                    <span class="text-sm-light">{{ $bill->shop->shopkeeper_mobile }}</span>
                                </td>
                                <td>
                                    <span class="text-info-dark">{{ $bill->final_price }}</span>
                                </td>
                                <td>
                                    <span class="text-success-dark">{{ $bill->recovered_amount }} </span><br>
                                    @if (!$bill->is_recovered)
                                    <span class="text-sm text-danger-dark">- {{ $bill->final_price - $bill->recovered_amount }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-end flex-gap-2">
                                        <a href="{{ route('bills.show', $bill->id) }}" class="btn btn-secondary">
                                            <i class=" fas fa-eye me-2"></i>
                                            Show
                                        </a>    
                                        @if (!$bill->is_recovered)
                                            <button data-bs-toggle="modal" data-bs-target="#addRecoveryModal" wire:click="selectBill({{ $bill }})"   class="btn btn-info text-light">
                                                <i class="fa fa-plus-circle me-2" aria-hidden="true"></i>
                                                Add Recovery
                                            </button>                                    
                                        @endif                                
                                        <a target="_blank" href="{{ route('bills.print', $bill->id) }}" class="btn btn-success text-white">
                                            <i class="fa fa-print me-2" aria-hidden="true"></i>                                            
                                        </a>                                    
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


    
  <!-- Modal -->
  
  <div  wire:ignore.self class="modal fade" id="addRecoveryModal" tabindex="-1" aria-labelledby="addRecoveryLabel" aria-hidden="true">
    <form wire:submit="addRecovery">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addRecoveryLabel">Add Recovery</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">  
                @csrf
                <div class="d-flex justify-content-between ">
                    <p>Bill Number</p>
                    <p>{{ $bill_number }}</p>
                </div>
                <div class="d-flex justify-content-between ">
                    <p>Order Booker</p>
                    <p>{{ $order_booker }}</p>
                </div>
                <div class="d-flex justify-content-between ">
                    <p>Bill Amount</p>
                    <p class="text-info-dark">{{ $bill_amount }}</p>
                </div>
                <div class="d-flex justify-content-between ">
                    <p>Recovered Amount</p>
                    <p class="text-success-dark">{{ $recovered_amount }}</p>
                </div>
                <div class="d-flex justify-content-between ">
                    <p>Remaining Amount</p>
                    <p class="text-danger-dark">{{ $remaining_amount }}</p>
                </div>
 

                <input type="number"   class="form-control" wire:model.live="recovery_amount" placeholder="Enter Recovered Amount">
                @error('recovery_amount')<div class="alert alert-danger p-2">{{ $message }}</div>@enderror

            </div>
            <div class="modal-footer">
                <button data-bs-toggle="modal" data-bs-target="#fullyRecoveredModal"  class="btn btn-secondary me-auto "> Fully Recovered</button>  
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        </div>
    </form>
  </div>

  
  <div  wire:ignore.self class="modal fade" id="fullyRecoveredModal" tabindex="-1" aria-labelledby="fullyRecoveredLabel" aria-hidden="true">
    <form wire:submit="fullyRecovered">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-danger-dark" id="fullyRecoveredLabel">Is Bill Recovered Fully?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">  
                @csrf
                <div class="d-flex justify-content-between ">
                    <p>Bill Number</p>
                    <p>{{ $bill_number }}</p>
                </div>
                <div class="d-flex justify-content-between ">
                    <p>Order Booker</p>
                    <p>{{ $order_booker }}</p>
                </div>
                <div class="d-flex justify-content-between ">
                    <p>Bill Amount</p>
                    <p class="text-info-dark">{{ $bill_amount }}</p>
                </div>
                <div class="d-flex justify-content-between ">
                    <p>Recovered Amount</p>
                    <p class="text-success-dark">{{ $recovered_amount }}</p>
                </div>
                <div class="d-flex justify-content-between ">
                    <p>Remaining Amount</p>
                    <p class="text-danger-dark">{{ $remaining_amount }}</p>
                </div>
 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        </div>
    </form>
  </div>
  

</div>
