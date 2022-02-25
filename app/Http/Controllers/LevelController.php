<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    /** Store the level data to db */
    public function store(Request $req){
        $req->validate([
            'name'=>'required',
            'menu_type'=>'required'
        ]);

        $newLevel = new Level();
        $newLevel->name = $req->input('name');
        $newLevel->menu_type = $req->input('menu_type');

        if($newLevel->save()){
            return redirect()->back()->with('success','Operation Completed');
        }else{
            return redirect()->back()->with('error',"Operation Failed, Please try again");
        }
    }

    /** Update the level */
    public function update(Request $req){

        $req->validate([
            'editName'=>'required',
            'editMenuType'=>'required',
            'editId'=>'required'
        ]);

        $newLevel = Level::find($req->input('editId'));
        $newLevel->name = $req->input('editName');
        $newLevel->menu_type = $req->input('editMenuType');

        if($newLevel->save()){
            return redirect()->back()->with('success','Operation Completed');
        }else{
            return redirect()->back()->with('error',"Operation Failed, Please try again");
        }
    }
}
