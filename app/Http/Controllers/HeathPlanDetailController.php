<?php

namespace App\Http\Controllers;

use App\Models\HeathCoverItem;
use App\Models\HeathPlan;
use App\Models\HeathPlanDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HeathPlanDetailController extends Controller
{
    public function index($plan_id){

        $headerTitleQuery = "SELECT hc.id, hc.name as cover_name, ic.name  as company_name, ic.logo , hp.name as plan_name
        FROM heath_covers hc 
        inner join insurance_companies ic on hc.company_id = ic.id
        inner join heath_plans hp on hp.cover_type_id  = hc.id 
        where hp.id  = ?";

        $headerTitleData = collect(DB::select($headerTitleQuery,[$plan_id]))->first();


        $priceUpdateQuery = "select  hpd.id, hci.name as item_name, hpd.cover_price  from heath_plan_details hpd
        inner join heath_cover_items hci on hpd.item_id = hci.id 
        where hpd.plan_id  = ?";

        $priceUpdateData = DB::select($priceUpdateQuery,[$plan_id]);

        $coverItems = collect(HeathCoverItem::where('cover_type_id','=', HeathPlan::find($plan_id)->cover_type_id)->get());

        for($i = 0; $i < sizeof($coverItems); $i++){
            $isInsert = true;
            for($j = 0; $j < sizeof($priceUpdateData);$j++){
                if($coverItems[$i]->name == $priceUpdateData[$j]->item_name){
                    error_log($coverItems[$i]->name);
                    $isInsert = false;
                    continue;
                }
            }
            if($isInsert==true){
                $newItem = new HeathPlanDetail();
                $newItem->item_id = $coverItems[$i]->id;
                $newItem->plan_id = $plan_id;
                $newItem->save();
            }
        }
        
        //Re fresh the data
        $priceUpdateData = DB::select($priceUpdateQuery,[$plan_id]);

        return view('admin.curd.heathPlan.planDetail')
        ->with('headerTitleData',$headerTitleData)
        ->with('priceUpdateData',$priceUpdateData);

    }

    public function update(Request $req,$plan_detail_id){
        $req->validate([
            'cover_price'=>'required'
        ]);
        $planDetail = HeathPlanDetail::find($plan_detail_id);
        $planDetail->cover_price = $req->input('cover_price');

        if($planDetail->save()){
            return redirect()->back()->with('success','ດຳເນີນການສຳເລັດ');
        }else{
            return redirect()->back()->with('error','ເກີດຂໍ້ຜິດພາດກະລຸນາລອງໃໝ່');
        }
        
    }
}
