<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
session_start();

class ProductController extends Controller
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
    public function add_product(){
        $this->AuthLogin();
        $cate_product=DB::table('tbl_category_product')->orderby('id_category_product','desc')->get();
        $brand=DB::table('tbl_brand')->orderby('id_brand','desc')->get();

        return view('admin.add_product')->with('cate_product', $cate_product)->with('brand', $brand);
    }
    public function all_product(){
        $this->AuthLogin();
        $all_product=DB::table('tbl_product')
        -> join('tbl_category_product','tbl_category_product.id_category_product','=','tbl_product.id_category_product')
        -> join('tbl_brand','tbl_brand.id_brand','=','tbl_product.id_brand')->orderby('tbl_category_product.id_category_product','desc')->get();
        $manager_product= view('admin.all_product')->with('all_product', $all_product);
        return view('admin_layout')->with('all_product', $manager_product);
    }
    public function save_product(Request $request){
        $this->AuthLogin();
        $data=array();
        $data['name_product']= $request ->name_product;
        $data['desc_product']= $request ->desc_product;
        $data['content_product']= $request ->content_product;
        $data['price_product']= $request ->price_product;
        $data['size_product']= $request ->size_product;
        $data['color_product']= $request ->color_product;
        $data['id_category_product']= $request ->cate_product;
        $data['id_brand']= $request ->brand;
        $data['status_product']= $request ->status_product;

        $get_image= $request-> file('image_product');
        if($get_image){
            $get_name_image= $get_image-> getClientOriginalName();
            $name_image=current(explode('.', $get_name_image));
            $new_image=  $name_image.rand(0,99).'.'.$get_image-> getClientOriginalExtension();
            $get_image->move('public/uploads/product', $new_image);
            $data['image_product']= $new_image;
            DB::table('tbl_product')->insert($data);
            Session::put('message','thêm sản phẩm thành công');
            return Redirect::to('/all-product');
        }
        $data['image_product']= '';
        DB::table('tbl_product')->insert($data);
        Session::put('message','thêm sản phẩm thành công');
        return Redirect::to('/add-product');
    }
    public function active_product($id_product){
        $this->AuthLogin();
        DB::table('tbl_product')->where('id_product',$id_product)->update(['status_product'=>0]);
        Session::put('message','Kích hoạt ẩn thương hiệu sản phẩm thành công');
        return Redirect::to('/all-product');
    }
    public function unactive_product($id_product){
        $this->AuthLogin();
        DB::table('tbl_product')->where('id_product',$id_product)->update(['status_product'=>1]);
        Session::put('message','Kích hoạt thương hiệu sản phẩm thành công');
        return Redirect::to('/all-product');
    }
    public function edit_product($id_product){
        $this->AuthLogin();
        $cate_product=DB::table('tbl_category_product')->orderby('id_category_product','desc')->get();
        $brand=DB::table('tbl_brand')->orderby('id_brand','desc')->get();

        $edit_product=DB::table('tbl_product')->where('id_product',$id_product)->get();
        $manager_product= view('admin.edit_product')->with('edit_product', $edit_product)->with('cate_product',$cate_product)
        ->with('brand', $brand);
        return view('admin_layout')->with('edit_product', $manager_product);
    }
    public function update_product(Request $request,$id_product){
        $this->AuthLogin();
        $data= array();
        $data['name_product']= $request ->name_product;
        $data['desc_product']= $request ->desc_product;
        $data['content_product']= $request ->content_product;
        $data['price_product']= $request ->price_product;
        $data['size_product']= $request ->size_product;
        $data['color_product']= $request ->color_product;
        $data['id_category_product']= $request ->cate_product;
        $data['id_brand']= $request ->brand;
        $data['status_product']= $request ->status_product;

        $get_image=$request->file('image_product');

        if($get_image){
            $get_name_image= $get_image-> getClientOriginalName();
            $name_image=current(explode('.', $get_name_image));
            $new_image=  $name_image.rand(0,99).'.'.$get_image-> getClientOriginalExtension();
            $get_image->move('public/uploads/product', $new_image);
            $data['image_product']= $new_image;
            DB::table('tbl_product')->where('id_product', $id_product)->update($data);
            Session::put('message','cập sản phẩm thành công');
            return Redirect::to('/all-product');
        }

        DB::table('tbl_product')->where('id_product', $id_product)->update($data);
        Session::put('message','cập sản phẩm thành công');
        return Redirect::to('/all-product');
    }
    public function delete_product($id_product){
        $this->AuthLogin();
        DB::table('tbl_product')->where('id_product',$id_product)->delete();
        Session::put('message',' Xóa thương hiệu sản phẩm thành công');
        return Redirect::to('/all-product');
    }
    // End admin page

    public function details_product($id_product){
        $cate_product=DB::table('tbl_category_product')->where('status_category_product','1')->orderby('id_category_product','desc')->get();
        $brand=DB::table('tbl_brand')->where('status_brand','1')->orderby('id_brand','desc')->get();
        $details_product=DB::table('tbl_product')
        -> join('tbl_category_product','tbl_category_product.id_category_product','=','tbl_product.id_category_product')
        -> join('tbl_brand','tbl_brand.id_brand','=','tbl_product.id_brand')
        ->where('tbl_product.id_product', $id_product)->get();

        foreach($details_product as $key =>$value){
            $id_category_product = $value->id_category_product;
        }

        $related_product=DB::table('tbl_product')
        -> join('tbl_category_product','tbl_category_product.id_category_product','=','tbl_product.id_category_product')
        -> join('tbl_brand','tbl_brand.id_brand','=','tbl_product.id_brand')
        ->where('tbl_category_product.id_category_product', $id_category_product)->whereNotIn('tbl_product.id_product',[$id_product])->get();

        return view('pages.sanpham.show_details_product')->with('category_product', $cate_product)->with('brand', $brand)
        ->with('detail_product', $details_product)->with('relate', $related_product);
    }



}
