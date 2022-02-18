<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\ThirdPartyOption;
use App\Models\Vehicle_Detail;
use Illuminate\Http\Request;

class JSONServiceController extends Controller
{
    /** Response third party option by selection */
    public function jsonThridPartyOption($level_id){
        $jsonThirdPartyOption = ThirdPartyOption::where('lvl_id','=',$level_id)->get();
        return response()->json($jsonThirdPartyOption);
    }

    /** Response Vehicle Detail by Vehicle Type */
    public function jsonVehicleDetail($v_id){
        $vehicleDetails = Vehicle_Detail::where('v_id','=',$v_id)->get();
        return response()->json($vehicleDetails);
    }
    /** Response District by select province */
    public function jsonDistrict($province_id){
        $districts = District::where('province_id','=',$province_id)->get();
        return response()->json($districts);
    }
}
