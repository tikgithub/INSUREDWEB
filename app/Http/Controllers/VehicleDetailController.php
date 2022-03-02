<?php

namespace App\Http\Controllers;

use App\Models\Vehicle_Detail;
use Illuminate\Http\Request;

class VehicleDetailController extends Controller
{
    /** Store Vehicle detail infor to the DB */
    public function store(Request $req){
        //Validate
        $req->validate([
            'v_id'=>'required',
            'name'=>'required|unique:vehicle__details,name'
        ]);

        //create new Object
        $newVehicleDetail = new Vehicle_Detail();
        $newVehicleDetail->v_id = $req->input('v_id');
        $newVehicleDetail->name = $req->input('name');
        
        if($newVehicleDetail->save()){

            return redirect()->route('AdminController.indexVehicleDetail')->with('success','ດຳເນີນການສຳເລັດ')->withInput();
        }else{
            return redirect()->route('AdminController.indexVehicleDetail')->with('error','ເກີດຂໍ້ຜິດພາດກະລຸນາລອງໃໝ່');
        }
    }

    /** Search Vehicle Detail by Type */
    public function searchByType($type_id){
        
    }
}
