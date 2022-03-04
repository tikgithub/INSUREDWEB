<?php

namespace App\Http\Controllers;

use App\Models\ThirdPartyCoverItem;
use App\Models\ThirdPartyOption;
use Error;
use Illuminate\Http\Request;

class ThirdParyCoverController extends Controller
{
    //Store
    public function store(Request $req)
    {
        $req->validate([
            'addName' => 'required',
            'addPrice' => 'required|numeric',
            'third_package_id' => 'required',
            'item_order' => 'required'
        ]);

        //Create object Third Cover Item
        $newCoverItem = new ThirdPartyCoverItem();
        $newCoverItem->name = $req->input('addName');
        $newCoverItem->price = $req->input('addPrice');
        //Check the item order already exit?
        if (ThirdPartyCoverItem::where('item_order', '=', $req->input('item_order'))->get()->first()) {
            //Count how many cover item do the package have
            $thirdCoverCount = ThirdPartyCoverItem::where('third_package_id', '=', $req->input('third_package_id'))->orderBy('item_order', 'asc')->get();
            //Loop the cover item to find the order
            for ($i = 0; $i < sizeof($thirdCoverCount); $i++) {
                if ($thirdCoverCount[$i]->item_order >= $req->input('item_order')) {
                    $thirdCoverCount[$i]->item_order += 1;
                    $thirdCoverCount[$i]->save();
                }
            }
        }


        $newCoverItem->third_package_id = $req->input('third_package_id');
        $newCoverItem->item_order = $req->input('item_order');

        if ($newCoverItem->save()) {
            return redirect()->back()->with('success', 'ດຳເນີນການສຳເລັດ');
        } else {
            return redirect()->back()->with('error', 'ເກີດຂໍຜິດພາດກະລຸນາລອງໃໝ່');
        }
    }

    //Update
    public function update(Request $req)
    {
        $req->validate([
            'editName' => 'required',
            'editPrice' => 'required|numeric',
            'editId' => 'required',
            'edit_item_order' => 'required'
        ]);

        //Find the Object and update
        $updateObject = ThirdPartyCoverItem::find($req->input('editId'));
        $updateObject->name = $req->input('editName');
        $updateObject->price = $req->input('editPrice');

        // //Get current Cover item
        // $thirdCoverCount = ThirdPartyCoverItem::where('third_package_id','=', $updateObject->third_package_id)->orderBy('item_order','asc')->get();

        //check the request to update position available ?
        $checkAvailablePosition = ThirdPartyCoverItem::where('item_order', '=', $req->input('edit_item_order'))->get()->first();

        if (!$checkAvailablePosition) {
            return redirect()->back()->with('error', 'ບໍ່ສາມາດອັບເດດລຳດັບໃຫ້ໄດ້ Index Not Available');
        }

        //Get new position want to move
        $newPosition = $req->input('edit_item_order');
        //Get current position of request item
        $currentPosition = $updateObject->item_order;

        //Find the object want to replace in DB
        $objectWantToReplace = ThirdPartyCoverItem::where('item_order', '=', $newPosition)->get()->first();
        $objectWantToReplace->item_order = $currentPosition;
        $objectWantToReplace->save();

        //Assign new position to request object
        $updateObject->item_order = $newPosition;

        if ($updateObject->save()) {
            return redirect()->back()->with('success', 'ດຳເນີນການສຳເລັດ');
        } else {
            return redirect()->back()->with('error', 'ເກີດຂໍຜິດພາດກະລຸນາລອງໃໝ່');
        }
    }

    //Delete
    public function destroy($id)
    {
        $deleteObject = ThirdPartyCoverItem::find($id);

        if ($deleteObject->delete()) {
            return redirect()->back()->with('success', 'ດຳເນີນການສຳເລັດ');
        } else {
            return redirect()->back()->with('error', 'ເກີດຂໍຜິດພາດກະລຸນາລອງໃໝ່');
        }
    }
}
