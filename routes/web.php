<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Models\Permission;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('store', [StoreController::class,'index'])->name('store.index');
Route::get('cart', [CartController::class,'index'])->name('cart.index');
Route::post('store/add-to-cart', [CartController::class,'addToCart'])->name('cart.add');

//for paypal we need 3 links
Route::get('payWithPaypal', [PaypalController::class,'payWithPaypal'])->name('paypal.pay');
Route::get('paypalSuccess',[PaypalController::class,'paypalSuccess'])->name('paypal.success');
Route::get('paypalCancel',[PaypalController::class,'paypalCancel'])->name('paypal.cancel');


Route::get('create-role/{name}',[RoleController::class,'create'])->name('role.create');
Route::get('give-role-to-user/{user}/{role}',[RoleController::class,'give_role_to_user'])->name('role.give_role_to_user');


Route::get('create-permission/{name}',[PermissionController::class,'create'])->name('permission.create');
Route::get('give-permission-to-role/{role}/{permission}',[PermissionController::class,'give_permission_to_role'])->name('permission.give_permission_to_role');
Route::get('revoke-permission-from-role/{role}/{permission}',[PermissionController::class,'remove_permission_from_role'])->name('permission.revoke_permission_from_role');
Route::get('give-permission-to-user/{user}/{permission}',[PermissionController::class,'give_permission_to_user'])->name('permission.give_permission_to_user');
Route::get('get-user-permissions/{user}',[PermissionController::class,'get_user_permissions'])->name('permission.get_user_permissions');


Route::get('SendSms',[SmsController::class,'send'])->name('sms.send');