<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\Request;

class VehiclePackageController extends Controller
{
    /** Store the package */
    public function store(Request $req){
        $req->validate(['level'=>'required']);
        //validate it is third party or normal
        $levelSelected = Level::find($req->input('level'));
        switch ($levelSelected->menu_type){
            case "THIRD_PARTY":
                echo 'THIRD PARTY';
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
