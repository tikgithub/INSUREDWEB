<?php

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

    /** Route to show agreement information for Normal after customer input */
    Route::get('/customer/agreement',[InsuranceFlowController::class,'showAgreementPage'])->name('InsuranceFlowController.showAgreementPage');
});
