<div class="row mb-3">

    <div class="col-sm-12">
        
        <div class="white-box">
            
            <div class="d-flex align-items-center justify-content-between mb-4 bg-info p-2">

                <p class="fw-bold text-light m-0">Bill Number: {{ $form->bill_number }}</p>

                <div wire:click="addInput" class="btn btn-dark">Add Entry</div>
            </div>

            <form class="form-horizontal form-material" wire:submit="save">
                @csrf

                <div class="row">
                    <div class="col-sm-6">
                        
                        <p>Bill Number: {{ $bill->bill_number }}</p>
                        <p>Bill Date: {{ \Carbon\Carbon::parse($bill->created_at)->format('d/m/Y g:i:s A')}}  </p>
                        
                    </div>
                    <div class="col-sm-6 text-end">
                        
                        <p>Order Booker: {{ $bill->orderBooker->name }}</p>
                        <p>Shop Name: {{ $bill->shop->shop_name }}</p>
                        <p>Shopkeeper Name: {{ $bill->shop->shopkeeper_name }}</p>
                        
                    </div>
                </div> 

                
                @if($isCountErrors)
                <div class="alert alert-danger" role="alert">
                    <ul class="mb-0">
                        @foreach ($errorMsg as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                
                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                            <tr> 
                                <th></th>
                                <th class="border-top-0  text-dark">#</th>
                                <th class="border-top-0  text-dark">SKU Code</th> 
                                <th class="border-top-0  text-dark" style="width: 30px;">No. Cottons</th> 
                                <th class="border-top-0  text-dark" style="width: 30px;">No. Pieces</th> 
                                <th class="border-top-0  text-dark">Assign Price</th> 
                                <th class="border-top-0  text-dark">Cottons Price</th> 
                                <th class="border-top-0  text-dark">Pieces Price</th> 
                                <th class="border-top-0  text-dark">Total Price</th> 
                                <th class="border-top-0  text-dark">Discount</th> 
                                <th class="border-top-0  text-dark w-10 text-end">Final Price</th>  
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($inputs as $key => $input)
                            <tr>
                                <td>
                                    @if($key > 0) <div wire:click="removeInput({{$key}})" class="btn btn-sm btn-danger text-white"><i class="fa fa-times"></i></div> @endif
                                </td>
                                <td>{{ $key+1 }}</td>
                                
                                <td>
                                    <div>
                                        <div class="border-bottom p-0">                                    
                                            <input type="text" id="input_{{$key}}_sku_code"   wire:model.blur="inputs.{{$key}}.sku_code"   class="form-control p-0 border-0">                                
                                            @error('inputs.'.$key.'.sku_code')<div class="alert alert-danger p-2">{{ $message }}</div>@enderror
                                        </div>

                                        @isset($inputs[$key]['product_name'])
                                            <span class="text-sm">
                                                {{  $inputs[$key]['product_name'] }} 
                                            </span>, 
                                            <span class="text-sm">
                                                {{  $inputs[$key]['distributor_prices'] }} 
                                            </span>
                                        @endisset
                                    </div>
                                </td> 
                                <td> 
                                    <div>
                                        <input type="number" id="input_{{$key}}_no_of_cottons"  wire:model.blur="inputs.{{$key}}.no_of_cottons"   class="form-control p-0 border-0">                                
                                        @error('inputs.'.$key.'.no_of_cottons')<div class="alert alert-danger p-2">{{ $message }}</div>@enderror
                                    </div>
                                </td>
                                <td> 
                                    <div>
                                        <input type="number" id="input_{{$key}}_no_of_pieces"  wire:model.blur="inputs.{{$key}}.no_of_pieces"   class="form-control  p-0 border-0">                                
                                        @error('inputs.'.$key.'.no_of_pieces')<div class="alert alert-danger p-2">{{ $message }}</div>@enderror
                                    </div>
                                </td>
                                <td class="text-end">
                                    <input type="text" class="form-control text-end" wire:model.blur="inputs.{{$key}}.assigned_price" />
                                    @error('inputs.'.$key.'.assigned_price')<div class="alert alert-danger p-2">{{ $message }}</div>@enderror
                                </td>
                                <td class="text-end">
                                    <input type="text" readonly class="form-control text-end" wire:model.live="inputs.{{$key}}.cottons_price" />
                                </td>
                                <td class="text-end ">
                                    <input type="text" readonly class="form-control text-end" wire:model.live="inputs.{{$key}}.peices_price" />
                                </td>
                                <td class="text-end ">
                                    <input type="text" readonly class="form-control text-end" wire:model.live="inputs.{{$key}}.total_price" />
                                </td>
                                <td>                                    
                                    <div>
                                        <input type="number" id="input_{{$key}}_discount"  wire:model.blur="inputs.{{$key}}.discount"   class="form-control  p-0 border-0">                                
                                        @error('inputs.'.$key.'.discount')<div class="alert alert-danger p-2">{{ $message }}</div>@enderror
                                    </div>
                                </td>
                                <td class="text-end">
                                    <input type="text" readonly class="form-control text-end" wire:model.live="inputs.{{$key}}.final_price" />
                                </td>
                            </tr> 
                            @endforeach
                            <tr>
                                <td colspan="3" class="fw-bold">Buying Price</td>
                                <td colspan="3" class=" fw-bold">{{ number_format($buyingPrice, '2', '.', ',') }}</td>
                                <td colspan="3" class="text-end fw-bold">Actual Price</td>
                                <td colspan="3" class="text-end fw-bold">{{ $form->actual_price }}</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="fw-bold">Selling Price</td>
                                <td colspan="3" class=" fw-bold">{{ number_format($sellingPrice, '2', '.', ',') }}</td>
                                <td colspan="3" class="text-end fw-bold">Total Discount</td>
                                <td colspan="3" class="text-end fw-bold">{{ $form->discount }}</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="fw-bold">Profit/Loss</td>
                                <td colspan="3" class=" fw-bold">{{ number_format($profitLoss, '2', '.', ',') }}</td>
                                <td colspan="3" class="text-end fw-bold">Final Price</td>
                                <td colspan="3" class="text-end fw-bold">{{ $form->final_price }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div> 
                                    
                <div class="form-group mb-4">
                    <div class="col-sm-12 text-end">
                        <button class="btn btn-success" type="submit">Update Bill</button>
                    </div>
                </div>
            </form>
            
        </div>

    </div>

</div>