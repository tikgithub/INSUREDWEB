<?php

namespace App\Http\Controllers;

use App\Models\CarBrand;
use App\Models\District;
use App\Models\InsuranceCompany;
use App\Models\Level;
use App\Models\Province;
use App\Models\SaleOption;
use App\Models\VehicleInsuranceDetail;
use App\Models\VehiclePackage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /** Function to show Admin Dashboard */
    public function showAdminDashBoard(){
        //Find new purchase order not payment
        $newPurchase = VehicleInsuranceDetail::where('payment_confirm','=',null)->get();
        //Find purchase data with paymented
        $paymentItems = VehicleInsuranceDetail::where('payment_confirm','=','WAIT_FOR_APPROVED')->get();

        //Find Insurance within contract
        $contracts =VehicleInsuranceDetail::where('contract_status','!=',null)->get();

        return view('admin.dashboard')
        ->with('newPurchase',$newPurchase)
        ->with('paymentItems',$paymentItems)
        ->with('contracts',$contracts);
    }

    /** Function to allow admin to view input data from customer (readonly customer can edit only) */
    public function showCustomerInput($id){
        //Get Input Data after submit
        $inputData = VehicleInsuranceDetail::find($id);
        //Get Sale option data

        $saleOption = SaleOption::find($inputData->sale_options_id);
        $vehiclePackage = VehiclePackage::find($saleOption->vp_id);
        $level = Level::find($vehiclePackage->lvl_id);
        $company = InsuranceCompany::find($vehiclePackage->c_id);

        //Get the package data
        $query = "SELECT ci.id, cg.id as group_id ,cg.name as group_name, ci.name as item_name, sod.price as cover_price FROM cover_groups cg Inner join cover_items ci on cg.id  = ci.cg_id INNER join sale_option_details sod on
        sod.ci_id = ci.id INNER JOIN sale_options so on so.id = sod.sale_id
        WHERE so.id  = ?";
        $saleOptionDetail = DB::select($query, [$inputData->sale_options_id]);

        //Province data
        $provinces = Province::all();
        //District Data
        $districts = District::where('province_id', '=', $inputData->province)->get();

        //Car Brand data
        $carBrands = CarBrand::all();

        return view('admin.viewInsurance')
            ->with('inputData', $inputData)
            ->with('level', $level)
            ->with('saleOption', $saleOption)
            ->with('vehiclePackage', $vehiclePackage)
            ->with('company', $company)
            ->with('saleDetails', $saleOptionDetail)
            ->with('Provinces', $provinces)
            ->with('carBrands', $carBrands)
            ->with('districts', $districts);
    }

    /** Function to show all  input data from customer (readonly customer can edit only) */
    public function showAllCustomerInput(){
         //Find new purchase order not payment
         $newPurchase = VehicleInsuranceDetail::where('payment_confirm','=',null)->get();

         return view('admin.viewAllInsurance')
         ->with('newPurchases',$newPurchase);
    }


    /** Function to delete the input data */
    public function deleteTheInput($id){
        VehicleInsuranceDetail::find($id)->delete();
        return redirect()->route('AdminController.showAdminDashBoard')->with('success','ດຳເນີນການສຳເລັດ');
    }


    /** Function to allow admin to view input data from customer (editable) */
    public function showCustomerPaymentItem($id){
        //Get Input Data after submit
        $inputData = VehicleInsuranceDetail::find($id);
        //Get Sale option data

        $saleOption = SaleOption::find($inputData->sale_options_id);
        $vehiclePackage = VehiclePackage::find($saleOption->vp_id);
        $level = Level::find($vehiclePackage->lvl_id);
        $company = InsuranceCompany::find($vehiclePackage->c_id);

        //Get the package data
        $query = "SELECT ci.id, cg.id as group_id ,cg.name as group_name, ci.name as item_name, sod.price as cover_price FROM cover_groups cg Inner join cover_items ci on cg.id  = ci.cg_id INNER join sale_option_details sod on
        sod.ci_id = ci.id INNER JOIN sale_options so on so.id = sod.sale_id
        WHERE so.id  = ?";
        $saleOptionDetail = DB::select($query, [$inputData->sale_options_id]);

        //Province data
        $provinces = Province::all();
        //District Data
        $districts = District::where('province_id', '=', $inputData->province)->get();

        //Car Brand data
        $carBrands = CarBrand::all();

        return view('admin.viewForApprove')
            ->with('inputData', $inputData)
            ->with('level', $level)
            ->with('saleOption', $saleOption)
            ->with('vehiclePackage', $vehiclePackage)
            ->with('company', $company)
            ->with('saleDetails', $saleOptionDetail)
            ->with('Provinces', $provinces)
            ->with('carBrands', $carBrands)
            ->with('districts', $districts);
    }

    /** Function Aprrove insurance from customer */
    public function approveInsurance(Request $req, $id){
        $package = VehicleInsuranceDetail::find($id);
        $package->contract_no = $req->input('contract_no');
        $package->start_date = $req->input('start_date');
        //Add more 1 year
        $package->end_date = Carbon::parse($req->input('start_date'))->addYear(1);
    }

}
