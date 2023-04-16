<?php

namespace App\Http\Controllers\payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Log;

class PaymentController extends Controller
{
    //
    public function index(Request $request){
        log::info("inthepaymentindex");
        log::info($request->all());

        return view('payment.payment');
    }
}
