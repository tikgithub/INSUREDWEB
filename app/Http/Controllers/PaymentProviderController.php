<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentProviderController extends Controller
{
    //Call index page
    public function index(){
        return view("admin.curd.paymentProvider.index");
    }
}
