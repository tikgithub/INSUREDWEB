<?php

namespace App\Http\Controllers;

use App\Models\InsuranceCompany;
use App\Models\SaleOption;
use App\Models\User;
use App\Models\VehicleInsuranceDetail;
use App\Models\VehiclePackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /** Function to login page */
    public function showLoginPage(){
        return view('user_view.login');
    }

    /** Function to show the register page */
    public function showRegisterPage(){

        return view('user_view.register');
    }

    /** Function to store the user register information to DB (Default role by 'user') */
    public function storeUserInformation(Request $req){
        /** Validate User input */
        $req->validate([
            'firstname' => 'required',
            'lastname'=>'required',
            'email' => 'required',
            'tel' => 'required',
            'password'=>'required|min:6|required_with:confirmedPassword|same:confirmedPassword',
            'confirmedPassword'=>'required|min:6'
        ],[
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

        Auth::attempt(['email'=>$user->email,'password'=>$req->password]);

        return redirect()->back()->with('success','ດຳເນີນການສຳເລັດ');
    }
    /** Function to logout the user  */
    public function logOut(){
        Auth::logout();
        return redirect()->route('welcome');
    }

    /** Function to SigIn User (For Welcome Page) */
    public function signIn(Request $req){
        $req->validate([
            'email'=>'required',
            'password'=>'required|min:6'
        ],[
            'password.required'=>'ກາລຸນາລະບຸລະຫັດຜ່ານ',
            'password.min'=>'ລະຫັດຜ່ານຫຼາຍກວ່າ 6'
        ]);
        /** Send to Laravel Sign */
        if(Auth::attempt(['email'=>$req->input('email'),'password'=>$req->input('password')])){
            return redirect()->route('welcome');
        }else{
            return redirect()->route('UserController.showLoginPage')->with('warning','ບໍ່ສາມາດເຂົ້າສູ່ລະບົບໄດ້ກາລຸນາກວດສອບ email ແລະ ລະຫັດຜ່ານອີກຄັ້ງ');
        }
    }

    /** public function validate user before buying */
    public function validateUserBeforeBuying(Request $req){
        $req->validate([
            'email'=>'required',
            'password'=>'required|min:6'
        ],[
            'password.required'=>'ກາລຸນາລະບຸລະຫັດຜ່ານ',
            'password.min'=>'ລະຫັດຜ່ານຫຼາຍກວ່າ 6'
        ]);
        /** Send to Laravel Sign */
        if(Auth::attempt(['email'=>$req->input('email'),'password'=>$req->input('password')])){
            return redirect()->back();
        }else{
            return redirect()->back()->with('erorr','ບໍ່ສາມາດເຂົ້າສູ່ລະບົບໄດ້ກາລຸນາກວດສອບ email ແລະ ລະຫັດຜ່ານອີກຄັ້ງ');
        }
    }
    /** List all the insurance data which customer having now */
    public function userListInsurance(){
        //Get user Information
        $user = Auth::user();

        //Get Information of Normal insurance
        $insuranceData = VehicleInsuranceDetail::where('user_id','=',$user->id)->get();


        return view('user_view.insuranceList')
        ->with('orderData',$insuranceData);
    }
}
