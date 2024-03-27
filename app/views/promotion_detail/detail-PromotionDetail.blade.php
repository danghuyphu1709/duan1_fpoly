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
                        <label for="formGroupExampleInput" class="font-lb">Sản phẩm</label>
                        <input type="text" name="id_bill" class="form-control" value="{{$product->nameproduct }}({{ $product->namesize }})" disabled>
                    </div>
                    <div class="form-group mt-3">
                        <label for="formGroupExampleInput" class="font-lb">Mã khuyến mại</label>
                        <input type="text" name="user_name" class="form-control" value="{{ $promotionDetail->name}}({{ $promotionDetail->value }}%)" disabled>
                    </div>
                    <div class="form-group mt-3">
                        <label for="formGroupExampleInput" class="font-lb">Số lượng sản phẩm khuyến mại</label>
                        <input type="text" name="user_name" class="form-control" value="{{ $promotionDetail->quantity}}" disabled>
                    </div>
                    <div class="form-group mt-3">
                        <label for="formGroupExampleInput" class="font-lb"> Giá sao khi áp dụng khuyến mại</label>
                        <input type="text" name="user_name" class="form-control" value="{{ number_format($promotionDetail->price_after_reduction , 0, ',', '.') }} .VNĐ" disabled>
                    </div>
                    <div class="form-group mt-3">
                        <label for="formGroupExampleInput" class="font-lb">Ngày tạo danh mục</label>
                        <input type="text" name="user_name" class="form-control"  value="{{ $promotionDetail->create_at }}" disabled>
                    </div>
                    <div class="form-group mt-3">
                        <label for="formGroupExampleInput" class="font-lb">Người tạo danh mục</label>
                        <input type="text" name="order_date" class="form-control" value="{{ $promotionDetail->create_by }}" disabled>
                    </div>
                    <div class="form-group mt-3">
                        <label for="formGroupExampleInput" class="font-lb">Cập nhật mới nhất</label>
                        <input type="text" name="total_amount" class="form-control" value="{{ $promotionDetail->update_at }}" disabled>
                    </div>
                    <div class="form-group mt-3">
                        <label for="formGroupExampleInput" class="font-lb">Người cập nhập</label>
                        <input type="text" name="payment" class="form-control" value="{{ $promotionDetail->update_by }}" disabled>
                    </div>
                    <div class="form-group mt-3">
                        <label for="formGroupExampleInput" class="font-lb">Trạng thái</label>
                        <input type="text" name="payment" class="form-control" value="@if ($promotionDetail->status == 0)
                                Đang hoạt động
                            @elseif ($promotionDetail->status == 1)
                                 Ngừng hoạt động
                            @endif" disabled>
                    </div>
                    <div class="wrap-btn">
                        <div>
                            <a href="{{ route('apply-now') }}"><button type="button" class="btn btn-success" style="margin-top: 50px;">Quay lại</button></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection