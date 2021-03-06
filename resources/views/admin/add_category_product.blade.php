@extends('admin_layout')
@section('admin_content')
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm danh mục sản phẩm
                </header>
                <div class="panel-body">
                    <?php
                        $message= Session::get('message');
                        if($message){
                            echo'<span class="text-alert">'.$message.'</span>' ;
                            Session::get('message', null);
                        }
                    ?>
                    <div class="position-center">
                        <form role="form" action="{{URL::to('/save-category-product')}}" method="POST">
                            {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" name="name_category_product" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea style="resize: none " rows="5" class="form-control" name="desc_category_product" id="exampleInputPassword1" placeholder="Mô tả sanh mục "></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                            <select name="status_category_product" class="form-control input-sm m-bot15">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiển thị</option>
                            </select>
                        </div>

                        <button type="submit" name="add_category_product" class="btn btn-info">Thêm danh mục</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
@endsection
