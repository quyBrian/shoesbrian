@extends('admin_layout')
@section('admin_content')
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật danh mục thương hiệu 
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
                        @foreach ($edit_brand as $key=>$brand)

                        <form role="form" action="{{URL::to('/update-brand/'.$brand->id_brand)}}" method="POST">
                            {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" name="name_brand" value="{{$brand->name_brand}}" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea style="resize: none " rows="5" class="form-control" name="desc_brand"  id="exampleInputPassword1">{{$brand->desc_brand}}</textarea>
                        </div>
                        <button type="submit" name="add_brand" class="btn btn-info">Cập nhật thương hiệu</button>
                    </form>
                    @endforeach
                    </div>

                </div>
            </section>

    </div>
@endsection
