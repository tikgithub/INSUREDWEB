<?php

namespace App\Http\Controllers;

use App\Models\Vehicle_Detail;
use App\Models\Vehicle_Type;
use Illuminate\Http\Request;

class VehicleDetailController extends Controller
{
    /** Store Vehicle detail infor to the DB */
    public function store(Request $req){
        //Validate
        $req->validate([
            'v_id'=>'required',
            'name'=>'required|unique:vehicle_details,name'
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

        $vehicleDetails = Vehicle_Detail::where('v_id','=',$type_id)->get();
        $vehicleTypes = Vehicle_Type::all();
       // dd($vehicleDetails);
        return view('admin.curd.vehicle_detail.index')->with('vehicleDetails',$vehicleDetails)
        ->with('vehicleTypes',$vehicleTypes)
        ->with('selected_v_id',$type_id);
    }

    /** Update Vehicle Detail */
    public function update(Request $req){
        $req->validate([
            'editId'=>'required',
            'editName'=>'required'
        ]);
        $detail = Vehicle_Detail::find($req->input('editId'));
        $detail->name = $req->input('editName');

        if($detail->save()){

            return redirect()->back()->with('success','ດຳເນີນການສຳເລັດ')->withInput();
        }else{
            return redirect()->back()->with('error','ເກີດຂໍ້ຜິດພາດກະລຸນາລອງໃໝ່');
        }

    }
}
