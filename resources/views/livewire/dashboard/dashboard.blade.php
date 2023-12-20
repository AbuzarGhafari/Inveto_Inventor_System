<div>
    
    
    <div class="row ">

        <div class="col-12">

            <div class="card p-4 mb-3">

                <form wire:submit="filter">

                    @csrf

                    <div class="row">

                        @error('search_period')<div class="alert alert-danger p-2">{{ $message }}</div>@enderror
                        @error('from_date')<div class="alert alert-danger p-2">{{ $message }}</div>@enderror
                        @error('to_date')<div class="alert alert-danger p-2">{{ $message }}</div>@enderror

                        <div class="col-4 d-flex align-items-center">
                            <label for="period" class="me-2 w-25">Search By</label>
                            <select wire:model.live="search_period"  class="form-control">
                                <option value="">Select</option>
                                <option value="last-week">Last Week</option>
                                <option value="last-month">Last Month</option>
                                <option value="all-time">All</option>
                                <option value="custom">Custom Date</option>
                            </select>
                        </div>

                        <div class="col-3 d-flex align-items-center">
                            <label for="from_date" class="form-label me-2">From</label>
                            <input type="date" class="form-control" wire:model.live="from_date">
                        </div>

                        <div class="col-3 d-flex align-items-center">
                            <label for="to_date" class="form-label me-2">To</label>
                            <input type="date" class="form-control" wire:model.live="to_date">
                        </div>

                        <div class="col-2">
                            <input type="submit" class="btn btn-primary" value="Search">
                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>


    {{-- <div class="row">
        <div class="col-12">
            <div class="alert alert-secondary">
                <p class="mb-0">Date: {{ $period }}</p>
            </div>
        </div>
    </div> --}}

    {{-- <pre>
        @php
            var_dump($statistics)
        @endphp
    </pre> --}}

    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Total Orders</h3>
                <ul class="list-inline two-part d-flex align-items-center mb-0">
                    <li class="ms-auto"><span class="counter text-success">{{ $statistics['ordersCount'] }}</span></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Recovered orders</h3>
                <ul class="list-inline two-part d-flex align-items-center mb-0">
                    <li class="ms-auto"><span class="counter text-purple">{{ $statistics['recoveredOrdersCount'] }}</span></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Pending Orders</h3>
                <ul class="list-inline two-part d-flex align-items-center mb-0">
                    <li class="ms-auto"><span class="counter text-danger-dark">{{ $statistics['pendingOrdersCount'] }}</span></li>
                </ul>
            </div>
        </div>
    </div>


    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Ordered Amount</h3>
                <ul class="list-inline two-part d-flex align-items-center mb-0">
                    <li class="ms-auto"><span class="counter text-success">{{ $statistics['totalOrderedAmount'] }}</span></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Recovered Amount</h3>
                <ul class="list-inline two-part d-flex align-items-center mb-0">
                    <li class="ms-auto"><span class="counter text-purple">{{ $statistics['totalRecoveredAmount'] }}</span></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Total Profit</h3>
                <ul class="list-inline two-part d-flex align-items-center mb-0">
                    <li>
                        <p>
                            <span class="text-danger">{{ $statistics['totalBuyAmount'] }}</span>,
                            <span class="text-success ms-2">{{ $statistics['totalSellAmount'] }}</span>
                        </p>
                    </li>
                    <li class="ms-auto"><span class="counter text-success-dark">{{ $statistics['totalProfit'] }}</span></li>
                </ul>
            </div>
        </div>
    </div>
    
</div>
