<?php

use App\Http\Controllers\AdsCampaignController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\CategoryProductTagController;
use App\Http\Controllers\CategoryRoleController;
use App\Http\Controllers\CategoryVnDistrictController;
use App\Http\Controllers\CategoryVnProvinceController;
use App\Http\Controllers\CategoryVnRegionsController;
use App\Http\Controllers\CategoryVnWardController;
use App\Http\Controllers\PriceRangeController;
use App\Http\Controllers\ProductBrandController;
use App\Http\Controllers\ProductColorController;
use App\Http\Controllers\ProductColorQtyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductEvaluateController;
use App\Http\Controllers\ProductTagController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\ProductVersionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UiController;
use App\Models\CategoryCurrency;
use App\Models\CategoryNation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest')
    ->name('register');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest')
    ->name('login');

Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
    ->middleware(['authLsanctum', 'signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');
    
Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.update');

Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
    ->middleware(['auth:sanctum', 'signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->middleware(['auth:sanctum', 'throttle:6,1'])
    ->name('verification.send');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// Ui
Route::get('/ui/rcm/category_menu/{product_id}', [UiController::class, 'rcm_category_menu']);

Route::get('/ui/rcm/product_list/{product_type_id}', [UiController::class, 'rcm_product_list']);

// Product
Route::get('/product', [ProductController::class, 'index']);

Route::get('/product/no_paginate', [ProductController::class, 'indexNoPaginate']);

Route::get('/product/product_id/{id}', [ProductController::class, 'productById']);

Route::get('/product/product_type_id/{product_type_id}', [ProductController::class, 'productByProductTypeId']);

Route::get('/product_type', [ProductTypeController::class, 'index']);

Route::get('/product_brand/product_id/{product_id}', [ProductBrandController::class, 'indexByProductId']);

Route::get('/product_brand/product_name/{product_name}', [ProductBrandController::class, 'indexByProductName']);

Route::get('/price_range/{product_id}', [PriceRangeController::class, 'index']);

Route::get('/ads_campaign', [AdsCampaignController::class, 'index']);

// Product version
Route::get('/product_version', [ProductVersionController::class, 'index']);

// Product color
Route::get('/product_color', [ProductColorController::class, 'index']);

// Product color qty
Route::get('/product_color_qty', [ProductColorQtyController::class, 'index']);

Route::get('/product_color_qty/with_name', [ProductColorQtyController::class, 'indexWithColorName']);

// Product evaluate
Route::get('/product_evaluate', [ProductEvaluateController::class, 'index']);

Route::get('/product_evaluate/with_created_user', [ProductEvaluateController::class, 'indexWithCreatedUser']);

Route::post('/product_evaluate', [ProductEvaluateController::class, 'anonymousStore']);

// Category Vn Region
Route::get('/category_vn_region', [CategoryVnRegionsController::class, 'index']);

Route::get('/category_vn_region/select', [CategoryVnRegionsController::class, 'indexNoPaginate']);

// Cateogory Vn Province
Route::get('/category_vn_province', [CategoryVnProvinceController::class, 'index']);

Route::get('/category_vn_province/select', [CategoryVnProvinceController::class, 'indexNoPaginate']);

// Category Vn District
Route::get('/category_vn_district', [CategoryVnDistrictController::class, 'index']);

Route::get('/category_vn_district/select', [CategoryVnDistrictController::class, 'indexNoPaginate']);

// Store
Route::get('/store/select', [StoreController::class, 'indexNoPaginate']);

// Category Vn Ward
Route::get('/category_vn_ward', [CategoryVnWardController::class, 'index']);

Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::get('/category_role', [CategoryRoleController::class, 'index']);

    Route::post('/category_role', [CategoryRoleController::class, 'store'])
        ->middleware('role:SupperUser');

    Route::patch('/category_role/{id}', [CategoryRoleController::class, 'update'])
        ->middleware('role:SupperUser');

    Route::delete('/category_role/{id}', [CategoryRoleController::class, 'destroy'])
        ->middleware('role:SupperUser');

    Route::get('/role/{user_id}', [RoleController::class, 'index']);

    Route::patch('/role/{id}', [RoleController::class, 'update'])
        ->middleware('role:Admin');

    Route::post('/role', [RoleController::class, 'store'])
        ->middleware('role:Admin');

    Route::delete('/role/{id}', [RoleController::class, 'destroy'])
        ->middleware('role:Admin');

    Route::get('/category_nation', [CategoryNation::class, 'index']);

    Route::post('/category_nation', [CategoryNation::class, 'store'])
        ->middleware('role:SupperUser');
    
    Route::patch('/category_nation/{id}', [CategoryNation::class, 'update'])
        ->middleware('role:SupperUser');

    Route::delete('/category_nation/{id}', [CategoryNation::class, 'destroy'])
        ->middleware('role:SupperUser');

    Route::get('/category_currency', [CategoryCurrency::class, 'index']);

    Route::post('/category_currency', [CategoryCurrency::class, 'store'])
        ->middleware('role:SupperUser');

    Route::patch('/category_currency/{id}', [CategoryCurrency::class, 'update'])
        ->middleware('role:SupperUser');
    
    Route::delete('/category_currency/{id}', [CategoryCurrency::class, 'destroy'])
        ->middleware('role:SupperUser');

    Route::post('/product_brand', [ProductBrandController::class, 'store'])
        ->middleware('role:Admin');

    Route::patch('/product_brand/{id}', [ProductBrandController::class, 'update'])
        ->middleware('role:Admin');

    Route::delete('/product_brand/{id}', [ProductBrandController::class, 'delete'])
        ->middleware('role:Admin');

    Route::post('/product', [ProductController::class, 'store'])
        ->middleware('role:Admin');
    
    Route::patch('/product/{id}', [ProductController::class, 'update'])
        ->middleware('role:Admin');

    Route::delete('/product/{id}', [ProductController::class, 'destroy'])
        ->middleware('role:Admin');

    Route::get('/category_product_tag', [CategoryProductTagController::class, 'index']);

    Route::post('/category_product_tag', [CategoryProductTagController::class, 'store'])
        ->middleware('role:Admin');

    Route::patch('/category_product_tag/{id}', [CategoryProductTagController::class, 'update'])
        ->middleware('role:Admin');
    
    Route::delete('category_product_tag/{id}', [CategoryProductTagController::class, 'delete'])
        ->middleware('role:Admin');

    Route::get('/product_tag/{product_id}', [ProductTagController::class, 'index']);

    Route::post('/product_tag', [ProductTagController::class, 'store'])
        ->middleware('role:Admin');
    
    Route::patch('/product_tag/{id}', [ProductTagController::class, 'update'])
        ->middleware('role:Admin');

    Route::delete('/product_tag/{id}', [ProductTagController::class, 'delete'])
        ->middleware('auth:Admin');

    Route::post('/price_range', [PriceRangeController::class, 'store'])
        ->middleware('role:Admin');
    
    Route::patch('/price_range/{id}', [PriceRangeController::class, 'update'])
        ->middleware('role:Admin');

    Route::delete('price_range/{id}', [PriceRangeController::class, 'delete'])
        ->middleware('role:Admin');
});
