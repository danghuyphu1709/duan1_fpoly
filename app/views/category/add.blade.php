@extends('layout.main')
@section('main-content')
    <section class="container-fluid mt-3ct">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="text-center">Thêm danh mục </h4>
            </div>
            <div class="card-body">
                <form action="{{ route('action-add-category') }}" method="post" enctype="multipart/form-data" id="form-1" class="">
                    <div class="row mb-4 mt-5">
                        <div class="col-xl-2">
                        </div>
                        <div class="col-xl-8">
                            <label for="exampleInputPassword1">Tên danh mục</label>
                            <input id="fullname" type="text" name="name"  class="form-control">
                            @if(isset($_SESSION['errors']) && isset($_GET['msg']))
                                <div style="color: red">{{$_SESSION['errors']['name']}}</div>
                            @endif
                            @if(isset($_SESSION['success']) && isset($_GET['msg']))
                                <div class="mt-3 " style="color: green">{{$_SESSION['success']}}</div>
                            @endif
                            <div>
                                <button type="submit" class="btn btn-primary" style="margin-top: 50px;">Gửi</button>
                                <a href="{{ route('category') }}"><button type="button" class="btn btn-primary" style="margin-top: 50px;">Quay lại</button></a>
                            </div>
                        </div>
                        <div class="col-xl-2">

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection