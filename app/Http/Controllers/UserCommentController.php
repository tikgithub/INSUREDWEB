<?php

namespace App\Http\Controllers;

use App\Models\UserComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserCommentController extends Controller
{
    public function storeUserComment(Request $req){
        $req->validate([
            'comment'=>'required',
            'stars' => 'required'
        ]);

        try {
           

          $new = new UserComment();

          $new->comment = $req->input('comment');

          $new->rates = $req->input('stars');

          $new->user_id = Auth::user()->id;

          $new->status = false;

          $new->save();

          return redirect()->back();


        } catch (\Exception | \Throwable $th) {
           Log::error($th);
           return redirect()->back()->with('error',$th->getMessage());
        }
    }
}
