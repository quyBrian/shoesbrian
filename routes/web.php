<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryProduct;
use App\Http\Controllers\BrandProduct;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
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
//front- end
Route::get('/',[HomeController::class,'index']);
Route::get('/trang_chu', [HomeController::class,'index']);
//trang-chu ->danh-muc-san-pham
Route::get('/danh-muc-san-pham/{id_category_product}', [CategoryProduct::class,'show_category_home']);
Route::get('/thuong-hieu/{id_brand}', [BrandProduct::class,'show_brand_home']);
Route::get('/chi-tiet-san-pham/{id_product}', [ProductController::class,'details_product']);



//back- end
Route::get('/admin', [AdminController::class,'index']);
Route::get('/dashboard', [AdminController::class,'show_dashboard']);
Route::get('/logout', [AdminController::class,'logout']);
Route::post('/admin-dashboard', [AdminController::class,'dashboard']);
//category-product
Route::get('/add-category-product', [CategoryProduct::class,'add_category_product']);
Route::get('/edit-category-product/{id_category_product}', [CategoryProduct::class,'edit_category_product']);
Route::get('/delete-category-product/{id_category_product}', [CategoryProduct::class,'delete_category_product']);
Route::get('/all-category-product', [CategoryProduct::class,'all_category_product']);
Route::get('/unactive-category-product/{id_category_product}', [CategoryProduct::class,'unactive_category_product']);
Route::get('/active-category-product/{id_category_product}', [CategoryProduct::class,'active_category_product']);
Route::post('/save-category-product', [CategoryProduct::class,'save_category_product']);
Route::post('/update-category-product/{id_category_product}', [CategoryProduct::class,'update_category_product']);
//brand_product
Route::get('/add-brand', [BrandProduct::class,'add_brand']);
Route::get('/edit-brand/{id_brand}', [BrandProduct::class,'edit_brand']);
Route::get('/delete-brand/{id_brand}', [BrandProduct::class,'delete_brand']);
Route::get('/all-brand', [BrandProduct::class,'all_brand']);
Route::get('/unactive-brand/{id_brand}', [BrandProduct::class,'unactive_brand']);
Route::get('/active-brand/{id_brand}', [BrandProduct::class,'active_brand']);
Route::post('/save-brand', [BrandProduct::class,'save_brand']);
Route::post('/update-brand/{id_brand}', [BrandProduct::class,'update_brand']);
//brand_product
Route::get('/add-product', [ProductController::class,'add_product']);
Route::get('/edit-product/{id_product}', [ProductController::class,'edit_product']);
Route::get('/delete-product/{id_product}', [ProductController::class,'delete_product']);
Route::get('/all-product', [ProductController::class,'all_product']);
Route::get('/unactive-product/{id_product}', [ProductController::class,'unactive_product']);
Route::get('/active-product/{id_product}', [ProductController::class,'active_product']);
Route::post('/save-product', [ProductController::class,'save_product']);
Route::post('/update-product/{id_product}', [ProductController::class,'update_product']);

//cart
Route::post('/save-cart', [CartController::class,'save_cart']);
Route::get('/show-cart', [CartController::class,'show_cart']);
Route::get('/delete-cart/{rowId}', [CartController::class,'delete_cart']);
Route::post('/update-cart-qty', [CartController::class,'update_cart_qty']);

//checkout
Route::get('/login-checkout', [CheckoutController::class,'login_checkout']);
Route::post('/add-customer', [CheckoutController::class,'add_customer']);
Route::get('/show-checkout', [CheckoutController::class,'show_checkout']);
Route::post('/save-checkcout-customer', [CheckoutController::class,'save-checkout-customer']);


