<?php

namespace App\Http\Controllers;

use App\Models\imageslide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    /** Function to call first page of web app */
    public function index(){
        $imageSlides= DB::select('select * from imageslides order by order_to_display asc');
        $insuranceType = DB::select('select * from insurance_type_pages order by order_to_display asc');

        return view('welcome')
        ->with('imageSlides',$imageSlides)
        ->with('insuranceType',$insuranceType);
    }

    public function errorPage(){
        return view('layouts.errorPage');
    }
}
