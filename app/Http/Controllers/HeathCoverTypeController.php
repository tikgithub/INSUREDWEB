<?php

namespace App\Http\Controllers;

use App\Models\HeathCoverType;
use Illuminate\Http\Request;
use App\Models\InsuranceCompany;

class HeathCoverTypeController extends Controller
{
    //Store
    public function store(Request $req){
        $req->validate([
            'name'=>'required',
            'insurance_company'=>'required'
        ]);

        //Create new object and save to DB
        $newSaveData = new HeathCoverType();
        $newSaveData->name = $req->input('name');
        $newSaveData->company_id = $req->input('insurance_company');
        $newSaveData->status = false;

        if($newSaveData->save()){
           return redirect()->back()->with('success','ດຳເນີນການສຳເລັດ');
        }else{
            return redirect()->back()->with('error','ເກີດຂໍ້ຜິດພາດກາລຸນາລອງໃໝ່');
        }
    }

    //Update
    public function update(Request $req){
       $errors =  $req->validate([
            'editId'=>'required',
            'editName'=> 'required'
        ],[
            'editName.required'=>'ກະລຸນາເພີ່ມຂໍ້ມູນໃຫ້ຄົບຖ້ວນ'
        ]);

        $updateItem = HeathCoverType::find($req->input('editId'));
        $updateItem->name = $req->input('editName');

        if($updateItem->save()){
            return redirect()->back()->with('success','ດຳເນີນການສຳເລັດ');
         }else{
             return redirect()->back()->with('error','ເກີດຂໍ້ຜິດພາດກາລຸນາລອງໃໝ່');
         }
    }

    //Delete
    public function delete($id){

        $deleteItem = HeathCoverType::find($id);

        if( $deleteItem->delete()){
            return redirect()->back()->with('success','ດຳເນີນການສຳເລັດ');
         }else{
             return redirect()->back()->with('error','ເກີດຂໍ້ຜິດພາດກາລຸນາລອງໃໝ່');
         }
    }

    //Update status
    public function updateStatus($id,$status){
        $updateItem = HeathCoverType::find($id);
        $updateItem->status = $status;
        if( $updateItem->save()){
            return redirect()->back()->with('success','ດຳເນີນການສຳເລັດ');
         }else{
             return redirect()->back()->with('error','ເກີດຂໍ້ຜິດພາດກາລຸນາລອງໃໝ່');
         }
    }

    //search by company
    public function searchByCompany($company_id){
        
        $companies = InsuranceCompany::all();
        $heathCoverTypes = HeathCoverType::where('company_id','=',$company_id)->paginate(10);
        return view('admin.curd.accidentCoverType.index')
        ->with('companies',$companies)
        ->with('company_id',$company_id)
        ->with('heathCoverTypes',$heathCoverTypes);
    }
}
