<?php

namespace App\Http\Controllers;

use App\Models\CarBrand;
use App\Models\District;
use App\Models\InsuranceCompany;
use App\Models\Level;
use App\Models\Province;
use App\Models\SaleOption;
use App\Models\Vehicle_Type;
use App\Models\VehicleInsuranceDetail;
use App\Models\VehiclePackage;
use App\Utils\ImageCompress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InsuranceFlowController extends Controller
{
    /** Function to show insurance type selection */
    public function showInsuranceTypeSelection()
    {
        return view('insurances.insurance_select');
    }
    /** Function to show the car insurance selection menu */
    public function showCarInsuranceSelectionMenu()
    {
        /** Get Level Information to Show at page */
        $levels = Level::all();
        /** Get Vehicle Type information to page */
        $vehicleTypes = Vehicle_Type::all();

        return view('insurances.cars.car_insured_select')
            ->with('levels', $levels)
            ->with('vehicleTypes', $vehicleTypes);
    }

    /** Vehicle Insurance Search */
    public function vehicleSearchForInsurancePackage(Request $req)
    {
        /** Check which insurance type customer select */
        $insuranceType = Level::find($req->input('level'));

        switch ($insuranceType->menu_type) {
            case "THIRD_PARTY":
                /** Query the package which relate to Third party only */

                break;
            case "NORMAL":
                /** Query the package which relate to Normal package only */
                $squery = "SELECT vp.id as Id ,ic.name as company_name, vp.name as package_name, l.name as level_name, ic.logo, vp.start_rank , vp.end_rank
                FROM vehicle_packages vp
                INNER JOIN  insurance_companies ic on vp.c_id  = ic.id
                INNER JOIN levels l on vp.lvl_id = l.id
                WHERE  vp .lvl_id =? AND vp.status = 1";

                $vehiclePackages = DB::select($squery, [$req->input('level')]);

                //Send Package Data to view
                return view("insurances.cars.showSearchedPackage")
                    ->with('level', $insuranceType)
                    ->with('packages', $vehiclePackages);

                break;
        }
    }
    /** Show the detail of option */
    public function showNormalPackageDetail($sale_id)
    {

        $saleOption = SaleOption::find($sale_id);
        $vehiclePackage = VehiclePackage::find($saleOption->vp_id);
        $level = Level::find($vehiclePackage->lvl_id);
        $company = InsuranceCompany::find($vehiclePackage->c_id);

        $query = "SELECT ci.id, cg.id as group_id ,cg.name as group_name, ci.name as item_name, sod.price as cover_price FROM cover_groups cg Inner join cover_items ci on cg.id  = ci.cg_id INNER join sale_option_details sod on
        sod.ci_id = ci.id INNER JOIN sale_options so on so.id = sod.sale_id
        WHERE so.id  = ?";
        $saleOptionDetail = DB::select($query, [$sale_id]);

        return view('insurances.cars.showPackageDetail')
            ->with('level', $level)
            ->with('saleOption', $saleOption)
            ->with('vehiclePackage', $vehiclePackage)
            ->with('company', $company)
            ->with('saleDetails', $saleOptionDetail);
    }
    /** Show to compare view of Normal Package */
    public function normalPackageCompare($p1, $p2)
    {

        /** First Selection ***************************************/
        $saleOptionFirst = SaleOption::find($p1);
        $vehiclePackageFirst = VehiclePackage::find($saleOptionFirst->vp_id);
        $levelFirst = Level::find($vehiclePackageFirst->lvl_id);
        $companyFirst = InsuranceCompany::find($vehiclePackageFirst->c_id);

        $query = "SELECT ci.id, cg.id as group_id ,cg.name as group_name, ci.name as item_name, sod.price as cover_price
        FROM cover_groups cg Inner join cover_items ci on cg.id  = ci.cg_id INNER join sale_option_details sod on
        sod.ci_id = ci.id INNER JOIN sale_options so on so.id = sod.sale_id
        WHERE so.id  = ?";
        $saleOptionDetailFirst = DB::select($query, [$p1]);

        /** End First Selection ***************************************/


        /** Second Selection ***************************************/
        $saleOptionSecond = SaleOption::find($p2);
        $vehiclePackageSecond = VehiclePackage::find($saleOptionSecond->vp_id);
        $levelSecond = Level::find($vehiclePackageSecond->lvl_id);
        $companySecond = InsuranceCompany::find($vehiclePackageSecond->c_id);

        $query = "SELECT ci.id, cg.id as group_id ,cg.name as group_name, ci.name as item_name, sod.price as cover_price
        FROM cover_groups cg Inner join cover_items ci on cg.id  = ci.cg_id INNER join sale_option_details sod on
        sod.ci_id = ci.id INNER JOIN sale_options so on so.id = sod.sale_id
        WHERE so.id  = ?";
        $saleOptionDetailSecond = DB::select($query, [$p2]);
        /** End Second Selection ***************************************/

        return view('insurances.cars.showComparePackage')

            ->with('levelFirst', $levelFirst)
            ->with('saleOptionFirst', $saleOptionFirst)
            ->with('vehiclePackageFirst', $vehiclePackageFirst)
            ->with('companyFirst', $companyFirst)
            ->with('saleDetailsFirst', $saleOptionDetailFirst)

            ->with('levelSecond', $levelSecond)
            ->with('saleOptionSecond', $saleOptionSecond)
            ->with('vehiclePackageSecond', $vehiclePackageSecond)
            ->with('companySecond', $companySecond)
            ->with('saleDetailsSecond', $saleOptionDetailSecond);;
    }

    /** Show Buy Now Page with input information */
    public function showBuyNowPage($sale_id){
        $saleOption = SaleOption::find($sale_id);
        $vehiclePackage = VehiclePackage::find($saleOption->vp_id);
        $level = Level::find($vehiclePackage->lvl_id);
        $company = InsuranceCompany::find($vehiclePackage->c_id);

        //Province data
        $provinces = Province::all();
        //Car Brand data
        $carBrands = CarBrand::all();

        $query = "SELECT ci.id, cg.id as group_id ,cg.name as group_name, ci.name as item_name, sod.price as cover_price FROM cover_groups cg Inner join cover_items ci on cg.id  = ci.cg_id INNER join sale_option_details sod on
        sod.ci_id = ci.id INNER JOIN sale_options so on so.id = sod.sale_id
        WHERE so.id  = ?";
        $saleOptionDetail = DB::select($query, [$sale_id]);

        return view('insurances.cars.buyNow')
        ->with('level', $level)
        ->with('saleOption', $saleOption)
        ->with('vehiclePackage', $vehiclePackage)
        ->with('company', $company)
        ->with('saleDetails', $saleOptionDetail)
        ->with('Provinces',$provinces)
        ->with('carBrands',$carBrands);
    }

    /** Store Insurance Information When Click Submit */
    public function storeInputFromCustomer(Request $req){
        //Validate input
        //Image Validate with maximun
        // $req->validate([
        //     'front'=>'required',
        //     'left'=>'required',
        //     'right'=>'required',
        //     'rear'=>'required',
        //     'yellow_book'=>'required',
        //     'firstname'=>'required',
        //     'lastname'=>'required',
        //     'tel'=>'required',
        //     'sex'=>'required',
        //     'dob'=>'required',
        //     'identity'=>'required',
        //     'province'=>'required',
        //     'district'=>'required',
        //     'vehicleBrand'=>'required',
        //     'registeredProvince'=>'required',
        //     'number_plate'=>'required',
        //     'color'=>'required',
        //     'address'=>'required',
        //      'sale_id=>'required'
        // ]);

        //Find Sale ID
        $saleData = SaleOption::find($req->input('sale_id'));

        //create new eqloquent object
        $newInput = new VehicleInsuranceDetail();

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
        //Prepare to upload image for 5 items
        $uploadPath = "Insurances/Vehicles";
        $newInput->front_image =  ImageCompress::compressImage($req->file('front'),70,$uploadPath,800);
        $newInput->left_image = ImageCompress::compressImage($req->file('left'),70,$uploadPath,800);
        $newInput->right_image = ImageCompress::compressImage($req->file('right'),70,$uploadPath,800);
        $newInput->rear_image = ImageCompress::compressImage($req->file('rear'),70,$uploadPath,800);
        $newInput->yellow_book_image = ImageCompress::compressImage($req->file('yellow_book'),70,$uploadPath,800);
        $newInput->sale_options_id = $req->input('sale_id');
        $newInput->save();
        //Set Session for new Input ID
        session(['input_id'=>$newInput->id]);

        return redirect()->route('InsuranceFlowController.showAgreementPage');
    }

    /** Show the agreement page after customer input the detail */
    public function showAgreementPage(){
        //Get session id
        $input_id = session('input_id');

        //Get Input Data after submit
        $inputData = VehicleInsuranceDetail::find($input_id);
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
          $districts = District::where('province_id','=',$inputData->province)->get();
          
          //Car Brand data
          $carBrands = CarBrand::all();

        return view('insurances.cars.insuranceAgreement')
        ->with('inputData',$inputData)
        ->with('level', $level)
        ->with('saleOption', $saleOption)
        ->with('vehiclePackage', $vehiclePackage)
        ->with('company', $company)
        ->with('saleDetails', $saleOptionDetail)
        ->with('Provinces',$provinces)
        ->with('carBrands',$carBrands)
        ->with('districts',$districts);
    }
}
