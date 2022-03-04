<?php

namespace App\Http\Controllers;

use App\Models\InsuranceCompany;
use App\Models\Level;
use App\Models\ThirdPartyOption;
use App\Models\ThirdPartyPackage;
use App\Models\Vehicle_Type;
use Illuminate\Http\Request;

class ThirdPartyInsuranceController extends Controller
{
    //create
    public function create(){
        $companies = InsuranceCompany::all();
        $levels = Level::where('menu_type','=','THIRD_PARTY')->get();
        $vehicleTypes = Vehicle_Type::all();

        return view('admin.curd.thirdPartyInsurance.create')
        ->with('companies',$companies)
        ->with('levels',$levels)
        ->with('vehicleTypes',$vehicleTypes);
    }

    //store
    public function store(Request $req){
        $req->validate([
            'level'=>'required',
            'name' => 'required',
            'company' => 'required',
            'vehicle_detail'=>'required',
            'fee'=>'required',
            'final_price'=>'required',
            'term'=>'required'
        ]);

        //Create new Object
        $thirdParty = new ThirdPartyPackage();
        $thirdParty->level = $req->input('level');
        $thirdParty->name = $req->input('name');
        $thirdParty->company_id = $req->input('company');
        $thirdParty->fee = $req->input('fee');
        $thirdParty->final_price = $req->input('final_price');
        $thirdParty->vehicle_detail =$req->input('vehicle_detail');
        $thirdParty->term = $req->input('term');
        $thirdParty->status = 0; // not active yet until the admin complete the setting

        if($thirdParty->save()){
            return redirect()->route('ThirdPartyInsuranceController.create')->with('success','ດຳເນີນການສຳເລັດ');
        }else{
            return redirect()->route('ThirdPartyInsuranceController.create')->with('error','ເກີດຂໍ້ຜິດພາດກະລຸນາລອງໃໝ່');
        }
    }

    //Index
    public function index(){
        //Get All the ThirdParty Package
        $packages = ThirdPartyPackage::paginate(20);

        return view('admin.curd.thirdPartyInsurance.index')
        ->with('packages',$packages);
    }
    //Update status as available
    public function updateAvailableStatus($id){
        $packageId = str_replace('check-','',$id);
        
        $package = ThirdPartyPackage::find($packageId);

        $package->status = 1;

        $package->save();

        return redirect()->back();
    }

    //Update status as unavailable
    public function updateNotAvailableStatus($id){
        $packageId = str_replace('check-','',$id);
        
        $package = ThirdPartyPackage::find($packageId);

        $package->status = 0;

        $package->save();

        return redirect()->back();
    }

    //Edit
    public function edit($id){

        $packageId = str_replace('item-','',$id);

        //Find the Package
        $package = ThirdPartyPackage::find($packageId);

        $companies = InsuranceCompany::all();
        $levels = Level::where('menu_type','=','THIRD_PARTY')->get();
        $vehicleTypes = Vehicle_Type::all();
        //Get Vehicle Detail depend on type
        
       
        return view('admin.curd.thirdPartyInsurance.edit')
        ->with('companies',$companies)
        ->with('levels',$levels)
        ->with('vehicleTypes',$vehicleTypes)
        ->with('package',$package);
    }
}
