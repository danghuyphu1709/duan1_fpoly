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
                <form action="{{ route('search-product-promotion')}}" method="post"
                      class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="row">
                        <div class="col">
                            <select class="form-control" aria-label="Default select example" id='category_insert'
                                    name="category">
                                <option selected value="0">Tất cả sản phẩm</option>
                                @foreach($data as $iteams)
                                    <option value="{{ $iteams->id }}">{{ $iteams->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control bg-light border-0 small"
                                   placeholder="Tên sản phẩm..."
                                   aria-label="Search" aria-describedby="basic-addon2" name="product_name">
                        </div>
                        <div class="col">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <div class="text-right">
                    <a href="{{ route('apply-now')}}">
                        <button type="button" class="btn btn-outline-warning">
                            Danh sách đang khuyến mãi
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
                                        <a href="{{ route('add-PromotionDetail/').$iteams->id }}">
                                            <button type="button" class="btn btn-outline-info">
                                                Áp dụng
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