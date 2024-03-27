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
        @if(empty($bill))
            <h3 style="color: red">Bạn chưa có đơn hàng nào<a href="{{ route('home-page') }}">Quay Lại</a></h3>
        @endif
        <div class="row">
            @if(!empty($bill))
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <table>
                        <thead>
                        <tr>
                            <th>Code</th>
                            <th>Trước khi ap dụng giảm giá</th>
                            <th>Sau khi áp dụng giảm giá</th>
                            <th>Giá Cuối</th>
                            <th>Thời gian</th>
                            <th>Trạng thái</th>
                            <th>Thao Tác</th>
                        </tr>

                        </thead>
                        <tbody>
                          @foreach($bill as $items)
                        <tr>
                            <td>
                                <h5>{{ $items->code }}</h5>
                            </td>
                            <td>
                                {{ number_format($items->total_mony_after_reduction,0, ',', '.')}}đ
                            </td>
                            <td>
                                @if($items->total_mony_before_reduction == null)
                                    không áp dụng
                                @else
                                    {{ number_format($items->total_mony_before_reduction,0, ',', '.')}}đ
                                @endif

                            </td>
                            <td>
                                {{ number_format($items->total_mony,0, ',', '.')}}đ
                            </td>
                            <td>
                                {{ $items->create_at }}
                            </td>
                            <td>
                                @switch($items->status)
                                    @case(0)
                                        <button type="button" class="btn  btn-danger" disabled>Đã hủy</button>
                                        <a href="{{ route('updateBill/1/').$items->id }}" onclick=" return confirm('Xác nhận mua lại đơn hàng này ?')"><button type="button" class="btn btn-success">Mua lại</button></a>
                                    @break;
                                    @case(1)
                                        <button type="button" class="btn btn-success" disabled>Chờ Xác Nhận</button>
                                        <a href="{{ route('updateBill/0/').$items->id }}" onclick=" return confirm('Xác nhận hủy đơn hàng này ?')"><button type="button" class="btn btn-danger">Hủy Đơn</button></a>
                                        @break;
                                    @case(2)
                                        <button type="button" class="btn btn-success" disabled>Đang giao hàng</button>
                                        @break;
                                    @case(3)
                                        <a href="{{ route('updateBill/4/').$items->id }}" onclick=" return confirm('Xác nhận thành công đơn hàng này ?')"><button type="button" class="btn btn-success">Nhận hàng thành công</button></a>
                                    @break;
                                    @case(4)
                                        <button type="button" class="btn btn-success" disabled>Đã mua</button>
                                    @break;
                                @endswitch
                            </td>
                            <td>
                                <div class="span"><a href="{{ route('bill/detail/').$items->id }}">Chi tiết</a></div>
                            </td>
                        </tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection
<!-- Shoping Cart Section End -->