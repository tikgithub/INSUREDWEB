<?php

namespace App\Http\Controllers;

use App\Models\HeathCover;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HeathSaleController extends Controller
{
    public function selectCompany(){
        $companyQuery = "select distinct ic.id as company_id, ic.name  as company_name, ic.logo  from insurance_companies ic inner join heath_covers hc on ic.id  = hc.company_id
        where hc.status  = 1";

        $companyData = collect(DB::select($companyQuery));
        
        return view('insurances.heath.select_company')
        ->with('companyData',$companyData);
    }

    public function showPackage($company_id){

        $heathCovers = collect(HeathCover::where('company_id','=',$company_id)->get());
        
        return view('insurances.heath.select_package')
        ->with('heathCovers',$heathCovers);
    }
}
