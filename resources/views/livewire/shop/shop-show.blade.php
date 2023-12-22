<div>

    
    <div class="d-flex justify-content-end mb-2"> 
        <button  wire:click="toggleDetails" class="btn btn-info text-white">
            <i class="fas fa-eye me-2"></i>
            Toggle Details
        </button>
    </div>

    @if ($detailsShown)
        
        <div class="card p-4 bg-light">


            <div class="row mb-0">
                
                <div class="col-sm-6">

                    <div class="white-box mb-0">
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="border-top-0 text-dark fw-bold">Shop Name</p>
                            </div>
                            <div class="col-sm-8 text-end">
                                <p>{{ $shop->shop_name }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="border-top-0  text-dark fw-bold">Shopkeeper Name</p>
                            </div>
                            <div class="col-sm-8 text-end">
                                <p>{{ $shop->shopkeeper_name }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="border-top-0  text-dark fw-bold">Shopkeeper Mobile</p>
                            </div>
                            <div class="col-sm-8 text-end">
                                <p>{{ $shop->shopkeeper_mobile }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="border-top-0  text-dark fw-bold">City</p>
                            </div>
                            <div class="col-sm-8 text-end">
                                <p>{{ $shop->city }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="border-top-0  text-dark fw-bold">Address</p>
                            </div>
                            <div class="col-sm-8 text-end">
                                <p>{{ $shop->address }}</p>
                            </div>
                        </div>
        

                    </div>

                </div>
                <div class="col-sm-6">

                    <div class="white-box mb-0">
                        
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="border-top-0  text-dark fw-bold">Channel</p>
                            </div>
                            <div class="col-sm-8 text-end">
                                <p>{{ $shop->channel }}</p>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-4">
                                <p class="border-top-0  text-dark fw-bold">Main Area</p>
                            </div>
                            <div class="col-sm-8 text-end">
                                @isset($shop->area)
                                    <span class="badge bg-info">{{ $shop->area->name }}</span>                             
                                @else 
                                    <span class="badge text-light bg-secondary">--</span>
                                @endisset
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <p class="border-top-0  text-dark fw-bold">Sub Area</p>
                            </div>
                            <div class="col-sm-8 text-end">
                                @isset($shop->subarea)                    
                                    <span class="badge bg-info">{{ $shop->subarea->name }}</span>                             
                                @else
                                    <span class="badge text-light bg-secondary">--</span>
                                @endisset
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <p class="border-top-0  text-dark fw-bold">Main type</p>
                            </div>
                            <div class="col-sm-8 text-end"> 
                                @isset($shop->shopMainType)
                                    <span class="badge bg-info">{{ $shop->shopMainType->name }}</span>                             
                                @else 
                                    <span class="badge text-light bg-secondary">--</span>
                                @endisset
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <p class="border-top-0  text-dark fw-bold">Sub Type</p>
                            </div>
                            <div class="col-sm-8 text-end"> 
                                @isset($shop->shopSubType)
                                    <span class="badge bg-info">{{ $shop->shopSubType->name }}</span>                             
                                @else 
                                    <span class="badge text-light bg-secondary">--</span>
                                @endisset
                            </div>
                        </div>



                    </div>

                </div>
            </div>

        </div>
    
    @endif
</div>
