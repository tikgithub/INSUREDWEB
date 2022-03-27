<?php

namespace App\Http\Controllers;

use App\Models\HeathCoverType;
use App\Models\InsuranceCompany;
use Illuminate\Http\Request;

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

}
