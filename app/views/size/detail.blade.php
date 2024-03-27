@extends('layout.main')
@section('main-content')
    <section class="container-fluid mt-3ct">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="text-center">Chi tiết danh mục </h4>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group mt-3">
                        <label for="formGroupExampleInput" class="font-lb">Code Kích Thước</label>
                        <input type="text" name="id_bill" class="form-control" value="{{ $data->code }}" disabled>
                    </div>
                    <div class="form-group mt-3">
                        <label for="formGroupExampleInput" class="font-lb">Tên Kích Thước</label>
                        <input type="text" name="user_name" class="form-control" value="{{ $data->name }}" disabled>
                    </div>
                    <div class="form-group mt-3">
                        <label for="formGroupExampleInput" class="font-lb">Ngày tạo </label>
                        <input type="text" name="user_name" class="form-control"  value="{{ $data->create_at }}" disabled>
                    </div>
                    <div class="form-group mt-3">
                        <label for="formGroupExampleInput" class="font-lb">Người tạo </label>
                        <input type="text" name="order_date" class="form-control" value="{{ $data->create_by }}" disabled>
                    </div>
                    <div class="form-group mt-3">
                        <label for="formGroupExampleInput" class="font-lb">Cập nhật mới nhất</label>
                        <input type="text" name="total_amount" class="form-control" value="{{ $data->update_at }}" disabled>
                    </div>
                    <div class="form-group mt-3">
                        <label for="formGroupExampleInput" class="font-lb">Người cập nhập</label>
                        <input type="text" name="payment" class="form-control" value="{{ $data->update_by }}" disabled>
                    </div>
                    <div class="form-group mt-3">
                        <label for="formGroupExampleInput" class="font-lb">Trạng thái</label>
                        <input type="text" name="payment" class="form-control" value="@if ($data->deleted == 0)
                                Đang hoạt động
                            @elseif ($data->deleted == 1)
                                 Ngừng hoạt động
                            @endif" disabled>
                    </div>
                    <div class="wrap-btn">
                        <div>
                            <a href="{{ route('size') }}"><button type="button" class="btn btn-primary" style="margin-top: 50px;">Quay lại</button></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection