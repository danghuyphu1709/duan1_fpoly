@extends('layout-user.main')
@section('main-content')
<!-- Contact Form Begin -->
<div class="contact-form spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="contact__form__title">
                    <h2>Địa chỉ giao hàng</h2>
                </div>
            </div>
        </div>
        <form action=" {{ route('add-to-address') }}" method="post" id="form-address">
            <input value="{{  $_SESSION['csrf_token'] }}" name="csrf_token" type="hidden">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <input id="name" type="text" name="name" placeholder="Tên người nhận...">
                    <span id="errors_name" style="color: red"></span>
                </div>
                <div class="col-lg-6 col-md-6">
                    <input id="phone" type="text" placeholder="Số điện thoại..." name="phone">
                    <span id="errors_phone" style="color: red"></span>
                </div>
            </div>

            <div class="col-lg-12 text-center">
                <textarea  id="address_detail" placeholder="Địa chị cụ thể" name="address_detail"></textarea>
                <span id="errors_address_detail" style="color: red"></span>
            </div>

             <div class="row">
                 <div class="col-lg-2 col-md-2">
                     <select class="select_form_adress" aria-label="Default select example" name="province" id="province">
                         <option value="0" selected>Chọn tỉnh/Thành phố</option>
                         @foreach($provinceCity as $items)
                         <option value="{{ $items->id }}">{{ $items->name }}</option>
                         @endforeach
                     </select>
                 </div>
                 <div class="col-lg-2 col-md-2" id="district">

                 </div>
                 <div class="col-lg-2 col-md-2" id="ward">

                 </div>
                 <div class="col-lg-2 col-md-2" id="village">

                 </div>
             </div>
            <span id="erorrs_select" style="color: red"></span>
            @if(isset($_SESSION['success']) && isset($_GET['msg']))
                <div class="mt-3 " style="color: green">{{$_SESSION['success']}}</div>
            @endif
         <div class="mt-5 ">
             <button type="submit" class="btn-success">Gửi</button>
             <a href="{{ route('cart') }}"><button type="button" class="btn-primary">Quay Lại</button></a>
         </div>

        </form>
    </div>
</div>
<script src="{{BASE_URL.'source-user/customer/addressAjax.js'}}"></script>
@endsection
<!-- Contact Form End -->