<?php

namespace App\Http\Controllers;

use App\Models\HeathCoverType;
use Illuminate\Http\Request;

class HeathCoverTypeController extends Controller
{
    //Store
    public function store(Request $req){
        $req->validate([
            'name'=>'required',
            'insurance_company'=>'required'
        ]);

        //Create new object and save to DB
        $newSaveData = new HeathCoverType();
        $newSaveData->name = $req->input('name');
        $newSaveData->company_id = $req->input('insurance_company');
        $newSaveData->status = false;

        if($newSaveData->save()){
           return redirect()->back()->with('success','ດຳເນີນການສຳເລັດ');
        }else{
            return redirect()->back()->with('error','ເກີດຂໍ້ຜິດພາດກາລຸນາລອງໃໝ່');
        }
    }
}
