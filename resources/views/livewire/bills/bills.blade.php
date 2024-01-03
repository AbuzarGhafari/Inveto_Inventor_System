<div>

    <div class="row mb-3">
        <div class="col-sm-6">
            {{-- <input wire:model.live="search" type="text"  placeholder="Search Bill" class="form-control"> --}}
        </div>
        <div class="col-sm-6 text-end">

            {{-- @if ($order_booker_bills & isset($selected_bills)) --}}
                <a target="_blank" wire:click="billsEntry" class="btn btn-success text-white">
                    <i class="fa fa-print me-2" aria-hidden="true"></i>
                    Bills Entry
                </a>
                <a target="_blank" wire:click="salesReport" class="btn btn-success text-white">
                    <i class="fa fa-print me-2" aria-hidden="true"></i>
                    Sales Report
                </a>
            {{-- @endif --}}

            <a href="{{ route('bills.create') }}" class="btn btn-dark">
                <i class="fas fa-plus me-2"></i>
                Generate Bill
            </a>

        </div>
    </div>



    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
 
                <div class="row mb-4">

                    <div class="col-md-4">
                        <div class="d-flex justify-content-between">
                            <p class="m-0">Bills Amount: {{ number_format($bills_amount) }}</p>
                            <p class="mb-0">Recovered: {{ number_format($bills_recovered_amount) }}</p>
                            <p class="mb-0">P/L: {{ number_format($bills_profit_amount) }}</p>
                        </div>
                    </div>

                    <div class="col-md-8"> 

                        <form wire:submit="filter">

                            @csrf

                            <div class="d-flex w-100 justify-content-end bills-filter">

                                <div class="d-flex align-items-center">
                                    <label for="period" class="me-2 mb-0 w-25">Filter By</label>
                                    <select wire:model.defer="search_period" class="form-control">
                                        <option value="">Select</option>
                                        <option value="last-week">Last Week</option>
                                        <option value="last-month">Last Month</option>
                                        <option value="all-time">All</option>
                                        <option value="custom">Custom Date</option>
                                    </select>
                                </div>

                                @if ($search_period === 'custom')
                                    <div class="d-flex align-items-center">
                                        <label for="from_date" class="form-label mb-0 me-2">From</label>
                                        <input type="date" class="form-control" wire:model.defer="from_date">
                                    </div>

                                    <div class="d-flex align-items-center">
                                        <label for="to_date" class="form-label me-2 mb-0">To</label>
                                        <input type="date" class="form-control" wire:model.defer="to_date">
                                    </div>
                                @endif

                                <div class="d-flex align-items-center">
                                    <label for="group_by" class="me-2 mb-0 w-25">Order By</label>
                                    <select wire:model.defer="group_by" class="form-control">
                                        <option value="created_at">Select</option>
                                        <option value="main_area_id">Main Area</option>
                                        <option value="sub_area_id">Sub Area</option>
                                        <option value="shop_id">Shop</option>
                                        <option value="order_booker_id">Order Booker</option>
                                    </select>
                                </div>

                                <input type="submit" class="btn btn-primary" value="Search">

                            </div>

                        </form>
  
                    </div>

                </div>
  

                <div class="d-flex justify-content-between"> 

                    <div class="bills-tabs-btns d-flex">
                        <button wire:click="allBills" class="all {{ $activeTab == 'all' ? 'active' : '' }}">All</button>
                        <button wire:click="pendingBills"
                            class="pending {{ $activeTab == 'pending' ? 'active' : '' }}">Pending</button>
                        <button wire:click="delayedBills"
                            class="delayed {{ $activeTab == 'delayed' ? 'active' : '' }}">Delayed</button>
                        <button wire:click="completedBills"
                            class="completed {{ $activeTab == 'completed' ? 'active' : '' }}">Completed</button>
                    </div>

                    <p>Records Found: {{ $billsCount }}</p>

                </div>
                @if (!$bills->isEmpty())

                    <div class="table-responsive--">
                        <table class="table text-nowrap hovered-action">
                            <thead>
                                <tr>
                                    <th class="border-top-0  text-dark">#</th>
                                    <th class="border-top-0  text-dark">Bill Number</th>
                                    <th class="border-top-0  text-dark">Order Booker</th>
                                    <th class="border-top-0  text-dark">Shop</th>
                                    <th class="border-top-0  text-dark">Bill Amount</th>
                                    <th class="border-top-0  text-dark">P/L</th>
                                    <th class="border-top-0  text-dark">Recovered</th>
                                    <th class="border-top-0  text-dark text-end"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bills as $bill)
                                    <tr class="{{ $bill->is_recovered ? ' ' : 'bill-pending' }}"
                                        wire:key = "{{ $bill->id }}">
                                        <td>
                                            {{-- @if ($order_booker_bills) --}}
                                                <input type="checkbox" id="{{ $bill->id }}"
                                                    name="{{ $bill->id }}" value="{{ $bill->id }}"
                                                    wire:model.defer="selected_bills" />
                                            {{-- @endif --}}
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            <a
                                                href="{{ route('bills.show', $bill->id) }}">{{ $bill->bill_number }}</a>
                                            @if ($bill->recover_bill)
                                                <span class="bill_alert"></span>
                                            @endif
                                            <br>
                                            <span
                                                class="date-sm">{{ \Carbon\Carbon::parse($bill->created_at)->format('d/m/Y g:i:s A') }}</span>
                                        </td>
                                        <td>
                                            {{ $bill->orderBooker->name }}
                                            <br>
                                            <span class="text-sm-light">{{ $bill->mainArea->name }}</span>
                                        </td>

                                        <td>
                                            @isset($bill->shop)
                                                {{ $bill->shop->shop_name }} <br>
                                                <span class="text-sm-light">{{ $bill->shop->shopkeeper_mobile }}</span>
                                            @endisset
                                        </td>
                                        <td>
                                            <span
                                                class="text-info-dark">{{ number_format($bill->final_price, '2', '.', ',') }}</span>
                                            @if ($bill->previous_bill_id)
                                                <br>
                                                <span class="text-danger-dark text-sm">Prv:
                                                    {{ number_format($bill->previous_bill_amount, '2', '.', ',') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span
                                                class="badge badge-secondary">{{ number_format($bill->profitLoss, '2', '.', ',') }}</span>
                                        </td>
                                        <td>
                                            <span
                                                class="text-success-dark">{{ number_format($bill->recovered_amount, '2', '.', ',') }}
                                            </span><br>
                                            @if (!$bill->is_recovered)
                                                @if (!$bill->previous_bill_id)
                                                    <span class="text-sm text-danger-dark">-
                                                        {{ number_format($bill->final_price - $bill->recovered_amount, '2', '.', ',') }}</span>
                                                @else
                                                    <span class="text-sm text-danger-dark">-
                                                        {{ number_format($bill->previous_bill_amount + $bill->final_price - $bill->recovered_amount, '2', '.', ',') }}
                                                    </span>
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-end flex-gap-2 actions">
                                                <a href="{{ route('bills.show', $bill->id) }}"
                                                    class="btn btn-secondary">
                                                    <i class=" fas fa-eye me-2"></i>
                                                    Show
                                                </a>
                                                <a target="_blank" href="{{ route('bills.print', $bill->id) }}"
                                                    class="btn btn-success text-white">
                                                    <i class="fa fa-print" aria-hidden="true"></i>
                                                </a>
                                                <div class="btn-group">
                                                    <button type="button"
                                                        class="btn btn-danger dropdown-toggle dropdown-toggle-split"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <span class="visually-hidden">Toggle Dropdown</span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        @if (!$bill->is_recovered)
                                                            <li><a class="dropdown-item" data-bs-toggle="modal"
                                                                    data-bs-target="#addRecoveryModal"
                                                                    wire:click="selectBill({{ $bill }})"
                                                                    type="button">Add Recovery</a></li>
                                                            <li><a class="dropdown-item" data-bs-toggle="modal"
                                                                    data-bs-target="#fullyRecoveredModal"
                                                                    wire:click="selectBill({{ $bill }})"
                                                                    type="button">Fully Recovered</a></li>
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('bills.createBillWithPreviousBill', $bill) }}">Add
                                                                    in New Bill</a></li>

                                                            <li>
                                                                <hr class="dropdown-divider">
                                                            </li>
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('bills.edit', $bill) }}">Edit
                                                                    Bill</a></li>
                                                        @endif
                                                        <li><a class="dropdown-item" data-bs-toggle="modal"
                                                                data-bs-target="#deleteBillModal"
                                                                wire:click="selectBill({{ $bill }})"
                                                                type="button">Delete Bill</a></li>
                                                    </ul>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                    {{ $bills->links() }}
                @else
                    <div class="alert alert-danger" role="alert">
                        No Record Found!
                    </div>

                @endif

            </div>
        </div>
    </div>



    <!-- Modal -->

    <div wire:ignore.self class="modal fade" id="addRecoveryModal" tabindex="-1" aria-labelledby="addRecoveryLabel"
        aria-hidden="true">
        <form wire:submit="addRecovery">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addRecoveryLabel">Add Recovery</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
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
                        @if ($is_previous_bill)
                            <div class="d-flex justify-content-between ">
                                <p>Previous Bill Amount</p>
                                <p class="text-danger-dark">{{ $previous_bill_amount }}</p>
                            </div>
                        @endif
                        <div class="d-flex justify-content-between ">
                            <p>Recovered Amount</p>
                            <p class="text-success-dark">{{ $recovered_amount }}</p>
                        </div>
                        <div class="d-flex justify-content-between ">
                            <p>Remaining Amount</p>
                            <p class="text-danger-dark">{{ $previous_bill_amount + $remaining_amount }}</p>
                        </div>


                        <input type="number" class="form-control" wire:model.live="recovery_amount"
                            placeholder="Enter Recovered Amount">
                        @error('recovery_amount')
                            <div class="alert alert-danger p-2">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </form>
    </div>


    <div wire:ignore.self class="modal fade" id="fullyRecoveredModal" tabindex="-1"
        aria-labelledby="fullyRecoveredLabel" aria-hidden="true">
        <form wire:submit="fullyRecovered">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 text-danger-dark" id="fullyRecoveredLabel">Is Bill Recovered
                            Fully?</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
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


    <div wire:ignore.self class="modal fade" id="deleteBillModal" tabindex="-1" aria-labelledby="deleteBillLabel"
        aria-hidden="true">
        <form wire:submit="deleteBill">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title text-danger fs-5" id="deleteBillLabel">Delete Bill</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-danger mb-2">Are you sure?</p>
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
                        @if ($is_previous_bill)
                            <div class="d-flex justify-content-between ">
                                <p>Previous Bill Amount</p>
                                <p class="text-danger-dark">{{ $previous_bill_amount }}</p>
                            </div>
                        @endif
                        <div class="d-flex justify-content-between ">
                            <p>Recovered Amount</p>
                            <p class="text-success-dark">{{ $recovered_amount }}</p>
                        </div>
                        <div class="d-flex justify-content-between ">
                            <p>Remaining Amount</p>
                            <p class="text-danger-dark">{{ $previous_bill_amount + $remaining_amount }}</p>
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
