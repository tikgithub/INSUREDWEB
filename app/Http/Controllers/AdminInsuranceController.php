<?php

namespace App\Http\Controllers;

use App\Models\CarBrand;
use App\Models\District;
use App\Models\InsuranceCompany;
use App\Models\InsuranceInformation;
use App\Models\Level;
use App\Models\licenseplate;
use App\Models\Province;
use App\Models\SaleOption;
use App\Models\ThirdPartyCoverItem;
use App\Models\VehiclePackage;
use App\Utils\ImageCompress;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminInsuranceController extends Controller
{
    public function showPageDetailForApprove($id)
    {
        $insurance = InsuranceInformation::find($id);

        switch ($insurance->insurance_Type) {
            case "HIGH-VALUEABLE":
                $vehicleSQLQuery = "select  ii.id as insurance_id, concat(case when ii.sex = 'M' then 'ທ' when ii.sex = 'F' then 'ນາງ' End,'. ' ,ii.firstname, ' ', ii.lastname) as insuredName, ii.payment_confirm,
                ic.name as company_name, ic.logo as company_logo, ii.contract_no , ii.contract_status, ii.insurance_type_id as sale_option_id, ii.number_plate, (select province_name from provinces where id= ii.registered_province) as registeredProvince,
                ii.color, ii.front_image , so.name as option_name , vp.name as package_name, l.name as level_name
                from insurance_information ii inner join sale_options so on ii.insurance_type_id = so.id
                inner join vehicle_packages vp on vp.id = so.vp_id
                inner join insurance_companies ic on ic.id = vp.c_id
                inner join levels l on l.id = vp.lvl_id
                where ii.insurance_Type  = 'HIGH-VALUEABLE' and ii.id = ?";
                $vehicleInsurance = collect(DB::select($vehicleSQLQuery, [$id]))->first();

                $query = "SELECT ci.id, cg.id as group_id ,cg.name as group_name, ci.name as item_name, sod.price as cover_price FROM cover_groups cg Inner join cover_items ci on cg.id  = ci.cg_id INNER join sale_option_details sod on
                sod.ci_id = ci.id INNER JOIN sale_options so on so.id = sod.sale_id
                WHERE so.id  = ?";
                $saleOptionDetail = DB::select($query, [$insurance->insurance_type_id]);

                return view('admin.insuranceNeedToCheck.vehicleInsuranceViewDetail')
                    ->with('insuranceDetail', $vehicleInsurance)
                    ->with('insurance', $insurance)
                    ->with('saleDetails', $saleOptionDetail);
                break;

            case "THIRD-PARTY":
                $thirdPartyQuery = "select  ii.id as insurance_id, concat(case when ii.sex = 'M' then 'ທ' when ii.sex = 'F' then 'ນາງ' End,'. ' ,ii.firstname, ' ', ii.lastname) as insuredName, ii.payment_confirm,
                ic.name as company_name, ic.logo as company_logo, ii.contract_no , ii.contract_status, ii.insurance_type_id as sale_option_id, ii.number_plate,
                (select province_name from provinces where id= ii.registered_province) as registeredProvince,
                ii.color, ii.front_image, tpp.name as package_name , tpo.name as option_name, l.name  as level_name
                from insurance_information ii inner join third_party_options tpo on ii.insurance_type_id = tpo.id
                inner join  levels l on l.id = tpo.lvl_id
                inner join  third_party_packages tpp on tpp.id = ii.insurance_type_id
                inner join insurance_companies ic on ic.id = tpp.company_id
                where ii.insurance_Type  = 'THIRD-PARTY' and ii.id =? ";
                $thirdPartInsurance = collect(DB::select($thirdPartyQuery, [$id]))->first();


                //Get cover item detail
                $coverDetail = ThirdPartyCoverItem::where('third_package_id', '=', $insurance->insurance_type_id)->get();
                return view('admin.insuranceNeedToCheck.thirdParyInsuranceViewDetail')
                    ->with('insurance', $insurance)
                    ->with('thirdPartyInsurance', $thirdPartInsurance)
                    ->with('coverDetail', $coverDetail);
                break;


            case "ACCIDENT":
                $accidentInsuranceQuery = "SELECT ii.id as insurance_id, ic.name  as company_name, ap.name as plan_name, hct.name as package_name, concat(case ii.sex when('M') then 'ທ້າວ. ' when('F') then 'ນາງ. ' End ,' ',ii.firstname,' ', ii.lastname) as insuredName,
                ic.logo  as company_logo, ii.payment_confirm, (select province_name from provinces where id = ii.province) as province
                FROM insurance_information ii
                inner join accident_plans ap on ap.id = ii.insurance_type_id
                inner JOIN  heath_cover_types hct  on hct.id = ap.cover_type_id
                INNER JOIN  insurance_companies ic  on ic.id  = hct.company_id
                Where ii.insurance_Type ='ACCIDENT' and ii.id = ?";
                $accidentInsurance = collect(DB::select($accidentInsuranceQuery, [$id]))->first();

                //Query the cover item and cover price
                $queryCoverData = "SELECT accident_plan_details.id, accident_cover_items.item, accident_plan_details.cover_price FROM accident_plan_details
            INNER JOIN accident_plans on accident_plans.id = accident_plan_details.plan_id
            INNER JOIN accident_cover_items on accident_plan_details.item_id = accident_cover_items.id WHERE accident_plan_details.plan_id = ?;";
                $coverData = DB::select($queryCoverData, [$insurance->insurance_type_id]);

                return view('admin.insuranceNeedToCheck.accidentInsuranceViewDetail')
                    ->with('accidentInsurance', $accidentInsurance)
                    ->with('insurance', $insurance)
                    ->with('coverDetail', $coverData);

                break;


            case "HEATH":
                $heathInsuranceQuery = "SELECT ii.id as insurance_id, ic.name  as company_name, hp.name as plan_name, hc.name as package_name, concat(case ii.sex when('M') then 'ທ້າວ. ' when('F') then 'ນາງ. ' End ,' ',ii.firstname,' ', ii.lastname) as insuredName,
                ic.logo  as company_logo, ii.payment_confirm, (select province_name from provinces where id = ii.province) as province
                FROM insurance_information ii
                inner join heath_plans hp on hp.id = ii.insurance_type_id
                inner JOIN  heath_covers hc on hc.id = hp.cover_type_id
                INNER JOIN  insurance_companies ic  on ic.id  = hc.company_id
                Where ii.insurance_Type ='HEATH' and ii.id = ?";

                $heathInsurance = collect(DB::select($heathInsuranceQuery, [$id]))->first();

                $coverDataQuery = "select hpd.id, hci.name, hpd.cover_price  from heath_plan_details hpd
                inner join heath_cover_items hci on hci.id  = hpd.item_id
                where hpd.plan_id  = ?";
                $coverData = collect(DB::select($coverDataQuery, [$insurance->insurance_type_id]));


                return view('admin.insuranceNeedToCheck.heathInsuranceViewDetail')
                    ->with('heathInsurance', $heathInsurance)
                    ->with('insurance', $insurance)
                    ->with('coverDetail', $coverData);


                break;
        }
    }

    public function showEditPageOfVehicleInsurance($id)
    {
        //Get Input Data after submit
        $inputData = InsuranceInformation::find($id);
        //Province data
        $provinces = Province::all();
        //District Data
        $districts = District::where('province_id', '=', $inputData->province)->get();

        //Get License plate
        $licenses = licenseplate::all();

        //Car Brand data
        $carBrands = CarBrand::all();

        return view('admin.insuranceNeedToCheck.editVehicleInsurance')
            ->with('inputData', $inputData)
            ->with('provinces', $provinces)
            ->with('carBrands', $carBrands)
            ->with('districts', $districts)
            ->with('licenses',$licenses);
    }

    public function updateVehicleInsurance(Request $req)
    {
        //Validate input
        //Image Validate with maximun
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
            'plateType' => 'required'
        ]);

        //Find eqloquent object for perform the update operation
        $newInput = InsuranceInformation::find($req->input('id'));

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
        $newInput->registered_province = $req->input('registeredProvince');
        $newInput->chassic_number = $req->input('chassic_number');
        $newInput->engine_number = $req->input('engine_number');
        $newInput->plate_type = $req->input('plateType');

        //Prepare to upload image for 5 items if image not upload mean do nothing
        $uploadPath = "Insurances/Vehicles";

        if ($req->file('front')) {
            Storage::delete($newInput->front_image);
            $newInput->front_image =  Storage::disk('local')->put('documents/', $req->file('front'));
        }
        if ($req->file('left')) {
            Storage::delete($newInput->left_image);
            $newInput->left_image = Storage::disk('local')->put('documents/', $req->file('left'));
        }
        if ($req->file('right')) {
            Storage::delete($newInput->right_image);
            $newInput->right_image = Storage::disk('local')->put('documents/', $req->file('right'));
        }
        if ($req->file('rear')) {
            Storage::delete($newInput->rear_image);
            $newInput->rear_image = Storage::disk('local')->put('documents/', $req->file('rear'));
        }
        if ($req->file('yellow_book')) {
            Storage::delete($newInput->yellow_book_image);
            $newInput->yellow_book_image = Storage::disk('local')->put('documents/', $req->file('yellow_book'));
        }

        if ($newInput->save()) {
            return redirect()->route('AdminInsuranceController.ShowPageDetailForApprove', ['id' => $req->input('id')])->with('success', 'Operation was completed');
        } else {
            return redirect()->route('AdminInsuranceController.ShowPageDetailForApprove', ['id' => $req->input('id')])->with('error', 'Operation was error, please try again later');
        }
    }

    public function updateVehicleInsuranceContract(Request $req)
    {
        //Validate
        $req->validate([
            'contract_no' => 'required',
            'start_date' => 'required',
            'id' => 'required'
        ]);

        if (InsuranceInformation::where('contract_no', '=', $req->input('contract_no'))->first()) {
            return redirect()->route('AdminInsuranceController.ShowPageDetailForApprove', ['id' => $req->input('id')])->with('warning', 'Contract number is already exist')
                ->withInput();
        }
        $insurance = InsuranceInformation::find($req->input('id'));

        $insurance->contract_no = $req->input('contract_no');
        $insurance->contract_status = "IN-CONTRACT";
        $insurance->start_date = $req->input('start_date');
        //Convert Date Time
        $converted = new DateTime($req->input('start_date'));
        //Assign end date with + 1 Year
        $insurance->end_date = $converted->add(new DateInterval("P1Y"));
        $insurance->approve_by = Auth::user()->id;
        $insurance->approved_time = now();
        $insurance->contract_available_time = $req->input('start_date');
        $insurance->contact_description = $req->input('contract_description');
        $insurance->payment_confirm = "APPROVED_OK";
        if ($insurance->save()) {
            return redirect()->route('AdminController.showInsuranceList')->with('success', 'Operation completed');
        } else {
            return redirect()->back()->with('error', 'Operation was not completed, please try again later');
        }
    }

    public function removeInsurance($id)
    {
        try {
            $removeItem = InsuranceInformation::find($id);

            $removeItem->delete();

            return redirect()->route('AdminInsuranceController.ShowPageDetailForApprove')->with('success', 'ດຳເນີນການສຳເລັດ');
        } catch (\Throwable $th) {

            Log::error($th);

            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function showEditPageOfThirPartyInsurance($id)
    {
        try {
            //Get Input Data after submit
            $inputData = InsuranceInformation::find($id);

            //  dd($inputData);
            //Province data
            $provinces = Province::all();
            //District Data
            $districts = District::where('province_id', '=', $inputData->province)->get();

            //Car Brand data
            $carBrands = CarBrand::all();

            return view('admin.insuranceNeedToCheck.editThirdPartyInsurance')
                ->with('inputData', $inputData)
                ->with('provinces', $provinces)
                ->with('carBrands', $carBrands)
                ->with('districts', $districts);
        } catch (\Exception | \Throwable $th) {
            Log::error($th);

            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function updateThirdPartyInsurance(Request $req)
    {
        try {
            //Validate input
            //Image Validate with maximun
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
                'address' => 'required'
            ]);

            //Find eqloquent object for perform the update operation
            $newInput = InsuranceInformation::find($req->input('id'));

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
            $newInput->registered_province = $req->input('registeredProvince');
            $newInput->chassic_number = $req->input('chassic_number');
            $newInput->engine_number = $req->input('engine_number');

            if ($req->file('front')) {
                Storage::delete($newInput->front_image);
                $newInput->front_image =  Storage::disk('local')->put('documents/', $req->file('front'));
            }

            if ($newInput->save()) {
                return redirect()->route('AdminInsuranceController.ShowPageDetailForApprove', ['id' => $req->input('id')])->with('success', 'Operation was completed');
            } else {
                return redirect()->route('AdminInsuranceController.ShowPageDetailForApprove', ['id' => $req->input('id')])->with('error', 'Operation was error, please try again later');
            }
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->route('AdminInsuranceController.ShowPageDetailForApprove', ['id' => $req->input('id')])->with('error', 'Operation was error, please try again later');
        }
    }

    public function showEditPageOfAccidentInsurance($id){
        try {
             //Get Input Data after submit
             $inputData = InsuranceInformation::find($id);

             //  dd($inputData);
             //Province data
             $provinces = Province::all();
             //District Data
             $districts = District::where('province_id', '=', $inputData->province)->get();

             //Car Brand data
             $carBrands = CarBrand::all();

             return view('admin.insuranceNeedToCheck.editAccidentInsurance')
                 ->with('inputData', $inputData)
                 ->with('provinces', $provinces)
                 ->with('carBrands', $carBrands)
                 ->with('districts', $districts);
        } catch (\Throwable $th) {
            Log::error($th);

            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function updateAccidentInsurance(Request $req){
        try {
            //Validate input
            //Image Validate with maximun
            $req->validate([
                'firstname' => 'required',
                'lastname' => 'required',
                'tel' => 'required',
                'sex' => 'required',
                'dob' => 'required',
                'identity' => 'required',
                'province' => 'required',
                'district' => 'required',
                'address' => 'required'
            ]);

            //Find eqloquent object for perform the update operation
            $newInput = InsuranceInformation::find($req->input('id'));

            $newInput->firstname = trim($req->input('firstname'));
            $newInput->lastname = trim($req->input('lastname'));
            $newInput->sex = $req->input('sex');
            $newInput->dob = $req->input('dob');
            $newInput->tel = $req->input('tel');
            $newInput->identity = trim($req->input('identity'));
            $newInput->province = $req->input('province');
            $newInput->district = $req->input('district');
            $newInput->address = trim($req->input('address'));

            if ($req->file('front')) {
                Storage::delete($newInput->front_image);
                $newInput->front_image =  Storage::disk('local')->put('documents/', $req->file('front'));
            }

            if ($newInput->save()) {
                return redirect()->route('AdminInsuranceController.ShowPageDetailForApprove', ['id' => $req->input('id')])->with('success', 'Operation was completed');
            } else {
                return redirect()->route('AdminInsuranceController.ShowPageDetailForApprove', ['id' => $req->input('id')])->with('error', 'Operation was error, please try again later');
            }
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->route('AdminInsuranceController.ShowPageDetailForApprove', ['id' => $req->input('id')])->with('error', 'Operation was error, please try again later');
        }
    }

    public function showEditPageOfHeathInsurance($id){
        try {
             //Get Input Data after submit
             $inputData = InsuranceInformation::find($id);

             //  dd($inputData);
             //Province data
             $provinces = Province::all();
             //District Data
             $districts = District::where('province_id', '=', $inputData->province)->get();

             //Car Brand data
             $carBrands = CarBrand::all();

             return view('admin.insuranceNeedToCheck.editAccidentInsurance')
                 ->with('inputData', $inputData)
                 ->with('provinces', $provinces)
                 ->with('carBrands', $carBrands)
                 ->with('districts', $districts);

        } catch (\Throwable $th) {
            Log::error($th);

            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function updateHeathInsurance(Request $req){
        try {
            //Validate input
            //Image Validate with maximun
            $req->validate([
                'firstname' => 'required',
                'lastname' => 'required',
                'tel' => 'required',
                'sex' => 'required',
                'dob' => 'required',
                'identity' => 'required',
                'province' => 'required',
                'district' => 'required',
                'address' => 'required'
            ]);

            //Find eqloquent object for perform the update operation
            $newInput = InsuranceInformation::find($req->input('id'));

            $newInput->firstname = trim($req->input('firstname'));
            $newInput->lastname = trim($req->input('lastname'));
            $newInput->sex = $req->input('sex');
            $newInput->dob = $req->input('dob');
            $newInput->tel = $req->input('tel');
            $newInput->identity = trim($req->input('identity'));
            $newInput->province = $req->input('province');
            $newInput->district = $req->input('district');
            $newInput->address = trim($req->input('address'));

            if ($req->file('front')) {
                Storage::delete($newInput->front_image);
                $newInput->front_image =  Storage::disk('local')->put('documents/', $req->file('front'));
            }

            if ($newInput->save()) {
                return redirect()->route('AdminInsuranceController.ShowPageDetailForApprove', ['id' => $req->input('id')])->with('success', 'Operation was completed');
            } else {
                return redirect()->route('AdminInsuranceController.ShowPageDetailForApprove', ['id' => $req->input('id')])->with('error', 'Operation was error, please try again later');
            }
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->route('AdminInsuranceController.ShowPageDetailForApprove', ['id' => $req->input('id')])->with('error', 'Operation was error, please try again later');
        }
    }


}
