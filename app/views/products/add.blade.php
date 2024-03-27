@extends('layout.main')
@section('main-content')
    <section class="container-fluid mt-3ct">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="text-center">Thêm sản phẩm</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('action-add-product') }}" method="post" enctype="multipart/form-data" class="container mt-5" id='form_add_product'>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên sản phẩm</label>
                                <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @if(isset($_SESSION['errors']) && isset($_GET['msg']))
                                    <div style="color: red">{{$_SESSION['errors']['name']}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-6 mt-3ct">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label"><i class="fa fa-upload" aria-hidden="true"></i></label>
                                <label for="exampleInputEmail1" class="form-label">Upload ảnh sản đại diện sản phẩn</label>
                                <input type="file" name="avataImage">
                                @if(isset($_SESSION['errors']) && isset($_GET['msg']))
                                    <div style="color: red">{{$_SESSION['errors']['image']}}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mt-7">
                            <select class="form-select" aria-label="Default select example" name="category">
                            @foreach($data2 as $iteams)
                                <option value="{{ $iteams->id }}">{{ $iteams->name }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 mt-5">
                        <label for="exampleFormControlTextarea1" class="form-label">Mô tả cho sản phẩm</label>
                        <textarea class="form-control" name="desc" id="exampleFormControlTextarea1" rows="3"></textarea>
                        @if(isset($_SESSION['errors']) && isset($_GET['msg']))
                            <div style="color: red">{{$_SESSION['errors']['desc']}}</div>
                        @endif
                    </div>
                    <div class="mt-5">
                        @if(isset($data))
                        @foreach($data as $iteams)
                        <div class="box-size row">
                            <div class="col-xl-2">
                                <input class="size form-check-input text-end" type="hidden" value="{{ $iteams->id }}" id="flexCheckDefault" name="size[]">
                                <label class="form-check-label" for="flexCheckDefault">{{ $iteams->name }}</label>
                            </div>

                            <div class="col-xl-4">
                                <label for="exampleInputEmail1" class="form-label">Giá sản phẩm</label>
                                <div class="input-group mb-3">
                                    <input type="number" min="1000" max="1000000000" class="price-input form-control" aria-label="Amount (to the nearest dollar)" name="price[]" data-required>
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
                                    <input type="number" class="quantity form-control" id="exampleInputEmail1" aria-describedby="emailHelp" min="1" max="9999" name="quantity[]" data-required>
                                    <span id="emailHelp" class="form-text"></span>
                                </div>
                            </div>
                            <div class="col-xl-2">
                                <div class="mt-3ct">
                                    <button type="button" class="btn-delete btn btn-outline-danger">Xóa</button>
                                </div>
                            </div>

                        </div>
                        @endforeach
                        @endif
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
                        <button type="submit" class="btn btn-success">Thêm</button>
                        <a href="{{ route('add-product') }}"><button type="button" class="btn btn-warning">Nhập lại</button></a>
                        <a href="{{ route('product') }}"><button type="button" class="btn btn-success">Quay lại</button></a>
                    </div>
                </form>
            </div>
        </div>
        <script src="{{BASE_URL.'source/customer/js/main.js'}}"></script>
    </section>
@endsection