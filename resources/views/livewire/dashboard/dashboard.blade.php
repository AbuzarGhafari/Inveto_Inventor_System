@push('scripts')
    <script>
        let ordersChart;

        function ordersChartShow(statistics) {

            var ctx = document.getElementById('ordersChart').getContext('2d');

            ordersChart = new Chart(
                ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Recovered Orders', 'Pending Orders'],
                        datasets: [{
                            label: 'Orders',
                            data: [statistics.recoveredOrdersCount, statistics.pendingOrdersCount],
                            backgroundColor: ['rgba(0, 205, 0, 0.5)', 'rgba(254, 0, 0, 0.5)', 'rgba(255, 205, 86, 0.5)'],
                            borderColor: ['rgba(0, 205, 0, 1)', 'rgba(254, 0, 0, 1)', 'rgba(255, 205, 86, 1)'],
                            hoverOffset: 4
                        }, ]
                    },
                    options: {
                        responsive: true,
                    }
                }
            );

        }

        let paymentsChart;

        function paymentsChartShow(statistics) {

            var ctx = document.getElementById('paymentsChart').getContext('2d');
            const labels = ['Buying Amount', 'Selling Amount', 'Bills Amount',  'Pending Amount','Recovered Amount', 'Profit' ];

            let statisticsData = [
                statistics.totalBuyAmount, 
                statistics.totalSellAmount, 
                statistics.totalOrderedAmount, 
                statistics.totalPendingAmount, 
                statistics.totalRecoveredAmount, 
                statistics.totalProfit
            ];

            const data = {
                labels: labels,
                datasets: [{
                    label: 'Payments',
                    data: statisticsData,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.75)',
                        'rgba(255, 159, 64, 0.75)',
                        'rgba(255, 50, 50, 0.75)',
                        'rgba(75, 192, 192, 0.75)',
                        'rgba(10, 255, 10, 0.75)',
                        'rgba(0, 202, 5, 0.75)',
                        'rgba(201, 203, 207, 0.75)'
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 50, 50)',
                        'rgb(75, 192, 192)',
                        'rgb(10, 255, 10)',
                        'rgb(0, 202, 5)',
                        'rgb(201, 203, 207)'
                    ],
                    borderWidth: 1
                }]
            };

            paymentsChart = new Chart(
                ctx, {
                    type: 'bar',
                    data: data,
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    },
                }
            );

        }

        Livewire.on('ordersChartupdate', data => {
            newData = data[0].statistics;
            ordersChart.destroy();
            ordersChartShow(newData);
            ordersChart.update();
        });

        Livewire.on('paymentsChartupdate', data => {
            newData = data[0].statistics;
            paymentsChart.destroy();
            paymentsChartShow(newData);
            paymentsChart.update();
        });
        
        ordersChartShow(@json($statistics));

        paymentsChartShow(@json($statistics));
        

    </script>
@endpush


<div>

    <div class="row ">

        <div class="col-12">

            <div class="mb-4">

                <form wire:submit="filter">

                    @csrf

                    <div class="row justify-content-end">

                        @error('search_period')
                            <div class="alert alert-danger p-2">{{ $message }}</div>
                        @enderror
                        @error('from_date')
                            <div class="alert alert-danger p-2">{{ $message }}</div>
                        @enderror
                        @error('to_date')
                            <div class="alert alert-danger p-2">{{ $message }}</div>
                        @enderror

                        <div class="col-4 d-flex align-items-center">
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
                            <div class="col-3 d-flex align-items-center">
                                <label for="from_date" class="form-label mb-0 me-2">From</label>
                                <input type="date" class="form-control" wire:model.defer="from_date">
                            </div>

                            <div class="col-3 d-flex align-items-center">
                                <label for="to_date" class="form-label me-2 mb-0">To</label>
                                <input type="date" class="form-control" wire:model.defer="to_date">
                            </div>
                        @endif

                        <div class="col-1">
                            <input type="submit" class="btn btn-primary" value="Search">
                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

    <div class="row mb-4">
        <div class="col-lg-6 col-md-12">
            <div class="analytics-card mb-4">
                <p class="title mb-4">Total Orders</p>
                <p class="value mb-4" >{{ $statistics['ordersCount'] }}</p>
                <div class="d-flex align-items-center justify-content-between">

                    <div class="d-flex">
                        <div class="me-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                style="fill: rgb(230, 2, 2);transform: ;msFilter:;">
                                <path
                                    d="M11.178 19.569a.998.998 0 0 0 1.644 0l9-13A.999.999 0 0 0 21 5H3a1.002 1.002 0 0 0-.822 1.569l9 13z">
                                </path>
                            </svg>
                            <span class=" ms-2" title="Pending Orders">{{ $statistics['pendingOrdersCount'] }}</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                style="fill: rgb(0, 235, 74);transform: ;msFilter:;">
                                <path
                                    d="M3 19h18a1.002 1.002 0 0 0 .823-1.569l-9-13c-.373-.539-1.271-.539-1.645 0l-9 13A.999.999 0 0 0 3 19z">
                                </path>
                            </svg>
                            <span class="ms-2" title="Recovered Orders">{{ $statistics['recoveredOrdersCount'] }}</span>
                        </div>
                    </div>

                </div>
            </div>

            <div class="analytics-card orders-chart">
                <canvas id="ordersChart"></canvas>
            </div>
        </div>

        <div class="col-lg-6 col-md-12">
            <div class="analytics-card mb-4">
                <h3 class="title mb-4">Total Profit</h3>
                <p class="value mb-4">{{ $statistics['totalProfit_format']  }}</p>
                <div class="d-flex align-items-center justify-content-between">

                    <div class="d-flex">
                        <div class="me-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                style="fill: rgb(230, 2, 2);transform: ;msFilter:;">
                                <path
                                    d="M11.178 19.569a.998.998 0 0 0 1.644 0l9-13A.999.999 0 0 0 21 5H3a1.002 1.002 0 0 0-.822 1.569l9 13z">
                                </path>
                            </svg>
                            <span class=" ms-2" title="Totay Buing Amount">{{ $statistics['totalBuyAmount_format'] }}</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                style="fill: rgb(0, 235, 74);transform: ;msFilter:;">
                                <path
                                    d="M3 19h18a1.002 1.002 0 0 0 .823-1.569l-9-13c-.373-.539-1.271-.539-1.645 0l-9 13A.999.999 0 0 0 3 19z">
                                </path>
                            </svg>
                            <span class="ms-2" title="Total Selling Amount">{{ $statistics['totalSellAmount_format'] }}</span>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="me-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                style="fill: rgb(230, 2, 2);transform: ;msFilter:;">
                                <path
                                    d="M11.178 19.569a.998.998 0 0 0 1.644 0l9-13A.999.999 0 0 0 21 5H3a1.002 1.002 0 0 0-.822 1.569l9 13z">
                                </path>
                            </svg>
                            <span class=" ms-2" title="Total Ordered Amount">{{ $statistics['totalOrderedAmount_format'] }}</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                style="fill: rgb(0, 235, 74);transform: ;msFilter:;">
                                <path
                                    d="M3 19h18a1.002 1.002 0 0 0 .823-1.569l-9-13c-.373-.539-1.271-.539-1.645 0l-9 13A.999.999 0 0 0 3 19z">
                                </path>
                            </svg>
                            <span class="ms-2" title="Total Recovered Amount">{{ $statistics['totalRecoveredAmount_format'] }}</span>
                        </div>
                    </div>

                </div>
            </div>

            <div class="analytics-card orders-chart">
                <canvas id="paymentsChart"></canvas>
            </div>
        </div>

    </div>





</div>
