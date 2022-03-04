<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\VehiclePackage;
use Illuminate\Http\Request;

class VehiclePackageController extends Controller
{
    /** Store the package */
    public function store(Request $req)
    {
        $req->validate(['level' => 'required']);
        //validate it is third party or normal
        $levelSelected = Level::find($req->input('level'));
        //create new object
        $package = new VehiclePackage();
        $package->lvl_id = $req->input('level');
        $package->name = $req->input('name');
        $package->start_rank = $req->input('start_rank');
        $package->end_rank = $req->input('end_rank');
        $package->c_id = $req->input('c_id');

        switch ($levelSelected->menu_type) {
            case "THIRD_PARTY":
                if($package->save()){
                    return redirect()->route('AdminController.createVehiclePackage')->with('success','ດຳເນີນການສຳເລັດ');
                }else{
                    return redirect()->route('AdminController.createVehiclePackage')->with('error','ເກີດຂໍ້ຜິດພາດກະລຸນາລອງໃໝ່');
                }
                break;
            case "NORMAL":
                echo 'NORMAL';
                break;
            default:
                echo 'OK';
                break;
        }
    }
}
