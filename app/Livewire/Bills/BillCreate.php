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

class BillCreate extends Component
{
    public BillForm $form; 

    public $add_previous_bill;

    public Bill $previousBill;

    public $products;

    public $orderBookers;

    public $mainAreas;

    public $subAreas;

    public $shops; 

    public Collection $inputs;

    protected $rules = [
        'inputs.*.product_id' => 'required',
        'inputs.*.no_of_cottons' => 'required',
        'inputs.*.no_of_pieces' => 'required', 
    ];
    
    protected $messages = [
        'inputs.*.product_id.required' => 'This SKU Code field is required.',
        'inputs.*.no_of_cottons.required' => 'This No. of Cottons field is required.',
        'inputs.*.no_of_pieces.required' => 'This No. of Pieces field is required.', 
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
        
        $now = Carbon::now()->timezone('Asia/Karachi');
        $this->form->bill_number = $now->year . 'M' . $now->month . 'D' . $now->day . strtoupper($now->shortLocaleDayOfWeek) . (Bill::getBillsCountToday() + 1);

        $this->fill([
            'inputs' => collect([
                [
                    'product_id' => '',
                    'sku_code' => '',
                    'assigned_price' => '1', 
                    'no_of_cottons' => '1', 
                    'no_of_pieces' => '1',
                    'cottons_price' => '0',
                    'peices_price' => '0',
                    'total_price' => '0',
                    'discount' => '0',
                    'final_price' => '0',
                ]                
            ]),
        ]);
    }

    public function addInput()
    {
        $this->inputs->push(
            [
                'product_id' => '',
                'sku_code' => '',
                'assigned_price' => '1', 
                'no_of_cottons' => '1', 
                'no_of_pieces' => '1',
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
        $this->formatMappedInputs();  
    }

    public function formatMappedInputs()
    {
        $this->inputs = $this->inputs->map(function ($row) {
            $total = 0;
            $subtotal = 0; 
            $product = Product::find($row['product_id']);
            if($product){

                $row['product_id'] = $product->id;

                $row['product_name'] = $product->name;

                $row['distributor_prices'] = $product->distributor_prices;

                $row['sku_code'] = $product->sku_code;

                $assigned_price = $row['assigned_price'];

                $row['cottons_price'] = $assigned_price * $row['no_of_cottons'];
                
                $row['peices_price'] = round(($assigned_price / $product->pack_size) * $row['no_of_pieces']);
    
                $row['total_price'] = $row['cottons_price'] + $row['peices_price'];
    
                if($row['discount'] > 0)
                    $row['final_price'] = $row['total_price'] - $row['discount'];
                else
                    $row['final_price'] = $row['total_price'];

            }else{
                $row['cottons_price'] = 0;
                $row['peices_price'] = 0;
                $row['total_price'] = 0;
                $row['discount'] = 0;
                $row['final_price'] = 0;
            }

            return $row; 
        });

        $this->form->actual_price = $this->inputs->sum('total_price');
        $this->form->final_price = $this->inputs->sum('final_price');
        $this->form->discount = $this->inputs->sum('discount');
    }
    

    public function save()
    { 
        $validated = $this->validate();   

        $bill = Bill::create($this->form->all());

        $this->inputs->map(function ($row)  use ($bill) {
            
            $row['bill_id'] = $bill->id;

            $row['bill_number'] = $bill->bill_number;

            unset($row['product_name']);
            unset($row['distributor_prices']);

            BillEntry::create($row);
            
        });

        return redirect()->route('bills.index');
    }

    public function createBillWithPreviousBill()
    {
        $this->form->order_booker_id = $this->previousBill->orderBooker->id;
        $this->form->main_area_id = $this->previousBill->mainArea->id;
        $this->form->sub_area_id = $this->previousBill->subArea->id;
        $this->form->shop_id = $this->previousBill->shop->id;

        $validated = $this->validate();   

        $previousBillAmount = $this->previousBill->previous_bill_amount +   $this->previousBill->final_price - $this->previousBill->recovered_amount;

        $bill = Bill::create($this->form->all() + [
            'previous_bill_id' => $this->previousBill->id,
            'previous_bill_amount' => $previousBillAmount
        ]);

        $this->previousBill->is_recovered = true;
        $this->previousBill->save();

        $this->inputs->map(function ($row)  use ($bill) {
            
            $row['bill_id'] = $bill->id;

            $row['bill_number'] = $bill->bill_number;

            unset($row['product_name']);
            unset($row['distributor_prices']);

            BillEntry::create($row);
            
        });

        return redirect()->route('bills.index');
    }

    public function render()
    {
        $this->orderBookers = OrderBooker::all();

        $this->products = Product::all();
 
        return view('livewire.bills.bill-create');
    }
}
