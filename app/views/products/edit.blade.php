@extends('layout.main')
@section('main-content')
    <section class="container-fluid mt-3ct">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="text-center">Sửa sản phẩm</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('action-edit-product/').$product->id}}" method="post" enctype="multipart/form-data" class="container mt-5" id='form_add_product'>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên sản phẩm</label>
                                <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $product->name }}">
                                @if(isset($_SESSION['errors']) && isset($_GET['msg']))
                                    <div style="color: red">{{$_SESSION['errors']['name']}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-6 mt-3ct">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label"><i class="fa fa-upload" aria-hidden="true"></i></label>
                                <label for="exampleInputEmail1" class="form-label">Upload ảnh sản phẩm</label>
                                <input type="file" name="avataImage" >
                                <div class="ecommerce-gallery" data-mdb-zoom-effect="true" data-mdb-auto-height="true">
                                    <div class="row py-3 shadow-5">
                                            <div class="col-3 mt-1">
                                                <img class="w-50 h-50"
                                                        src="../upload/{{$product->avata}}";
                                                        data-mdb-img="{{route('upload/').$product->avata}}"
                                                        alt="Gallery image 1"
                                                />
                                                <input type="hidden" value="{{ $product->avata }}" name="avataImageOld">
                                            </div>
                                    </div>
                                </div>
                                @if(isset($_SESSION['errors']) && isset($_GET['msg']))
                                    <div style="color: red">{{$_SESSION['errors']['image']}}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mt-2">
                            <label for="exampleInputEmail1" class="form-label">Danh mục</label>
                            <select class="form-select" aria-label="Default select example" name="category">
                                @foreach($category as $iteams)
                                    <option value="{{ $iteams->id }}">{{ $iteams->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="exampleInputPassword1">Trạng thái</label>
                            <select class="form-select" aria-label="Default select example" name="deleted">
                                @if ($product->deleted == 0)
                                    <option value="0" selected>Đang Hoạt Động</option>
                                    <option value="1">Ngừng Hoạt Động</option>
                                @elseif ($product->deleted == 1)
                                    <option value="0" >Đang Hoạt Động</option>
                                    <option value="1" selected>Ngừng Hoạt Động</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 mt-5">
                        <label for="exampleFormControlTextarea1" class="form-label">Mô tả cho sản phẩm</label>
                        <textarea class="form-control" name="desc" id="exampleFormControlTextarea1" rows="3">{{ $product->description }}</textarea>
                        @if(isset($_SESSION['errors']) && isset($_GET['msg']))
                            <div style="color: red">{{$_SESSION['errors']['desc']}}</div>
                        @endif
                    </div>
                    <div class="mt-5">
                        @foreach($productDetail as $iteams)
                            <div class="box-size row">
                                    <input type="hidden" name="id[]" value="{{ $iteams->id }}">
                                <div class="col-xl-2">
                                    <input class="size form-check-input text-end" type="hidden" value="{{ $iteams->idsize }}" id="flexCheckDefault" name="size[]">
                                    <label class="form-check-label" for="flexCheckDefault">{{ $iteams->namesize }}</label>
                                </div>
                                <div class="col-xl-4">
                                    <label for="exampleInputEmail1" class="form-label">Giá sản phẩm</label>
                                    <div class="input-group mb-3">
                                        <input type="number" min="1000" max="1000000000" class="price-input form-control" aria-label="Amount (to the nearest dollar)" name="price[]" data-required value="{{ $iteams->price }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text">VNĐ</span>
                                            <span class="input-group-text">0.00</span>
                                        </div>
                                        <span id="emailHelp" class="form-text"></span>
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Số lượng sản phẩm</label>
                                        <input type="number" class="quantity form-control" id="exampleInputEmail1" aria-describedby="emailHelp" min="1" max="9999" name="quantity[]" data-required value="{{ $iteams->quantity }}">
                                        <span id="emailHelp" class="form-text"></span>
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="exampleInputPassword1">Trạng thái</label>
                                    <select class="form-select" aria-label="Default select example" name="status[]">
                                        @if ($iteams->status == 0)
                                            <option value="0" selected>Đang Hoạt Động</option>
                                            <option value="1">Ngừng Hoạt Động</option>
                                        @elseif ($iteams->status == 1)
                                            <option value="0" >Đang Hoạt Động</option>
                                            <option value="1" selected>Ngừng Hoạt Động</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        @endforeach
                        @if(isset($_SESSION['errors']) && isset($_GET['msg']))
                            <div style="color: red">{{$_SESSION['errors']['size']}}</div>
                        @endif
                        @if(isset($_SESSION['errors']) && isset($_GET['msg']))
                            <div style="color: red">{{$_SESSION['errors']['price']}}</div>
                        @endif
                        @if(isset($_SESSION['errors']) && isset($_GET['msg']))
                            <div style="color: red">{{$_SESSION['errors']['quantity']}}</div>
                        @endif
                    </div>
                    @if(isset($_SESSION['success']) && isset($_GET['msg']))
                        <div class="mt-3 " style="color: green">{{$_SESSION['success']}}</div>
                    @endif
                    <div class="btn">
                        <button type="submit" class="btn btn-success">Sửa</button>
                        <a href="{{ route('product') }}"><button type="button" class="btn btn-success">Quay lại</button></a>
                    </div>
                </form>
            </div>
        </div>
        <script src="{{BASE_URL.'source/customer/js/main.js'}}"></script>
    </section>
@endsection