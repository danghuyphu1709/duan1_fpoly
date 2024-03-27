@extends('layout.main')
@section('main-content')
    <section class="container-fluid mt-3ct">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="text-center">Chi tiết sản phẩm </h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Kích thước</th>
                            <th>Ngày sửa</th>
                            <th>Người sửa</th>
                            <th>Danh mục</th>
                            <th>Trạng thái</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $iteams)
                            <tr id="list-cate">
                                <td>{{$iteams->nameproduct}}</td>
                                <td>{{ number_format($iteams->price, 0, ',', '.') }}đ</td>
                                <td>{{$iteams->quantity}}</td>
                                <td>{{$iteams->namesize}}</td>
                                <td>{{$iteams->update_at}}</td>
                                <td>{{$iteams->update_by}}</td>
                                <td>{{$iteams->namecategory}}</td>
                                <td> @if ($iteams->status == 0)
                                        Đang hoạt động
                                    @elseif ($iteams->status == 1)
                                        Ngừng hoạt động
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                    <div class="card-header py-3">
                        <h4 class="">Mô tả sản phẩm : </h4>
                        <h5>{{ $data[0]->description}}</h5>
                    </div>
                </div>

                <div class="ecommerce-gallery" data-mdb-zoom-effect="true" data-mdb-auto-height="true">
                    <div class="row py-3 shadow-5">
                        @foreach($data_image as $iteams)
                        <div class="col-3 mt-1">
                            <img
                                    src="../upload/{{$iteams->source}}";
                                    data-mdb-img="{{route('upload/').$iteams->source}}"
                                    alt="Gallery image 1"
                                    class="active w-100"
                            />
                        </div>
                        @endforeach
                    </div>
                    <a href="{{ route('product') }}"><button type="button" class="btn btn-success">Quay lại</button></a>
                </div>
            </div>
        </div>
        <script src="{{BASE_URL.'source/customer/js/main.js'}}"></script>
    </section>
@endsection