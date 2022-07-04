<?php

namespace App\Http\Controllers;

use App\Models\PaymentProvider;
use App\Utils\ImageCompress;
use Illuminate\Http\Request;

class PaymentProviderController extends Controller
{
    //Call index page
    public function index()
    {
        $payment = PaymentProvider::all();
        return view("admin.curd.paymentProvider.index")->with('payments',$payment);
    }

    //function store payment provider
    public function store(Request $req)
    {
        try {
            $req->validate([
                'name'=>'required',
                'account'=>'required',
                'logo'=>'required',
                'qrscan'=>'required',
                'howto'=>'required'
            ]);


            $payment = new PaymentProvider();
            $payment->name = $req->input('name');
            $payment->account = $req->input('account');
            $payment->status = 1;
            $payment->logo = ImageCompress::compressImage($req->file('logo'),90,'PaymentProvider',100);
            $payment->qrscan = ImageCompress::compressImage($req->file('qrscan'),90,'PaymentProvider',100);
            $payment->howto = ImageCompress::compressImage($req->file('howto'),90,'PaymentProvider',100);

            if($payment->save()){
                return redirect()->route('PaymentProviderController.Index')->with('success', 'ດຳເນີນການສຳເລັດ');
            }else{
                return redirect()->route('PaymentProviderController.Index')->with('error', 'ບໍ່ສຳເລັດກະລຸນາລອງໃໝ່');
            }
        } catch (\Throwable $e) {
            return redirect()->route('PaymentProviderController.Index')->with('error', $e->getMessage());
        }

    }
}
