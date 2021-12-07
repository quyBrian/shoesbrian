<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
session_start();


class CartController extends Controller
{
    public function save_cart(Request $request){

        $Idproduct= $request->id_product_hidden;
        $quantity =$request->qty;
        $product_info=DB::table('tbl_product')->where('id_product',$Idproduct)->first();

        //Cart::add('293ad', 'Product 1', 1, 9.99, 550);
        //Cart::destroy();
        $data['id']= $product_info->id_product;
        $data['qty']=$quantity;
        $data['name']= $product_info->name_product;
        $data['price']= $product_info->price_product;
        $data['weight']= $product_info->price_product;
        $data['options']['image']= $product_info->image_product;
        $data['size']= $product_info->size_product;
        $data['color']= $product_info->color_product;

        Cart::add($data);
        Cart::setGlobalTax(10);
        return Redirect::to('/show-cart');
    }
    public function show_cart(){
        $cate_product=DB::table('tbl_category_product')->where('status_category_product','1')->orderby('id_category_product','desc')->get();
        $brand=DB::table('tbl_brand')->where('status_brand','1')->orderby('id_brand','desc')->get();
        return view('pages.cart.show_cart')->with('category_product', $cate_product)->with('brand', $brand);
    }
    public function delete_cart($rowId){
        Cart::update($rowId, 0);
        return Redirect::to('/show-cart');
    }
    public function update_cart_qty(Request $request){
        $rowId=$request->rowId_cart;
        $qty= $request->quantity_cart;
        Cart::update($rowId, $qty);
        return Redirect::to('/show-cart');

    }

}
