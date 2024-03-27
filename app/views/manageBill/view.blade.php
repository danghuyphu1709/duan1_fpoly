@extends('layout.main')
@section('main-content')
    <section class="container-fluid mt-3ct">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="{{ route('manage/bill') }}" class="text-decoration-none"><h4 class="text-black-50 text-center">Đơn hàng</h4></a>
                <form action="{{ route('search-bill')}}" method="post"
                      class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control bg-light border-0 small"
                                   placeholder="Code đơn hàng..."
                                   aria-label="Search" aria-describedby="basic-addon2" name="code">
                        </div>
                        <div class="col">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                    @if(isset($_SESSION['errors']) && isset($_GET['msg']))
                        <div style="color: red" class="mt-3">{{$_SESSION['errors']['code']}}</div>
                    @endif
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Code</th>
                            <th>Thông tin người đặt</th>
                            <th>Địa chỉ đặt hàng</th>
                            <th>Tổng đơn</th>
                            <th>Thời gian tạo</th>
                            <th>Trạng thái</th>
                            <th class="text-right">Thao Tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($bill))
                            @foreach($bill as $items)
                                <tr id="list-cate">
                                    <td>{{$items->code}}</td>
                                    <td>{{$items->name_user}},{{$items->phone}}</td>
                                    <td>{{$items->name_village}},{{$items->name_ward}},{{$items->name_district}},{{$items->name_city}}</td>
                                    <td>{{ number_format($items->total_mony,0, ',', '.')}}đ</td>
                                    <td>{{$items->create_at}}</td>
                                    <td>  @switch($items->status)
                                            @case(0)
                                                <button type="button" class="btn  btn-danger" disabled>Đơn hàng hủy</button>
                                                @break;
                                            @case(1)
                                                <a href="{{ route('manage/update/bill/2/').$items->id }}" onclick=" return confirm('Xác nhận đơn hàng này ?')"><button type="button" class="btn btn-success">Xác nhận đơn</button></a>
                                                <a href="{{ route('manage/update/bill/0/').$items->id }}" onclick=" return confirm('Xác nhận hủy đơn hàng này ?')"><button type="button" class="btn btn-danger">Hủy đơn</button></a>
                                                @break;
                                            @case(2)
                                                <a href="{{ route('manage/update/bill/3/').$items->id }}" onclick=" return confirm('Xác nhận giao đơn hàng này ?')"><button type="button" class="btn btn-success">Xác nhận giao hàng</button></a>
                                                @break;
                                            @case(3)
                                                <button type="button" class="btn  btn-secondary" disabled>Chờ xác nhận người mua</button>
                                                @break;
                                            @case(4)
                                                <button type="button" class="btn btn-success" disabled>Đơn hàng thành công</button>
                                                @break;
                                        @endswitch
                                    </td>
                                    <td class="text-right">
                                        <a href="{{ route('bill/detail/').$items->id }}">
                                            <button type="button" class="btn btn-outline-info">
                                                <i class="fa-regular fa-eye" style="color: #00ff33; font-size:15px"></i>
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
