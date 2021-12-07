<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
session_start();

class BrandProduct extends Controller
{
    public function AuthLogin(){
        $id_admin= Session::get('id_admin');
        if($id_admin){
            return Redirect::to('dashboard');
        }
        else{
            return Redirect::to('admin')->send();

        }
    }
    public function add_brand(){
        $this->AuthLogin();
        return view('admin.add_brand');
    }
    public function all_brand(){
        $this->AuthLogin();
        $all_brand=DB::table('tbl_brand')->get();
        $manager_brand= view('admin.all_brand')->with('all_brand', $all_brand);
        return view('admin_layout')->with('all_brand', $manager_brand);
    }
    public function save_brand(Request $request){
        $this->AuthLogin();
        $data=array();
        $data['name_brand']= $request ->name_brand;
        $data['desc_brand']= $request ->desc_brand;
        $data['status_brand']= $request ->status_brand;

        DB::table('tbl_brand')->insert($data);
        Session::put('message','thêm thương hiệu sản phẩm thành công');
        return Redirect::to('/add-brand');
    }
    public function active_brand($id_brand){
        $this->AuthLogin();
        DB::table('tbl_brand')->where('id_brand',$id_brand)->update(['status_brand'=>0]);
        Session::put('message','Không kích hoạt thương hiệu sản phẩm thành công');
        return Redirect::to('/all-brand');
    }
    public function unactive_brand($id_brand){
        $this->AuthLogin();
        DB::table('tbl_brand')->where('id_brand',$id_brand)->update(['status_brand'=>1]);
        Session::put('message','Kích hoạt thương hiệu sản phẩm thành công');
        return Redirect::to('/all-brand');
    }
    public function edit_brand($id_brand){
        $this->AuthLogin();
        $edit_brand=DB::table('tbl_brand')->where('id_brand',$id_brand)->get();
        $manager_brand= view('admin.edit_brand')->with('edit_brand', $edit_brand);
        return view('admin_layout')->with('edit_brand', $manager_brand);
    }
    public function update_brand(Request $request,$id_brand){
        $this->AuthLogin();
        $data= array();
        $data['name_brand']= $request ->name_brand;
        $data['desc_brand']= $request ->desc_brand;
        DB::table('tbl_brand')->where('id_brand',$id_brand)->update($data);
        Session::put('message','Cập nhật thương hiệu sản phẩm thành công');
        return Redirect::to('/all-brand');
    }
    public function delete_brand($id_brand){
        $this->AuthLogin();
        DB::table('tbl_brand')->where('id_brand',$id_brand)->delete();
        Session::put('message',' Xóa thương hiệu sản phẩm thành công');
        return Redirect::to('/all-brand');
    }
    //End function Admin Page

    //Home
    public function show_brand_home($id_brand){
        $cate_product=DB::table('tbl_category_product')->where('status_category_product','1')->orderby('id_category_product','desc')->get();
        $brand=DB::table('tbl_brand')->where('status_brand','1')->orderby('id_brand','desc')->get();
        $brand_by_id= DB::table('tbl_product')->join('tbl_brand','tbl_product.id_brand','=','tbl_brand.id_brand')
        ->where('tbl_product.id_brand',$id_brand)->get();
        $brand_name= DB::table('tbl_brand')->where('id_brand',$id_brand)->limit(1)->get();
        return view('pages.brand.show_brand')->with('category_product', $cate_product)->with('brand', $brand)
        ->with('brand_by_id',$brand_by_id)->with('brand_name',$brand_name);
    }

}
