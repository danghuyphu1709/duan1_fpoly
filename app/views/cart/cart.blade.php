@extends('layout-user.main')
@section('main-content')
@php
        if(!isset($_SESSION['auth'])) {
                header('Location: ' . BASE_URL . 'login');
        }
@endphp

<!-- Shoping Cart Section Begin -->
<section class="shoping-cart spad">
    <div class="container">
        @if(isset($errors))
            <h3 style="color: red">{{ $errors }}</h3>
        @endif
        @if(empty($productCart))
            <h3 style="color: red">Bạn không có sản phẩm nào trong giỏ hàng <a href="{{ route('home-page') }}">Quay Lại</a></h3>
        @endif
            <form action="{{ route('checkoutCart') }}" method="post" id="form-checkout-cart" autocomplete="off">
                <input type="hidden" value="{{ $_SESSION['csrf_token'] }}" name="csrf_token">
                @if(!empty($productCart))
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <table>
                        <thead>
                        <tr>
                            <th class="shoping__product">Sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Tổng tiền</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $_SESSION['total_cart'] = 0; @endphp
                        @foreach($productCart as $items)
                            <input type="hidden" value="{{ $items->cart_id }}" name="cart_id[]">
                            @php $price = $items->price_after_reduction ? $items->price_after_reduction : $items->price ;$total =  $price * $items->quantity ; $_SESSION['total_cart'] += $total ;@endphp
                        <tr>
                            <td class="shoping__cart__item">
                                <a href="{{ route('productDetail/').$items->products_id }}">
                                <img src="{{ route('upload/').$items->avata }}" alt="" width="100px">
                                <h5>{{ $items->product_name}}</h5>
                                <span>{{ $items->name }}</span>
                                </a>
                            </td>
                            <td class="shoping__cart__price product__discount__item__text">
                                <div class="shoping__cart__price_customer">
                                    <div class="product__item__price"><span style=";font-size: 16px">@if($items->price_after_reduction)
                                                {{ number_format($items->price, 0, ',', '.') }}đ
                                            @else
                                                   0đ
                                    @endif</span>
                                    </div>
                                    <div class="price_cart">@if($items->price_after_reduction)
                                            {{ number_format($items->price_after_reduction, 0, ',', '.') }}đ
                                        @else
                                            {{ number_format($items->price, 0, ',', '.') }}đ
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="shoping__cart__quantity">
                                <div class="quantity">
                                    <button class="pro-qty clickQuantity" type="button">
                                        <input type="number" value="{{ $items->quantity }}" name="quantity[]" max="{{ $items->quantity_max }}" min="1">
                                    </button>
                                </div>
                            </td>
                            <td class="shoping__cart__total">
                                {{ number_format($total, 0, ',', '.') }}đ
                            </td>
                            <td class="shoping__cart__item__close">
                                <a href="{{ route('cartDelete/').$items->cart_id }}" onclick="return confirm('Bạn muốn xóa sản phẩm này khỏi giỏ hàng ?')"><span class="icon_close"></span></a>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                        </tbody>
                    </table>
                    @if(isset($_SESSION['errors']) && isset($_GET['msg']))
                        <div style="color: red">{{$_SESSION['errors']['quantity']}}</div>
                    @endif
                </div>
            </div>
        </div>
                @if(!empty($productCart))
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__btns">
                    <a href="{{ route('shop') }}" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                    <button type="submit" class="primary-btn cart-btn cart-btn-right" style=" border:none;" name="update"><span class="icon_loading"></span> Cập nhật</button>
                </div>
            </div>

            <div class="col-lg-6 mt-5">
                    <div class="row">
                        <div class="col-lg-12 shoping_option">
                            <h5>Danh sách mã giảm giá</h5>
                            <div>
                                <select class="form-select" aria-label="Default select example" id="discount-cart" name="discount">
                                    <option value="0" selected>Chọn mã giảm giá cho đơn hàng</option>
                                    @foreach($discount as $items)
                                        @if($items->minimum_amount <= $_SESSION['total_cart'])
                                            <option value="{{ $items->id }}">{{ $items->name }}</option>
                                        @else
                                            <option value="{{ $items->id }}" disabled>{{ $items->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <span id="errorsKeyword" style="color: red"></span>
                            @if(isset($_SESSION['errors']) && isset($_GET['msg']))
                                <div style="color: red" id="errorsKeyword2">{{$_SESSION['errors']['keyword']}}</div>
                            @endif
                            @if(isset($_SESSION['success']) && isset($_GET['msg']))
                                <div class="mt-3 " style="color: green">{{$_SESSION['success']}}</div>
                            @endif

                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-lg-12 shoping_option">
                            <h5>Phương Thức Thanh Toán</h5>
                                <div class="payment_address mt-3">
                                    @foreach($payment as $items)
                                        @if($items->default == 1)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="payment" id="flexRadioDefault1" value="{{ $items->id }}" checked>
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    {{ $items->name }}
                                                </label>
                                            </div>
                                        @else
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="payment" id="flexRadioDefault1" value="{{$items->id}}">
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    {{ $items->name }}
                                                </label>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            <span id="errorsKeyword" style="color: red"></span>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-lg-12 shoping_option" >
                            <h5>Địa chỉ giao hàng</h5>
                            <div class="mt-3">
                                <select aria-label="Default select example" id="address" name="address">
                                    @foreach($address as $items)
                                        <option value="{{ $items->id }}">{{ $items->name .'/'. $items->phone.'/'.$items->address_detail}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="contact__widget">
                               <a href="{{ route('address/add') }}"><span class="icon_pin_alt"></span><span>Thêm địa chỉ </span></a>
                            </div>
                            <span id="errorsKeyword" style="color: red"></span>
                        </div>
                    </div>

            </div>
            <div class="col-lg-6">
                <div class="shoping__checkout">
                    <h5>Cart Total</h5>
                    <ul>
                        <li>Giá trị giảm<span id="value"></span></li>
                        <li>Áp dụng mã giảm giá<span id="apply">0đ</span></li>
                        <li>Giá cuối <span id="total_price">{{ number_format($_SESSION['total_cart'], 0, ',', '.') }}đ</span>
                        </li>
                    </ul>
                    <input type="hidden" value="{{ $_SESSION['total_cart'] }}" name="total_cart">
                    <button type="submit" name="checkout" class="primary-btn" style="border: none">PROCEED TO CHECKOUT</button>
                </div>
            </div>

        </div>
            @endif
    </div>
</section>
</form>
<script src="{{BASE_URL.'source-user/customer/cartAjax.js'}}"></script>
<!-- Shoping Cart Section End -->
@endsection