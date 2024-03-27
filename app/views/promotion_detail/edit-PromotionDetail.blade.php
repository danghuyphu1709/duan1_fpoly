@extends('layout.main')
@section('main-content')
    <section class="container-fluid mt-3ct">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="text-center"> Chi tiết sản phẩm </h4>
                <div class="text-right">
                </div>
            </div>
            <div class="card-body">
                <form action="{{route('action-edit-detail-promotion/'.$promotionDetail->id)}}"
                      method="post">
                    <div class="table-responsive">
                        <div class="table-content table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="jb-product-thumbnail">Tên sản phẩm</th>
                                    <th class="cart-product-name">Giá</th>
                                    <th class="jb-product-price">Số lượng</th>
                                    <th class="jb-product-quantity">Kích thước</th>
                                    <th class="jb-product-quantity">Giá sau giảm</th>
                                    <th class="jb-product-quantity">Khuyến mại</th>
                                    <th class="jb-product-subtotal">Số lượng sản phẩm giảm giá</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <td class="product-name">{{ $product->nameproduct }}</td>
                                    <td class="product-price" id="price_value_now">{{ number_format($product->price , 0, ',', '.') }}<span
                                                class="amount">.VNĐ</span></td>
                                    <td class="product-quantity">{{  $product->quantity }}</td>
                                    <td class="product-sizename">{{ $product->namesize }}</td>
                                    <td class="product-price" id="price_after"></td>
                                    <td class="product-input">
                                        <select class="form-control" aria-label="Default select example" id='promotion_id'
                                                name="promotion">
                                            <option selected value="0">Chọn mã giảm giá</option>
                                            @foreach($promotion as $iteams)
                                                <option value="{{ $iteams->id }}">{{$iteams->name}} ({{$iteams->value}}%)</option>
                                            @endforeach
                                        </select>
                                        <div class="mt-3"><span>Mã Khuyến mãi:{{ $promotionDetail->name}}({{ $promotionDetail->value }}%)</span></div>
                                    </td>
                                    <td class="product-input"><input type="number" class="form-control"
                                                                     name="quantity"
                                                                     max="{{$product->quantity}}" min="0"
                                                                     id="exampleInputEmail1"
                                                                     aria-describedby="emailHelp" value="{{ $promotionDetail->quantity }}">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            @if(isset($_SESSION['errors']) && isset($_GET['msg']))
                                <div style="color: red">{{$_SESSION['errors']['quantity']}}</div>
                            @endif
                            @if(isset($_SESSION['errors']) && isset($_GET['msg']))
                                <div style="color: red">{{$_SESSION['errors']['price']}}</div>
                            @endif
                            @if(isset($_SESSION['success']) && isset($_GET['msg']))
                                <div class="mt-3 " style="color: green">{{$_SESSION['success']}}</div>
                            @endif
                        </div>
                        <div class="btn">
                            <button type="submit" class="btn btn-success">Sửa</button>
                            <a href="{{ route('apply-promotion')}}">
                                <button type="button" class="btn btn-success">Quay lại</button>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        {{--jquery check --}}
        <script src="{{BASE_URL.'source/customer/js/axios.main.js'}}"></script>
    </section>
@endsection
