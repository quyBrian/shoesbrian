@extends('admin_layout')
@section('admin_content')
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                Thêm sản phẩm
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
                        <form role="form" action="{{URL::to('/save-product')}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text" name="name_product" class="form-control" id="exampleInputEmail1" placeholder="Tên sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                            <input type="file" name="image_product" class="form-control" id="exampleInputEmail1" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá sản phẩm</label>
                            <input type="text" name="price_product" class="form-control" id="exampleInputEmail1" placeholder="Tên sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Size sản phẩm</label>
                            <input type="text" name="size_product" class="form-control" id="exampleInputEmail1" placeholder="Tên sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Màu sản phẩm</label>
                            <input type="text" name="color_product" class="form-control" id="exampleInputEmail1" placeholder="Tên sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                            <textarea style="resize: none " rows="5" class="form-control" name="desc_product" id="exampleInputPassword1" placeholder="Mô tả sản phẩm "></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                            <textarea style="resize: none " rows="5" class="form-control" name="content_product" id="exampleInputPassword1" placeholder="Nội dung sản phẩm "></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                            <select name="cate_product" class="form-control input-sm m-bot15">
                                @foreach($cate_product as $key=> $cate)
                                <option value="{{$cate->id_category_product}}">{{$cate->name_category_product}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Thương hiệu</label>
                            <select name="brand" class="form-control input-sm m-bot15">
                                @foreach ($brand as $key=> $bra)
                                <option value="{{$bra->id_brand}}">{{$bra->name_brand}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                            <select name="status_product" class="form-control input-sm m-bot15">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiển thị</option>
                            </select>
                        </div>

                        <button type="submit" name="add_product" class="btn btn-info">Thêm thương hiệu</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
@endsection
