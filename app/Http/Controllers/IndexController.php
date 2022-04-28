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
        $howtopays = collect(DB::select('select * from howtopays order by order_to_display asc'));
        $partners = collect(DB::select('select * from partner_web_pages order by order_to_display asc'));
        $comments = (DB::select('select * from user_comments where status = 1'));
        $commentsArrayChunk = (array_chunk($comments,2));

        return view('welcome')
        ->with('imageSlides',$imageSlides)
        ->with('insuranceType',$insuranceType)
        ->with('howtopays',$howtopays)
        ->with('partners', $partners)
        ->with('commentsArrayChunk',$comments);
    }

    public function errorPage(){
        return view('layouts.errorPage');
    }
}
