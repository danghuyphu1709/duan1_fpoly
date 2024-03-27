@extends('layout-user.main')
@section('main-content')
    <link rel="stylesheet" href="{{BASE_URL.'source-user/css/orderStyle.css'}}">
    <div class="container px-1 px-md-4 py-5 mx-auto">
        <h2>Chi Tiết Trạng Thái Đơn Hàng</h2>
        <div class="card">
            <div class="row d-flex justify-content-between px-3 top">
                <div class="d-flex">
                    <h5>Code :<span class="text-primary font-weight-bold">{{ $detail->code }}</span></h5>
                </div>
                <div class="d-flex flex-column text-sm-right">
                    <p class="mb-0">Thời gian: <span>{{ $detail->create_at }}</span></p>
                    <p> Mã giảm giá : <span class="font-weight-bold">@if($detail->name_voucher == null) Không áp dụng @else {{ $detail->name_voucher }} @endif </span></p>
                </div>
            </div>
            <!-- Add class 'active' to progress -->
            <div class="row d-flex justify-content-center">
                <div class="col-12">
                    <ul id="progressbar" class="text-center">
                        @switch($detail->status)
                            @case(0)
                                <li class="step0"></li>
                                <li class="step0"></li>
                                <li class="step0"></li>
                                <li class="step0"></li>
                                @break;
                            @case(1)
                                <li class="active step0"></li>
                                <li class="step0"></li>
                                <li class="step0"></li>
                                <li class="step0"></li>
                                @break;
                            @case(2)
                                <li class="active step0"></li>
                                <li class="active step0"></li>
                                <li class="step0"></li>
                                <li class="step0"></li>
                                @break;
                            @case(3)
                                <li class="active step0"></li>
                                <li class="active step0"></li>
                                <li class="active step0"></li>
                                <li class="step0"></li>
                                @break;
                            @case(4)
                                <li class="active step0"></li>
                                <li class="active step0"></li>
                                <li class="active step0"></li>
                                <li class="active step0"></li>
                                @break;
                        @endswitch


                    </ul>
                </div>
            </div>
            <div class="row justify-content-between top">
                <div class="row d-flex icon-content">
                    <img class="icon" src="https://i.imgur.com/9nnc9Et.png">
                    <div class="d-flex flex-column">
                        <p class="font-weight-bold">Order<br>Chờ xác nhận</p>
                    </div>
                </div>
                <div class="row d-flex icon-content">
                    <img class="icon" src="https://i.imgur.com/u1AzR7w.png">
                    <div class="d-flex flex-column">
                        <p class="font-weight-bold">Order<br>Chuẩn bị </p>
                    </div>
                </div>
                <div class="row d-flex icon-content">
                    <img class="icon" src="https://i.imgur.com/TkPm63y.png">
                    <div class="d-flex flex-column">
                        <p class="font-weight-bold">Order<br>Đang giao</p>
                    </div>
                </div>
                <div class="row d-flex icon-content">
                    <img class="icon" src="https://i.imgur.com/HdsziHP.png">
                    <div class="d-flex flex-column">
                        <p class="font-weight-bold">Order<br>Giao thành công</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card2">
            <div class="row">
                <div class="col-lg-8 col-md-6">
                    <section class="shoping-cart spad">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="shoping__cart__table">
                                        <table>
                                            <thead>
                                            <tr>
                                                <th class="shoping__product">Sản phẩm</th>
                                                <th>Tổng</th>
                                                <th>Số lượng</th>
                                                <th>Giảm giá</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($listDetail as $items)
                                            <tr>
                                                <td class="shoping__cart__item">
                                                    <img src="{{ route('upload/').$items->avata }}" alt="" width="100px">
                                                       <h5>{{ $items->name }}, {{ $items->size_name }}</h5>
                                                </td>

                                                <td class="shoping__cart__total">
                                                    {{ number_format($items->price, 0, ',', '.') }}đ
                                                </td>
                                                <td class="shoping__cart__total">
                                                    {{ $items->quantity }}
                                                </td>
                                                <td class="shoping__cart__price product__discount__item__text">
                                                    <div class="shoping__cart__price_customer">
                                                        <div class="price_cart">@if($items->promotion_price)
                                                                {{ number_format($items->promotion_price, 0, ',', '.') }}đ
                                                            @else
                                                                {{ number_format($items->price, 0, ',', '.') }}đ
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="shoping__cart__item__close">

                                                </td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="checkout__order">
                        <h4>Hóa Đơn</h4>
                        <div class="checkout__order__products">Thông tin cơ bản</div>
                        <ul>
                            <li>Người nhận hàng : {{ $detail->name_user }}</li>
                            <li>Số điện thoại : {{ $detail->phone }}</li>
                            <li>Hình thức thanh toán : {{ $detail->name_payment }}</li>
                            <li>Chi tiết địa chỉ : {{ $detail->address_detail }}</li>
                            <li>Địa chỉ : {{ $detail->name_village }},{{ $detail->name_ward }},{{ $detail->name_district }},{{ $detail->name_city }}</li>
                        </ul>
                        <div class="checkout__order__subtotal"> Tổng tiền: <span>{{ number_format($detail->total_mony_after_reduction,0, ',', '.')}}đ </span></div>
                        @if($detail->total_mony_before_reduction)
                            <div class="checkout__order__total">Áp dụng giảm giá : <span>{{ number_format($detail->total_mony,0, ',', '.') }}đ</span></div>
                        @endif
                        <p>Cảm ơn bạn đã luôn tin tưởng và đặt hàng của chúng tôi ,hi vọng bạn có một trải nghiệm mua hàng tuyệt vời.</p>
                        @if($_SESSION['role'] ==! 0)
                            <a href="{{ route('manage/bill') }}"><button type="submit" class="site-btn">Quay lại trang quản lý </button></a>
                        @else
                            <a href="{{ route('bill') }}"><button type="submit" class="site-btn">Quay Lại</button></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection