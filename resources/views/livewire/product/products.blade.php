<div>
    <div class="row mb-3">
        <div class="col-sm-6">
            <input wire:model.live="search" type="text"  placeholder="Search Product" class="form-control">
        </div> 
        <div class="col-sm-6 text-end">
            <a href="{{ route('products.create') }}" class="btn btn-danger text-white">
                <i class="fas fa-plus me-2"></i>
                Add Product
            </a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                
                <div class="">
                    <table class="table ">
                        <thead>
                            <tr>
                                <th class="border-top-0 text-dark">#</th>
                                <th class="border-top-0 text-dark">SKU Code</th>
                                <th class="border-top-0 text-wrap  text-dark">Name</th> 
                                <th class="border-top-0  text-dark">Cartons Qty</th>
                                <th class="border-top-0  text-dark">Stock Status</th>
                                <th class="border-top-0  text-dark text-end">Action</th>
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
                                <td>{{ $product->stock_quantity }}</td> 
                                <td>
                                    @if ($product->stock_quantity >= 10)
                                        <span class="badge bg-success">In-Stock</span>
                                    @elseif ($product->stock_quantity > 0 && $product->stock_quantity < 10)
                                        <span class="badge bg-warning">In-Stock</span>
                                    @else
                                        <span class="badge bg-danger">Out-of-Stock</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-end flex-gap-2">
                                        <a class="btn btn-gray text-dark" href="{{ route('products.show', $product->id) }}">
                                            <i class="fa fa-eye me-2" aria-hidden="true"></i>
                                            Show
                                        </a>
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">
                                            <i class=" fas fa-pencil-alt me-2"></i>
                                            Edit
                                        </a>
                                        <button  type="button" wire:click="selectProduct({{ $product->id }})" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#AddStockModal">
                                            <i class=" fas fa-plus me-2"></i>
                                            Add Stock
                                        </button>
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

            <input type="number" min="0" class="form-control" wire:model.live="cartons_qty" placeholder="Enter Cartons Quantity">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" wire:click="addStock">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  
</div>
