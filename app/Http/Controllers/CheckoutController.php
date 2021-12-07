<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
session_start();

class CheckoutController extends Controller
{
    public function login_checkout(){
        $cate_product=DB::table('tbl_category_product')->where('status_category_product','1')->orderby('id_category_product','desc')->get();
        $brand=DB::table('tbl_brand')->where('status_brand','1')->orderby('id_brand','desc')->get();
        return view('pages.checkout.login_checkout')->with('category_product', $cate_product)->with('brand', $brand);
    }
    public function add_customer(Request $request){
        $data= array();
        $data['name_customer']= $request->name_customer;
        $data['email_customer']= $request->email_customer;
        $data['password_customer']= $request->password_customer;
        $data['phone_customer']= $request->phone_customer;

        $id_customer =DB::table('tbl_customers')->insertGetId($data);

        Session::put('id_customer', $id_customer);
        Session::put('name_customer', $request->name_customer);
        return Redirect('/show_checkout');
    }
    public function show_checkout(){
        $cate_product=DB::table('tbl_category_product')->where('status_category_product','1')->orderby('id_category_product','desc')->get();
        $brand=DB::table('tbl_brand')->where('status_brand','1')->orderby('id_brand','desc')->get();
        return view('pages.checkout.show_checkout')->with('category_product', $cate_product)->with('brand', $brand);
    }
    public function save_checkout_customer(){
        // $data= array();
        // $data['name_customer']= $request->name_customer;
        // $data['email_customer']= $request->email_customer;
        // $data['password_customer']= $request->password_customer;
        // $data['phone_customer']= $request->phone_customer;

        // $id_customer =DB::table('tbl_customers')->insertGetId($data);

        // Session::put('id_customer', $id_customer);
        // Session::put('name_customer', $request->name_customer);
        // return Redirect('/show_checkout');
    }
}
