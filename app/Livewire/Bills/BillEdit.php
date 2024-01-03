<?php

namespace App\Livewire\Bills;

use Carbon\Carbon;
use App\Models\Area;
use App\Models\Bill;
use App\Models\Product;
use App\Models\SubArea;
use Livewire\Component;
use App\Models\BillEntry;
use App\Models\OrderBooker;
use App\Livewire\Forms\BillForm;
use Illuminate\Support\Collection;
use App\Livewire\Forms\BillEntryForm;

class BillEdit extends Component
{
    public BillForm $form;  

    public Bill $bill;

    public $products;

    public $orderBookers;

    public $mainAreas;

    public $subAreas;

    public $shops; 

    public Collection $inputs;

    public $buyingPrice = 0;

    public $sellingPrice = 0;

    public $profitLoss = 0;

    protected $rules = [
        'inputs.*.sku_code' => 'required|regex:/^([0-9]*)$/',
        'inputs.*.no_of_cottons' => 'required|integer',
        'inputs.*.no_of_pieces' => 'required|integer', 
        'inputs.*.assigned_price' => 'required', 
        'inputs.*.discount' => 'required|integer', 
    ];
    
    protected $messages = [
        'inputs.*.sku_code.required' => 'The SKU Code field is required.',
        'inputs.*.sku_code.integer' => 'The SKU Code field must be number.',
        'inputs.*.no_of_cottons.required' => 'The No. of Cottons field is required.',
        'inputs.*.no_of_cottons.integer' => 'The No. of Cottons field must be number.',
        'inputs.*.no_of_pieces.required' => 'The No. of Pieces field is required.', 
        'inputs.*.no_of_pieces.integer' => 'The No. of Pieces field must be number.', 
        'inputs.*.assigned_price.required' => 'The Assigned Price field is required.', 
        'inputs.*.discount.required' => 'The discount field is required.', 
    ];
  
    public function updated($field, $value)
    { 
        if ($field == 'form.order_booker_id') { 

            $orderBooker = OrderBooker::with('areas')->find($this->form->order_booker_id);
  
            if(isset($orderBooker))
                $this->mainAreas = $orderBooker->areas;
            else{
                $this->mainAreas = NULL;
            }
 
        } else if ($field == 'form.main_area_id') { 

            $areas = Area::with('subAreas')->find($this->form->main_area_id);

            if(isset($areas))                
                $this->subAreas = $areas->subAreas;
            else{
                $this->mainAreas = NULL;
            }
 
        } else if ($field == 'form.sub_area_id') { 

            $areas = SubArea::with('shops')->find($this->form->sub_area_id);
  
            if(isset($areas))                
                $this->shops = $areas->shops;
            else{
                $this->mainAreas = NULL;
            }
 
        }
    }

    public function mount()
    {        
        $this->form->bill_number = $this->bill->bill_number;
        $this->fill([
            'inputs' => collect( ),
        ]);

        $billEntries = $this->bill->billEntries;

        foreach ($billEntries as $entry) {
            $this->inputs->push(
                [
                    'product_id' => $entry->product_id,
                    'sku_code' => $entry->sku_code,
                    'assigned_price' => $entry->assigned_price, 
                    'no_of_cottons' => $entry->no_of_cottons, 
                    'no_of_pieces' => $entry->no_of_pieces,
                    'cottons_price' => $entry->cottons_price,
                    'peices_price' => $entry->peices_price,
                    'total_price' => $entry->total_price,
                    'discount' => $entry->discount,
                    'final_price' => $entry->final_price,
                ]   
            );
        }
        $this->formatMappedInputs(); 

        
    }

    public function addInput()
    {
        $this->inputs->push(
            [
                'product_id' => '',
                'sku_code' => '',
                'assigned_price' => '0', 
                'no_of_cottons' => '0', 
                'no_of_pieces' => '0',
                'cottons_price' => '0',
                'peices_price' => '0',
                'total_price' => '0',
                'discount' => '0',
                'final_price' => '0',
            ]   
        );
    }

    public function removeInput($key)
    {
        $this->inputs->pull($key);
    }

    public function updatedInputs()
    {   
        // $validated = $this->validate();  
        
        $this->formatMappedInputs();  
    }
  
    public function formatMappedInputs()
    { 
        $this->inputs = $this->inputs->map(function ($row) {

            $product = Product::where('sku_code', $row['sku_code'])->first();
             
            if(!$product) return $row;

            $row['product_id'] = $product->id;

            $row['product_name'] = $product->name;

            $row['distributor_prices'] = $product->distributor_prices; 

            $row['pack_size'] = $product->pack_size; 

            $row['sku_code'] = $product->sku_code;

            $assigned_price = $row['assigned_price'];

            $row['cottons_price'] = $assigned_price * $row['no_of_cottons'];
            
            $row['peices_price'] = round(($assigned_price / $product->pack_size) * $row['no_of_pieces']);

            $row['total_price'] = $row['cottons_price'] + $row['peices_price'];

            if($row['discount'] > 0){
                $row['final_price'] = $row['total_price'] - $row['discount'];
                $row['discount'] = $row['discount'];                
            }
            else
                $row['final_price'] = $row['total_price'];

            return $row; 
        });

        $this->form->actual_price = $this->inputs->sum('total_price');
        $this->form->final_price = $this->inputs->sum('final_price');
        $this->form->discount = $this->inputs->sum('discount');
 
        $data = $this->inputs->map(function($row){
            
            $totalBuyAmount = ($row['distributor_prices'] * $row['no_of_cottons']) + ($row['distributor_prices'] / $row['pack_size'] * $row['no_of_pieces']);
            
            return [
                'totalBuyAmount' => $totalBuyAmount,
                'totalSellAmount' => $row['final_price']
            ];

        });

        $this->buyingPrice = $data->sum('totalBuyAmount');
        $this->sellingPrice = $data->sum('totalSellAmount');
        $this->profitLoss = $this->sellingPrice - $this->buyingPrice;

    }
    

    public function save()
    {  
        $this->formatMappedInputs();  
        
        $this->bill->update([
            'actual_price' => $this->form->actual_price,
            'final_price' => $this->form->final_price,
            'discount' => $this->form->discount,
        ]);

        $billEntries = $this->bill->billEntries;

        $bill = $this->bill;

        foreach ($billEntries as $entry) {
            
            Product::returnStock($entry->toArray());

            $entry->delete();
        }

        $this->inputs->map(function ($row) use ($bill) {
            
            $row['bill_id'] = $bill->id;

            $row['bill_number'] = $bill->bill_number;

            unset($row['product_name']);
            // unset($row['distributor_prices']);
            // unset($row['pack_size']);

            BillEntry::create($row);

            Product::soldStock($row);
            
        });

        return redirect()->route('bills.index');
    }
 

    public function render()
    {
        $this->orderBookers = OrderBooker::all();

        $this->products = Product::all();
 
        return view('livewire.bills.bill-edit');
    }
}
