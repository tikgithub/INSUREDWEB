<?php

namespace App\Http\Controllers;

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
