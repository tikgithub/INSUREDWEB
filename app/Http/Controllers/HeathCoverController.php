<?php

namespace App\Http\Controllers;

use App\Models\HeathCover;
use App\Models\InsuranceCompany;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\TryCatch;

class HeathCoverController extends Controller
{
    public function index()
    {
        $companies = InsuranceCompany::all();

        $heathCovers = collect(DB::select('SELECT hc.*, ic.name as company_name from heath_covers hc inner join insurance_companies ic on ic.id  = hc.company_id'));
     //   dd($companies,$heathCovers);
        return view('admin.curd.heathCoverType.index')
            ->with('companies', $companies)
            ->with('heathCovers', $heathCovers);
    }

    public function store(Request $req)
    {
        //Validate input
        $req->validate([
            'company_id' => 'required',
            'name' => 'required'
        ]);

        $obj = new HeathCover();
        $obj->name = $req->input('name');
        $obj->company_id = $req->input('company_id');
        $obj->status = false;


        if ($obj->save()) {
            return redirect()->back()->with('success', 'ດຳເນີນການສຳເລັດ');
        } else {
            return redirect()->back()->with('error', 'ເກີດຂໍ້ຜີດພາດກະລຸນາລອງໃໝ່');
        }
    }

    public function changeStatus($id, $status)
    {
        $object = HeathCover::find($id);
        if (!$object) {
            return redirect()->back()->with('error', 'ເກີດຂໍ້ຜີດພາດກະລຸນາລອງໃໝ່');
        }
        $object->status = $status;

        if ($object->save()) {
            return redirect()->back()->with('success', 'ດຳເນີນການສຳເລັດ');
        } else {
            return redirect()->back()->with('error', 'ເກີດຂໍ້ຜີດພາດກະລຸນາລອງໃໝ່');
        }
    }

    public function update(Request $req){
        $req->validate([
            'editId' => 'required',
            'editCompany_id'=>'required',
            'editName'=>'required'
        ]);

        $updateItem = HeathCover::find($req->input('editId'));
        $updateItem->name = $req->input('editName');
        $updateItem->company_id = $req->input('editCompany_id');
        if($updateItem->save()){
            return redirect()->back()->with('success', 'ດຳເນີນການສຳເລັດ');
        }else{
            return redirect()->back()->with('error', 'ເກີດຂໍ້ຜີດພາດກະລຸນາລອງໃໝ່');
        }
    }
}
