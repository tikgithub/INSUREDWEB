<?php

namespace App\Http\Controllers;

use App\Models\InsuranceCompany;
use App\Models\InsuranceInformation;
use App\Models\SaleOption;
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

    public function showUserInsuranceList(){

        $vehicleSQLQuery = "select  ii.id as insurance_id, concat(case when ii.sex = 'M' then 'ທ' when ii.sex = 'F' then 'ນາງ' End,'. ' ,ii.firstname, ' ', ii.lastname) as insuredName, ii.payment_confirm,
        ic.name as company_name, ic.logo as company_logo, ii.contract_no , ii.contract_status, ii.insurance_type_id as sale_option_id, ii.number_plate, (select province_name from Provinces where id= ii.registered_province) as registeredProvince,
        ii.color, ii.front_image , so.name as option_name , vp.name as package_name, l.name as level_name
        from insurance_information ii inner join sale_options so on ii.insurance_type_id = so.id 
        inner join vehicle_packages vp on vp.id = so.vp_id 
        inner join insurance_companies ic on ic.id = vp.c_id
        inner join levels l on l.id = vp.lvl_id 
        where ii.insurance_Type  = 'HIGH-VALUEABLE' and ii.user_id = ?";

        $thirdPartyQuery = "select  ii.id as insurance_id, concat(case when ii.sex = 'M' then 'ທ' when ii.sex = 'F' then 'ນາງ' End,'. ' ,ii.firstname, ' ', ii.lastname) as insuredName, ii.payment_confirm,
        ic.name as company_name, ic.logo as company_logo, ii.contract_no , ii.contract_status, ii.insurance_type_id as sale_option_id, ii.number_plate, 
        (select province_name from Provinces where id= ii.registered_province) as registeredProvince,
        ii.color, ii.front_image, tpp.name as package_name , tpo.name as option_name, l.name  as level_name
        from insurance_information ii inner join third_party_options tpo on ii.insurance_type_id = tpo.id
        inner join  levels l on l.id = tpo.lvl_id 
        inner join  third_party_packages tpp on tpp.id = ii.insurance_type_id 
        inner join insurance_companies ic on ic.id = tpp.company_id 
        where ii.insurance_Type  = 'THIRD-PARTY' and user_id = ?";

        $vehicleInsurance = DB::select($vehicleSQLQuery,[Auth::user()->id]);

        $thirdPartyInsurance = DB::select($thirdPartyQuery,[Auth::user()->id]);

        return view('user_view.userInsuranceList')->with('vehicleInsurance',$vehicleInsurance)->with('thirdPartyInsurance',$thirdPartyInsurance);
    }

    public function showVehicleInsuranceDetailPage($id){
        return view('user_view.vehicleinsuranceDetailView');
    }
}
