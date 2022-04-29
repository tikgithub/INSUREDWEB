<?php

namespace App\Http\Controllers;

use App\Models\MessagesToUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
            $newItem = new MessagesToUs();

            $newItem->name = $req->input('name');

            $newItem->title = $req->input('title');

            $newItem->email = $req->input('email');

            $newItem->message = $req->input('message');

            $newItem->status = false;

            $newItem->tel = $req->input('tel');

            $newItem->save();

            return redirect()->back()->with('success','ດຳເນີນການສຳເລັດ');

        } catch (\Throwable $th) {
            Log::error($th);

            return redirect()->back()->with('error','ເກີດຂໍ້ຜິດພາດກະລຸນາລອງໃຫມ່');
        }
    }

    public function viewMessage(){
        try {

            $messages = MessagesToUs::all();
            
            return view('admin.message.index')
            ->with('messages',$messages);

        } catch (\Throwable $th) {
            Log::error($th);

            return redirect()->back()->with('error','ເກີດຂໍ້ຜິດພາດກະລຸນາລອງໃຫມ່');
        }
    }

    public function viewMessageDetail($id){
        try {
            
            $message = MessagesToUs::find($id);

            $message->status = 1;

            $user = Auth::user();

            if(!$message->readby){
                $message->readby = $user->firstname . ' ' . $user->lastname;
            }
            

            $message->save();

            return view('admin.message.messageViewDetail')
            ->with('message',$message);

        } catch (\Throwable $th) {
            Log::error($th);

            return redirect()->back()->with('error','ເກີດຂໍ້ຜິດພາດກະລຸນາລອງໃຫມ່');
        }
    }

    public function deleteMessage($id){
        try {
            $message = MessagesToUs::find($id);

            $message->delete();

            return redirect()->route('MessageToUsController.ViewMessage')->with('success','ດຳເນີນການສຳເລັດ');

        } catch (\Exception | \Throwable $th) {
            Log::error($th);

            return redirect()->back()->with('error','ເກີດຂໍ້ຜິດພາດກະລຸນາລອງໃຫມ່');
        }
    }
}
