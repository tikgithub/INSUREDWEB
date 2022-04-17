<?php

namespace App\Http\Controllers;

use App\Models\CarBrand;
use App\Models\District;
use App\Models\InsuranceCompany;
use App\Models\InsuranceInformation;
use App\Models\Level;
use App\Models\PaymentProvider;
use App\Models\Province;
use App\Models\SaleOption;
use App\Models\ThirdPartyCoverItem;
use App\Models\ThirdPartyCustomerInput;
use App\Models\ThirdPartyPackage;
use App\Models\Vehicle_Detail;
use App\Models\Vehicle_Type;
use App\Models\VehicleInsuranceDetail;
use App\Models\VehiclePackage;
use App\Utils\ImageCompress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class InsuranceFlowController extends Controller
{
    /** Function to show insurance type selection */
    public function showInsuranceTypeSelection()
    {
        return view('insurances.insurance_select');
    }
    /** Function to show the car insurance selection menu */
    public function showCarInsuranceSelectionMenu()
    {
        /** Get Level Information to Show at page */
        $levels = Level::orderBy('name', 'asc')->get();
        /** Get Vehicle Type information to page */
        $vehicleTypes = Vehicle_Type::all();

        return view('insurances.cars.car_insured_select')
            ->with('levels', $levels)
            ->with('vehicleTypes', $vehicleTypes);
    }

    /** Vehicle Insurance Search */
    public function vehicleSearchForInsurancePackage(Request $req)
    {
        /** Check which insurance type customer select */
        $insuranceType = Level::find($req->input('level'));

        switch ($insuranceType->menu_type) {
            case "THIRD_PARTY":
                /** Query the package which relate to Third party only */
                $query = "SELECT tpp.id, tpp.name as package_name,  l.name as level_name, vt.name as vehicle_types  ,vd.name as vehicle_details,
                tpp.fee, tpp.final_price, ic.logo
                FROM third_party_packages tpp inner join vehicle__details vd on tpp.vehicle_detail  = vd.id
                INNER JOIN vehicle__types vt on vt.id = vd.v_id
                INNER JOIN insurance_companies ic on ic.id = tpp.company_id
                INNER JOIN levels l on l.id = tpp.`level`
                AND vt.id = ? AND  tpp.status = 1 AND l.id = ?";

                $thirdPartyPackage = DB::select($query, [$req->input('vehicle_type'), $req->input('level')]);
                //Get Vehicle Detail from Vehicle Type ID
                $vehicleDetail = Vehicle_Detail::where('v_id', '=', $req->input('vehicle_type'))->get();

                return view('insurances.thirdParty.showSelectResult')->with('vehicleDetail', $vehicleDetail)
                    ->with('thirdPartyPackage', $thirdPartyPackage);

                break;
            case "NORMAL":
                /** Query the package which relate to Normal package only */
                $squery = "SELECT vp.id as Id ,ic.name as company_name, vp.name as package_name, l.name as level_name, ic.logo, vp.start_rank , vp.end_rank
                FROM vehicle_packages vp
                INNER JOIN  insurance_companies ic on vp.c_id  = ic.id
                INNER JOIN levels l on vp.lvl_id = l.id
                WHERE  vp .lvl_id =? AND vp.status = 1";

                $vehiclePackages = DB::select($squery, [$req->input('level')]);

                //Send Package Data to view
                return view("insurances.cars.showSearchedPackage")
                    ->with('level', $insuranceType)
                    ->with('packages', $vehiclePackages);

                break;
        }
    }
    /** Show the detail of option */
    public function showNormalPackageDetail($sale_id)
    {

        $saleOption = SaleOption::find($sale_id);
        $vehiclePackage = VehiclePackage::find($saleOption->vp_id);
        $level = Level::find($vehiclePackage->lvl_id);
        $company = InsuranceCompany::find($vehiclePackage->c_id);

        $query = "SELECT ci.id, cg.id as group_id ,cg.name as group_name, ci.name as item_name, sod.price as cover_price FROM cover_groups cg Inner join cover_items ci on cg.id  = ci.cg_id INNER join sale_option_details sod on
        sod.ci_id = ci.id INNER JOIN sale_options so on so.id = sod.sale_id
        WHERE so.id  = ?";
        $saleOptionDetail = DB::select($query, [$sale_id]);

        return view('insurances.cars.showPackageDetail')
            ->with('level', $level)
            ->with('saleOption', $saleOption)
            ->with('vehiclePackage', $vehiclePackage)
            ->with('company', $company)
            ->with('saleDetails', $saleOptionDetail);
    }
    /** Show to compare view of Normal Package */
    public function normalPackageCompare($p1, $p2)
    {

        /** First Selection ***************************************/
        $saleOptionFirst = SaleOption::find($p1);
        $vehiclePackageFirst = VehiclePackage::find($saleOptionFirst->vp_id);
        $levelFirst = Level::find($vehiclePackageFirst->lvl_id);
        $companyFirst = InsuranceCompany::find($vehiclePackageFirst->c_id);

        $query = "SELECT ci.id, cg.id as group_id ,cg.name as group_name, ci.name as item_name, sod.price as cover_price
        FROM cover_groups cg Inner join cover_items ci on cg.id  = ci.cg_id INNER join sale_option_details sod on
        sod.ci_id = ci.id INNER JOIN sale_options so on so.id = sod.sale_id
        WHERE so.id  = ?";
        $saleOptionDetailFirst = DB::select($query, [$p1]);

        /** End First Selection ***************************************/


        /** Second Selection ***************************************/
        $saleOptionSecond = SaleOption::find($p2);
        $vehiclePackageSecond = VehiclePackage::find($saleOptionSecond->vp_id);
        $levelSecond = Level::find($vehiclePackageSecond->lvl_id);
        $companySecond = InsuranceCompany::find($vehiclePackageSecond->c_id);

        $query = "SELECT ci.id, cg.id as group_id ,cg.name as group_name, ci.name as item_name, sod.price as cover_price
        FROM cover_groups cg Inner join cover_items ci on cg.id  = ci.cg_id INNER join sale_option_details sod on
        sod.ci_id = ci.id INNER JOIN sale_options so on so.id = sod.sale_id
        WHERE so.id  = ?";
        $saleOptionDetailSecond = DB::select($query, [$p2]);
        /** End Second Selection ***************************************/

        return view('insurances.cars.showComparePackage')

            ->with('levelFirst', $levelFirst)
            ->with('saleOptionFirst', $saleOptionFirst)
            ->with('vehiclePackageFirst', $vehiclePackageFirst)
            ->with('companyFirst', $companyFirst)
            ->with('saleDetailsFirst', $saleOptionDetailFirst)

            ->with('levelSecond', $levelSecond)
            ->with('saleOptionSecond', $saleOptionSecond)
            ->with('vehiclePackageSecond', $vehiclePackageSecond)
            ->with('companySecond', $companySecond)
            ->with('saleDetailsSecond', $saleOptionDetailSecond);;
    }

    /** Show Buy Now Page with input information */
    public function showBuyNowPage($sale_id)
    {
        $saleOption = SaleOption::find($sale_id);
        $vehiclePackage = VehiclePackage::find($saleOption->vp_id);
        $level = Level::find($vehiclePackage->lvl_id);
        $company = InsuranceCompany::find($vehiclePackage->c_id);

        //Province data
        $provinces = Province::all();
        //Car Brand data
        $carBrands = CarBrand::all();

        $query = "SELECT ci.id, cg.id as group_id ,cg.name as group_name, ci.name as item_name, sod.price as cover_price FROM cover_groups cg Inner join cover_items ci on cg.id  = ci.cg_id INNER join sale_option_details sod on
        sod.ci_id = ci.id INNER JOIN sale_options so on so.id = sod.sale_id
        WHERE so.id  = ?";
        $saleOptionDetail = DB::select($query, [$sale_id]);

        return view('insurances.cars.buyNow')
            ->with('level', $level)
            ->with('saleOption', $saleOption)
            ->with('vehiclePackage', $vehiclePackage)
            ->with('company', $company)
            ->with('saleDetails', $saleOptionDetail)
            ->with('Provinces', $provinces)
            ->with('carBrands', $carBrands);
    }

    /** Store Insurance Information When Click Submit */
    public function storeInputFromCustomer(Request $req)
    {
        //Validate input
        //Image Validate with maximun
        $req->validate([
            'front' => 'required',
            'left' => 'required',
            'right' => 'required',
            'rear' => 'required',
            'yellow_book' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'tel' => 'required',
            'sex' => 'required',
            'dob' => 'required',
            'identity' => 'required',
            'province' => 'required',
            'district' => 'required',
            'vehicleBrand' => 'required',
            'registeredProvince' => 'required',
            'number_plate' => 'required',
            'color' => 'required',
            'address' => 'required',
            'sale_id' => 'required'
        ]);

        //Find Sale ID
        $saleData = SaleOption::find($req->input('sale_id'));

        //create new eqloquent object
        $newInput = new InsuranceInformation();

        $newInput->firstname = trim($req->input('firstname'));
        $newInput->lastname = trim($req->input('lastname'));
        $newInput->sex = $req->input('sex');
        $newInput->dob = $req->input('dob');
        $newInput->tel = $req->input('tel');
        $newInput->identity = trim($req->input('identity'));
        $newInput->province = $req->input('province');
        $newInput->district = $req->input('district');
        $newInput->address = trim($req->input('address'));
        $newInput->vehicle_brand = $req->input('vehicleBrand');
        $newInput->number_plate = trim($req->number_plate);
        $newInput->color = trim($req->input('color'));
        $newInput->fee_charge = $saleData->fee_charge;
        $newInput->total_price = $saleData->sale_price;
        $newInput->registered_province = $req->input('registeredProvince');
        $newInput->user_id = Auth::user()->id;
        $newInput->chassic_number = $req->input('chassic_number');
        $newInput->engine_number = $req->input('engine_number');

        //Prepare to upload image for 5 items
        $uploadPath = "Insurances/Vehicles";
        $newInput->front_image =  ImageCompress::notCompressImage($req->file('front'), $uploadPath);
        $newInput->left_image = ImageCompress::notCompressImage($req->file('left'), $uploadPath);
        $newInput->right_image = ImageCompress::notCompressImage($req->file('right'), $uploadPath);
        $newInput->rear_image = ImageCompress::notCompressImage($req->file('rear'), $uploadPath);
        $newInput->yellow_book_image = ImageCompress::notCompressImage($req->file('yellow_book'), $uploadPath);
        $newInput->insurance_type_id = $req->input('sale_id');
        $newInput->insurance_type = "HIGH-VALUEABLE";
        $newInput->payment_confirm = "WAIT_FOR_PAYMENT";
        $newInput->save();
        //Set Session for new Input ID
        session(['input_id' => $newInput->id]);

        return redirect()->route('InsuranceFlowController.showAgreementPage');
    }

    /** Show the agreement page after customer input the detail */
    public function showAgreementPage()
    {


        if (session('input_id')) {
            //Get session id
            $input_id = session('input_id');
            //Get Input Data after submit
            $inputData = InsuranceInformation::find($input_id);

            //Get Sale option data
            $saleOption = SaleOption::find($inputData->insurance_type_id);
            $vehiclePackage = VehiclePackage::find($saleOption->vp_id);
            $level = Level::find($vehiclePackage->lvl_id);
            $company = InsuranceCompany::find($vehiclePackage->c_id);

            //Get the package data
            $query = "SELECT ci.id, cg.id as group_id ,cg.name as group_name, ci.name as item_name, sod.price as cover_price FROM cover_groups cg Inner join cover_items ci on cg.id  = ci.cg_id INNER join sale_option_details sod on
            sod.ci_id = ci.id INNER JOIN sale_options so on so.id = sod.sale_id
            WHERE so.id  = ?";
            $saleOptionDetail = DB::select($query, [$inputData->insurance_type_id]);

            //Province data
            $provinces = Province::all();
            //District Data
            $districts = District::where('province_id', '=', $inputData->province)->get();

            //Car Brand data
            $carBrands = CarBrand::all();

            return view('insurances.cars.insuranceAgreement')
                ->with('inputData', $inputData)
                ->with('level', $level)
                ->with('saleOption', $saleOption)
                ->with('vehiclePackage', $vehiclePackage)
                ->with('company', $company)
                ->with('saleDetails', $saleOptionDetail)
                ->with('Provinces', $provinces)
                ->with('carBrands', $carBrands)
                ->with('districts', $districts);
        }
    }

    /** Set Session of Input ID and go to agreement page */
    public function redirectToAgreement($id)
    {
        session(['input_id' => $id]);
        return redirect()->route('InsuranceFlowController.showAgreementPage');
    }

    /** Function Update the user input data before go to payment */
    public function updateInputData(Request $req)
    {
        //Validate input
        //Image Validate with maximun
        $req->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'tel' => 'required',
            'sex' => 'required',
            'dob' => 'required',
            'identity' => 'required',
            'province' => 'required',
            'district' => 'required',
            'vehicleBrand' => 'required',
            'registeredProvince' => 'required',
            'number_plate' => 'required',
            'color' => 'required',
            'address' => 'required',
            'sale_id' => 'required'
        ]);

        //Find Sale ID
        $saleData = SaleOption::find($req->input('sale_id'));
        //Find eqloquent object for perform the update operation
        $newInput = InsuranceInformation::find($req->input('id'));

        $newInput->firstname = trim($req->input('firstname'));
        $newInput->lastname = trim($req->input('lastname'));
        $newInput->sex = $req->input('sex');
        $newInput->dob = $req->input('dob');
        $newInput->tel = $req->input('tel');
        $newInput->identity = trim($req->input('identity'));
        $newInput->province = $req->input('province');
        $newInput->district = $req->input('district');
        $newInput->address = trim($req->input('address'));
        $newInput->vehicle_brand = $req->input('vehicleBrand');
        $newInput->number_plate = trim($req->number_plate);
        $newInput->color = trim($req->input('color'));
        $newInput->fee_charge = $saleData->fee_charge;
        $newInput->total_price = $saleData->sale_price;
        $newInput->registered_province = $req->input('registeredProvince');
        $newInput->user_id = Auth::user()->id;
        $newInput->chassic_number = $req->input('chassic_number');
        $newInput->engine_number = $req->input('engine_number');

        //Prepare to upload image for 5 items if image not upload mean do nothing
        $uploadPath = "Insurances/Vehicles";

        if ($req->file('front')) {
            File::delete($newInput->front_image);
            $newInput->front_image =  ImageCompress::compressImage($req->file('front'), 70, $uploadPath, 800);
        }
        if ($req->file('left')) {
            File::delete($newInput->left_image);
            $newInput->left_image = ImageCompress::compressImage($req->file('left'), 70, $uploadPath, 800);
        }
        if ($req->file('right')) {
            error_log('update here rigth');
            File::delete($newInput->right_image);
            $newInput->right_image = ImageCompress::compressImage($req->file('right'), 70, $uploadPath, 800);
        }
        if ($req->file('rear')) {
            File::delete($newInput->rear_image);
            $newInput->rear_image = ImageCompress::compressImage($req->file('rear'), 70, $uploadPath, 800);
        }
        if ($req->file('yellow_book_image')) {
            File::delete($newInput->yellow_book_image);
            $newInput->yellow_book_image = ImageCompress::compressImage($req->file('yellow_book'), 70, $uploadPath, 800);
        }

        $newInput->insurance_type_id = $req->input('sale_id');
        $newInput->save();
        //Set Session for new Input ID
        session(['input_id' => $newInput->id]);

        return redirect()->route('InsuranceFlowController.showPaymentProviderPageSelection');
    }

    /** Function show the Available Payment Provider */
    public function showPaymentProviderPageSelection()
    {
        //When session not set then send back to welcome page
        if (!session('input_id')) {
            return redirect()->route('welcome');
        }

        //Get the available payment provider data by status 1 = avaialbe, 0 = not available
        $paymentProviders = PaymentProvider::where('status', '=', '1')->get();

        return view('insurances.cars.showPaymentProviderList')->with('paymentProviders', $paymentProviders);
    }

    /** Function Show submit Payment form */
    public function showFormSubmitPayment($provider_id)
    {
        //When session not set then send back to welcome page
        if (!session('input_id')) {
            return redirect()->route('welcome');
        }
        $provider = PaymentProvider::find($provider_id);

        return view('insurances.cars.submitPayment')->with('provider', $provider);
    }

    /** Function to Update the payment */
    public function updatePaymentDetail(Request $req)
    {
        //Validate the image should be upload
        $req->validate([
            'slipUploaded' => 'required'
        ]);

        //When session not set then send back to welcome page
        if (!session('input_id')) {
            return redirect()->route('welcome');
        }
        $inputData = InsuranceInformation::find(session('input_id'));

        $extension = $req->file('slipUploaded')->getClientOriginalExtension();
        $newImageCompress = ImageCompress::compressImage($req->file('slipUploaded'), 70, 'tmpfolder', 800);
        $data = file_get_contents($newImageCompress);
        $base64SlipImage = 'data:image/' . $extension . ';base64,' . base64_encode($data);
        File::delete($newImageCompress);

        $inputData->slipUploaded = $base64SlipImage;
        $inputData->payment_time = now();
        $inputData->payment_confirm = "WAIT_FOR_APPROVED";

        $inputData->save();

        session(['payment_status' => 'WAIT_FOR_APPROVED']);

        return redirect()->route('InsuranceFlowController.showComplete');
    }

    /** Function to show the complete page */
    public function showComplete()
    {
        //When session not set then send back to welcome page
        if (!session('payment_status')) {
            return redirect()->route('welcome');
        }

        return view('insurances.cars.completePayment');
    }

    /** Function to delete the input data */
    public function deleteTheInput($id)
    {
        VehicleInsuranceDetail::find($id)->delete();
        return redirect()->route('UserController.userListInsurance')->with('success', 'ດຳເນີນການສຳເລັດ');
    }

    /** Function show insurance detail by customer*/
    public function showInsuranceDetailByCustomer($id)
    {

        $saleOption = SaleOption::find($id);

        $vehiclePackage = VehiclePackage::find($saleOption->vp_id);
        $level = Level::find($vehiclePackage->lvl_id);
        $company = InsuranceCompany::find($vehiclePackage->c_id);

        $query = "SELECT ci.id, cg.id as group_id ,cg.name as group_name, ci.name as item_name, sod.price as cover_price FROM cover_groups cg Inner join cover_items ci on cg.id  = ci.cg_id INNER join sale_option_details sod on
        sod.ci_id = ci.id INNER JOIN sale_options so on so.id = sod.sale_id
        WHERE so.id  = ?";
        $saleOptionDetail = DB::select($query, [$id]);

        return view('user_view.showInsuranceDetail')
            ->with('level', $level)
            ->with('saleOption', $saleOption)
            ->with('vehiclePackage', $vehiclePackage)
            ->with('company', $company)
            ->with('saleDetails', $saleOptionDetail);
    }

    /** Function to show the Third Party insurance cover item */
    public function showThirdPartyInsuranceCoverItem($id)
    {
        $query = "SELECT tpp.id, tpp.name as package_name,  l.name as level_name, vt.name as vehicle_types  ,vd.name as vehicle_details,
        tpp.fee, tpp.final_price, ic.logo
        FROM third_party_packages tpp inner join vehicle__details vd on tpp.vehicle_detail  = vd.id
        INNER JOIN vehicle__types vt on vt.id = vd.v_id
        INNER JOIN insurance_companies ic on ic.id = tpp.company_id
        INNER JOIN levels l on l.id = tpp.`level`
        AND tpp.id =?";
        //Get Package Detail
        $packageDetail = collect(DB::select($query, [$id]))->first();

        //Get cover item detail
        $coverDetail = ThirdPartyCoverItem::where('third_package_id', '=', $id)->get();

        return view('insurances.thirdParty.showCoverItem')->with('packageDetail', $packageDetail)
            ->with('coverDetails', $coverDetail);
    }

    /** Function to show the compare view of third party insurance */
    public function showCompareViewThirdPartyInsurance($id1, $id2)
    {

        $query = "SELECT tpp.id, tpp.name as package_name,  l.name as level_name, vt.name as vehicle_types  ,vd.name as vehicle_details,
        tpp.fee, tpp.final_price, ic.logo
        FROM third_party_packages tpp inner join vehicle__details vd on tpp.vehicle_detail  = vd.id
        INNER JOIN vehicle__types vt on vt.id = vd.v_id
        INNER JOIN insurance_companies ic on ic.id = tpp.company_id
        INNER JOIN levels l on l.id = tpp.`level`
        AND tpp.id =?";

        //Get Package Detail
        $packageDetail1 = collect(DB::select($query, [$id1]))->first();
        //Get cover item detail1
        $coverDetail1 = ThirdPartyCoverItem::where('third_package_id', '=', $id1)->get();

        //Get cover item detail2
        $coverDetail2 = (ThirdPartyCoverItem::where('third_package_id', '=', $id2))->get();
        //Get Package Detail
        $packageDetail2 = collect(DB::select($query, [$id2]))->first();

        return view('insurances.thirdParty.showCompareView')
            ->with('coverDetail1', $coverDetail1)
            ->with('coverDetail2', $coverDetail2)
            ->with('packageDetail1', $packageDetail1)
            ->with('packageDetail2', $packageDetail2);
    }

    /** Function to show the input data page of Third Party Insurance */
    public function showInputPageThirdPartyInsurance($id)
    {
        //session(['third_id'=>$id]);
        $query = "SELECT tpp.id, tpp.name as package_name,  l.name as level_name, vt.name as vehicle_types  ,vd.name as vehicle_details,
        tpp.fee, tpp.final_price, ic.logo
        FROM third_party_packages tpp inner join vehicle__details vd on tpp.vehicle_detail  = vd.id
        INNER JOIN vehicle__types vt on vt.id = vd.v_id
        INNER JOIN insurance_companies ic on ic.id = tpp.company_id
        INNER JOIN levels l on l.id = tpp.`level`
        AND tpp.id =?";

        $thirdPartyPackage = collect(DB::select($query, [$id]))->first();

        //Get cover item detail
        $coverDetail = ThirdPartyCoverItem::where('third_package_id', '=', $id)->get();

        //Province information
        $provinces = Province::all();
        //Vehicle Brand
        $vehicleBrand = CarBrand::all();


        return view('insurances.thirdParty.showInputView')
            ->with('package', $thirdPartyPackage)
            ->with('coverDetail', $coverDetail)
            ->with('provinces', $provinces)
            ->with('vehicleBrand', $vehicleBrand);
    }

    /** Function to store the input date of the ThirdPartyInsurane */
    public function thirdPartyStoreInput(Request $req)
    {
        //Validate the information
        $req->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'lastname' => 'required',
            'sex' => 'required',
            'identity' => 'required',
            'province'  =>  'required',
            'district'  => 'required',
            'address' => 'required',
            'vehicleBrand' => 'required',
            'number_plate' => 'required',
            'color' => 'required',
            'engine_number' => 'required',
            'chassic_number' => 'required',
            'registeredProvince' => 'required',
            'reference_photo' => 'required'
        ]);
        //More validate from here ///////

        /////////////////////////////////
        
        //Create new object
        $object = new InsuranceInformation();
        $object->firstname = $req->input('firstname');
        $object->lastname = $req->input('lastname');
        $object->sex = $req->input('sex');
        $object->dob = $req->input('dob');
        $object->tel = $req->input('tel');
        $object->identity = $req->input('identity');
        $object->province = $req->input('province');
        $object->district = $req->input('district');
        $object->address = $req->input('address');
        $object->vehicle_brand = $req->input('vehicleBrand');
        $object->number_plate = $req->input('number_plate');
        $object->color = $req->input('color');
        $object->engine_number = $req->input('engine_number');
        $object->chassic_number = $req->input('chassic_number');
        $object->registered_province = $req->input('registeredProvince');
        //Get Third Party Package data
        $thirdPackage = ThirdPartyPackage::find($req->input('package_id'));

        $object->fee_charge = $thirdPackage->fee;
        $object->total_price = $thirdPackage->final_price;
        $object->insurance_type_id = $req->input('package_id');
        $object->insurance_type = "THIRD-PARTY";
        $object->payment_confirm = "WAIT_FOR_PAYMENT";
        $object->user_id = Auth::user()->id;

        $uploadPath = "Insurances/thirdParty";
        $object->front_image =  ImageCompress::notCompressImage($req->file('reference_photo'), $uploadPath);

        if ($object->save()) {
            session(['third_package_id' => $object->id]);
            return redirect()->route('InsuranceFlowController.showThirdPartyAgreement', ['package_id' => $object->id]);
        } else {
            return redirect()->back()->withInput()->with('error', 'ເກີດຂໍ້ຜິດພາດກະລຸນາລອງໃໝ່');
        }
    }


    /** Function to show agreement of thirdParty after input */
    public function showThirdPartyAgreement($package_id)
    {

        //Get section information
        session(['third_package_id' => $package_id]);

        $query = "SELECT tpp.id, tpp.name as package_name,  l.name as level_name, vt.name as vehicle_types  ,vd.name as vehicle_details,
        tpp.fee, tpp.final_price, ic.logo, tpp.term
        FROM third_party_packages tpp inner join vehicle__details vd on tpp.vehicle_detail  = vd.id
        INNER JOIN vehicle__types vt on vt.id = vd.v_id
        INNER JOIN insurance_companies ic on ic.id = tpp.company_id
        INNER JOIN levels l on l.id = tpp.`level`
        AND tpp.id =?";

        $customerPackage = InsuranceInformation::find(session('third_package_id'));

        $thirdPartyPackage = collect(DB::select($query, [$customerPackage->insurance_type_id]))->first();

        //Get cover item detail
        $coverDetail = ThirdPartyCoverItem::where('third_package_id', '=', $customerPackage->third_package_id)->get();

        //Province information
        $provinces = Province::all();
        //Vehicle Brand
        $vehicleBrand = CarBrand::all();

        return view('insurances.thirdParty.showAgreement')
            ->with('package', $thirdPartyPackage)
            ->with('coverDetail', $coverDetail)
            ->with('provinces', $provinces)
            ->with('vehicleBrand', $vehicleBrand)
            ->with('customerPackage', $customerPackage);
    }

    /** Function to customer to confirm customer information */
    public function updateConfirmThirdParty(Request $req)
    {

        //Get section information
        if (!Session::has('third_package_id')) {
            return redirect()->back()->with('error', 'ເກິດຂໍ້ຜິດພາດກະລຸນາລອງໃໝ່ພາຍຫຼັງ');
        }
        //Validate the information
        $req->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'lastname' => 'required',
            'sex' => 'required',
            'identity' => 'required',
            'province'  =>  'required',
            'district'  => 'required',
            'address' => 'required',
            'vehicleBrand' => 'required',
            'number_plate' => 'required',
            'color' => 'required',
            'engine_number' => 'required',
            'chassic_number' => 'required',
            'registeredProvince' => 'required'
        ]);

        //Find the object
        $object = InsuranceInformation::find(session('third_package_id'));
        $object->firstname = $req->input('firstname');
        $object->lastname = $req->input('lastname');
        $object->sex = $req->input('sex');
        $object->dob = $req->input('dob');
        $object->tel = $req->input('tel');
        $object->identity = $req->input('identity');
        $object->province = $req->input('province');
        $object->district = $req->input('district');
        $object->address = $req->input('address');
        $object->vehicle_brand = $req->input('vehicleBrand');
        $object->number_plate = $req->input('number_plate');
        $object->color = $req->input('color');
        $object->engine_number = $req->input('engine_number');
        $object->chassic_number = $req->input('chassic_number');
        $object->registered_province = $req->input('registeredProvince');
        $object->payment_confirm = "WAIT_FOR_PAYMENT";
        if ($object->save()) {

            return redirect()->route('InsuranceFlowController.showPaymentProviderForThirdPartyPackage');
        } else {
            return redirect()->back()->with('error', 'ເກີດຂໍ້ຜິດພາດກະລຸນາລອງໃໝ່');
        }
    }

    /** Function to show the payment provider detail */
    public function showPaymentProviderForThirdPartyPackage()
    {
        //When session not set then send back to welcome page
        if (!Session::has('third_package_id')) {
            return redirect()->route('welcome');
        }

        //Get the available payment provider data by status 1 = avaialbe, 0 = not available
        $paymentProviders = PaymentProvider::where('status', '=', '1')->get();

        return view('insurances.thirdParty.showPaymentProviderList')->with('paymentProviders', $paymentProviders);
    }

    /** Function to select payment provider for third party package */
    public function showSubmitPaymentForThirdPartyPackage($provider_id)
    {
        //dd(session('third_package_id'));

        //When session not set then send back to welcome page
        if (!Session::has('third_package_id')) {

            return redirect()->route('welcome');
        }
        $provider = PaymentProvider::find($provider_id);

        return view('insurances.thirdParty.showPaymentSubmit')->with('provider', $provider);
    }

    /** Function update payment detail of third party package */
    public function updatePaymentDetailOfThirdParty(Request $req)
    {
        //Validate the image should be upload
        $req->validate([
            'slipUploaded' => 'required'
        ]);
        $thirdPackageID = session('third_package_id');

        //When session not set then send back to welcome page
        if (!Session::has('third_package_id')) {

            return redirect()->route('welcome');
        }

        $inputData = InsuranceInformation::find(session('third_package_id'));

        $extension = $req->file('slipUploaded')->getClientOriginalExtension();
        $newImageCompress = ImageCompress::compressImage($req->file('slipUploaded'), 70, 'tmpfolder', 800);
        $data = file_get_contents($newImageCompress);
        $base64SlipImage = 'data:image/' . $extension . ';base64,' . base64_encode($data);
        File::delete($newImageCompress);

        $inputData->slipUploaded = $base64SlipImage;
        $inputData->payment_time = now();
        $inputData->payment_confirm = "WAIT_FOR_APPROVED";

        $inputData->save();

        session(['payment_status' => 'WAIT_FOR_APPROVED']);

        return redirect()->route('InsuranceFlowController.showComplete');
    }

    /** Function to delete customer of third party */
    public function deleteThirdPartyInsurance($id)
    {
        $deleteObject = ThirdPartyCustomerInput::find($id);

        if ($deleteObject->delete()) {
            return redirect()->back()->with('success', 'ດຳເນີນການສຳເລັດ');
        } else {
            return redirect()->back()->with('error', 'ເກີດຂໍ້ຜິດພາດກະລຸນາລອງໃໝ່');
        }
    }
}
