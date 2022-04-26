<?php

namespace App\Http\Controllers;

use App\Models\imageslide;
use App\Models\InsuranceTypePage;
use App\Utils\ImageCompress;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class WebsiteController extends Controller
{
    public function index()
    {
        $imageData = DB::select('select * from imageslides order by order_to_display asc');

        return view('admin.website_mainpage.index');
    }

    public function imageSlide()
    {
        $imageData = DB::select('select * from imageslides order by order_to_display asc');
        return view('admin.website_mainpage.image_slider')->with('imageData', $imageData);
    }

    public function storeSlideImage(Request $req)
    {
    
        //Validate
        $req->validate([
            'image' => 'required',
            'order_to_display' => 'required'
        ]);

        if (!$req->file('image')) {
            return redirect()->back()->with('error', 'No Image was selected');
        }

        //Check order is misstach
        $isExistOrdered = imageslide::where('order_to_display', '=', $req->input('order_to_display'))->first();

        if ($isExistOrdered) {
            //Return to input page again and warning with an existing
            return redirect()->back()->with('error', 'ລຳດັບການກະແດງຜົນຊໍ້າກັນກະລຸນາເລືອກໃໝ່');
        } else {
            //Save data to DB
            $obj = new imageslide();
            $obj->image_path = ImageCompress::notCompressImage($req->file('image'), 'websites');
            $obj->order_to_display = $req->input('order_to_display');
            if ($obj->save()) {
                return redirect()->back()->with('success', 'ດຳເນິນການສຳເລັດ');
            } else {
                return redirect()->back()->with('error', 'ດຳເນີນການຜິດພາດກະລຸນາລອງໃໝ່');
            }
        }
    }

    public function editSlideImage(Request $req)
    {
        $req->validate([
            'editId' => 'required',
            'order_to_display' => 'required'
        ]);


        $editData = imageslide::find($req->input('editId'));
        $editData->order_to_display = $req->input('order_to_display');

        if ($req->file('image')) {
            File::delete('websites/' . $editData->image_path);
            $editData->image_path = ImageCompress::notCompressImage($req->file('image'), 'websites');
        }

        if ($editData->save()) {
            return redirect()->back()->with('success', 'ດຳເນິນການສຳເລັດ');
        } else {
            return redirect()->back()->with('error', 'ດຳເນີນການຜິດພາດກະລຸນາລອງໃໝ່');
        }
    }

    public function deleteSlideImage($id)
    {
        $delete = imageslide::find($id);
        File::delete($delete->image_path);
        $delete->delete();
        return redirect()->back()->with('success', 'ດຳເນິນການສຳເລັດ');
    }

    public function showInsuranceTypePage()
    {

        $insuraceTypes = InsuranceTypePage::all();

        return view('admin.website_mainpage.insurance_type')->with('insuranceTypes',$insuraceTypes);
    }

    public function storeInsuraceTypePage(Request $req)
    {
        try {
            $req->validate([
                'image_path' => 'required',
                'order_to_display' => 'required'
            ]);
            Log::debug('OK Controller WebsiteController : ');
            Log::info($req->all());

            //Check existing number
            $isExistedOrdered = InsuranceTypePage::where('order_to_display','=',$req->input('order_to_display'))->first();
            if($isExistedOrdered){
                return redirect()->back()->with('error','ລຳດັບສະແດງຜົນຊ້ຳກັນກະລຸນາກະລຸນາເລືອກໃໝ່');
            }

            $new = new InsuranceTypePage();
            $new->order_to_display = $req->input('order_to_display');
            $new->image_path = ImageCompress::notCompressImage($req->file('image_path'), 'websites');

            $new->save();
            return redirect()->back()->with('success', 'ດຳເນີນການສຳເລັດ');
        } catch (\Exception | \Throwable $e) {
            Log::error('Error from controller: ' . $e);
            return redirect()->back()->with('error', 'ເກີດຂໍ້ຜິດພາດກະລຸນາລອງໃໝ່');
        }
    }
}
