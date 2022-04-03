<?php

namespace App\Http\Controllers;

use App\Models\AccidentCoverItem;
use App\Models\AccidentPlan;
use App\Models\AccidentPlanDetail;
use App\Models\HeathCoverType;
use App\Models\InsuranceCompany;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

class AccidentPlanController extends Controller
{
    public function index(){
        $companies = InsuranceCompany::all();
        return view("admin.curd.accidentPlan.create")->with('companies',$companies);
    }

    public function searchByCompany($company_id)
    {

        $companies = InsuranceCompany::all();
        $accidentType = HeathCoverType::where('company_id', '=', $company_id)->get();
        return view('admin.curd.AccidentPlan.create')
            ->with('companies', $companies)
            ->with('accidentData', $accidentType)
            ->with('searchId', $company_id);
    }

    public function managePlan($type_id){
        $plans = AccidentPlan::where("cover_type_id","=",$type_id)->get();

        $sqlQuery = "select hct.id, hct.name, ic.name as companyname, ic.logo as companylogo from heath_cover_types hct inner join
        insurance_companies ic on hct.company_id = ic.id
        Where hct.id=?;";

        $coverTypeData = collect(DB::select($sqlQuery, [$type_id]))->first();


        return view("admin.curd.accidentPlan.createPlan")
        ->with('coverTypeData',$coverTypeData)
        ->with('plans',$plans);

    }

    public function store(Request $req)
    {
        $req->validate([
            "cover_type_id" => 'required',
            "name" => 'required',
            'start_age' => 'required',
            'end_age' => 'required',
            'fee' => 'required',
            'sale_price'=> 'required'
        ]);

        //Create object and store
        $data = new AccidentPlan();
        $data->cover_type_id = $req->input('cover_type_id');
        $data->name = $req->input("name");
        $data->start_age  = $req->input('start_age');
        $data->end_age = $req->input('end_age');
        $data->fee = $req->input('fee');
        $data->sale_price = $req->input('sale_price');
        if($data->save()){
            //Create the plan detail
            $coverItems = AccidentCoverItem::where("cover_type_id","=",$req->input('cover_type_id'))->get();

            foreach($coverItems as $item){
               $cover = new AccidentPlanDetail();
               $cover->plan_id = $data->id;
               $cover->item_id = $item->id;
               $cover->save();
            }


            return redirect()->back()->with('success','ດຳເນີນການສຳເລັດ');
        }else{
            return redirect()->back()->with("error","ເກີດຂໍ້ຜິດພາດກະລຸນາລອງໃໝ່");
        }
    }

    public function delete($id){
        $data = AccidentPlan::find($id);

        if($data->delete()){

            AccidentPlanDetail::where("plan_id","=",$id)->delete();

            return redirect()->back()->with('success','ດຳເນີນການສຳເລັດ');
        }else{
            return redirect()->back()->with("error","ເກີດຂໍ້ຜິດພາດກະລຸນາລອງໃໝ່");
        }
    }

    public function update(Request $req){
        $req->validate([
            'editId'=>'required',
            'editName'=>'required',
            'editStartAge'=>'required',
            'editEndAge'=>'required',
            'editFee'=> 'required',
            'editSalePrice'=>'required'
        ]);
        //Find and Update
        $data = AccidentPlan::find($req->input('editId'));
        $data->name = $req->input('editName');
        $data->start_age = $req->input('editStartAge');
        $data->end_age = $req->input('editEndAge');
        $data->fee = $req->input('editFee');
        $data->sale_price = $req->input('editSalePrice');

        if($data->save()){
            return redirect()->back()->with('success','ດຳເນີນການສຳເລັດ');
        }else{
            return redirect()->back()->with("error","ເກີດຂໍ້ຜິດພາດກະລຸນາລອງໃໝ່");
        }

    }

    public function showPlanDetail($plan_id){

        //get the accident plan detail
        $planDetail = AccidentPlan::find($plan_id);

        //Find the cover item of this cover type id
        $allCoverItem = AccidentCoverItem::where('cover_type_id','=',$planDetail->cover_type_id)->get();

       
        $coverTypeDataQuery = "select hct.id, hct.name, ic.name as companyname, ic.logo as companylogo from heath_cover_types hct inner join
        insurance_companies ic on hct.company_id = ic.id
        Where hct.id=?;";

        $coverTypeData = collect(DB::select($coverTypeDataQuery, [$planDetail->cover_type_id]))->first();

        $planItemDetailQuery = "SELECT apd.id, apd.cover_price, aci.item, apd.plan_id, apd.item_id from accident_plan_details apd inner join accident_cover_items aci on aci.id = apd.item_id where apd.plan_id = ?";

        $planItemDetails = DB::select($planItemDetailQuery,[$plan_id]);

         //Compare with current item and all item 
        //If items not have the same 
        //then insert the different to db
        $newItem =  array();
  
        for($i = 0; $i < sizeof($allCoverItem);$i++){
            $exist = false;
           for($j = 0; $j < sizeof($planItemDetails);$j++){
               //When data is exit then exit loop and continue next for value
               if($allCoverItem[$i]->id == $planItemDetails[$j]->item_id){
                    $exist = true;
                    break;
               }
           }
           //If the checker is false then add new one
           if($exist==false){
                array_push($newItem,$allCoverItem[$i]);
           }
        }

        //When have new data then insert new data to plan 
        for($i = 0 ; $i < sizeof($newItem);$i++){
            $newPlanItem = new AccidentPlanDetail();
            $newPlanItem->plan_id = $plan_id;
            $newPlanItem->item_id = $newItem[$i]->id;
            $newPlanItem->save();
        }

        //query new item list to show at page
        $newPlanItemDetails = DB::select($planItemDetailQuery,[$plan_id]);
    
        return view('admin.curd.accidentPlan.accidentPlanDetail')
        ->with('planDetail',$planDetail)
        ->with('planItemDetails',$newPlanItemDetails)
        ->with('coverTypeData',$coverTypeData);
    }

    public function updatePrice(Request $req){
        $req->validate([
            'update_id'=>'required',
            'update_price'=>'required'
        ]);
        
        $updateRow = AccidentPlanDetail::find($req->input('update_id'));
        $updateRow->cover_price = $req->input("update_price");
        

        if($updateRow->save()){
            return redirect()->back()->with('success','ດຳເນີນການສຳເລັດ');
        }else{
            return redirect()->back()->with("error","ເກີດຂໍ້ຜິດພາດກະລຸນາລອງໃໝ່");
        }
    }

}
