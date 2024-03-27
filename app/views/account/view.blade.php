@extends('layout.main')
@section('main-content')
    <section class="container-fluid mt-3ct">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
               <a href="{{ route('manage/account') }}" class="text-decoration-none"><h4 class="text-black-50 text-center">Tài Khoản </h4></a>
                <form action="{{ route('search-account')}}" method="post"
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
                            <th>Tên người dùng</th>
                            <th>Username</th>
                            <th>Vai trò</th>
                            <th>Ngày tạo</th>
                            <th>Trạng thái</th>
                            <th class="text-right">Thao Tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($data))
                            @foreach($data as $iteams)
                                <tr id="list-cate">
                                    <td>{{$iteams->codeAccount}}</td>
                                    <td>{{$iteams->name}}</td>
                                    <td>{{$iteams->username}}</td>
                                    <td>{{$iteams->name_role}}</td>
                                    <td>{{$iteams->create_at}}</td>
                                    <td> @if ($iteams->status == 0)
                                            Đang hoạt động
                                        @elseif ($iteams->status == 1)
                                            Ngừng hoạt động
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        <a href="{{ route('detail-account/').$iteams->idAccount }}">
                                            <button type="button" class="btn btn-outline-info">
                                                <i class="fa-regular fa-eye" style="color: #00ff33; font-size:15px"></i>
                                            </button>
                                        </a>
                                        @if ($_SESSION['role'] == 2)
                                            <a href="{{ route('edit-account/').$iteams->idAccount}}">
                                                <button type="button" class="btn btn-outline-warning">
                                                    <i class="fa-solid fa-pen-to-square" style="color: #f7d708; font-size:15px"></i>
                                                </button>
                                            </a>
                                        @endif
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
