<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageToUsController extends Controller
{
    public function storeMessage(Request $req){
        $req->validate([
            'name'=>'required',
            'tel'=>'required',
            'title'=>'required',
            'message' => 'required'
        ]);
        try {
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
