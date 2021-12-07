<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
session_start();

class CategoryProduct extends Controller
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
    public function add_category_product(){
        $this->AuthLogin();
        return view('admin.add_category_product');
    }
    public function all_category_product(){
        $this->AuthLogin();
        $all_category_product=DB::table('tbl_category_product')->get();
        $manager_category_product= view('admin.all_category_product')->with('all_category_product', $all_category_product);
        return view('admin_layout')->with('all_category_product', $manager_category_product);
    }
    public function save_category_product(Request $request){
        $this->AuthLogin();
        $data=array();
        $data['name_category_product']= $request ->name_category_product;
        $data['desc_category_product']= $request ->desc_category_product;
        $data['status_category_product']= $request ->status_category_product;

        DB::table('tbl_category_product')->insert($data);
        Session::put('message','thêm danh mục sản phẩm thành công');
        return Redirect::to('/add-category-product');
    }
    public function active_category_product($id_category_product){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('id_category_product',$id_category_product)->update(['status_category_product'=>0]);
        Session::put('message','Không kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('/all-category-product');
    }
    public function unactive_category_product($id_category_product){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('id_category_product',$id_category_product)->update(['status_category_product'=>1]);
        Session::put('message','Kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('/all-category-product');
    }
    public function edit_category_product($id_category_product){
        $this->AuthLogin();
        $edit_category_product=DB::table('tbl_category_product')->where('id_category_product',$id_category_product)->get();
        $manager_category_product= view('admin.edit_category_product')->with('edit_category_product', $edit_category_product);
        return view('admin_layout')->with('edit_category_product', $manager_category_product);
    }
    public function update_category_product(Request $request,$id_category_product){
        $this->AuthLogin();
        $data= array();
        $data['name_category_product']= $request ->name_category_product;
        $data['desc_category_product']= $request ->desc_category_product;
        DB::table('tbl_category_product')->where('id_category_product',$id_category_product)->update($data);
        Session::put('message','Cập nhật danh mục sản phẩm thành công');
        return Redirect::to('/all-category-product');
    }
    public function delete_category_product($id_category_product){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('id_category_product',$id_category_product)->delete();
        Session::put('message',' Xóa danh mục sản phẩm thành công');
        return Redirect::to('/all-category-product');
    }
    //End function Admin Page

    //Home
    public function show_category_home($id_category_product){
        $cate_product=DB::table('tbl_category_product')->where('status_category_product','1')->orderby('id_category_product','desc')->get();
        $brand=DB::table('tbl_brand')->where('status_brand','1')->orderby('id_brand','desc')->get();
        $category_by_id= DB::table('tbl_product')->join('tbl_category_product','tbl_product.id_category_product','=','tbl_category_product.id_category_product')
        ->where('tbl_product.id_category_product',$id_category_product)->get();
        $category_name= DB::table('tbl_category_product')->where('id_category_product',$id_category_product)->limit(1)->get();
        return view('pages.category.show_category')->with('category_product', $cate_product)->with('brand', $brand)
        ->with('category_by_id',$category_by_id)->with('category_name',$category_name);
    }

}
