<div class="row mb-3">
    <div class="col-sm-12">
        
        <div class="card">
            <div class="card-body">
                
                <div class="d-flex align-items-center justify-content-between mb-4 bg-info p-2">

                    <p class="fw-bold text-light m-0">Bill Number: {{ $form->bill_number }}</p>

                    <div wire:click="addInput" class="btn btn-dark">Add Entry</div>
                </div>

                <form class="form-horizontal form-material" wire:submit="{{ !$add_previous_bill ? 'save': 'createBillWithPreviousBill' }}">
                    @csrf

                    @if (!$add_previous_bill)
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Select Order Booker</label>
                                <div class="col-md-12 border-bottom p-0">                                    
                                    <select wire:model.live="form.order_booker_id"   class="form-control p-0 border-0">
                                        <option value="">Select Order Booker</option>
                                        @foreach ($orderBookers as $ob)
                                            <option value="{{ $ob->id }}">{{ $ob->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('form.order_booker_id')<div class="alert alert-danger p-2">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group mb-4"> 
                                <label class="col-md-12 p-0">Select Main Area</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <select wire:model.live="form.main_area_id"   class="form-control p-0 border-0">
                                        <option value="">Select Main Area</option>
                                        @isset($mainAreas)
                                            @foreach ($mainAreas as $oba)
                                                <option value="{{ $oba->id }}">{{ $oba->name }}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                </div>
                                @error('form.main_area_id')<div class="alert alert-danger p-2">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Select Sub Area</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <select wire:model.live="form.sub_area_id"   class="form-control p-0 border-0">
                                        <option value="">Select Sub Area</option>
                                        @isset($subAreas)
                                            @foreach ($subAreas as $oba)
                                                <option value="{{ $oba->id }}">{{ $oba->name }}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                </div>
                                @error('form.sub_area_id')<div class="alert alert-danger p-2">{{ $message }}</div>@enderror
                            </div>

                        </div>
                        <div class="col-sm-3">
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Select Shop</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <select wire:model.live="form.shop_id"   class="form-control p-0 border-0">
                                        <option value="">Select Shop</option>
                                        @isset($shops)
                                            @foreach ($shops as $oba)
                                                <option value="{{ $oba->id }}">{{ $oba->shop_name }}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                </div>
                                @error('form.shop_id')<div class="alert alert-danger p-2">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div> 
                    @endif

                    @if ($add_previous_bill)
                    <div class="row">
                        <div class="col-sm-6">
                            
                            <p>Previous Bill Number: {{ $previousBill->bill_number }}</p>
                            <p>Bill Date: {{ \Carbon\Carbon::parse($previousBill->created_at)->format('d/m/Y g:i:s A')}}  </p>
                            <p>Pending Bill Amount: <span class="text-danger-dark">{{ $previousBill->previous_bill_amount + $previousBill->final_price - $previousBill->recovered_amount }}</span></p>
                            
                        </div>
                        <div class="col-sm-6 text-end">
                            
                            <p>Order Booker: {{ $previousBill->orderBooker->name }}</p>
                            <p>Shop Name: {{ $previousBill->shop->shop_name }}</p>
                            <p>Shopkeeper Name: {{ $previousBill->shop->shopkeeper_name }}</p>
                            
                        </div>
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
                                            <select id="input_{{$key}}_product_id"  wire:model.live="inputs.{{$key}}.product_id"   class="form-control p-0 border-0">
                                                <option value="">Select SKU Code</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->sku_code }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('inputs.'.$key.'.product_id')<div class="alert alert-danger p-2">{{ $message }}</div>@enderror

                                        @isset($inputs[$key]['product_name'])
                                            <span class="text-sm">
                                                {{  $inputs[$key]['product_name'] }} 
                                            </span>, 
                                            <span class="text-sm">
                                                {{  $inputs[$key]['distributor_prices'] }} 
                                            </span>
                                        @endisset
                                        {{-- <input type="text" readonly class="form-control px-0 " wire:model.live="inputs.{{$key}}.product_name" />
                                        <input type="text" readonly class="form-control px-0" wire:model.live="inputs.{{$key}}.distributor_prices" /> --}}
                                    </div>
                                </td> 
                                <td> 
                                    <div>
                                        <input type="number" id="input_{{$key}}_no_of_cottons"  wire:model.live.debounce.500ms="inputs.{{$key}}.no_of_cottons"   class="form-control p-0 border-0">                                
                                        @error('inputs'.$key.'.no_of_cottons')<div class="alert alert-danger p-2">{{ $message }}</div>@enderror
                                    </div>
                                </td>
                                <td> 
                                    <div>
                                        <input type="number" id="input_{{$key}}_no_of_pieces"  wire:model.live.debounce.500ms="inputs.{{$key}}.no_of_pieces"   class="form-control  p-0 border-0">                                
                                        @error('inputs'.$key.'.no_of_pieces')<div class="alert alert-danger p-2">{{ $message }}</div>@enderror
                                    </div>
                                </td>
                                <td class="text-end">
                                    <input type="text" class="form-control text-end" wire:model.live.debounce.500ms="inputs.{{$key}}.assigned_price" />
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
                                        <input type="number" id="input_{{$key}}_discount"  wire:model.live.debounce.500ms="inputs.{{$key}}.discount"   class="form-control  p-0 border-0">                                
                                        @error('inputs'.$key.'.discount')<div class="alert alert-danger p-2">{{ $message }}</div>@enderror
                                    </div>
                                </td>
                                <td class="text-end">
                                    <input type="text" readonly class="form-control text-end" wire:model.live="inputs.{{$key}}.final_price" />
                                </td>
                            </tr> 
                            @endforeach
                            <tr>
                                <td colspan="9" class="text-end fw-bold">Actual Price</td>
                                <td colspan="3" class="text-end fw-bold">{{ $form->actual_price }}</td>
                            </tr>
                            <tr>
                                <td colspan="9" class="text-end fw-bold">Total Discount</td>
                                <td colspan="3" class="text-end fw-bold">{{ $form->discount }}</td>
                            </tr>
                            <tr>
                                <td colspan="9" class="text-end fw-bold">Final Price</td>
                                <td colspan="3" class="text-end fw-bold">{{ $form->final_price }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>


                    

                    
                    
                     
 
                                        
                    <div class="form-group mb-4">
                        <div class="col-sm-12 text-end">
                            <button class="btn btn-success" type="submit">Generate Bill</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>