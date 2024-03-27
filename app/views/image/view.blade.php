@extends('layout.main')
@section('main-content')
    @include('layout-user.source')
    <section class="container-fluid mt-3ct">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="text-center"> Ảnh sản phẩm </h4>
                <div class="text-right">
                </div>
            </div>
            <div class="card-body">
                <section class="product-details spad">
                    <div class="container">
                        <div class="row">
                            <div class="product__details__pic__slider owl-carousel">
                                @foreach($data as $iteams)
                                    <div>
                                        <div class="" style="width: 200px; height: 200px">
                                            <img data-imgbigurl="" width="100%" height="100%"
                                                 src="{{ route('upload/').$iteams->source}}" alt="">
                                        </div>
                                        <div class="text-center mt-3" style="width: 200px; height: 200px">
                                            <a href="{{ route('deleted-image/').$iteams->id.'/'.$id}}"
                                               onclick="return confirm('Khóa danh mục này ?')">
                                                <button type="button" class="btn btn-outline-danger">
                                                    <i class="fa-solid fa-trash-can"
                                                       style="color: #ff0000; font-size:15px"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <form action="{{ route('action-add-image/').$id }}" method="post" class="mt-5"
                              enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label"><i class="fa fa-upload"
                                                                                      aria-hidden="true"></i></label>
                                <label for="exampleInputEmail1" class="form-label">Upload ảnh sản phẩn</label>
                                <input type="file" name="image[]" multiple>
                                @if(isset($_SESSION['errors']) && isset($_GET['msg']))
                                    <div style="color: red">{{$_SESSION['errors']['image']}}</div>
                                @endif
                            </div>
                            <div class="btn">
                                <button type="submit" class="btn btn-success">Thêm</button>
                                <a href="{{ route('product') }}">
                                    <button type="button" class="btn btn-success">Quay lại</button>
                                </a>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </section>
    @include('layout-user.source-js')
@endsection