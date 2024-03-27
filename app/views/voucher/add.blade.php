@extends('layout.main')
@section('main-content')
    <section class="container-fluid mt-3ct">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="text-center">Thêm voucher</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('action-add-voucher') }}" method="post" enctype="multipart/form-data" class="container mt-5" id='form_add_product'>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên khuyến mại</label>
                                <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @if(isset($_SESSION['errors']) && isset($_GET['msg']))
                                    <div style="color: red">{{$_SESSION['errors']['name']}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Giá trị giảm giá</label>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control" name="value" max="99" min="1" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                    </div>
                                    <span id="emailHelp" class="form-text"></span>
                                </div>
                                @if(isset($_SESSION['errors']) && isset($_GET['msg']))
                                    <div style="color: red">{{$_SESSION['errors']['value']}}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Số tiền tối thiểu</label>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control" name="minimum_amount" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <div class="input-group-append">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                    <span id="emailHelp" class="form-text"></span>
                                </div>
                                @if(isset($_SESSION['errors']) && isset($_GET['msg']))
                                    <div style="color: red">{{$_SESSION['errors']['minimum_amount']}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Số lượng</label>
                                <input type="number" class="form-control" name="quantity" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @if(isset($_SESSION['errors']) && isset($_GET['msg']))
                                    <div style="color: red">{{$_SESSION['errors']['quantity']}}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Ngày bắt đầu giảm giá</label>
                                <input type="datetime-local" class="form-control" name="startTime" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @if(isset($_SESSION['errors']) && isset($_GET['msg']))
                                    <div style="color: red">{{$_SESSION['errors']['startTime']}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Ngày kết thúc giảm giá</label>
                                <input type="datetime-local" class="form-control" name="endTime" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @if(isset($_SESSION['errors']) && isset($_GET['msg']))
                                    <div style="color: red">{{$_SESSION['errors']['endTime']}}</div>
                                @endif
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="forever">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Không bao giờ kết thúc
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Code discount</label>
                                <input type="text" class="form-control" name="discount_code" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @if(isset($_SESSION['errors']) && isset($_GET['msg']))
                                    <div style="color: red">{{$_SESSION['errors']['discount_code']}}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if(isset($_SESSION['success']) && isset($_GET['msg']))
                        <div class="mt-3 " style="color: green">{{$_SESSION['success']}}</div>
                    @endif
                    <div class="btn">
                        <button type="submit" class="btn btn-success">Thêm</button>
                        <a href="{{ route('voucher') }}"><button type="button" class="btn btn-success">Quay lại</button></a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection