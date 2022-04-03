<?php

namespace App\Http\Controllers;

use App\Models\AccidentPlan;
use App\Models\HeathCoverType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccidentSaleController extends Controller
{
    public function showSelectCompany()
    {
        $companyQuery = "SELECT distinct ic.id as company_id, ic.name as company_name, ic.logo FROM insurance_companies ic INNER JOIN heath_cover_types hct on ic.id = hct.company_id where hct.status = 1;";
        $companyQueryDatas = DB::select($companyQuery);
       
        return view('insurances.accident.select_company')
        ->with('companyQueryDatas',$companyQueryDatas);
    }

    public function showPackagePlan($company_id){
        $accidentType = HeathCoverType::where('company_id','=',$company_id)->get();

        return view('insurances.accident.select_package')->with('accidentDetails',$accidentType);
    }

    public function showPlanDetail($plan_id){

        $queryAccidentData = "SELECT accident_plans.id, accident_plans.name as planName, insurance_companies.name as companyName, insurance_companies.logo, heath_cover_types.name as coverType FROM accident_plans 
        INNER JOIN heath_cover_types on accident_plans.cover_type_id = heath_cover_types.id 
        INNER JOIN insurance_companies on insurance_companies.id = heath_cover_types.company_id WHERE accident_plans.id = ?;";
        $planDatas = collect(DB::select($queryAccidentData,[$plan_id]))->first();

        //Query the cover item and cover price
        $queryCoverData = "SELECT accident_plan_details.id, accident_cover_items.item, accident_plan_details.cover_price FROM accident_plan_details 
        INNER JOIN accident_plans on accident_plans.id = accident_plan_details.plan_id 
        INNER JOIN accident_cover_items on accident_plan_details.item_id = accident_cover_items.id WHERE accident_plan_details.plan_id = ?;";
        $coverData = DB::select($queryCoverData,[$plan_id]);

        //Query the plan detail
        $plan = AccidentPlan::find($plan_id);

        return view('insurances.accident.show_selected_package')
        ->with('planDatas',$planDatas)
        ->with('coverData',$coverData)
        ->with('plan',$plan);
    }

    public function showInputInformationPage($plan_id){
        
        $queryAccidentData = "SELECT accident_plans.id, accident_plans.name as planName, insurance_companies.name as companyName, insurance_companies.logo, heath_cover_types.name as coverType FROM accident_plans 
        INNER JOIN heath_cover_types on accident_plans.cover_type_id = heath_cover_types.id 
        INNER JOIN insurance_companies on insurance_companies.id = heath_cover_types.company_id WHERE accident_plans.id = ?;";
        $planData = collect(DB::select($queryAccidentData,[$plan_id]))->first();

        //Show cover Item detail
         //Query the cover item and cover price
         $queryCoverData = "SELECT accident_plan_details.id, accident_cover_items.item, accident_plan_details.cover_price FROM accident_plan_details 
         INNER JOIN accident_plans on accident_plans.id = accident_plan_details.plan_id 
         INNER JOIN accident_cover_items on accident_plan_details.item_id = accident_cover_items.id WHERE accident_plan_details.plan_id = ?;";
         $coverData = DB::select($queryCoverData,[$plan_id]);
 
         //Query the plan detail
         $plan = AccidentPlan::find($plan_id);


        return view('insurances.accident.input_customer_info')
        ->with('planDatas',$planData)
        ->with('coverData',$coverData)
        ->with('plan',$plan);
    }
}
