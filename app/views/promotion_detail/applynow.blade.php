@extends('layout.main')
@section('main-content')
    <section class="container-fluid mt-3ct">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="{{ route('manage/promotion') }}" class="text-decoration-none"><h4 class="text-center text-black-50"> Khuyễn mãi </h4></a>
                <div class="text-right">
                </div>
            </div>
            <div class="card-body">
                <div>
                    <a href="{{ route('apply-promotion/')}}">
                        <button type="button" class="btn btn-outline-warning">
                            Quay Lại
                        </button>
                    </a>
                </div>
                <div class="table-responsive mt-3">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Code</th>
                            <th>Ảnh sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th class="text-right">Thao Tác</th>
                        </tr>
                        </thead>
                        <tbody id="product_insert">
                        @if(isset($data2))
                            @foreach($data2 as $iteams)
                                <tr>
                                    <td>{{ $iteams->code }}</td>
                                    <td><img src="{{ route('upload/').$iteams->products_avata }}"
                                             width="100px"></td>
                                    <td>{{ $iteams->product_name }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('detail-promotionDetail/').$iteams->promotionDetail_id }}">
                                            <button type="button" class="btn btn-outline-info">
                                                <i class="fa-regular fa-eye" style="color: #00ff33; font-size:15px"></i>
                                            </button>
                                        </a>
                                        <a href="{{ route('edit-promotionDetail/').$iteams->promotionDetail_id }}">
                                            <button type="button" class="btn btn-outline-warning">
                                                <i class="fa-solid fa-pen-to-square" style="color: #f7d708; font-size:15px"></i>
                                            </button>
                                        </a>
                                        <a href="{{ route('deleted-promotionDetail/').$iteams->promotionDetail_id }}" onclick="return confirm('Xóa danh mục này ?')">
                                            <button type="button" class="btn btn-outline-danger">
                                                <i class="fa-solid fa-trash-can" style="color: #ff0000; font-size:15px"></i>
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    @if(!isset($data2))
                        <div style="color: red">Không tìm thấy sản phẩm nào</div>
                    @endif
                </div>
            </div>
        </div>
        {{--         jquery check --}}
        {{--        <script src="{{BASE_URL.'source/customer/js/axios.main.js'}}"></script>--}}
    </section>
@endsection