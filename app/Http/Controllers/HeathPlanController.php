<?php

namespace App\Http\Controllers;

use App\Models\HeathCoverItem;
use App\Models\HeathPlan;
use App\Models\HeathPlanDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HeathPlanController extends Controller
{
    public function create($cover_type_id){

        $headerTitleQuery = "SELECT hc.id, hc.name as cover_name, ic.name  as company_name, ic.logo  
        FROM heath_covers hc inner join insurance_companies ic on hc.company_id = ic.id 
        where hc.id =?";
        $headerTitleData = collect(DB::select($headerTitleQuery,[$cover_type_id]))->first();

        $plans = HeathPlan::where('cover_type_id','=',$cover_type_id)->get();


        return view('admin.curd.heathPlan.create')
        ->with('headerTitleData',$headerTitleData)
        ->with('plans',$plans);
    }

    public function store(Request $req){
        $req->validate([
            'cover_type_id'=>'required',
            'name'=>'required',
            'sale_price'=>'required',
            'fee'=>'required',
            'start_age'=>'required',
            'end_age'=>'required'
        ]);

        $item = new HeathPlan();
        $item->cover_type_id = $req->input('cover_type_id');
        $item->name = $req->input('name');
        $item->sale_price = $req->input('sale_price');
        $item->fee = $req->input('fee');
        $item->start_age = $req->input('start_age');
        $item->end_age = $req->input('end_age');

        if($item->save()){
            //Find the cover items and save them to db
            $coverItems = HeathCoverItem::where('cover_type_id','=',$req->input('cover_type_id'))->get();

            // Loop cover item 

            for($i = 0 ; $i < sizeof($coverItems);$i++){

                $planDetail = new HeathPlanDetail();
                $planDetail->plan_id = $item->id;
                $planDetail->item_id = $coverItems[$i]->id;
                $planDetail->save();
            }

            return redirect()->back()->with('success','ດຳເນີນການສຳເລັດ');
        }else{
            return redirect()->back()->with('error','ດຳເນີນການບໍ່ສຳເລັດກະລຸນາລອງໃໝ່');
        }
    }

    public function update(Request $req){
        $req->validate([
            'id'=>'required',
            'name'=>'required',
            'sale_price'=>'required',
            'fee'=>'required',
            'start_age'=>'required',
            'end_age'=>'required'
        ]);

        $item = HeathPlan::find($req->input('id'));
        $item->name = $req->input('name');
        $item->sale_price = $req->input('sale_price');
        $item->fee = $req->input('fee');
        $item->start_age = $req->input('start_age');
        $item->end_age = $req->input('end_age');

        if($item->save()){
            return redirect()->back()->with('success','ດຳເນີນການສຳເລັດ');
        }else{
            return redirect()->back()->with('error','ດຳເນີນການບໍ່ສຳເລັດກະລຸນາລອງໃໝ່');
        }
    }
}
