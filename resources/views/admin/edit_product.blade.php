@extends('admin_layout')
@section('admin_content')
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                Cập nhật sản phẩm
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
                        @foreach ($edit_product as $key=>$value)
                        <form role="form" action="{{URL::to('/update-product/'.$value->id_product)}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text" name="name_product" class="form-control" id="exampleInputEmail1" value="{{$value->name_product}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                            <input type="file" name="image_product" class="form-control" id="exampleInputEmail1" >
                            <img src="{{URL::to('public/uploads/product/'.$value->image_product)}}" width="80px" height="100px">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá sản phẩm</label>
                            <input type="text" name="price_product" class="form-control" id="exampleInputEmail1" value="{{$value->price_product}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Size sản phẩm</label>
                            <input type="text" name="size_product" class="form-control" id="exampleInputEmail1" value="{{$value->size_product}}" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Màu sản phẩm</label>
                            <input type="text" name="color_product" class="form-control" id="exampleInputEmail1" value="{{$value->color_product}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                            <textarea style="resize: none " rows="5" class="form-control" name="desc_product" id="exampleInputPassword1" >{{$value->desc_product}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                            <textarea style="resize: none " rows="5" class="form-control" name="content_product" id="exampleInputPassword1">{{$value->content_product}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Cập nhật sản phẩm</label>
                            <select name="cate_product" class="form-control input-sm m-bot15">
                                @foreach($cate_product as $key=> $cate)
                                    @if($cate->id_category_product==$value->id_category_product)
                                        <option selected value="{{$cate->id_category_product}}">{{$cate->name_category_product}}</option>
                                    @else
                                        <option value="{{$cate->id_category_product}}">{{$cate->name_category_product}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Thương hiệu</label>
                            <select name="brand" class="form-control input-sm m-bot15">
                                @foreach ($brand as $key=> $bra)
                                    @if($bra->id_brand==$value->id_brand)
                                        <option selected value="{{$bra->id_brand}}">{{$bra->name_brand}}</option>
                                    @else
                                        <option value="{{$bra->id_brand}}">{{$bra->name_brand}}</option>
                                    @endif
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                            <select name="status_product" class="form-control input-sm m-bot15">
                                @if($value->status_product==0)
                                <option selected value="0">Ẩn</option>
                                <option value="1">Hiển thị</option>
                                @else
                                <option value="0">Ẩn</option>
                                <option selected value="1">Hiển thị</option>
                                @endif
                            </select>
                        </div>
                        <button type="submit" name="add_product" class="btn btn-info">Cập nhật sản phẩm</button>
                    </form>

                    @endforeach
                    </div>

                </div>
            </section>

    </div>
@endsection
