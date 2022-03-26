<?php

namespace App\Http\Controllers;

use App\Models\HeathCoverType;
use App\Models\InsuranceCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccidentItemController extends Controller
{
    public function index()
    {
        $companies = InsuranceCompany::all();

        return view('admin.curd.AccidentCoverItem.index')
            ->with('companies', $companies);
    }

    public function searchByCompany($company_id)
    {

        $companies = InsuranceCompany::all();
        $accidentType = HeathCoverType::where('company_id', '=', $company_id)->get();
        return view('admin.curd.AccidentCoverItem.index')
            ->with('companies', $companies)
            ->with('accidentData', $accidentType)
            ->with('searchId',$company_id);
    }

    public function create($id){
        $sqlQuery = "select hct.id, hct.name, ic.name as companyname, ic.logo as companylogo from heath_cover_types hct inner join 
        insurance_companies ic on hct.company_id = ic.id
        Where hct.id=?;";

        $coverTypeData = collect(DB::select($sqlQuery,[$id]))->first();


        return view('admin.curd.AccidentCoverItem.create')
            ->with("coverTypeData",$coverTypeData);
    }
}
