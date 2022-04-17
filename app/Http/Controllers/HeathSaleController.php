<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\HeathCover;
use App\Models\HeathPlan;
use App\Models\InsuranceInformation;
use App\Models\PaymentProvider;
use App\Models\Province;
use App\Utils\ImageCompress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HeathSaleController extends Controller
{
    public function selectCompany(){
        $companyQuery = "select distinct ic.id as company_id, ic.name  as company_name, ic.logo  from insurance_companies ic inner join heath_covers hc on ic.id  = hc.company_id
        where hc.status  = 1";

        $companyData = collect(DB::select($companyQuery));
        
        return view('insurances.heath.select_company')
        ->with('companyData',$companyData);
    }

    public function showPackage($company_id){

        $heathCovers = collect(HeathCover::where('company_id','=',$company_id)->get());
        
        return view('insurances.heath.select_package')
        ->with('heathCovers',$heathCovers);
    }

    public function showSelectedPackage($plan_id){
        $headerTitleQuery = "select hp.id as plan_id, hp.name as plan_name, ic.name as company_name, hc.name as cover_name, ic.logo  from heath_plans hp
        inner join heath_covers hc on hc.id  = hp.cover_type_id 
        inner join insurance_companies ic on ic.id = hc.company_id 
        where hp.id  = ?";
        $headerTitleData = collect(DB::select($headerTitleQuery,[$plan_id]))->first();

        $plan = HeathPlan::find($plan_id);


        $coverDataQuery = "select hpd.id, hci.name, hpd.cover_price  from heath_plan_details hpd 
        inner join heath_cover_items hci on hci.id  = hpd.item_id 
        where hpd.plan_id  = ?";
        $coverData = collect(DB::select($coverDataQuery,[$plan_id]));

        return view('insurances.heath.show_selected_package')
        ->with('headerTitleData',$headerTitleData)
        ->with('plan',$plan)
        ->with('coverData',$coverData);
    }
    public function showCustomerInput($plan_id){
        $headerTitleQuery = "select hp.id as plan_id, hp.name as plan_name, ic.name as company_name, hc.name as cover_name, ic.logo  from heath_plans hp
        inner join heath_covers hc on hc.id  = hp.cover_type_id 
        inner join insurance_companies ic on ic.id = hc.company_id 
        where hp.id  = ?";
        $headerTitleData = collect(DB::select($headerTitleQuery,[$plan_id]))->first();

        $plan = HeathPlan::find($plan_id);


        $coverDataQuery = "select hpd.id, hci.name, hpd.cover_price  from heath_plan_details hpd 
        inner join heath_cover_items hci on hci.id  = hpd.item_id 
        where hpd.plan_id  = ?";
        $coverData = collect(DB::select($coverDataQuery,[$plan_id]));

        //Query Province data
        $provinceData = Province::all();

        return view('insurances.heath.input_customer_info')
        ->with('headerTitleData',$headerTitleData)
        ->with('plan',$plan)
        ->with('coverData',$coverData)
        ->with('provinceData',$provinceData);
    }

    public function storeUserInformation(Request $req){
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

        //Create new Object for store user input information
        $obj = new InsuranceInformation();
        $obj->firstname = $req->input('firstname');
        $obj->lastname = $req->input('lastname');
        $obj->sex = $req->input('sex');
        $obj->tel = $req->input('tel');
        $obj->identity = $req->input('identity');
        $obj->dob = $req->input('dob');
        $obj->province = $req->input('province');
        $obj->district = $req->input('district');
        $obj->address = $req->input('address');
        $obj->insurance_type_id = $req->input('plan_id');
        $obj->insurance_type = "HEATH";
        $obj->payment_confirm = "WAIT_FOR_PAYMENT";
        //Add free charge and Total price of each plan Id
        $heathPlan = HeathPlan::find($req->input('plan_id'));
        $obj->fee_charge = $heathPlan->fee;
        $obj->total_price = $heathPlan->sale_price;
        $obj->user_id = Auth::user()->id;

        //Image upload
        if ($req->file('reference_photo')) {
            $obj->front_image =   ImageCompress::notCompressImage($req->file('reference_photo'), 'Insurances/people');
        } else {
            return redirect()->back()->with('error', 'Photo not found');
        }

        if ($obj->save()) {
            //Set Session
            Session(['health' => $obj->id]);
            return redirect()->route('HeathSaleController.ShowUserConfirmationPage');
           
        } {
            return redirect()->back()->with('error', 'ເກີດຂໍ້ຜິດພາດກະລຸນາລອງໃໝ່');
        }
    }

    public function showUserConfirmationPage(){
        if (Session('health')) {

            $heath_id = Session('health');
            
           // dd($accident_id);
            $heathData = InsuranceInformation::find($heath_id);
            $plan_id = $heathData->insurance_type_id;

            $headerTitleQuery = "select hp.id as plan_id, hp.name as plan_name, ic.name as company_name, hc.name as cover_name, ic.logo  from heath_plans hp
            inner join heath_covers hc on hc.id  = hp.cover_type_id 
            inner join insurance_companies ic on ic.id = hc.company_id 
            where hp.id  = ?";
            $headerTitleData = collect(DB::select($headerTitleQuery,[$plan_id]))->first();
    
            $plan = HeathPlan::find($plan_id);
    
    
            $coverDataQuery = "select hpd.id, hci.name, hpd.cover_price  from heath_plan_details hpd 
            inner join heath_cover_items hci on hci.id  = hpd.item_id 
            where hpd.plan_id  = ?";
            $coverData = collect(DB::select($coverDataQuery,[$plan_id]));

            //Query Province data
            $provinceData = Province::all();

            $districtData = District::where('province_id', '=', $heathData->province)->get();

            return view('insurances.heath.confirm_information')
            ->with('headerTitleData',$headerTitleData)
            ->with('plan',$plan)
            ->with('coverData',$coverData)
            ->with('provinceData',$provinceData)
            ->with('heathData', $heathData)
            ->with('districtData', $districtData);
        } else {
            return redirect()->route('welcome');
        }
    }

    public function updateUserConfirmationData(Request $req){
        if (Session('health')) {
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
            $obj = InsuranceInformation::find($req->input('update_id'));
            $obj->firstname = $req->input('firstname');
            $obj->lastname = $req->input('lastname');
            $obj->sex = $req->input('sex');
            $obj->tel = $req->input('tel');
            $obj->identity = $req->input('identity');
            $obj->dob = $req->input('dob');
            $obj->province = $req->input('province');
            $obj->district = $req->input('district');
            $obj->address = $req->input('address');

            //Image upload
            if ($req->file('reference_photo')) {
                $obj->front_image =   ImageCompress::notCompressImage($req->file('reference_photo'), 'Insurances/people');
            }
            if ($obj->save()) {
                //Set Session
                Session(['health' => $obj->id]);
                return redirect()->route('HeathSaleController.ShowPaymentProvider');
            } {
                return redirect()->back()->with('error', 'ເກີດຂໍ້ຜິດພາດກະລຸນາລອງໃໝ່');
            }
        } else {

            return redirect()->route('welcome');
        }
    }

    public function showPaymentProvider(){
    
        if(Session('health')){
            $paymentProviders = PaymentProvider::all();

            return view('insurances.heath.showPayment_providerList')
            ->with('paymentProviders', $paymentProviders);
        }else{
            return redirect()->route('welcome');
        }
    }

    public function showPaymentSubmitPage($id){
  
        if(Session('health')){
            $provider = PaymentProvider::find($id);
            return view('insurances.heath.showPaymentSubmit')
            ->with('provider',$provider);
        }else{
            return redirect()->route('welcome');
        }
    }

    public function submitHeathPayment(Request $req){
        if(Session('health')){

            $req->validate([
                'slipUploaded'=>'required'
            ]);
            $health_id = Session('health');

            $heathData = InsuranceInformation::find($health_id);
            $extension = $req->file('slipUploaded')->getClientOriginalExtension();
            $newImageCompress = ImageCompress::compressImage($req->file('slipUploaded'), 70, 'tmpfolder', 800);
            $imageData = file_get_contents($newImageCompress);
            $base64SlipImage = 'data:image/' . $extension . ';base64,' . base64_encode($imageData);

            $heathData->slipUploaded = $base64SlipImage;

            $heathData->payment_time = now();

            $heathData->save();

            session(['payment_status' => 'WAIT_FOR_APPROVED']);

            return redirect()->route('InsuranceFlowController.showComplete');


        }else{
            return redirect()->route('welcome');
        }
    }

}
