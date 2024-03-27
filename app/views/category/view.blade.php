@extends('layout.main')
@section('main-content')
<div class="container-fluid">
    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3" >
            <a href=" {{ route('manage/category') }}" class="text-decoration-none"><h1 class="h3 mb-2 text-gray-800 text-center">Danh Mục</h1></a>
           <div class="text-right">
               <a href="{{ route('add-category') }}">
                   <button type="button" class="btn btn-success">
                       <i class="fa-solid fa-plus" style="font-size: 15px"></i>Thêm Danh Mục</button>
               </a>
           </div>
            <form action="{{ route('search-category')}}" method="post"
                  class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control bg-light border-0 small"
                               placeholder="Tên sản phẩm..."
                               aria-label="Search" aria-describedby="basic-addon2" name="keyword">

                    </div>
                    <div class="col">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
                @if(isset($_SESSION['errors']) && isset($_GET['msg']))
                    <div style="color: red" class="mt-3">{{$_SESSION['errors']['keyword']}}</div>
                @endif
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Code</th>
                        <th>Tên Danh Mục</th>
                        <th>Thời Gian Tạo</th>
                        <th>Người tạo</th>
                        <th>Trạng Thái</th>
                        <th class="text-right">Thao Tác</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($data))
                   @foreach($data as $iteams)
                    <tr id="list-cate">
                        <td>{{ $iteams->code }}</td>
                        <td>{{ $iteams->name }}</td>
                        <td>{{ $iteams->create_at }}</td>
                        <td>{{ $iteams->create_by }}</td>
                        <td> @if ($iteams->deleted == 0)
                                Đang hoạt động
                            @elseif ($iteams->deleted == 1)
                                 Ngừng hoạt động
                            @endif
                        </td>
                        <td class="text-right">
                            <a href="{{ route('detail-category').'/'. $iteams->id}}">
                                <button type="button" class="btn btn-outline-success">
                                    <i class="fa-solid fa-eye" style="color: #20f708; font-size:15px"></i>
                                </button>
                            </a>
                            <a href="{{ route('edit-category').'/'. $iteams->id}}">
                                <button type="button" class="btn btn-outline-warning">
                                    <i class="fa-solid fa-pen-to-square" style="color: #f7d708; font-size:15px"></i>
                                </button>
                            </a>
                            <a href="{{ route('deleted-category').'/'. $iteams->id }}" onclick="return confirm('Khóa danh mục này ?')">
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
                <nav aria-label="Page navigation example">
                    <ul class="pagination">

                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection