<?php

namespace App\Http\Controllers;

use App\Models\AccidentCoverItem;
use App\Models\CoverItem;
use App\Models\HeathCoverType;
use App\Models\InsuranceCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;

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
            ->with('searchId', $company_id);
}

    public function create($id)
    {
        $sqlQuery = "select hct.id, hct.name, ic.name as companyname, ic.logo as companylogo from heath_cover_types hct inner join 
        insurance_companies ic on hct.company_id = ic.id
        Where hct.id=?;";

        $coverTypeData = collect(DB::select($sqlQuery, [$id]))->first();

        $coverItems = AccidentCoverItem::where("cover_type_id", "=", $coverTypeData->id)->get();

        return view('admin.curd.AccidentCoverItem.create')
            ->with("coverTypeData", $coverTypeData)
            ->with("coverItems", $coverItems);
    }

    public function store(Request $req)
    {
        //Validate input
        $req->validate([
            'cover_type_id' => 'required',
            'cover_item' => 'required'
        ]);

        //Create new Object
        $data = new AccidentCoverItem();
        $data->cover_Type_id = $req->input('cover_type_id');
        $data->item = $req->input('cover_item');

        if ($data->save()) {
            return redirect()->back()->with('success', 'ດຳເນີນການສຳເລັດ');
        } else {
            return redirect()->back()->with('error', 'ເກີດຂໍ້ຜິດພາດກາລຸນາລອງໃໝ່');
        }
    }

    public function delete($id)
    {
        $delItem = AccidentCoverItem::find($id);
        if ($delItem->delete()) {
            return redirect()->back()->with('success', 'ດຳເນີນການສຳເລັດ');
        } else {
            return redirect()->back()->with('error', 'ເກີດຂໍ້ຜິດພາດກາລຸນາລອງໃໝ່');
        }
    }

    public function update(Request $req)
    {
        $req->validate([
            'update_id' => 'required',
            'editItem' => 'required'
        ]);

        $updateItem = AccidentCoverItem::find($req->input('update_id'));
        $updateItem->item = $req->input('editItem');
        if ($updateItem->save()) {
            return redirect()->back()->with('success', 'ດຳເນີນການສຳເລັດ');
        } else {
            return redirect()->back()->with('error', 'ເກີດຂໍ້ຜິດພາດກາລຸນາລອງໃໝ່');
        }
    }
}
