<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\CategoryProductTagController;
use App\Http\Controllers\CategoryProductTypeController;
use App\Http\Controllers\CategoryRoleController;
use App\Http\Controllers\PriceRangeController;
use App\Http\Controllers\ProducerController;
use App\Http\Controllers\CategoryProductBrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTagController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UiRcmController;
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

Route::get('/ui/rcm/menu_product', [UiRcmController::class, 'menuProduct']);

Route::get('/ui/rcm/menu_detail/{product_id}', [UiRcmController::class, 'menuDetail']);

Route::get('/product_brand/product_id/{product_id}', [CategoryProductBrandController::class, 'indexByProductId']);

Route::get('/product_brand/product_name/{product_name}', [CategoryProductBrandController::class, 'indexByProductName']);

Route::get('/price_range/{product_id}', [PriceRangeController::class, 'index']);

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

    Route::get('/producer', [ProducerController::class, 'index']);

    Route::post('/producer', [ProducerController::class, 'store'])
        ->middleware('role:Admin');

    Route::patch('/producer/{id}', [ProducerController::class, 'update'])
        ->middleware('role:Admin');

    Route::delete('producer/{id}', [ProducerController::class, 'delete'])
        ->middleware('role:Admin');

    Route::post('/product_brand', [CategoryProductBrandController::class, 'store'])
        ->middleware('role:Admin');

    Route::patch('/product_brand/{id}', [CategoryProductBrandController::class, 'update'])
        ->middleware('role:Admin');

    Route::delete('/product_brand/{id}', [CategoryProductBrandController::class, 'delete'])
        ->middleware('role:Admin');

    Route::get('/product', [ProductController::class, 'index']);

    Route::post('/product', [ProductController::class, 'store'])
        ->middleware('role:Admin');
    
    Route::patch('/product/{id}', [ProductController::class, 'update'])
        ->middleware('role:Admin');

    Route::delete('/product/{id}', [ProductController::class, 'destroy'])
        ->middleware('role:Admin');

    Route::get('/category_product_type', [CategoryProductTypeController::class, 'index']);

    Route::post('/category_product_type', [CategoryProductTypeController::class, 'store'])
        ->middleware('role:Admin');

    Route::patch('/category_product_type/{id}', [CategoryProductTypeController::class, 'update'])
        ->middleware('role:Admin');

    Route::delete('/category_product_type/{id}', [CategoryProductTypeController::class, 'delete'])
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
