@extends('layout.main')
@section('main-content')
    <section class="container-fluid mt-3ct">
        <div class="card shadow mb-4">
            <div class="card-header py-3 ">
                <a href="{{ route('manage/promotion') }}" class="text-decoration-none"><h4 class="text-center text-black-50"> Khuyễn mãi </h4></a>
                <div class="d-flex justify-content-between" >
                    <div class="">
                        <a href="{{ route('apply-promotion') }}">
                            <button type="button" class="btn btn-warning">
                                Danh sách sản phẩm
                            </button>
                        </a>
                    </div>
                    <div class="">
                        <a href="{{ route('add-promotion') }}">
                            <button type="button" class="btn btn-success">
                                <i class="fa-solid fa-plus" style="font-size: 15px"></i>Thêm khuyễn mãi</button>
                        </a>
                    </div>
                </div>
                <div class="mt-3">
                    <form action="{{ route('search-promotion')}}" method="post"
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
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Code</th>
                            <th>Tên khuyến mại </th>
                            <th>Giá trị</th>
                            <th>Ngày tạo</th>
                            <th>Người tạo</th>
                            <th>Áp dụng</th>
                            <th>Trạng thái</th>
                            <th class="text-right">Thao Tác</th>
                        </tr>
                        </thead>
                        <tbody>
                  @if(isset($data))
                      @foreach($data as $iteams)
                          <tr id="list-cate">
                              <td>{{$iteams->code}}</td>
                              <td>{{$iteams->name}}</td>
                              <td>{{$iteams->value}}%</td>
                              <td>{{$iteams->create_at}}</td>
                              <td>{{$iteams->create_by}}</td>
                              <td> @if ($iteams->status == 0)
                                      Đang áp dụng
                                  @elseif ($iteams->status == 1)
                                      Ngừng áp dụng
                                  @endif
                              </td>
                              <td> @if ($iteams->deleted == 0)
                                      Đang hoạt động
                                  @elseif ($iteams->deleted == 1)
                                      Đã khóa
                                  @endif
                              </td>
                              <td class="text-right">
                                  <a href="{{ route('detail-promotion/').$iteams->id }}">
                                      <button type="button" class="btn btn-outline-info">
                                          <i class="fa-regular fa-eye" style="color: #00ff33; font-size:15px"></i>
                                      </button>
                                  </a>
                                  <a href="{{ route('edit-promotion/').$iteams->id }}">
                                      <button type="button" class="btn btn-outline-warning">
                                          <i class="fa-solid fa-pen-to-square" style="color: #f7d708; font-size:15px"></i>
                                      </button>
                                  </a>
                                  <a href="{{ route('deleted-promotion/').$iteams->id }}" onclick="return confirm('Khóa danh mục này ?')">
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
                </div>
            </div>
        </div>
    </section>
@endsection