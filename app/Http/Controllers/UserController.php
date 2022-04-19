<?php

namespace App\Http\Controllers;

use App\Models\InsuranceCompany;
use App\Models\InsuranceInformation;
use App\Models\SaleOption;
use App\Models\ThirdPartyCoverItem;
use App\Models\User;
use App\Models\VehicleInsuranceDetail;
use App\Models\VehiclePackage;
use App\Utils\ImageCompress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class UserController extends Controller
{
    /** Function to login page */
    public function showLoginPage()
    {
        return view('user_view.login');
    }

    /** Function to show the register page */
    public function showRegisterPage()
    {

        return view('user_view.register');
    }

    /** Function to store the user register information to DB (Default role by 'user') */
    public function storeUserInformation(Request $req)
    {
        /** Validate User input */
        $req->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'tel' => 'required',
            'password' => 'required|min:6|required_with:confirmedPassword|same:confirmedPassword',
            'confirmedPassword' => 'required|min:6'
        ], [
            'password.required' => 'ກາລຸນາລະບຸລະຫັດຜ່ານ',
            'confirmedPassword.required' => 'ກາລຸນາຢືນຢັນລະຫັດຜ່ານ',
            'password.same' => 'ລະຫັດຜ່ານາບໍ່ກົງກັນກາລຸນາກວດສອບອີກຄັ້ງ',
            'password.min' => 'ລະຫັດຜ່ານຕ້ອງຫຼາຍກວ່າ 6 ໂຕ'
        ]);
        $user = new User();
        $user->firstname = $req->input('firstname');
        $user->lastname = $req->input('lastname');
        $user->email = $req->input('email');
        $user->tel = $req->input('tel');
        $user->password = Hash::make($req->input('password'));
        $user->role = "user";
        $user->save();

        Auth::attempt(['email' => $user->email, 'password' => $req->password]);

        return redirect()->back()->with('success', 'ດຳເນີນການສຳເລັດ');
    }
    /** Function to logout the user  */
    public function logOut()
    {
        Auth::logout();
        return redirect()->route('welcome');
    }

    /** Function to SigIn User (For Welcome Page) */
    public function signIn(Request $req)
    {
        $req->validate([
            'email' => 'required',
            'password' => 'required|min:6'
        ], [
            'password.required' => 'ກາລຸນາລະບຸລະຫັດຜ່ານ',
            'password.min' => 'ລະຫັດຜ່ານຫຼາຍກວ່າ 6'
        ]);
        /** Send to Laravel Sign */
        if (Auth::attempt(['email' => $req->input('email'), 'password' => $req->input('password')])) {
            if (Auth::user()->role == 'admin') {
                return redirect()->route('AdminController.showNewAdminDashBoard');
            } else {
                return redirect()->route('welcome');
            }
        } else {
            return redirect()->route('UserController.showLoginPage')->with('warning', 'ບໍ່ສາມາດເຂົ້າສູ່ລະບົບໄດ້ກາລຸນາກວດສອບ email ແລະ ລະຫັດຜ່ານອີກຄັ້ງ')->withInput();
        }
    }
    //ືົດ
    /** public function validate user before buying */
    public function validateUserBeforeBuying(Request $req)
    {
        $req->validate([
            'email' => 'required',
            'password' => 'required|min:6'
        ], [
            'password.required' => 'ກາລຸນາລະບຸລະຫັດຜ່ານ',
            'password.min' => 'ລະຫັດຜ່ານຫຼາຍກວ່າ 6'
        ]);
        /** Send to Laravel Sign */
        if (Auth::attempt(['email' => $req->input('email'), 'password' => $req->input('password')])) {
            return redirect()->back();
        } else {
            return redirect()->back()->with('erorr', 'ບໍ່ສາມາດເຂົ້າສູ່ລະບົບໄດ້ກາລຸນາກວດສອບ email ແລະ ລະຫັດຜ່ານອີກຄັ້ງ')->withInput();
        }
    }
    /** List all the insurance data which customer having now */
    // public function userListInsurance()
    // {
    //     //Get user Information
    //     $user = Auth::user();

    //     //Get Information of Normal insurance
    //     $insuranceData = VehicleInsuranceDetail::where('user_id', '=', $user->id)->get();
    //     //Get ThirdParty Insurance data of user
    //     $query = "SELECT tpci.id, tpp.name  as package_name, ic.name  as company_name, ic.logo, tpci.total_price, c.name as vehicle_brand, pro.province_name as registered_province,
    //     tpci .number_plate ,tpci.engine_number , tpci.chassic_number, tpci.payment_time, tpci .payment_confirm, tpci .slip_confirmed, tpci.third_package_id, tpci.contract_no
    //     FROM third_party_customer_inputs tpci inner join provinces p on p.id = tpci.id
    //     inner join third_party_packages tpp on tpp.id = tpci.third_package_id
    //     INNER join insurance_companies ic on ic.id = tpp.company_id
    //     INNER join carbrands c on c.id = tpci.vehicle_brand
    //     inner join provinces pro on pro.id = tpci.registered_province
    //     Where tpci .user_id  = ?";
    //     $thirdPartyList = (DB::select($query,[Auth::user()->id]));

    //     return view('user_view.insuranceList')
    //         ->with('orderData', $insuranceData)
    //         ->with('thirdPartyList',$thirdPartyList);
    // }

    /** User Profile viewer */
    public function showUserProfilePage()
    {
        //Get User ID from Auth Facades
        $user = Auth::user();
        return view('user_view.profile')->with('user', $user);
    }

    /** Functino Profile change */
    public function changeProfilePhoto(Request $req)
    {
        $user = Auth::user();
        $req->validate(['profile_photo' => 'required']);
        //Compress image and store to Folder
        $userDB = User::find($user->id);
        //Delete old image
        if ($userDB->profile_photo) {
            \Illuminate\Support\Facades\File::delete($userDB->profile_Photo);
        }
        $photo_path = ImageCompress::compressImage($req->file('profile_photo'), 30, 'UserImages', 300);
        $userDB->profile_photo = $photo_path;
        $userDB->save();
        return redirect()->route('UserController.showUserProfilePage')->with('success', 'ດຳເນີນການສຳເລັດ');
    }

    /** Function to update basic information */
    public function updateBasicInformation(Request $req)
    {
        $user = User::find(Auth::user()->id);
        $req->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'tel' => 'required'
        ]);

        $user->firstname = $req->input('firstname');
        $user->lastname = $req->input('lastname');
        $user->email = $req->input('email');
        $user->tel = $req->input('tel');
        $user->save();
        return redirect()->route('UserController.showUserProfilePage')->with('success', 'ດຳເນີນການສຳເລັດ');
    }

    /** Function to changePassword of User */
    public function changeUserPassword(Request $req)
    {
        $user = User::find(Auth::user()->id);

        $req->validate([
            'oldPassword' => 'required',
            'confirmedPassword1' => 'required|min:6|required_with:confirmedPassword2|same:confirmedPassword2',
            'confirmedPassword1' => 'required|min:6'
        ], [
            'oldPassword.required' => 'ກາລຸນາລະບຸລະຫັດຜ່ານ',
            'confirmedPassword1.required' => 'ກາລຸນາຢືນຢັນລະຫັດຜ່ານ',
            'confirmedPassword1.same' => 'ລະຫັດຜ່ານາບໍ່ກົງກັນກາລຸນາກວດສອບອີກຄັ້ງ',
            'confirmedPassword1.min' => 'ລະຫັດຜ່ານຕ້ອງຫຼາຍກວ່າ 6 ໂຕ'
        ]);

        if (!Auth::attempt(['email' => $user->email, 'password' => $req->input('oldPassword')])) {
            return redirect()->route('UserController.showUserProfilePage')->with('error', 'ລະຫັດຜ່ານເກົ່າບໍ່ຖືກຕ້ອງ');
        }



        $user->password = Hash::make($req->input('confirmedPassword1'));

        $user->save();
        Auth::attempt(['email' => $user->email, 'password' => $user->password]);
        return redirect()->route('UserController.showUserProfilePage')->with('success', 'ດຳເນີນການສຳເລັດ');
    }

    public function showUserInsuranceList()
    {

        $vehicleSQLQuery = "select  ii.id as insurance_id, concat(case when ii.sex = 'M' then 'ທ' when ii.sex = 'F' then 'ນາງ' End,'. ' ,ii.firstname, ' ', ii.lastname) as insuredName, ii.payment_confirm,
        ic.name as company_name, ic.logo as company_logo, ii.contract_no , ii.contract_status, ii.insurance_type_id as sale_option_id, ii.number_plate, (select province_name from Provinces where id= ii.registered_province) as registeredProvince,
        ii.color, ii.front_image , so.name as option_name , vp.name as package_name, l.name as level_name,ii.end_date
        from insurance_information ii inner join sale_options so on ii.insurance_type_id = so.id 
        inner join vehicle_packages vp on vp.id = so.vp_id 
        inner join insurance_companies ic on ic.id = vp.c_id
        inner join levels l on l.id = vp.lvl_id 
        where ii.insurance_Type  = 'HIGH-VALUEABLE' and ii.user_id = ?";

        $thirdPartyQuery = "select  ii.id as insurance_id, concat(case when ii.sex = 'M' then 'ທ' when ii.sex = 'F' then 'ນາງ' End,'. ' ,ii.firstname, ' ', ii.lastname) as insuredName, ii.payment_confirm,
        ic.name as company_name, ic.logo as company_logo, ii.contract_no , ii.contract_status, ii.insurance_type_id as sale_option_id, ii.number_plate, 
        (select province_name from Provinces where id= ii.registered_province) as registeredProvince,
        ii.color, ii.front_image, tpp.name as package_name , tpo.name as option_name, l.name  as level_name, ii.end_date
        from insurance_information ii inner join third_party_options tpo on ii.insurance_type_id = tpo.id
        inner join  levels l on l.id = tpo.lvl_id 
        inner join  third_party_packages tpp on tpp.id = ii.insurance_type_id 
        inner join insurance_companies ic on ic.id = tpp.company_id 
        where ii.insurance_Type  = 'THIRD-PARTY' and user_id = ?";

        $accidentInsuranceQuery = "SELECT ii.id as insurance_id, ic.name  as company_name, ap.name as plan_name, hct.name as package_name, concat(case ii.sex when('M') then 'ທ້າວ. ' when('F') then 'ນາງ. ' End ,' ',ii.firstname,' ', ii.lastname) as insuredName,
        ic.logo  as company_logo, ii.payment_confirm, (select province_name from provinces where id = ii.province) as province, ii.end_date
        FROM insurance_information ii
        inner join accident_plans ap on ap.id = ii.insurance_type_id 
        inner JOIN  heath_cover_types hct  on hct.id = ap.cover_type_id
        INNER JOIN  insurance_companies ic  on ic.id  = hct.company_id
        Where ii.insurance_Type ='ACCIDENT' And user_id=?";

        $heathInsuranceQuery = "SELECT ii.id as insurance_id, ic.name  as company_name, hp.name as plan_name, hc.name as package_name, concat(case ii.sex when('M') then 'ທ້າວ. ' when('F') then 'ນາງ. ' End ,' ',ii.firstname,' ', ii.lastname) as insuredName,
        ic.logo  as company_logo, ii.payment_confirm, (select province_name from provinces where id = ii.province) as province, ii.end_date
        FROM insurance_information ii
        inner join heath_plans hp on hp.id = ii.insurance_type_id 
        inner JOIN  heath_covers hc on hc.id = hp.cover_type_id
        INNER JOIN  insurance_companies ic  on ic.id  = hc.company_id
        Where ii.insurance_Type ='HEATH' And user_id = ?";

        $vehicleInsurance = DB::select($vehicleSQLQuery, [Auth::user()->id]);

        $thirdPartyInsurance = DB::select($thirdPartyQuery, [Auth::user()->id]);

        $accidentInsurance = DB::select($accidentInsuranceQuery, [Auth::user()->id]);

        $heathInsurance = DB::select($heathInsuranceQuery, [Auth::user()->id]);

        return view('user_view.userInsuranceList')
            ->with('vehicleInsurance', $vehicleInsurance)
            ->with('thirdPartyInsurance', $thirdPartyInsurance)
            ->with('accidentInsurance', $accidentInsurance)
            ->with('heathInsurance', $heathInsurance);
    }

    public function insuranceViewDetail($insurance_id)
    {
        $insurance = InsuranceInformation::find($insurance_id);
        //Check which type of insurance

        $vehicleInsurance = null;

        switch ($insurance->insurance_Type) {
            case "HIGH-VALUEABLE":
                $vehicleSQLQuery = "select  ii.id as insurance_id, concat(case when ii.sex = 'M' then 'ທ' when ii.sex = 'F' then 'ນາງ' End,'. ' ,ii.firstname, ' ', ii.lastname) as insuredName, ii.payment_confirm,
                ic.name as company_name, ic.logo as company_logo, ii.contract_no , ii.contract_status, ii.insurance_type_id as sale_option_id, ii.number_plate, (select province_name from Provinces where id= ii.registered_province) as registeredProvince,
                ii.color, ii.front_image , so.name as option_name , vp.name as package_name, l.name as level_name
                from insurance_information ii inner join sale_options so on ii.insurance_type_id = so.id 
                inner join vehicle_packages vp on vp.id = so.vp_id 
                inner join insurance_companies ic on ic.id = vp.c_id
                inner join levels l on l.id = vp.lvl_id 
                where ii.insurance_Type  = 'HIGH-VALUEABLE' and ii.user_id = ? and ii.id = ?";
                $vehicleInsurance = collect(DB::select($vehicleSQLQuery, [Auth::user()->id, $insurance_id]))->first();

                $query = "SELECT ci.id, cg.id as group_id ,cg.name as group_name, ci.name as item_name, sod.price as cover_price FROM cover_groups cg Inner join cover_items ci on cg.id  = ci.cg_id INNER join sale_option_details sod on
                sod.ci_id = ci.id INNER JOIN sale_options so on so.id = sod.sale_id
                WHERE so.id  = ?";
                $saleOptionDetail = DB::select($query, [$insurance->insurance_type_id]);

                return view('user_view.vehicleInsuranceViewDetail')
                    ->with('insuranceDetail', $vehicleInsurance)
                    ->with('insurance', $insurance)
                    ->with('saleDetails', $saleOptionDetail);
                break;

            case "THIRD-PARTY":
                $thirdPartyQuery = "select  ii.id as insurance_id, concat(case when ii.sex = 'M' then 'ທ' when ii.sex = 'F' then 'ນາງ' End,'. ' ,ii.firstname, ' ', ii.lastname) as insuredName, ii.payment_confirm,
                ic.name as company_name, ic.logo as company_logo, ii.contract_no , ii.contract_status, ii.insurance_type_id as sale_option_id, ii.number_plate, 
                (select province_name from Provinces where id= ii.registered_province) as registeredProvince,
                ii.color, ii.front_image, tpp.name as package_name , tpo.name as option_name, l.name  as level_name
                from insurance_information ii inner join third_party_options tpo on ii.insurance_type_id = tpo.id
                inner join  levels l on l.id = tpo.lvl_id 
                inner join  third_party_packages tpp on tpp.id = ii.insurance_type_id 
                inner join insurance_companies ic on ic.id = tpp.company_id 
                where ii.insurance_Type  = 'THIRD-PARTY' and user_id = ? and ii.id =? ";
                $thirdPartInsurance = collect(DB::select($thirdPartyQuery, [Auth::user()->id, $insurance_id]))->first();


                //Get cover item detail
                $coverDetail = ThirdPartyCoverItem::where('third_package_id', '=', $insurance->insurance_type_id)->get();
                return view('user_view.thirdParyInsuranceViewDetail')
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
                Where ii.insurance_Type ='ACCIDENT' And ii.user_id=? and ii.id = ?";
                $accidentInsurance = collect(DB::select($accidentInsuranceQuery, [Auth::user()->id, $insurance_id]))->first();

                //Query the cover item and cover price
                $queryCoverData = "SELECT accident_plan_details.id, accident_cover_items.item, accident_plan_details.cover_price FROM accident_plan_details
            INNER JOIN accident_plans on accident_plans.id = accident_plan_details.plan_id
            INNER JOIN accident_cover_items on accident_plan_details.item_id = accident_cover_items.id WHERE accident_plan_details.plan_id = ?;";
                $coverData = DB::select($queryCoverData, [$insurance->insurance_type_id]);

                return view('user_view.accidentInsuranceViewDetail')
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
                Where ii.insurance_Type ='HEATH' And ii.user_id = ? and ii.id = ?";

                $heathInsurance = collect(DB::select($heathInsuranceQuery, [Auth::user()->id, $insurance_id]))->first();

                $coverDataQuery = "select hpd.id, hci.name, hpd.cover_price  from heath_plan_details hpd 
                inner join heath_cover_items hci on hci.id  = hpd.item_id 
                where hpd.plan_id  = ?";
                $coverData = collect(DB::select($coverDataQuery, [$insurance->insurance_type_id]));


                return view('user_view.heathInsuranceViewDetail')
                    ->with('heathInsurance', $heathInsurance)
                    ->with('insurance', $insurance)
                    ->with('coverDetail', $coverData);


                break;
        }
    }

    public function setVehicleInsuranceID($id)
    {
        $insurance = InsuranceInformation::find($id);
        switch ($insurance->insurance_Type) {
            case "HIGH-VALUEABLE":
                Session(['input_id' => $id]);
                return redirect()->route('InsuranceFlowController.showAgreementPage');
                break;
            case "THIRD-PARTY":
                session(['third_package_id' => $id]);
                return redirect()->route('InsuranceFlowController.showThirdPartyAgreement', ['package_id' => $id]);
                break;
            case "ACCIDENT":
                Session(['accident_id' => $id]);
                return redirect()->route('AccidentSaleController.showConfirmationPage');
                break;
            case "HEATH":
                Session(['health' => $id]);
                return redirect()->route('HeathSaleController.ShowUserConfirmationPage');
                break;
        }
    }
}
