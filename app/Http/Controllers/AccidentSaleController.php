<?php

namespace App\Http\Controllers;

use App\Models\AccidentInput;
use App\Models\AccidentPlan;
use App\Models\District;
use App\Models\HeathCoverType;
use App\Models\PaymentProvider;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Utils\ImageCompress;
use Illuminate\Contracts\Session\Session;

class AccidentSaleController extends Controller
{
    public function showSelectCompany()
    {
        $companyQuery = "SELECT distinct ic.id as company_id, ic.name as company_name, ic.logo FROM insurance_companies ic INNER JOIN heath_cover_types hct on ic.id = hct.company_id where hct.status = 1;";
        $companyQueryDatas = DB::select($companyQuery);

        return view('insurances.accident.select_company')
            ->with('companyQueryDatas', $companyQueryDatas);
    }

    public function showPackagePlan($company_id)
    {
        $accidentType = HeathCoverType::where('company_id', '=', $company_id)->get();

        return view('insurances.accident.select_package')->with('accidentDetails', $accidentType);
    }

    public function showPlanDetail($plan_id)
    {

        $queryAccidentData = "SELECT accident_plans.id, accident_plans.name as planName, insurance_companies.name as companyName, insurance_companies.logo, heath_cover_types.name as coverType FROM accident_plans
        INNER JOIN heath_cover_types on accident_plans.cover_type_id = heath_cover_types.id
        INNER JOIN insurance_companies on insurance_companies.id = heath_cover_types.company_id WHERE accident_plans.id = ?;";
        $planDatas = collect(DB::select($queryAccidentData, [$plan_id]))->first();

        //Query the cover item and cover price
        $queryCoverData = "SELECT accident_plan_details.id, accident_cover_items.item, accident_plan_details.cover_price FROM accident_plan_details
        INNER JOIN accident_plans on accident_plans.id = accident_plan_details.plan_id
        INNER JOIN accident_cover_items on accident_plan_details.item_id = accident_cover_items.id WHERE accident_plan_details.plan_id = ?;";
        $coverData = DB::select($queryCoverData, [$plan_id]);

        //Query the plan detail
        $plan = AccidentPlan::find($plan_id);

        return view('insurances.accident.show_selected_package')
            ->with('planDatas', $planDatas)
            ->with('coverData', $coverData)
            ->with('plan', $plan);
    }

    public function showInputInformationPage($plan_id)
    {

        $queryAccidentData = "SELECT accident_plans.id, accident_plans.name as planName, insurance_companies.name as companyName, insurance_companies.logo, heath_cover_types.name as coverType FROM accident_plans
        INNER JOIN heath_cover_types on accident_plans.cover_type_id = heath_cover_types.id
        INNER JOIN insurance_companies on insurance_companies.id = heath_cover_types.company_id WHERE accident_plans.id = ?;";
        $planData = collect(DB::select($queryAccidentData, [$plan_id]))->first();

        //Query Province data
        $provinceData = Province::all();

        //Show cover Item detail
        //Query the cover item and cover price
        $queryCoverData = "SELECT accident_plan_details.id, accident_cover_items.item, accident_plan_details.cover_price FROM accident_plan_details
         INNER JOIN accident_plans on accident_plans.id = accident_plan_details.plan_id
         INNER JOIN accident_cover_items on accident_plan_details.item_id = accident_cover_items.id WHERE accident_plan_details.plan_id = ?;";
        $coverData = DB::select($queryCoverData, [$plan_id]);

        //Query the plan detail
        $plan = AccidentPlan::find($plan_id);


        return view('insurances.accident.input_customer_info')
            ->with('planDatas', $planData)
            ->with('coverData', $coverData)
            ->with('plan', $plan)
            ->with('provinceData', $provinceData);
    }

    public function storeInput(Request $req)
    {
        //Validate input data
        //all data should be required
        $sexRequire = ['F', 'M'];
        $req->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'sex' => 'required|in:' . implode(',', $sexRequire),
            'tel' => 'required',
            'dob' => 'required',
            'identity' => 'required',
            'province' => 'required',
            'district' => 'required',
            'address' => 'required',
            'reference_photo' => 'required'
        ]);
        /** Validate user policy here but now stop */

        /** *************************************** */

        //Create new Object for store user input information
        $obj = new AccidentInput();
        $obj->firstname = $req->input('firstname');
        $obj->lastname = $req->input('lastname');
        $obj->sex = $req->input('sex');
        $obj->tel = $req->input('tel');
        $obj->identity = $req->input('identity');
        $obj->dob = $req->input('dob');
        $obj->province = $req->input('province');
        $obj->district = $req->input('district');
        $obj->address = $req->input('address');
        $obj->plan_id = $req->input('plan_id');
        //Image upload
        if ($req->file('reference_photo')) {
            $obj->reference_photo =   ImageCompress::notCompressImage($req->file('reference_photo'), 'Insurances/people');
        } else {
            return redirect()->back()->with('error', 'Photo not found');
        }

        if ($obj->save()) {
            //Set Session
            Session(['accident_id' => $obj->id]);
            return redirect()->route('AccidentSaleController.showConfirmationPage');
        } {
            return redirect()->back()->with('error', 'ເກີດຂໍ້ຜິດພາດກະລຸນາລອງໃໝ່');
        }
    }
    public function showConfirmationPage()
    {
        if (Session('accident_id')) {
            $accident_id = Session('accident_id');

            $accidentData = AccidentInput::find($accident_id);
            $plan_id = $accidentData->plan_id;

            $queryAccidentData = "SELECT accident_plans.id, accident_plans.name as planName, insurance_companies.name as companyName, insurance_companies.logo, heath_cover_types.name as coverType FROM accident_plans
            INNER JOIN heath_cover_types on accident_plans.cover_type_id = heath_cover_types.id
            INNER JOIN insurance_companies on insurance_companies.id = heath_cover_types.company_id WHERE accident_plans.id = ?;";
            $planData = collect(DB::select($queryAccidentData, [$plan_id]))->first();

            //Query Province data
            $provinceData = Province::all();

            $districtData = District::where('province_id', '=', $accidentData->province)->get();


            //Show cover Item detail
            //Query the cover item and cover price
            $queryCoverData = "SELECT accident_plan_details.id, accident_cover_items.item, accident_plan_details.cover_price FROM accident_plan_details
             INNER JOIN accident_plans on accident_plans.id = accident_plan_details.plan_id
             INNER JOIN accident_cover_items on accident_plan_details.item_id = accident_cover_items.id WHERE accident_plan_details.plan_id = ?;";
            $coverData = DB::select($queryCoverData, [$plan_id]);

            //Query the plan detail
            $plan = AccidentPlan::find($plan_id);

            return view('insurances.accident.confirm_information')
                ->with('planDatas', $planData)
                ->with('coverData', $coverData)
                ->with('plan', $plan)
                ->with('provinceData', $provinceData)
                ->with('accidentData', $accidentData)
                ->with('districtData', $districtData);
        } else {
            return redirect()->route('welcome');
        }
    }

    public function updateConfirmation(Request $req)
    {
        if (Session('accident_id')) {
            //Validate input data
            //all data should be required expec reference photo
            $sexRequire = ['F', 'M'];
            $req->validate([
                'firstname' => 'required',
                'lastname' => 'required',
                'sex' => 'required|in:' . implode(',', $sexRequire),
                'tel' => 'required',
                'dob' => 'required',
                'identity' => 'required',
                'province' => 'required',
                'district' => 'required',
                'address' => 'required',
                'update_id' => 'required'
            ]);
            /** Validate user policy here but now stop */

            /** *************************************** */

            //Create new Object for store user input information
            $obj = AccidentInput::find($req->input('update_id'));
            $obj->firstname = $req->input('firstname');
            $obj->lastname = $req->input('lastname');
            $obj->sex = $req->input('sex');
            $obj->tel = $req->input('tel');
            $obj->identity = $req->input('identity');
            $obj->dob = $req->input('dob');
            $obj->province = $req->input('province');
            $obj->district = $req->input('district');
            $obj->address = $req->input('address');
            $obj->plan_id = $req->input('plan_id');

            //Image upload
            if ($req->file('reference_photo')) {
                $obj->reference_photo =   ImageCompress::notCompressImage($req->file('reference_photo'), 'Insurances/people');
            }
            if ($obj->save()) {
                //Set Session
                Session(['accident_id' => $obj->id]);
                return redirect()->route('AccidentController.paymentProvider');
            } {
                return redirect()->back()->with('error', 'ເກີດຂໍ້ຜິດພາດກະລຸນາລອງໃໝ່');
            }
        } else {

            return redirect()->route('welcome');
        }
    }
    

    public function showPlaymentProviderList()
    {
        
        if(Session('accident_id')){
            $paymentProviders = PaymentProvider::all();

            return view('insurances.accident.showPayment_providerList')
            ->with('paymentProviders', $paymentProviders);
        }else{
            return redirect()->route('welcome');
        }
       
    }
    public function showPaymentSubmitPage($id){
        if(Session('accident_id')){
            $provider = PaymentProvider::find($id);
            return view('insurances.accident.showPaymentSubmit')
            ->with('provider',$provider);
        }else{
            return redirect()->route('welcome');
        }
    }

    public function submitAccidentPayment(Request $req){
        if(Session('accident_id')){

            $req->validate([
                'slipUploaded'=>'required'
            ]);
            $accident_id = Session('accident_id');

            $accidentData = AccidentInput::find($accident_id);
            $extension = $req->file('slipUploaded')->getClientOriginalExtension();
            $newImageCompress = ImageCompress::compressImage($req->file('slipUploaded'), 70, 'tmpfolder', 800);
            $imageData = file_get_contents($newImageCompress);
            $base64SlipImage = 'data:image/' . $extension . ';base64,' . base64_encode($imageData);

            $accidentData->slipUploaded = $base64SlipImage;

            $accidentData->payment_time = now();

            $accidentData->save();
            
            session(['payment_status' => 'WAIT_FOR_APPROVED']);

            return redirect()->route('InsuranceFlowController.showComplete');


        }else{
            return redirect()->route('welcome');
        }
    }
}
