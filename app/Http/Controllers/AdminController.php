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
use App\Utils\ImageCompress;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class AdminController extends Controller
{
    /** Function to show Admin Dashboard */
    public function showAdminDashBoard()
    {
        //Find new purchase order not payment
        $newPurchase = VehicleInsuranceDetail::where('payment_confirm', '=', null)->get();
        //Find purchase data with paymented
        $paymentItems = VehicleInsuranceDetail::where('payment_confirm', '=', 'WAIT_FOR_APPROVED')->get();

        //Find Insurance within contract
        $contracts = VehicleInsuranceDetail::where('payment_confirm', '=', 'APPROVED_OK', 'AND')->where('end_date', '>', now())->get();

        //Find Insurance within contract
        $outOfContracts = VehicleInsuranceDetail::where('contract_status', '=', 'IN_CONTRACT', 'AND')
            ->where(DB::raw('now()'), '>=', DB::raw("DATE_SUB(end_date,INTERVAL 7 DAY)"), 'AND')
            ->where(DB::raw('now()'), '<=', DB::raw("DATE_ADD(end_date,INTERVAL 7 DAY)"))->get();

        return view('admin.dashboard')
            ->with('newPurchase', $newPurchase)
            ->with('paymentItems', $paymentItems)
            ->with('contracts', $contracts)
            ->with('outOfContracts', $outOfContracts);
    }

    /** Function to allow admin to view input data from customer (readonly customer can edit only) */
    public function showCustomerInput($id)
    {
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
    public function showAllCustomerInput()
    {
        //Find new purchase order not payment
        $newPurchase = VehicleInsuranceDetail::where('payment_confirm', '=', null)->get();

        return view('admin.viewAllInsurance')
            ->with('newPurchases', $newPurchase);
    }


    /** Function to delete the input data */
    public function deleteTheInput($id)
    {
        VehicleInsuranceDetail::find($id)->delete();
        return redirect()->route('AdminController.showAdminDashBoard')->with('success', 'ດຳເນີນການສຳເລັດ');
    }


    /** Function to allow admin to view input data from customer (editable) */
    public function showCustomerPaymentItem($id)
    {
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
    public function approveInsurance(Request $req, $id)
    {
        $req->validate([
            'start_date' => 'required',
            'contract_no' => 'required'
        ]);

        $package = VehicleInsuranceDetail::find($id);
        $package->contract_no = $req->input('contract_no');
        $package->start_date = $req->input('start_date');
        //Add more 1 year
        $package->end_date = Carbon::parse($req->input('start_date'))->addYear(1);

        $package->contract_status = "IN_CONTRACT";
        $package->approved_time = now();
        $package->payment_confirm = "APPROVED_OK";
        $package->save();

        return redirect()->route('AdminController.showAdminDashBoard');
    }

    /** Function update insurance from customer information */
    public function updateCustomerInsuranceInformation(Request $req)
    {
        $req->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'tel' => 'required',
            'sex' => 'required',
            'dob' => 'required',
            'identity' => 'required',
            'province' => 'required',
            'district' => 'required',
            'vehicleBrand' => 'required',
            'registeredProvince' => 'required',
            'number_plate' => 'required',
            'color' => 'required',
            'address' => 'required',
            'sale_id' => 'required'
        ]);

        //Find Sale ID
        $saleData = SaleOption::find($req->input('sale_id'));
        //Find eqloquent object for perform the update operation
        $newInput = VehicleInsuranceDetail::find($req->input('id'));

        $newInput->firstname = trim($req->input('firstname'));
        $newInput->lastname = trim($req->input('lastname'));
        $newInput->sex = $req->input('sex');
        $newInput->dob = $req->input('dob');
        $newInput->tel = $req->input('tel');
        $newInput->identity = trim($req->input('identity'));
        $newInput->province = $req->input('province');
        $newInput->district = $req->input('district');
        $newInput->address = trim($req->input('address'));
        $newInput->vehicle_brand = $req->input('vehicleBrand');
        $newInput->number_plate = trim($req->number_plate);
        $newInput->color = trim($req->input('color'));
        $newInput->fee_charge = $saleData->fee_charge;
        $newInput->total_price = $saleData->sale_price;
        $newInput->registered_province = $req->input('registeredProvince');
        $newInput->user_id = Auth::user()->id;
        $newInput->chassic_number = $req->input('chassic_number');
        $newInput->engine_number = $req->input('engine_number');

        //Prepare to upload image for 5 items if image not upload mean do nothing
        $uploadPath = "Insurances/Vehicles";


        if ($req->file('front')) {
            File::delete($newInput->front_image);
            $newInput->front_image =  ImageCompress::compressImage($req->file('front'), 70, $uploadPath, 800);
        }
        if ($req->file('left')) {
            File::delete($newInput->left_image);
            $newInput->left_image = ImageCompress::compressImage($req->file('left'), 70, $uploadPath, 800);
        }
        if ($req->file('right')) {
            error_log('update here rigth');
            File::delete($newInput->right_image);
            $newInput->right_image = ImageCompress::compressImage($req->file('right'), 70, $uploadPath, 800);
        }
        if ($req->file('rear')) {
            File::delete($newInput->rear_image);
            $newInput->rear_image = ImageCompress::compressImage($req->file('rear'), 70, $uploadPath, 800);
        }
        if ($req->file('yellow_book_image')) {
            File::delete($newInput->yellow_book_image);
            $newInput->yellow_book_image = ImageCompress::compressImage($req->file('yellow_book'), 70, $uploadPath, 800);
        }

        $newInput->sale_options_id = $req->input('sale_id');
        $newInput->save();

        return redirect()->route('AdminController.showCustomerPaymentItem', ['id' => $req->input('id')])->with('success', 'ດຳເນີນການສຳເລັດ');
    }

    /** Function to show all  payment from customer () */
    public function showAllPaymentItem()
    {
        //Find new purchase order not payment
        $paymentItems = VehicleInsuranceDetail::where('payment_confirm', '=', 'WAIT_FOR_APPROVED')->get();

        return view('admin.viewAllPayment')
            ->with('paymentItems', $paymentItems);
    }

    /** Function to show all  approved from admin () */
    public function showAllApprovedItem()
    {
        //Find new purchase order not payment
        //Find where approved and not out of contract
        $contracts = VehicleInsuranceDetail::where('payment_confirm', '=', 'APPROVED_OK', 'AND')->where('end_date', '>', now())->get();

        return view('admin.viewAllInContract')
            ->with('contracts', $contracts);
    }

    /** Function to view insurance which in contract*/
    public function showInsuranceInContract($id)
    {
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

        return view('admin.viewContractInsurance')
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

    /** Function to view Out of contract data */
    public function viewOutOfContract($id)
    {

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

        return view('admin.viewOutOfContract')
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

     /** Function to show all  out of contract () */
     public function showAllOutOfContract()
     {
         //Find new purchase order not payment
         //Find where approved and not out of contract
         $outOfContracts = VehicleInsuranceDetail::where('contract_status', '=', 'IN_CONTRACT', 'AND')
            ->where(DB::raw('now()'), '>=', DB::raw("DATE_SUB(end_date,INTERVAL 7 DAY)"), 'AND')
            ->where(DB::raw('now()'), '<=', DB::raw("DATE_ADD(end_date,INTERVAL 7 DAY)"))->get();

         //$outOfContracts = VehicleInsuranceDetail::where('payment_confirm', '=', 'APPROVED_OK', 'AND')->where('end_date', '>', now())->get();

         return view('admin.viewAllOutOfContracts')
             ->with('outOfContracts', $outOfContracts);
     }
}
