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
            "name" => 'required'
        ]);

        //Create object and store
        $data = new AccidentPlan();
        $data->cover_type_id = $req->input('cover_type_id');
        $data->name = $req->input("name");
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
            'editName'=>'required'
        ]);
        //Find and Update
        $data = AccidentPlan::find($req->input('editId'));
        $data->name = $req->input('editName');
        if($data->save()){
            return redirect()->back()->with('success','ດຳເນີນການສຳເລັດ');
        }else{
            return redirect()->back()->with("error","ເກີດຂໍ້ຜິດພາດກະລຸນາລອງໃໝ່");
        }

    }

    public function showPlanDetail($plan_id){

        //get the accident plan detail
        $planDetail = AccidentPlan::find($plan_id);

        $coverTypeDataQuery = "select hct.id, hct.name, ic.name as companyname, ic.logo as companylogo from heath_cover_types hct inner join
        insurance_companies ic on hct.company_id = ic.id
        Where hct.id=?;";

        $coverTypeData = collect(DB::select($coverTypeDataQuery, [$planDetail->cover_type_id]))->first();

        $planItemDetailQuery = "SELECT * from accident_plan_details apd inner join accident_cover_items aci on aci.id = apd.item_id where apd.plan_id = ?";

        $planItemDetails = DB::select($planItemDetailQuery,[$plan_id]);

        return view('admin.curd.accidentPlan.accidentPlanDetail')
        ->with('planDetail',$planDetail)
        ->with('planItemDetails',$planItemDetails)
        ->with('coverTypeData',$coverTypeData);
    }

    public function updatePrice(Request $req){

        // $planDetail = AccidentPlanDetail::find($req->input('update_id'));
        // $planDetail->cover_price = $req->input('update_price');
        // $planDetail->save();

         error_log("incomming");

        return response()->json(['name' => 'Virat Gandhi', 'state' => 'Gujarat']);
    }

}
