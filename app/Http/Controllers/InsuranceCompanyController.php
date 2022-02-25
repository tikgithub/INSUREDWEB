<?php

namespace App\Http\Controllers;

use App\Models\InsuranceCompany;
use App\Utils\ImageCompress;
use Illuminate\Http\Request;

class InsuranceCompanyController extends Controller
{
    /** Store insurance company */
    public function store(Request $req){
        $req->validate([
            'name'=>'required|unique:insurance_companies,name',
            'info'=>'required',
            'address'=>'required',
            'logo'=>'required',
            'contact'=>'required'
        ]);

        $newCompany = new InsuranceCompany();
        $newCompany->name = $req->input('name');
        $newCompany->info = $req->input('info');
        $newCompany->address = $req->input('address');
        $newCompany->contact = $req->input('contact');
        $newCompany->logo = ImageCompress::notCompressImage($req->file('logo'),'Companies');
        if($newCompany->save()){
            return redirect()->back()->with('success','ດຳເນີນການສຳເລັດ');
        }else{
            return redirect()->back()->with('error','ເກີດຂໍ້ຜິດພາດອີກຄັ້ງ ກະລຸນາລອງໃໝ່ ');
        }
    }
    /** funtion to update the company insurance */
    public function update(Request $req){
        $req->validate([
            'name'=>'required',
            'info'=>'required',
            'address'=>'required',
            'contact'=>'required'
        ]);
        //find the object
        $company = InsuranceCompany::find($req->input('editId'));
        $company->name = $req->input('name');
        $company->info = $req->input('info');
        $company->contact = $req->input('contact');
        $company->address = $req->input('address');
        //When logo has been upload
        if($req->file('logo')){
            //delete the old image
            \Illuminate\Support\Facades\File::delete($company->logo);
            //Upload new logo
            $company->logo = ImageCompress::notCompressImage($req->file('logo'),'Companies');
        }

        if($company->save()){
            return redirect()->back()->with('success','ດຳເນີນການສຳເລັດ');
        }else{
            return redirect()->back()->with('error','ເກີດຂໍ້ຜິດພາດອີກຄັ້ງ ກະລຸນາລອງໃໝ່ ');
        }


    }
}
