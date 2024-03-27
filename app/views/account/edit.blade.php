@extends('layout-user.main')
@section('main-content')
    <section class="container-fluid mt-3ct">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="text-center">Chỉnh sửa tài khoản </h4>
            </div>
            <div class="card-body">
                <form action="{{ route('action-edit-account/').$data->idAccount }}" method="post">
                    <div class="form-group mt-3">
                        <label for="formGroupExampleInput" class="font-lb">Code</label>
                        <input type="text" class="form-control" value="{{ $data->codeAccount }}" disabled>
                    </div>
                    <div class="form-group mt-3">
                        <label for="formGroupExampleInput" class="font-lb">Tên tài khoản</label>
                        <input type="text" class="form-control" value="{{ $data->name }}" disabled>
                    </div>
                    <div class="form-group mt-3">
                        <label for="formGroupExampleInput" class="font-lb">Username</label>
                        <input type="text"  class="form-control"  value="{{ $data->username }}" disabled>
                    </div>
                    <div class="form-group mt-3">
                        <label for="formGroupExampleInput" class="font-lb">Vài trò</label>
                        <select class="form-select" aria-label="Default select example" name="role">
                                 @foreach($data_role as $iteams)
                                    <option value="{{$iteams->id}}">{{$iteams->name_role}}</option>
                                  @endforeach
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <label for="formGroupExampleInput" class="font-lb">Cập nhật mới nhất</label>
                        <input type="text" class="form-control" value="{{ $data->update_at }}" disabled>
                    </div>
                    <div class="form-group mt-3">
                        <label for="formGroupExampleInput" class="font-lb">Người cập nhập</label>
                        <input type="text" class="form-control" value="{{ $data->update_by }}" disabled>
                    </div>
                    <div class="form-group mt-3">
                        <label for="formGroupExampleInput" class="font-lb">Trạng thái</label>
                        <input type="text" name="payment" class="form-control" value="@if ($data->status == 0)
                                Đang hoạt động
                            @elseif ($data->status == 1)
                                 Ngừng hoạt động
                            @endif" disabled>
                    </div>
                    @if(isset($_SESSION['success']) && isset($_GET['msg']))
                        <div class="mt-3 " style="color: green">{{$_SESSION['success']}}</div>
                    @endif
                    <div class="wrap-btn">
                        <div>
                            <button type="submit" class="btn btn-success" style="margin-top: 50px;" onclick="return confirm('Bạn có chắc chắn muốn cấp quyền cho tài khoản {{$data->username}}?')">Sửa</button>
                            <a href="{{ route('account') }}" ><button type="button" class="btn btn-primary" style="margin-top: 50px;">Quay lại</button></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection