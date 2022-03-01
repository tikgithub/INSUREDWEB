<?php

namespace App\Http\Controllers;

use App\Models\Vehicle_Type;
use Illuminate\Http\Request;

class VehicleTypeController extends Controller
{
    /** Store Vehicle Type Information */
    public function store(Request $req){
        //Validate the input
        $req->validate([
            'name'=>'required|unique:vehicle_types,name'
        ]);

        //Create Object
        $vehicle = new Vehicle_Type();
        $vehicle->name = $req->input("name");
        if($vehicle->save()){
            return redirect()->route('AdminController.indexVehicleType')->with('success','ດຳເນີນການສຳເລັດ');
        }else{
            return redirect()->route('AdminController.indexVehicleType')->with('error','ເກີດຂໍ້ຜິດພາດກະລຸນາລອງໃໝ່');
        }
    }

    /** Edit Vehicle Type Information */
    public function update(Request $req)
    {
        //Validate the input
        $req->validate([
            'editName'=>'required'
        ]);

        //Find the Object
        $vehicle = Vehicle_Type::find($req->input('editId'));
        $vehicle->name = $req->input('editName');
        if($vehicle->save()){
            return redirect()->back()->with('success','ດຳເນີນການສຳເລັດ');
        }else{
            return redirect()->back()->with('error','ເກີດຂໍ້ຜິດພາດກະລຸນາລອງໃໝ່');
        }
    }

}
