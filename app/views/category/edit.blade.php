@extends('layout.main')
@section('main-content')
<section class="container-fluid mt-3ct">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="text-center">Sửa danh mục </h4>
        </div>
        <div class="card-body">
            <form action="{{ route('action-edit-category').'/'.$data->id}}" method="post" enctype="multipart/form-data" id="form-1" class="mt-3ct">
                <div class="row mb-4">
                    <div class="col">
                        <label for="exampleInputPassword1">Tên danh mục </label>
                        <input id="fullname" type="text" name="name" class="form-control" value="{{ $data->name}}">
                    </div>
                    <div class="col">
                        <label for="exampleInputPassword1">Trạng thái</label>
                        <select class="form-select" aria-label="Default select example" name="deleted">
                            @if ($data->deleted == 0)
                                <option value="0" selected>Đang Hoạt Động</option>
                                <option value="1">Ngừng Hoạt Động</option>
                            @elseif ($data->deleted == 1)
                                <option value="0" >Đang Hoạt Động</option>
                                <option value="1" selected>Ngừng Hoạt Động</option>
                            @endif
                        </select>
                    </div>
                </div>
                @if(isset($_SESSION['errors']) && isset($_GET['msg']))
                    <div style="color: red">{{$_SESSION['errors']['name']}}</div>
                @endif
                @if(isset($_SESSION['success']) && isset($_GET['msg']))
                    <div class="mt-3 " style="color: green">{{$_SESSION['success']}}</div>
                @endif
                <button type="submit" class="btn btn-primary" style="margin-top: 50px;">Gửi</button>
                <a href="{{ route('category')  }}"><button type="button" class="btn btn-primary" style="margin-top: 50px;">Quay lại</button></a>
            </form>
        </div>
    </div>
</section>
@endsection