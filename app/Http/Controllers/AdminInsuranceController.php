<?php

namespace App\Http\Controllers;

use App\Models\InsuranceInformation;
use App\Models\ThirdPartyCoverItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminInsuranceController extends Controller
{
    public function showPageDetailForApprove($id)
    {
        $insurance = InsuranceInformation::find($id);
      
        switch ($insurance->insurance_Type) {
            case "HIGH-VALUEABLE":
                $vehicleSQLQuery = "select  ii.id as insurance_id, concat(case when ii.sex = 'M' then 'ທ' when ii.sex = 'F' then 'ນາງ' End,'. ' ,ii.firstname, ' ', ii.lastname) as insuredName, ii.payment_confirm,
                ic.name as company_name, ic.logo as company_logo, ii.contract_no , ii.contract_status, ii.insurance_type_id as sale_option_id, ii.number_plate, (select province_name from Provinces where id= ii.registered_province) as registeredProvince,
                ii.color, ii.front_image , so.name as option_name , vp.name as package_name, l.name as level_name
                from insurance_information ii inner join sale_options so on ii.insurance_type_id = so.id 
                inner join vehicle_packages vp on vp.id = so.vp_id 
                inner join insurance_companies ic on ic.id = vp.c_id
                inner join levels l on l.id = vp.lvl_id 
                where ii.insurance_Type  = 'HIGH-VALUEABLE' and ii.id = ?";
                $vehicleInsurance = collect(DB::select($vehicleSQLQuery, [$id]))->first();

                $query = "SELECT ci.id, cg.id as group_id ,cg.name as group_name, ci.name as item_name, sod.price as cover_price FROM cover_groups cg Inner join cover_items ci on cg.id  = ci.cg_id INNER join sale_option_details sod on
                sod.ci_id = ci.id INNER JOIN sale_options so on so.id = sod.sale_id
                WHERE so.id  = ?";
                $saleOptionDetail = DB::select($query, [$insurance->insurance_type_id]);

                return view('admin.insuranceNeedToCheck.vehicleInsuranceViewDetail')
                    ->with('insuranceDetail', $vehicleInsurance)
                    ->with('insurance', $insurance)
                    ->with('saleDetails', $saleOptionDetail);
                break;

            case "THIRD-PARTY":
                $thirdPartyQuery = "select  ii.id as insurance_id, concat(case when ii.sex = 'M' then 'ທ' when ii.sex = 'F' then 'ນາງ' End,'. ' ,ii.firstname, ' ', ii.lastname) as insuredName, ii.payment_confirm,
                ic.name as company_name, ic.logo as company_logo, ii.contract_no , ii.contract_status, ii.insurance_type_id as sale_option_id, ii.number_plate, 
                (select province_name from Provinces where id= ii.registered_province) as registeredProvince,
                ii.color, ii.front_image, tpp.name as package_name , tpo.name as option_name, l.name  as level_name
                from insurance_information ii inner join third_party_options tpo on ii.insurance_type_id = tpo.id
                inner join  levels l on l.id = tpo.lvl_id 
                inner join  third_party_packages tpp on tpp.id = ii.insurance_type_id 
                inner join insurance_companies ic on ic.id = tpp.company_id 
                where ii.insurance_Type  = 'THIRD-PARTY' and ii.id =? ";
                $thirdPartInsurance = collect(DB::select($thirdPartyQuery, [$id]))->first();


                //Get cover item detail
                $coverDetail = ThirdPartyCoverItem::where('third_package_id', '=', $insurance->insurance_type_id)->get();
                return view('admin.insuranceNeedToCheck.thirdParyInsuranceViewDetail')
                    ->with('insurance', $insurance)
                    ->with('thirdPartyInsurance', $thirdPartInsurance)
                    ->with('coverDetail', $coverDetail);
                break;


            case "ACCIDENT":
                $accidentInsuranceQuery = "SELECT ii.id as insurance_id, ic.name  as company_name, ap.name as plan_name, hct.name as package_name, concat(case ii.sex when('M') then 'ທ້າວ. ' when('F') then 'ນາງ. ' End ,' ',ii.firstname,' ', ii.lastname) as insuredName,
                ic.logo  as company_logo, ii.payment_confirm, (select province_name from provinces where id = ii.province) as province
                FROM insurance_information ii
                inner join accident_plans ap on ap.id = ii.insurance_type_id 
                inner JOIN  heath_cover_types hct  on hct.id = ap.cover_type_id
                INNER JOIN  insurance_companies ic  on ic.id  = hct.company_id
                Where ii.insurance_Type ='ACCIDENT' and ii.id = ?";
                $accidentInsurance = collect(DB::select($accidentInsuranceQuery, [ $id]))->first();

                //Query the cover item and cover price
                $queryCoverData = "SELECT accident_plan_details.id, accident_cover_items.item, accident_plan_details.cover_price FROM accident_plan_details
            INNER JOIN accident_plans on accident_plans.id = accident_plan_details.plan_id
            INNER JOIN accident_cover_items on accident_plan_details.item_id = accident_cover_items.id WHERE accident_plan_details.plan_id = ?;";
                $coverData = DB::select($queryCoverData, [$insurance->insurance_type_id]);

                return view('admin.insuranceNeedToCheck.accidentInsuranceViewDetail')
                    ->with('accidentInsurance', $accidentInsurance)
                    ->with('insurance', $insurance)
                    ->with('coverDetail', $coverData);

                break;


            case "HEATH":
                $heathInsuranceQuery = "SELECT ii.id as insurance_id, ic.name  as company_name, hp.name as plan_name, hc.name as package_name, concat(case ii.sex when('M') then 'ທ້າວ. ' when('F') then 'ນາງ. ' End ,' ',ii.firstname,' ', ii.lastname) as insuredName,
                ic.logo  as company_logo, ii.payment_confirm, (select province_name from provinces where id = ii.province) as province
                FROM insurance_information ii
                inner join heath_plans hp on hp.id = ii.insurance_type_id 
                inner JOIN  heath_covers hc on hc.id = hp.cover_type_id
                INNER JOIN  insurance_companies ic  on ic.id  = hc.company_id
                Where ii.insurance_Type ='HEATH' and ii.id = ?";

                $heathInsurance = collect(DB::select($heathInsuranceQuery, [$id]))->first();

                $coverDataQuery = "select hpd.id, hci.name, hpd.cover_price  from heath_plan_details hpd 
                inner join heath_cover_items hci on hci.id  = hpd.item_id 
                where hpd.plan_id  = ?";
                $coverData = collect(DB::select($coverDataQuery, [$insurance->insurance_type_id]));


                return view('admin.insuranceNeedToCheck.heathInsuranceViewDetail')
                    ->with('heathInsurance', $heathInsurance)
                    ->with('insurance', $insurance)
                    ->with('coverDetail', $coverData);


                break;
        }
    }
}
