<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    /** Function to call first page of web app */
    public function index(){
        return view('welcome');
    }
}
