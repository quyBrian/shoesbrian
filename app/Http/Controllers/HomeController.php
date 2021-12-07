<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
session_start();

class HomeController extends Controller
{
    public function index(){
        $cate_product=DB::table('tbl_category_product')->where('status_category_product','1')->orderby('id_category_product','desc')->get();
        $brand=DB::table('tbl_brand')->where('status_brand','1')->orderby('id_brand','desc')->get();
        $new_product=DB::table('tbl_product')->where('status_product','1')->orderby('id_product','desc')->limit(3)->get();
        return view('pages.home')->with('category_product', $cate_product)->with('brand', $brand)->with('new_product',$new_product);
    }
}
