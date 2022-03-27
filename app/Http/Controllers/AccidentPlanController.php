<?php

namespace App\Http\Controllers;

use App\Models\AccidentCoverItem;
use App\Models\AccidentPlan;
use App\Models\HeathCoverType;
use App\Models\InsuranceCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $plans = AccidentPlan::where("cover_type_id","=",$type_id);

      
        $sqlQuery = "select hct.id, hct.name, ic.name as companyname, ic.logo as companylogo from heath_cover_types hct inner join 
        insurance_companies ic on hct.company_id = ic.id
        Where hct.id=?;";

        $coverTypeData = collect(DB::select($sqlQuery, [$type_id]))->first();


        return view("admin.curd.accidentPlan.createPlan")
        ->with('coverTypeData',$coverTypeData)
        ->with('plans',$plans);

    }

}
