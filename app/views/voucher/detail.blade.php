@extends('layout.main')
@section('main-content')
    <section class="container-fluid mt-3ct">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="text-center">Chi tiết khuyến mãi </h4>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group mt-3">
                        <label for="formGroupExampleInput" class="font-lb">Code khuyến mại </label>
                            <input type="text" name="id_bill" class="form-control" value="{{$voucher->code}}" disabled >
                    </div>
                    <div class="form-group mt-3">
                        <label for="formGroupExampleInput" class="font-lb">Discount Code</label>
                        <input type="text" name="id_bill" class="form-control" value="{{$voucher->discount_code}}" disabled >
                    </div>
                    <div class="form-group mt-3">
                        <label for="formGroupExampleInput" class="font-lb">Tên khuyến mại </label>
                        <input type="text" name="id_bill" class="form-control" value="{{$voucher->name}}" disabled >
                    </div>
                    <div class="form-group mt-3">
                        <label for="formGroupExampleInput" class="font-lb">Giá trị </label>
                        <input type="text" name="user_name" class="form-control" value="{{$voucher->value }}%)" disabled >
                    </div>
                    <div class="form-group mt-3">
                        <label for="formGroupExampleInput" class="font-lb">Số lượng khuyến mại</label>
                        <input type="text" name="user_name" class="form-control" value="{{ $voucher->quantity}}" disabled >
                    </div>
                    <div class="form-group mt-3">
                        <label for="formGroupExampleInput" class="font-lb"> Giá trị tối thiểu</label>
                        <input type="text" name="user_name" class="form-control" value="{{ number_format($voucher->	minimum_amount, 0, ',', '.') }} .VNĐ" disabled >
                    </div>
                    <div class="form-group mt-3">
                        <label for="formGroupExampleInput" class="font-lb">Thời gian bắt đầu</label>
                        <input type="text" name="user_name" class="form-control" value="{{ $voucher->start_time}}" disabled >
                    </div>
                    <div class="form-group mt-3">
                        <label for="formGroupExampleInput" class="font-lb"> Thời gian kết thúc</label>
                        <input type="text" name="user_name" class="form-control" value="{{ $voucher->end_time }}" disabled >
                    </div>
                    <div class="form-group mt-3">
                        <label for="formGroupExampleInput" class="font-lb">Ngày tạo</label>
                        <input type="text" name="user_name" class="form-control"  value="{{ $voucher->create_at }}" disabled >
                    </div>
                    <div class="form-group mt-3">
                        <label for="formGroupExampleInput" class="font-lb">Người tạo </label>
                        <input type="text" name="order_date" class="form-control" value="{{ $voucher->create_by }}" disabled>
                    </div>
                    <div class="form-group mt-3">
                        <label for="formGroupExampleInput" class="font-lb">Cập nhật mới nhất</label>
                        <input type="text" name="total_amount" class="form-control" value="{{ $voucher->update_at }}" disabled>
                    </div>
                    <div class="form-group mt-3">
                        <label for="formGroupExampleInput" class="font-lb">Người cập nhập</label>
                        <input type="text" name="payment" class="form-control" value="{{ $voucher->update_by }}" disabled>
                    </div>
                    <div class="form-group mt-3">
                        <label for="formGroupExampleInput" class="font-lb">Trạng thái</label>
                        <input type="text" name="payment" class="form-control" value="@if ($voucher->deleted == 0)
                                Đang hoạt động
                            @elseif ($voucher->status == 1)
                                 Ngừng hoạt động
                            @endif" disabled>
                    </div>
                    <div class="wrap-btn">
                        <div>
                            <a href="{{ route('voucher') }}"><button type="button" class="btn btn-success" style="margin-top: 50px;">Quay lại</button></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
