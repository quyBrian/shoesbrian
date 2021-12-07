<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class AdminController extends Controller
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
    public function index(){
        return view('admin_login');
    }
    public function show_dashboard(){
        $this->AuthLogin();
        return view('admin.dashboard');
    }
    public function dashboard(Request $request ){
        $email_admin=$request-> email_admin;
        $password_admin=MD5($request->password_admin);

        //$result= DB::select("SELECT * FROM tbl_admin WHERE email_admin= '$email_admin' AND password_admin= '$password_admin'",[1]);
        $result=DB::table('tbl_admin')->where('email_admin', $email_admin)->where('password_admin', $password_admin)->first();
        // lấy giới hạn 1 user
        // echo '<pre>';
        // print_r($result);
        // echo '<pre>';
        if($result){
            Session::put('name_admin', $result->name_admin);
            Session::put('id_admin', $result->id_admin);
            return Redirect('/dashboard');
        }
        else{

            Session::put('message', "Mật khẩu or Tài khoản không đúng vui lòng nhập lại");
            return Redirect('/admin');
        }
    }
    public function logout(){
        $this->AuthLogin();
        Session::put('name_admin',null);
        Session::put('id_admin',null);
        return Redirect('/admin');
    }
}
