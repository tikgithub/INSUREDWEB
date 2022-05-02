<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HeathCoverTypeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\InsuranceCompanyController;
use App\Http\Controllers\InsuranceFlowController;
use App\Http\Controllers\JSONServiceController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\ThirdPartyInsuranceController;
use App\Http\Controllers\ThirdParyCoverController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleDetailController;
use App\Http\Controllers\VehiclePackageController;
use App\Http\Controllers\VehicleTypeController;
use App\Http\Controllers\AccidentItemController;
use App\Http\Controllers\AccidentPlanController;
use App\Http\Controllers\AccidentSaleController;
use App\Http\Controllers\AdminInsuranceController;
use App\Http\Controllers\HeathCoverController;
use App\Http\Controllers\HeathCoverItemController;
use App\Http\Controllers\HeathPlanController;
use App\Http\Controllers\HeathPlanDetailController;
use App\Http\Controllers\HeathSaleController;
use App\Http\Controllers\MessageToUsController;
use App\Http\Controllers\UserCommentController;
use App\Http\Controllers\WebsiteController;
use App\Models\ThirdPartyCoverItem;
use App\Models\Vehicle_Type;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/** Route Call Index Of Web APP */
Route::get('/', [IndexController::class, 'index'])->name('welcome');
Route::get('/error', [IndexController::class, 'errorPage'])->name('errorPage');


/** Group route for user operation */
Route::group(['prefix' => 'user'], function () {
    /** Route Call Login Page */
    Route::get('/login', [UserController::class, 'showLoginPage'])->name('UserController.showLoginPage');

    /** Route Call Register Page */
    Route::get('/register', [UserController::class, 'showRegisterPage'])->name('UserController.showRegisterPage');

    /** Route for Store User Information */
    Route::post('/store', [UserController::class, 'storeUserInformation'])->name('UserController.storeUserInformation');

    /** Route for User Logout */
    Route::get('/logout', [UserController::class, 'logOut'])->name('UserController.logOut');

    /** Route for Sign In User (Welcome Page) */
    Route::post('/login', [UserController::class, 'signIn'])->name("UserController.signIn");

    /** Route for validate User before buying insurance (During make transactionx ) */
    Route::post('/validate', [UserController::class, 'validateUserBeforeBuying'])->name('UserController.validateUserBeforeBuying');
});

/** Group route for insurance buying */
Route::group(['prefix' => 'insurance'], function () {
    /** Route show the insurance type selection */
    Route::get('/select', [InsuranceFlowController::class, 'showInsuranceTypeSelection'])->name('InsuranceFlowController.showInsuranceTypeSelection');

    /** Route show the car insured select menu page */
    Route::get('/car', [InsuranceFlowController::class, 'showCarInsuranceSelectionMenu'])->name('InsuranceFlowController.showCarInsuranceSelectionMenu');

    /** Route searching package of vehicle insurance */
    Route::get('/search', [InsuranceFlowController::class, 'vehicleSearchForInsurancePackage'])->name('InsuranceFlowController.vehicleSearchForInsurancePackage');

    /** Route for show Option Detail of Normal level */
    Route::get('/detail/{sale_id}', [InsuranceFlowController::class, 'showNormalPackageDetail'])->name('InsuranceFlowController.showNormalPackageDetail');

    /** Route for show the compare view of Normal package */
    Route::get('/compare/option/{p1}/{p2}', [InsuranceFlowController::class, 'normalPackageCompare'])->name('InsuranceFlowController.normalPackageCompare');

    /** Route for show buy now page with input menu */
    Route::get('/buy/{sale_id}', [InsuranceFlowController::class, 'showBuyNowPage'])->name('InsuranceFlowController.showBuyNowPage');

    /** Route to show third party insurance cover item page */
    Route::get('/customer/thirdparty/coveritem/{id}', [InsuranceFlowController::class, 'showThirdPartyInsuranceCoverItem'])->name('InsuranceFlowController.showThirdPartyInsuranceCoverItem');

    /** ROute to show the compare view of the third party insurance */
    Route::get('/customer/thirdparty/compare/{id1}/{id2}', [InsuranceFlowController::class, 'showCompareViewThirdPartyInsurance'])->name('InsuranceFlowController.showCompareViewThirdPartyInsurance');

    /** Route to show input data of third party insurance */
    Route::get('/customer/thirdparty/fillform/{id}', [InsuranceFlowController::class, 'showInputPageThirdPartyInsurance'])->name('InsuranceFlowController.showInputPageThirdPartyInsurance');

    /** Accident PA/OPA Work flow */
    Route::get('/accident/select_company', [AccidentSaleController::class, 'showSelectCompany'])->name('AccidentSaleController.showSelectCompany');
    Route::get('/accident/select_insurance_type/{company_id}', [AccidentSaleController::class, 'showPackagePlan'])->name('AccidentSaleController.showPackagePlan');
    Route::get('/accident/show_package_detail/{plan_id}', [AccidentSaleController::class, 'showPlanDetail'])->name('AccidentSaleController.showPlanDetail');
    Route::get('/accident/customer_information_input/{plan_id}', [AccidentSaleController::class, 'showInputInformationPage'])->name('AccidentSaleController.showInputInformationPage');

    /** Route group of HeathSaleController */
    Route::get('/heath/company_select', [HeathSaleController::class, 'selectCompany'])->name('HeathController.SelectCompany');
    Route::get('/heath/package_select/{company_id}', [HeathSaleController::class, 'showPackage'])->name('HeathSaleController.ShowPackage');
    Route::get('/heath/package_select_detail/{plan_id}', [HeathSaleController::class, 'showSelectedPackage'])->name('HeathSaleController.ShowSelectPackage');
    Route::get('/heath/customer_input./{plan_id}', [HeathSaleController::class, 'showCustomerInput'])->name('HeathSaleController.ShowCustomerInput');
    /** Route ground of heathSaleController End */

    /** Contact Us Controller */
    Route::post('/customer/contact_us', [MessageToUsController::class, 'storeMessage'])->name('MessageToUsController.StoreMessage');
    /** Contact Us Controller End */
});

/** JsonResponse Route Group */
Route::group(['prefix' => 'api/json'], function () {

    /** Route to response ThirdPartyOption */
    Route::get('/thirdpartyoption/{level_id}', [JSONServiceController::class, 'jsonThridPartyOption']);

    /** Route to response Vehicle Detail By Vehicle Type */
    Route::get('/vehicledetail/{v_id}', [JSONServiceController::class, 'jsonVehicleDetail']);

    /** Route to response District detail By Province */
    Route::get('/district/{province_id}', [JSONServiceController::class, 'jsonDistrict'])->name('JSONDistrict');
});

/** Route Group for customer who already the member or Route which require to SignIn First */
Route::group(['prefix' => 'insurance', 'middleware' => 'customerAuthentication'], function () {
    /** Route store customer input information for Normal */
    Route::post('/customer/input/store', [InsuranceFlowController::class, 'storeInputFromCustomer'])->name('InsuranceFlowController.storeInputFromCustomer');

    /** Route update customer input information for Normal */
    Route::post('/customer/input/update', [InsuranceFlowController::class, 'updateInputData'])->name('InsuranceFlowController.updateInputData');

    /** Route to show agreement information for Normal after customer input */
    Route::get('/customer/agreement', [InsuranceFlowController::class, 'showAgreementPage'])->name('InsuranceFlowController.showAgreementPage');

    /** Route to show user insurance list that being to customer */
    Route::get('/customer/order', [UserController::class, 'userListInsurance'])->name('UserController.userListInsurance');

    /** Route to show user insurance list that being to customer */
    Route::get('/customer/order', [UserController::class, 'showUserInsuranceList'])->name('UserController.showUserInsuranceList');

    /** Route to show user profile page */
    Route::get('/customer/profile', [UserController::class, 'showUserProfilePage'])->name('UserController.showUserProfilePage');

    /** Route to redirect to agreement page */
    Route::get('/redirect_to_agreement/{id}', [InsuranceFlowController::class, 'redirectToAgreement'])->name('InsuranceFlowController.redirectToAgreement');

    /** Route to show available PaymentProvider list */
    Route::get('/customer/payment_provider', [InsuranceFlowController::class, 'showPaymentProviderPageSelection'])->name('InsuranceFlowController.showPaymentProviderPageSelection');

    /** Route to show payment submit */
    Route::get('/customer/payment/{provider_id}', [InsuranceFlowController::class, 'showFormSubmitPayment'])->name('InsuranceFlowController.showFormSubmitPayment');

    /** Route update the payment detail */
    Route::post('/customer/confirm/payment', [InsuranceFlowController::class, 'updatePaymentDetail'])->name('InsuranceFlowController.updatePaymentDetail');

    /** Route to show complete the payment */
    Route::get('/customer/completed', [InsuranceFlowController::class, 'showComplete'])->name('InsuranceFlowController.showComplete');

    /** Route to delete the input detail by customer */
    Route::get('/customer/delete/{id}', [InsuranceFlowController::class, 'deleteTheInput'])->name('InsuranceFlowController.deleteTheInput');

    /** Route to show the insurance detail page */
    Route::get('/customer/insurance_detail/{id}', [InsuranceFlowController::class, 'showInsuranceDetailByCustomer'])->name('InsuranceFlowController.showInsuranceDetailByCustomer');

    /** Route to update profile user */
    Route::post('/customer/update_photo', [UserController::class, 'changeProfilePhoto'])->name('UserController.changeProfilePhoto');

    /** Route to update basic user information */
    Route::post('/cusotmer/update/basicinfo', [UserController::class, 'updateBasicInformation'])->name('UserController.updateBasicInformation');

    /** Route to update or change user password */
    Route::post('/customer/changepassword', [UserController::class, 'changeUserPassword'])->name('UserController.changeUserPassword');

    /** Route to store user information of third party package */
    Route::post('/customer/thirdparty/information', [InsuranceFlowController::class, 'thirdPartyStoreInput'])->name('InsuranceFlowController.thirdPartyStoreInput');

    /** Route to show user information agreement before submit */
    Route::get('/customer/thirdparty/agreement/{package_id}', [InsuranceFlowController::class, 'showThirdPartyAgreement'])->name('InsuranceFlowController.showThirdPartyAgreement');

    /** Route to confirm the user information agreement */
    Route::post('/customer/thirdparty/confirm', [InsuranceFlowController::class, 'updateConfirmThirdParty'])->name('InsuranceFlowController.updateConfirmThirdParty');

    /** Route to show payment provider for third party insurnace */
    Route::get('/customer/thirdparty/paymentprovider}', [InsuranceFlowController::class, 'showPaymentProviderForThirdPartyPackage'])->name('InsuranceFlowController.showPaymentProviderForThirdPartyPackage');

    /** Route to select payment provider and show how to pay */
    Route::get('/customer/thirdparty/howtopay/{provider_id}', [InsuranceFlowController::class, 'showSubmitPaymentForThirdPartyPackage'])->name('InsuranceFlowController.showSubmitPaymentForThirdPartyPackage');

    /** Route to update payment detail of third party insurnace */
    Route::post('/customer/thirparty/paymentconfirm', [InsuranceFlowController::class, 'updatePaymentDetailOfThirdParty'])->name('InsuranceFlowController.updatePaymentDetailOfThirdParty');

    /** Route to store the input information of accident insurance */
    Route::post('/customer/accident/store', [AccidentSaleController::class, 'storeInput'])->name('AccidentSaleController.storeInput');

    /** Route to show confirmation page of accident insurance */
    Route::get('/customer/accident/confirm', [AccidentSaleController::class, 'showConfirmationPage'])->name('AccidentSaleController.showConfirmationPage');

    /** Route to update confirmation input from customer of accident insurance */
    Route::post('/customer/accident/confrim/update', [AccidentSaleController::class, 'updateConfirmation'])->name('AccidentSaleController.updateConfirmation');

    //** Route to show payment provinder list for accident insurance */
    Route::get('/customer/accident/paymentlist', [AccidentSaleController::class, 'showPlaymentProviderList'])->name('AccidentController.paymentProvider');

    /** Route to show the payment submit page for accident insurance */
    Route::get('/customer/accident/submitPayment/{id}', [AccidentSaleController::class, 'showPaymentSubmitPage'])->name('AccidentSaleController.showPaymentSubmitPage');

    /** Route To update the payment slip of Accident insurance */
    Route::post('customer/accident/submitPayment', [AccidentSaleController::class, 'submitAccidentPayment'])->name('AccidentSaleController.submitAccidentPayment');

    /** Route to show insurance user information detail */
    Route::get('/user/insurance_view_detail/{id}', [UserController::class, 'insuranceViewDetail'])->name('UserController.InsuranceViewDetail');

    /** HeathSaleController */
    Route::post('/customer/heath/store', [HeathSaleController::class, 'storeUserInformation'])->name('HeathSaleController.StoreUserInformation');
    Route::get('/customer/heath/confirmation', [HeathSaleController::class, 'showUserConfirmationPage'])->name('HeathSaleController.ShowUserConfirmationPage');
    Route::post('/customer/heath/confirmatio/update', [HeathSaleController::class, 'updateUserConfirmationData'])->name('HeathSaleController.UpdateUserConfirmationData');
    Route::get('/customer/heath/paymentprovider', [HeathSaleController::class, 'showPaymentProvider'])->name('HeathSaleController.ShowPaymentProvider');
    Route::get('/customer/heath/payment_submit/{id}', [HeathSaleController::class, 'showPaymentSubmitPage'])->name('HeathSaleController.ShowPaymentSubmitPage');
    Route::post('/customer/heath/payment_submit', [HeathSaleController::class, 'submitHeathPayment'])->name('HeathSaleController.SubmitHeathPayment');
    /** HeathSaleController End */

    /** UserController  */
    Route::get('/customer/view_vehicle_insurance_detail/{id}', [UserController::class, 'setVehicleInsuranceID'])->name('UserController.SetVehicleInsuranceID');
    /** UserController End */


    /** UserCommentController */
    Route::post('/customer/comment/store', [UserCommentController::class, 'storeUserComment'])->name('UserCommentController.StoreUserComment');
    /** UserCommentController End */
});


/** Route Group For Admin User */

Route::group(['prefix' => 'admin', 'middleware' => ['adminAuthentication']], function () {
    /** Route to show admin dashboard */
    Route::get('/welcome', [AdminController::class, 'showAdminDashBoard'])->name('AdminController.showAdminDashBoard');
    Route::get('/welcome_admin', [AdminController::class, 'showNewAdminDashBoard'])->name('AdminController.showNewAdminDashBoard');

    /** Route to allow admin to view detail of insurance customer selected */
    Route::get('/insurance/view/{id}', [AdminController::class, 'showCustomerInput'])->name('AdminController.showCustomerInput');

    /** Route to show all insurance customer selected */
    Route::get('/insurance/views', [AdminController::class, 'showAllCustomerInput'])->name('AdminController.showAllCustomerInput');

    /** Route to delete the input detail by admin */
    Route::get('/insurance/delete/{id}', [AdminController::class, 'deleteTheInput'])->name('AdminController.deleteTheInput');

    /** Route to allow admin to approve, delete, edit the input data from custmer (Verify the data) */
    Route::get('/insurance/verify/{id}', [AdminController::class, 'showCustomerPaymentItem'])->name('AdminController.showCustomerPaymentItem');

    /** Route to approve the insurance from customer */
    Route::post('insurance/approve/{id}', [AdminController::class, 'approveInsurance'])->name('AdminController.approveInsurance');

    /** Route to update the insurance from customer by admin */
    Route::post('insurance/update', [AdminController::class, 'updateCustomerInsuranceInformation'])->name('AdminController.updateCustomerInsuranceInformation');

    /** Route to show the all payment item */
    Route::get('insurance/view_all_payment', [AdminController::class, 'showAllPaymentItem'])->name('AdminController.showAllPaymentItem');

    /** Route to show all the contracts items */
    Route::get('insurance/contracts', [AdminController::class, 'showAllApprovedItem'])->name('AdminController.showAllApprovedItem');

    /** Route to show insurance in contract item */
    Route::get('insurance/contract/{id}', [AdminController::class, 'showInsuranceInContract'])->name('AdminController.showInsuranceInContract');

    /** Route to show insurance has been out of contract */
    Route::get('/insurance/outOfContract/{id}', [AdminController::class, 'viewOutOfContract'])->name('AdminController.viewOutOfContract');

    /** Route to show insurance has been out of contracts as list */
    Route::get('/insurance/outOfContracts', [AdminController::class, 'showAllOutOfContract'])->name('AdminController.showAllOutOfContract');

    /************************************************ Data Manager **************************************/

    /** Route Show index page of Datamanager */
    Route::get('/datamanager/index', [AdminController::class, 'indexDataManager'])->name('AdminController.indexDataManager');
    /** ROute show index of CarBrand */
    Route::get('/datamanager/carbrand', [AdminController::class, 'indexCarbrand'])->name('AdminController.indexCarbrand');
    /** Route to store carbrand */
    Route::post('/datamanager/carbrand/store', [AdminController::class, 'storeCarbrand'])->name('AdminController.storeCarbrand');
    /** Route to update carbrand */
    Route::post('/datamanager/carbrand/update', [AdminController::class, 'updateCarbrand'])->name('AdminController.updateCarbrand');

    /** Route to show index page of Insurance Company */
    Route::get('/datamanager/insurance_company', [AdminController::class, 'indexInsuranceCompany'])->name('AdminController.indexInsuranceCompany');

    /** Route to store Insurance Company */
    Route::post('/datamanager/insurance_company/store', [InsuranceCompanyController::class, 'store'])->name('InsuranceCompanyController.store');

    /** Route to update Insurance Company */
    Route::post('/datamanager/insurance_company/update', [InsuranceCompanyController::class, 'update'])->name('InsuranceCompanyController.update');

    /** Route to show the Index page of Level */
    Route::get('/datamanager/level', [AdminController::class, 'indexInsuranceLevel'])->name('AdminController.indexInsuranceLevel');

    /** Route to store the Level */
    Route::post('/datamanger/level/store', [LevelController::class, 'store'])->name('LevelController.store');

    /** Route to update the Level */
    Route::post('/datamanager/level/update', [LevelController::class, 'update'])->name('LevelController.update');

    /** Route to show the index page of Vehicle Type */
    Route::get('/datamanager/vehicletype/', [AdminController::class, 'indexVehicleType'])->name('AdminController.indexVehicleType');

    /** Route to store the Vehicle Type to DB */
    Route::post('/datamanager/vehicletype/store', [VehicleTypeController::class, 'store'])->name('VehicleTypeController.store');

    /** Route to edit the Vehicle Type to DB */
    Route::post('/datamanager/vehicletype/edit', [VehicleTypeController::class, 'update'])->name('VehicleTypeController.update');

    /** Route to show the index page of Vehicle Detail */
    Route::get('/datamanager/vehicledetails', [AdminController::class, 'indexVehicleDetail'])->name('AdminController.indexVehicleDetail');

    /** Route to store Vehicle Detail */
    Route::post('/datamanager/vehicledetail/store', [VehicleDetailController::class, 'store'])->name('VehicleDetailController.store');

    /** Route to search Vehicle Detail by Type ID */
    Route::get('/datamanager/vehicledetail/search/{type_id}', [VehicleDetailController::class, 'searchByType'])->name('VehicleDetailController.searchByType');

    /** Route to update Vehicle Detail */
    Route::post('/datamanager/vehicledetail/update', [VehicleDetailController::class, 'update'])->name('VehicleDetailController.update');

    /** Route to show VehiclePackage create page */
    Route::get('/datamanger/vehiclepackage/', [AdminController::class, 'createVehiclePackage'])->name('AdminController.createVehiclePackage');

    /** Route to create VehiclePackage */
    Route::post('/datamanager/vehiclepackage/store', [VehiclePackageController::class, 'store'])->name('VehiclePacakgeController.store');

    /** Route to create Third Party Insurance */
    Route::get('/datamanager/thirdparty/create', [ThirdPartyInsuranceController::class, 'create'])->name('ThirdPartyInsuranceController.create');

    /** Route to store Third Party Insurance */
    Route::post('/datamanager/thirdparty/store', [ThirdPartyInsuranceController::class, 'store'])->name('ThirPartyInsuranceController.store');

    /** Rote to show list of Third Party Insurance */
    Route::get('/datamanager/thirdparty', [ThirdPartyInsuranceController::class, 'index'])->name('ThirdPartyInsuranceController.index');

    /** Route to update status of package */
    Route::get('/datamanager/thirdparty/update_status/{id}', [ThirdPartyInsuranceController::class, 'updateAvailableStatus'])->name('ThirdPartyInsuranceController.updateAvailableStatus');

    /** Route to update status of package */
    Route::get('/datamanager/thirdparty/update_not_status/{id}', [ThirdPartyInsuranceController::class, 'updateNotAvailableStatus'])->name('ThirdPartyInsuranceController.updateNotAvailableStatus');

    /** Route to update status of package */
    Route::get('/datamanager/thirdparty/edit/{id}', [ThirdPartyInsuranceController::class, 'edit'])->name('ThirdPartyInsuranceController.edit');

    /** Route to update the information of ThirdPartyPackage */
    Route::post('/datamanager/thirdparty/update', [ThirdPartyInsuranceController::class, 'update'])->name('ThirdPartyInsuranceController.update');

    /** Route to store Third Party Cover Item */
    Route::post('/datamanager/thirdpartycover/store', [ThirdParyCoverController::class, 'store'])->name('ThirPartyCoverController.store');

    /** Route to update Thrid Party Item */
    Route::post('/datamanager/thirdpartycover/update', [ThirdParyCoverController::class, 'update'])->name('ThirdPartyCoverController.update');

    /** Route to remove Third Party Item */
    Route::get('/datamanager/thirdpartycover/delete/{id}', [ThirdParyCoverController::class, 'destroy'])->name('ThirdPartyCoverController.destroy');

    /** Route to show Third Party Insurance */
    Route::get('/insurance/thirdpartyinsurance/{id}', [AdminController::class, 'thirdPartyWaitForPaymentDetail'])->name('AdminController.thirdPartyWaitForPaymentDetail');

    /** Route to delete the Third Party Insurance by Admin */
    Route::get('/insurance/thirdparty/delete/{id}', [AdminController::class, 'deleteThirdPartyInsurance'])->name('AdminController.deleteThirdPartyInsurance');

    /** Route for display third party insruance link which not payment yet */
    Route::get('/insurance/thirdparty/waitforpayment', [AdminController::class, 'listOfThirdPartyInsuranceWaitForPayment'])->name('AdminController.listOfThirdPartyInsuranceWaitForPayment');

    /** Route for show wait for approve view */
    Route::get('/insurance/thirdparty/waitforapprove/{id}', [AdminController::class, 'thirdPartyWaitForApproveDetail'])->name('AdminController.thirdPartyWaitForApproveDetail');

    /** Route for update the data for admin update user information */
    Route::post('/insurance/thirdparty/waitforapprove/update', [AdminController::class, 'updateThirdPartyInformationForCustomer'])->name('AdminController.updateThirdPartyInformationForCustomer');

    /** Route for update the approve insurance for third party insurnace */
    Route::post('/insurance/thirdparty/approve', [AdminController::class, 'approveThirdPartyInsurance'])->name('AdminController.approveThirdPartyInsurance');

    /** Route for show the HeathCoverType Index page */
    Route::get('/datamanager/heathcovertype/', [AdminController::class, 'heathCoverType'])->name('AdminController.heathCoverType');
    /** Route to store HeathCoverType Item */
    Route::post('/datamanager/heathcovertype/store', [HeathCoverTypeController::class, 'store'])->name('HeathCoverTypeController.store');

    /** Route to update HeathCoverType Item */
    Route::post('/datamanager/heathcovertype/update', [HeathCoverTypeController::class, 'update'])->name('HeathCoverTypeController.update');

    /** Route to delete HeathCoverType */
    Route::get('/datamanager/heathcovertype/delete/{id}', [HeathCoverTypeController::class, 'delete'])->name('HeathCoverTypeController.delete');

    /** Route to update HeathCoverType Status */
    Route::get('/datamanager/heathcovertype/updatestatus/{id}/{status}', [HeathCoverTypeController::class, 'updateStatus'])->name('HeathCoverTypeController.updateStatus');

    /** Route to search HeathCoverType By Company Id */
    Route::get('/datamanager/heathcovertype/search/{company_id}', [HeathCoverTypeController::class, 'searchByCompany'])->name('HeathCoverTypeController.searchByCompany');

    /** Route to call Index of curd accident item  */
    Route::get('/datamanager/accidentcoveritem/', [\App\Http\Controllers\AccidentItemController::class, 'index'])->name('AccidentItemController@index');

    /** Route for each the OPA/PA Data by company_id */
    Route::get('/datamanager/accidentcoveritem/find/{company_id}', [AccidentItemController::class, 'searchByCompany'])->name('AccidentItemController.searchByCompany');

    /** Route for create PA*OPA  */
    Route::get('/datamanager/accidentcoveritem/create/{id}', [AccidentItemController::class, 'create'])->name('AccidentItemController.create');

    /** Route for store PA & OPA Data */
    Route::post('/datamanger/accidentcoveritem/store', [AccidentItemController::class, 'store'])->name('AccidentItemController.store');
    Route::get('/datamanager/accidentcoveritem/delete/{id}', [AccidentItemController::class, 'delete'])->name('AccidentItemController.delete');
    Route::post('/datamanager/accidentcoveritem/update', [AccidentItemController::class, 'update'])->name('AccidentItemController.update');


    /** Accident Plan */
    Route::get('/datamanager/accidentplan/create', [AccidentPlanController::class, 'index'])->name('AccidentPlanController.index');
    Route::get('/datamanager/accidentplan/search/{company_id}', [AccidentPlanController::class, 'searchByCompany'])->name('AccidentPlanController.search');
    Route::get('/datamanager/accidentplan/createplan/{type_id}', [AccidentPlanController::class, 'managePlan'])->name("AccidentPlanController.managePlan");
    Route::post('/datamanager/accidentplan/store', [AccidentPlanController::class, 'store'])->name('AccidentPlanController.store');
    Route::get('/datamanager/accidentplan/delete/{id}', [AccidentPlanController::class, 'delete'])->name('AccidentPlanController.delete');
    Route::post('/datamanager/accidentplan/update', [AccidentPlanController::class, 'update'])->name('AccidentPlanController.update');
    Route::get("/datamanager/accidentplan/plandetail/{plan_id}", [AccidentPlanController::class, 'showPlanDetail'])->name("AccidentPlanController.showPlanDetail");
    Route::post('/datamanager/accidentplan/plandetail', [AccidentPlanController::class, 'updatePrice'])->name('AccidentPlanController.updatePrice');
    /** End Accident Plan */

    Route::get('/insuranceList', [AdminController::class, 'showInsuranceList'])->name('AdminController.showInsuranceList');

    /** HeathCoverType Controller */
    Route::get('/datamanager/heath_cover/index', [HeathCoverController::class, 'index'])->name('HeathCoverController.Index');
    Route::post('/datamanager/heath_cover/store', [HeathCoverController::class, 'store'])->name('HeathCoverController.Store');
    Route::get('/datamanager/heath_cover/update/{id}/{status}', [HeathCoverController::class, 'changeStatus'])->name('HeathCoverController.ChangeStatus');
    Route::post('/datamanager/heath_cover/update', [HeathCoverController::class, 'update'])->name('HeathCoverController.Update');
    /** HeathCoverType Controller End */

    /** HeathCoverItem Controller */
    Route::get('/datamanager/heath_cover_item/index', [HeathCoverItemController::class, 'index'])->name('HeathCoverItemController.Index');
    Route::get('/datamanager/heath_cover_item/search/{company_id}', [HeathCoverItemController::class, 'getCoverTypeByCompany'])->name('HeathCoverItemController.getCoverTypeByCompany');
    Route::get('/datamanager/heath_cover_item/create/{cover_type_id}', [HeathCoverItemController::class, 'create'])->name('HeathCoverItemController.Create');
    Route::post('/datamanager/heath_cover_item/store/', [HeathCoverItemController::class, 'store'])->name('HeathCoverItemController.Store');
    Route::post('/datamanger/heath_cover_item/update', [HeathCoverItemController::class, 'update'])->name('HeathCoverItemController.Update');
    Route::get('/datamanager/heath_cover_item/delete/{id}', [HeathCoverItemController::class, 'delete'])->name('HeathCoverItemController.Delete');
    /** HeathCoverItem Controller End */

    /** HeathPlan Controller */
    Route::get('/datamanager/heath_plan/create/{cover_type_id}', [HeathPlanController::class, 'create'])->name('HeathPlanController.Create');
    Route::post('/datamanager/heath_plan/store', [HeathPlanController::class, 'store'])->name('HeathPlanController.Store');
    Route::post('/datamanager/heath_plan/update', [HeathPlanController::class, 'update'])->name('HeathPlanController.Update');
    /** HeathPlan Controller End */

    /** HeathPlanDetail Controller */
    Route::get('/datamanager/heath_plan_detail/{plan_id}', [HeathPlanDetailController::class, 'index'])->name('HeathPlanDetailController.Index');
    Route::get('/datamanager/heath_plan_detail/update/{plan_detail_id}', [HeathPlanDetailController::class, 'update'])->name('HeathPlanDetailController.Update');
    /** HeathPlanDetail Controller End */

    /** AdminInsuranceController */
    Route::get('/check_for_approve/{id}', [AdminInsuranceController::class, 'showPageDetailForApprove'])->name('AdminInsuranceController.ShowPageDetailForApprove');
    Route::get('/edit_vehicle_detail/{id}', [AdminInsuranceController::class, 'showEditPageOfVehicleInsurance'])->name('AdminInsuranceController.ShowEditPageOfVehicleInsurance');
    Route::post('/edit_vehicle_detail', [AdminInsuranceController::class, 'updateVehicleInsurance'])->name('AdminInsuranceController.UpdateVehicleInsurance');
    Route::post('/approve_vehicle_detail', [AdminInsuranceController::class, 'updateVehicleInsuranceContract'])->name('AdminInsuranceController.UpdateVehicleInsuranceContract');
    Route::get('/remove_insurance/{id}', [AdminInsuranceController::class, 'removeInsurance'])->name('AdminInsuranceController.RemoveInsurance');

    Route::get('/edit_thirdparty_detail/{id}',[AdminInsuranceController::class,'showEditPageOfThirPartyInsurance'])->name('AdminInsuranceController.ShowEditPageOfThirPartyInsurance');
    Route::post('/edit_thirdparty_delete',[AdminInsuranceController::class,'updateThirdPartyInsurance'])->name('AdminInsuranceController.UpdateThirdPartyInsurance');

    Route::get('/edit_accident_detail/{id}',[AdminInsuranceController::class,'showEditPageOfAccidentInsurance'])->name('AdminInsuranceController.ShowEditPageOfAccidentInsurance');
    Route::post('/edit_accident_detail',[AdminInsuranceController::class,'updateAccidentInsurance'])->name('AdminInsuranceController.UpdateAccidentInsurance');

    Route::get('/edit_heath_detail/{id}',[AdminInsuranceController::class,'showEditPageOfHeathInsurance'])->name('AdminInsuranceController.ShowEditPageOfHeathInsurance');
    Route::post('/edit_heath_detail',[AdminInsuranceController::class,'updateHeathInsurance'])->name('AdminInsuranceController.UpdateHeathInsurance');
    /** AdminInsuranceController End */


    /** Website Controller */
    Route::get('/website/', [WebsiteController::class, 'index'])->name('WebsiteController.index');
    Route::get('/website/image_slide', [WebsiteController::class, 'imageSlide'])->name('WebsiteController.ImageSlide');
    Route::post('/website/image_slide/store', [WebsiteController::class, 'storeSlideImage'])->name('WebsiteController.StoreSliderImage');
    Route::post('/website/image_slide/update', [WebsiteController::class, 'editSlideImage'])->name('WebsiteController.EditSlideImage');
    Route::get('/website/image_slide/delete/{id}', [WebsiteController::class, 'deleteSlideImage'])->name('WebsiteController.DeleteSlideImage');

    Route::get('/website/insurance_type', [WebsiteController::class, 'showInsuranceTypePage'])->name('WebsiteController.ShowInsuranceTypePage');
    Route::post('/website/insurance_type_page/store/', [WebsiteController::class, 'storeInsuraceTypePage'])->name('WebsiteController.StoreInsuraceTypePage');
    Route::post('/website/insurance_type_page/update', [WebsiteController::class, 'updateInsuranceTypePage'])->name('WebsiteController.UpdateInsuranceTypePage');
    Route::get('/website/insurance_type_page/delete/{id}', [WebsiteController::class, 'deleteInsuranceTypePage'])->name('WebsiteController.DeleteInsuranceTypePage');

    Route::get('/website/howtopay', [WebsiteController::class, 'showHowToPay'])->name('WebsiteController.ShowHowToPay');
    Route::post('/website/howtopay/store', [WebsiteController::class, 'storeHowToPay'])->name('WebsiteController.StoreHowToPay');
    Route::get('/website/howtopay/delete/{id}', [WebsiteController::class, 'deleteHowToPay'])->name('WebsiteController.DeleteHowToPay');
    Route::post('/website/howtopay/update', [WebsiteController::class, 'updateHowToPay'])->name('WebsiteController.UpdateHowToPay');

    Route::get('/website/partner/', [WebsiteController::class, 'showPartnerWebPage'])->name('WebsiteController.ShowPartnerWebPage');
    Route::post('/website/partner/store', [WebsiteController::class, 'storePartnerWebPage'])->name('WebsiteController.StorePartnerWebPage');
    Route::post('/website/partner/update', [WebsiteController::class, 'updatePartnerWebPage'])->name('WebsiteController.UpdatePartnerWebPage');
    Route::get('/website/partner/delete/{id}', [WebsiteController::class, 'deletePartnerWebPage'])->name('WebsiteController.DeletePartnerWebPage');

    Route::get('/website/comment/', [WebsiteController::class, 'showCommentWebPage'])->name('WebsiteController.ShowCommentWebPage');
    Route::get('/website/comment/updatestatus/{id}', [WebsiteController::class, 'updateCommentStatus'])->name('WebsiteController.UpdateCommentStatus');

    Route::get('/website/webinfo', [WebsiteController::class, 'showWebsiteInfo'])->name('WebsiteController.ShowWebsiteInfo');

    /** Website Controller End */

    /** MessageToUs Controller */
    Route::get('/messaging', [MessageToUsController::class, 'viewMessage'])->name('MessageToUsController.ViewMessage');
    Route::get('/messaging/{id}', [MessageToUsController::class, 'viewMessageDetail'])->name('MessageToUsController.ViewMessageDetail');
    Route::get('/messaging/delete/{id}', [MessageToUsController::class, 'deleteMessage'])->name('MessageToUsController.DeleteMessage');
    /** MessageToUs Controller */


    /************************************************ End Data Manager **************************************/
});
