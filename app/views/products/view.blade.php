@extends('layout.main')
@section('main-content')
    <section class="container-fluid mt-3ct">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="{{ route('manage/product') }}" class="text-decoration-none"><h4 class="text-black-50 text-center">Sản phẩm </h4></a>
                <div class="text-right">
                    <a href="{{ route('add-product') }}">
                        <button type="button" class="btn btn-success">
                            <i class="fa-solid fa-plus" style="font-size: 15px"></i>Thêm sản phẩm</button>
                    </a>
                </div>
                <form action="{{ route('search-product')}}" method="post"
                      class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="row">
                        <div class="col">
                            <select class="form-control" aria-label="Default select example" id='category_insert'
                                    name="category">
                                <option selected value="0">Tất cả sản phẩm</option>
                                @foreach($category as $iteams)
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
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table-product" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Code</th>
                            <th>ảnh sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Danh mục sản phẩm</th>
                            <th>Ngày tạo</th>
                            <th>Người tạo</th>
                            <th>Trạng thái</th>
                            <th class="text-right">Thao Tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($data))
                        @foreach($data as $iteams)
                        <tr id="list-cate">
                            <td>{{$iteams->code_product}}</td>
                            <td><img src="{{ route('upload/').$iteams->avata}}" width="100px"></td>
                            <td>{{$iteams->nameproduct}}</td>
                            <td>{{$iteams->namecate}}</td>
                            <td>{{$iteams->create_at}}</td>
                            <td>{{$iteams->create_by}}</td>
                            <td> @if ($iteams->deleted_product == 0)
                                    Đang hoạt động
                                @elseif ($iteams->deleted_product == 1)
                                    Ngừng hoạt động
                                @endif
                            </td>
                            <td class="text-right">
                                <a href="{{ route('detail-product/').$iteams->product_id }}">
                                    <button type="button" class="btn btn-outline-info">
                                        <i class="fa-regular fa-eye" style="color: #00ff33; font-size:15px"></i>
                                    </button>
                                </a>
                                <a href="{{ route('edit-product/').$iteams->product_id }}">
                                    <button type="button" class="btn btn-outline-warning">

                                        <i class="fa-solid fa-pen-to-square" style="color: #f7d708; font-size:15px"></i>
                                    </button>
                                </a>
                                <a href="{{ route('deleted-product/').$iteams->product_id }}" onclick="return confirm('Khóa danh mục này ?')">
                                    <button type="button" class="btn btn-outline-danger">
                                        <i class="fa-solid fa-trash-can" style="color: #ff0000; font-size:15px"></i>
                                    </button>
                                </a>
                               <div class="mt-2">
                                   <a href="{{ route('image-product/').$iteams->product_id }}">
                                       <button type="button" class="btn btn-outline-info">
                                           Ảnh sản phẩm
                                       </button>
                                   </a>
                               </div>
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