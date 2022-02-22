<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\InsuranceFlowController;
use App\Http\Controllers\JSONServiceController;
use App\Http\Controllers\UserController;
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
Route::get('/',[IndexController::class,'index'])->name('welcome');

/** Group route for user operation */
Route::group(['prefix'=>'user'],function(){
    /** Route Call Login Page */
    Route::get('/login',[UserController::class,'showLoginPage'])->name('UserController.showLoginPage');

    /** Route Call Register Page */
    Route::get('/register',[UserController::class,'showRegisterPage'])->name('UserController.showRegisterPage');

    /** Route for Store User Information */
    Route::post('/store',[UserController::class,'storeUserInformation'])->name('UserController.storeUserInformation');

    /** Route for User Logout */
    Route::get('/logout',[UserController::class,'logOut'])->name('UserController.logOut');

    /** Route for Sign In User (Welcome Page) */
    Route::post('/login',[UserController::class,'signIn'])->name("UserController.signIn");

    /** Route for validate User before buying insurance (During make transactionx ) */
    Route::post('/validate',[UserController::class,'validateUserBeforeBuying'])->name('UserController.validateUserBeforeBuying');
});

/** Group route for insurance buying */
Route::group(['prefix'=>'insurance'],function(){

    /** Route show the insurance type selection */
    Route::get('/select',[InsuranceFlowController::class,'showInsuranceTypeSelection'])->name('InsuranceFlowController.showInsuranceTypeSelection');

    /** Route show the car insured select menu page */
    Route::get('/car',[InsuranceFlowController::class,'showCarInsuranceSelectionMenu'])->name('InsuranceFlowController.showCarInsuranceSelectionMenu');

    /** Route searching package of vehicle insurance */
    Route::get('/search',[InsuranceFlowController::class,'vehicleSearchForInsurancePackage'])->name('InsuranceFlowController.vehicleSearchForInsurancePackage');

    /** Route for show Option Detail of Normal level */
    Route::get('/detail/{sale_id}',[InsuranceFlowController::class,'showNormalPackageDetail'])->name('InsuranceFlowController.showNormalPackageDetail');

    /** Route for show the compare view of Normal package */
    Route::get('/compare/option/{p1}/{p2}',[InsuranceFlowController::class,'normalPackageCompare'])->name('InsuranceFlowController.normalPackageCompare');

    /** Route for show buy now page with input menu */
    Route::get('/buy/{sale_id}',[InsuranceFlowController::class,'showBuyNowPage'])->name('InsuranceFlowController.showBuyNowPage');
});

/** JsonResponse Route Group */
Route::group(['prefix'=>'api/json'],function(){

    /** Route to response ThirdPartyOption */
    Route::get('/thirdpartyoption/{level_id}',[JSONServiceController::class,'jsonThridPartyOption']);

    /** Route to response Vehicle Detail By Vehicle Type */
    Route::get('/vehicledetail/{v_id}',[JSONServiceController::class,'jsonVehicleDetail']);

    /** Route to response District detail By Province */
    Route::get('/district/{province_id}',[JSONServiceController::class,'jsonDistrict']);

});

/** Route Group for customer who already the member or Route which require to SignIn First */
Route::group(['prefix'=>'insurance','middleware'=>'customerAuthentication'],function(){
    /** Route store customer input information for Normal */
    Route::post('/customer/input/store',[InsuranceFlowController::class,'storeInputFromCustomer'])->name('InsuranceFlowController.storeInputFromCustomer');

    /** Route update customer input information for Normal */
    Route::post('/customer/input/update',[InsuranceFlowController::class,'updateInputData'])->name('InsuranceFlowController.updateInputData');

    /** Route to show agreement information for Normal after customer input */
    Route::get('/customer/agreement',[InsuranceFlowController::class,'showAgreementPage'])->name('InsuranceFlowController.showAgreementPage');

    /** Route to show user insurance list that being to customer */
    Route::get('/customer/order',[UserController::class,'userListInsurance'])->name('UserController.userListInsurance');

    /** Route to redirect to agreement page */
    Route::get('/redirect_to_agreement/{id}',[InsuranceFlowController::class,'redirectToAgreement'])->name('InsuranceFlowController.redirectToAgreement');

    /** Route to show available PaymentProvider list */
    Route::get('/customer/payment_provider',[InsuranceFlowController::class,'showPaymentProviderPageSelection'])->name('InsuranceFlowController.showPaymentProviderPageSelection');

    /** Route to show payment submit */
    Route::get('/customer/payment/{provider_id}',[InsuranceFlowController::class,'showFormSubmitPayment'])->name('InsuranceFlowController.showFormSubmitPayment');

    /** Route update the payment detail */
    Route::post('/customer/confirm/payment',[InsuranceFlowController::class,'updatePaymentDetail'])->name('InsuranceFlowController.updatePaymentDetail');

    /** Route to show complete the payment */
    Route::get('/customer/completed',[InsuranceFlowController::class,'showComplete'])->name('InsuranceFlowController.showComplete');

    /** Route to delete the input detail by customer */
    Route::get('/customer/delete/{id}',[InsuranceFlowController::class,'deleteTheInput'])->name('InsuranceFlowController.deleteTheInput');

    /** Route to show the insurance detail page */
    Route::get('/customer/insurance_detail/{id}',[InsuranceFlowController::class,'showInsuranceDetailByCustomer'])->name('InsuranceFlowController.showInsuranceDetailByCustomer');
});


/** Route Group For Admin User */

Route::group(['prefix'=>'admin','middleware'=>['adminAuthentication']],function(){
    /** Route to show admin dashboard */
    Route::get('/welcome',[AdminController::class,'showAdminDashBoard'])->name('AdminController.showAdminDashBoard');

    /** Route to allow admin to view detail of insurance customer selected */
    Route::get('/insurance/view/{id}',[AdminController::class,'showCustomerInput'])->name('AdminController.showCustomerInput');

    /** Route to show all insurance customer selected */
    Route::get('/insurance/views',[AdminController::class,'showAllCustomerInput'])->name('AdminController.showAllCustomerInput');

    /** Route to delete the input detail by admin */
     Route::get('/insurance/delete/{id}',[AdminController::class,'deleteTheInput'])->name('AdminController.deleteTheInput');

     /** Route to allow admin to approve, delete, edit the input data from custmer (Verify the data) */
     Route::get('/insurance/verify/{id}',[AdminController::class,'showCustomerPaymentItem'])->name('AdminController.showCustomerPaymentItem');

     /** Route to approve the insurance from customer */
     Route::post('insurance/approve/{id}',[AdminController::class,'approveInsurance'])->name('AdminController.approveInsurance');

     /** Route to update the insurance from customer by admin */
     Route::post('insurance/update',[AdminController::class,'updateCustomerInsuranceInformation'])->name('AdminController.updateCustomerInsuranceInformation');

     /** Route to show the all payment item */
     Route::get('insurance/view_all_payment',[AdminController::class,'showAllPaymentItem'])->name('AdminController.showAllPaymentItem');

     /** Route to show all the contracts items */
     Route::get('insurance/contracts',[AdminController::class,'showAllApprovedItem'])->name('AdminController.showAllApprovedItem');

     /** Route to show insurance in contract item */
     Route::get('insurance/contract/{id}',[AdminController::class,'showInsuranceInContract'])->name('AdminController.showInsuranceInContract');

     /** Route to show insurance has been out of contract */
     Route::get('/insurance/outOfContract/{id}',[AdminController::class,'viewOutOfContract'])->name('AdminController.viewOutOfContract');

     /** Route to show insurance has been out of contracts as list */
     Route::get('/insurance/outOfContracts',[AdminController::class,'showAllOutOfContract'])->name('AdminController.showAllOutOfContract');
});
