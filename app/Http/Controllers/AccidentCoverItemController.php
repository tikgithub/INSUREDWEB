<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccidentCoverItemController extends Controller
{
    public function index(){
        return view('admin.curd.AccidentCoverItem.index');
    }
}
