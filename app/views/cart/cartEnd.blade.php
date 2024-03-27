@extends('layout-user.main')
@section('main-content')
<link rel="stylesheet" href="{{BASE_URL.'source-user/css/cartEnd.css'}}">

 <div class="container mt-5 h-25" >
    <div class="text-center">
        <button type="button" class="btn btn-success launch" data-toggle="modal" data-target="#staticBackdrop"> <i class="fa fa-info"></i> Đặt hàng thành công
        </button>
    </div>
 </div>
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body ">
                <div class="text-right"> <i class="fa fa-close close" data-dismiss="modal"></i> </div>

                <div class="px-4 py-5">

                    <h5 class="text-uppercase">{{ $_SESSION['username'] }}</h5>

                    <h4 class="mt-5 theme-color mb-5">Cảm ơn bạn đã mua hàng</h4>

                    <span class="theme-color">Địa chỉ</span>
                    <div class="mb-3">
                        <hr class="new1">
                         <span>{{ $bill->name_user }},{{ $bill->phone }}</span>
                        <span>{{ $bill->name_village }},{{ $bill->name_ward }},{{ $bill->name_district}},{{ $bill->name_city}}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="font-weight-bold">Thanh toán : {{ number_format( $bill->total_mony_after_reduction, 0, ',', '.') }}</span>
                    </div>
                    @if($bill->name_voucher)
                        <div class="d-flex justify-content-between">
                            <small>Mã giảm giá : {{ $bill->name_voucher }}</small>
                            <small></small>
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <span class="font-weight-bold">Số tiền sau ap dụng : </span>
                            <span class="font-weight-bold ">  {{  number_format($bill->total_mony_before_reduction, 0, ',', '.')  }}</span>
                        </div>
                    @else
                        <div class="d-flex justify-content-between">
                            <small>Mã giảm giá : Không áp dụng</small>
                            <small></small>
                        </div>
                    @endif

                    <div class="d-flex justify-content-between">
                        <small>Hình thức thanh toán : {{ $bill->name_payment }}</small>
                        <small></small>
                    </div>

                    <div class="d-flex justify-content-between mt-3">
                        <span class="font-weight-bold">Số tiền thanh toán : </span>
                        <span class="font-weight-bold theme-color">  {{ number_format($bill->total_mony, 0, ',', '.') }}đ</span>
                    </div>
                    <div class="text-center mt-5">
                       <a href="{{ route('bill') }}"> <button class="btn btn-primary">Danh sách đơn hàng</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection