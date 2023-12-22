<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Bill;
use App\Models\Product;
use App\Models\BillEntry;
use Illuminate\Http\Request; 

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    { 
        $series = [
            [5, 2, 7, 4, 5, 3, 5, 4],
            [12, 2, 3, 5, 3, 11, 9, 2]
        ];

        return view('welcome', compact('series'));
    }

}
