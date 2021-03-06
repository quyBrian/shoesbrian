@extends('welcome')
@section('content')
<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2>Đăng nhập tài khoản</h2>
                    <form action="#">
                        <input type="text" name="email_account" placeholder="Tài khoản" />
                        <input type="password" name="password_account" placeholder="Password" />
                        <span>
                            <input type="checkbox" class="checkbox">
                            Ghi nhớ
                        </span>
                        <button type="submit" class="btn btn-default">Đăng nhập</button>
                    </form>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">Hoặc</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>Đăng ký!</h2>
                    <form action="{{URL::to('/add-customer')}}" method="POST">
                        {{ csrf_field() }}
                        <input type="text" name='name_customer' placeholder="Họ tên"/>
                        <input type="email" name='email_customer' placeholder="Email "/>
                        <input type="password" name='password_customer' placeholder="Mật khẩu"/>
                        <input type="text" name='phone_customer' placeholder="SĐT"/>
                        <button type="submit" name='dang_ky' class="btn btn-default">Đăng ký</button>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->

@endsection
