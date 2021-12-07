@extends('admin_layout')
@section('admin_content')
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật danh mục sản phẩm
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
                        @foreach ($edit_category_product as $key=>$edit_value)

                        <form role="form" action="{{URL::to('/update-category-product/'.$edit_value->id_category_product)}}" method="POST">
                            {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" name="name_category_product" value="{{$edit_value->name_category_product}}" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea style="resize: none " rows="5" class="form-control" name="desc_category_product"  id="exampleInputPassword1">{{$edit_value->desc_category_product}}</textarea>
                        </div>
                        <button type="submit" name="add_category_product" class="btn btn-info">Cập nhật danh mục</button>
                    </form>
                    @endforeach
                    </div>

                </div>
            </section>

    </div>
@endsection
