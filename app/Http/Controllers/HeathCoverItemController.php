<?php

namespace App\Http\Controllers;

use App\Models\CoverItem;
use App\Models\HeathCover;
use App\Models\HeathCoverItem;
use App\Models\InsuranceCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;

class HeathCoverItemController extends Controller
{
    public function index(){
        
        $companies = InsuranceCompany::all();
        $coverTypes = collect(DB::select('SELECT hc.*, ic.name as company_name FROM heath_covers hc inner join insurance_companies ic on hc.company_id = ic.id '));

        return view('admin.curd.heathCoverItem.index')
        ->with('companies',$companies)
        ->with('coverTypes',$coverTypes);
    }

    public function getCoverTypeByCompany($id){
        $companies = InsuranceCompany::all();

        $coverTypes = collect(DB::select('SELECT hc.*, ic.name as company_name 
        FROM heath_covers hc inner join insurance_companies ic on hc.company_id = ic.id where ic.id=?',[$id]));
        

        return view('admin.curd.heathCoverItem.index')
        ->with('companies',$companies)
        ->with('coverTypes',$coverTypes)
        ->with('selected_company_id',$id);
    }

    public function create($cover_type_id){
        $headerTitleQuery = "SELECT hc.id, hc.name as cover_name, ic.name  as company_name, ic.logo  
        FROM heath_covers hc inner join insurance_companies ic on hc.company_id = ic.id 
        where hc.id =?";
        $headerTitleData = collect(DB::select($headerTitleQuery,[$cover_type_id]))->first();

        $items = HeathCoverItem::where('cover_type_id','=',$cover_type_id)->get();
       

        return view('admin.curd.heathCoverItem.create')->with('headerTitleData',$headerTitleData)
        ->with('items',$items);
    }

    public function store(Request $req){
       
        $req->validate([
            'cover_type_id' => 'required',
            'name' => 'required'
        ]);

        $item = new HeathCoverItem();
        $item->cover_type_id = $req->input('cover_type_id');
        $item->name = $req->input('name');
        if($item->save()){
            return redirect()->back()->with('success','ດຳເນີນການສຳເລັດ');
        }else{
            return redirect()->back()->with('error','ດຳເນີນການບໍ່ສຳເລັດກະລຸນາລອງໃໝ່');
        }
    }

    public function update(Request $req){
        $req->validate([
            'id' => 'required',
            'name' => 'required'
        ]);

        $item = HeathCoverItem::find($req->id);

        $item->name = $req->input('name');

        if($item->save()){
            return redirect()->back()->with('success','ດຳເນີນການສຳເລັດ');
        }else{
            return redirect()->back()->with('error','ດຳເນີນການບໍ່ສຳເລັດກະລຸນາລອງໃໝ່');
        }
    }
    public function delete($id){
        $item = HeathCoverItem::find($id);

        if($item->delete()){
            return redirect()->back()->with('success','ດຳເນີນການສຳເລັດ');
        }else{
            return redirect()->back()->with('error','ດຳເນີນການບໍ່ສຳເລັດກະລຸນາລອງໃໝ່');
        }
    }
}
