<div>
    <div class="row mb-3">
        <div class="col-sm-6">
            <input wire:model.live="search" type="text"  placeholder="Search Product" class="form-control">
        </div> 
        <div class="col-sm-6 text-end">
            <a target="_blank" wire:click="stockPDF" class="btn btn-success text-white">
                <i class="fa fa-print me-2" aria-hidden="true"></i>
                Print Stock
            </a>
            <a href="{{ route('products.create') }}" class="btn btn-danger text-white">
                <i class="fas fa-plus me-2"></i>
                Add Product
            </a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">

                <div class="d-flex justify-content-between">
                    <p>Records Found: {{ $productsCount }}</p>
                    <p>Stock Amount: <span class="text-danger fw-bold">{{ number_format($total_stock_amount, 2) }}</span></p>
                </div>
                
                <div class="">
                    <table class="table hovered-action">
                        <thead>
                            <tr>
                                <th class="border-top-0 text-dark">#</th>
                                <th class="border-top-0 text-dark">SKU Code</th>
                                <th class="border-top-0 text-wrap  text-dark">Name</th> 
                                <th class="border-top-0  text-dark">Cartons Qty</th>
                                <th class="border-top-0  text-dark">Pieces Qty</th>
                                <th class="border-top-0  text-dark">Stock Status</th>
                                <th class="border-top-0  text-dark">Stock Amount</th>
                                <th class="border-top-0  text-dark text-end"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)                            
                            <tr wire:key = "{{ $product->sku_code }}">
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    <a href="{{ route('products.show', $product->id) }}">{{ $product->sku_code }}</a>
                                </td>
                                <td>
                                    {{ $product->name }} 
                                </td>
                                <td>{{ $product->no_of_cottons }}</td> 
                                <td>{{ $product->no_of_pieces }}</td> 
                                <td>
                                    @if ($product->no_of_cottons >= 10)
                                        <span class="badge bg-success">In-Stock</span>
                                    @elseif ($product->no_of_cottons > 0 && $product->no_of_cottons < 10)
                                        <span class="badge bg-warning">In-Stock</span>
                                    @else
                                        <span class="badge bg-danger">Out-of-Stock</span>
                                    @endif
                                </td>
                                <td>{{ number_format($product->total_price, 2) }}</td>
                                <td>
                                    <div class="d-flex justify-content-end flex-gap-2 actions">
                                        <a class="btn btn-gray text-dark" href="{{ route('products.show', $product->id) }}">
                                            <i class="fa fa-eye me-2" aria-hidden="true"></i>
                                            Show
                                        </a>
                                        <button  type="button" wire:click="selectProduct({{ $product->id }})" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#AddStockModal">
                                            <i class=" fas fa-plus me-2"></i>
                                            Add Stock
                                        </button>
                                        <div class="btn-group"> 
                                            <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="visually-hidden">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu"> 
                                                <li><a class="dropdown-item" href="{{ route('products.edit', $product->id) }}">Edit</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item" data-bs-toggle="modal" 
                                                    data-bs-target="#deleteProduct" wire:click="selectProduct({{ $product->id }})"
                                                    type="button" >Delete</a></li>
                                            </ul>
                                        </div> 
                                    </div>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                            
                {{ $products->links() }}
            </div>
        </div>
    </div>
    
  <!-- Modal -->
  
  <div  wire:ignore.self class="modal fade" id="AddStockModal" tabindex="-1" aria-labelledby="AddStockModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="AddStockModalLabel">Add Stock</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <p>
                <Strong>SKU Code: </Strong> {{ $sku_code }}
            </p>

            <p>
                <Strong>Product Name: </Strong> {{ $product_name }}
            </p>

            <input type="number" min="0" class="form-control" wire:model.live="no_of_cottons" placeholder="Enter Cartons Quantity">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" wire:click="addStock">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  
  <div  wire:ignore.self class="modal fade" id="deleteProduct" tabindex="-1" aria-labelledby="deleteProductLabel" aria-hidden="true">
    <form wire:submit="deleteProduct">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title text-danger fs-5" >Delete Product</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">  
                <p class="text-danger mb-2">Are you sure?</p>
                @csrf
                <div class="d-flex justify-content-between ">
                    <p>SKU Code</p>
                    <p>{{ $sku_code }}</p>
                </div>
                <div class="d-flex justify-content-between ">
                    <p>Product</p>
                    <p>{{ $product_name }}</p>
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
