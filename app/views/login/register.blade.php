@extends('layout-login.main')

@section('main-content')
<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Đăng ký tài khoản!</h1>
                        </div>
                        <form class="user" action="{{ route('create-account') }}" method="post" id="form">
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" id="name" placeholder="Nhập họ tên" name="name">
                                    @if(isset($_SESSION['errors']) && isset($_GET['msg']))
                                        <div style="color: red">{{$_SESSION['errors']['name']}}</div>
                                    @endif
                                </div>
                                <div class="col-sm-6">
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">84+</div>
                                            </div>
                                            <input type="number" class="form-control form-control-user" id="phone"
                                                   placeholder="Nhập số điện điện thoại" min="0" name="phone" >
                                        </div>
                                    @if(isset($_SESSION['errors']) && isset($_GET['msg']))
                                        <div style="color: red">{{$_SESSION['errors']['phone1']}}</div>
                                    @endif
                                    @if(isset($_SESSION['errors']) && isset($_GET['msg']))
                                        <div style="color: red">{{$_SESSION['errors']['phone2']}}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user"
                                       id="email" placeholder=" Nhập email" name="email">
                                @if(isset($_SESSION['errors']) && isset($_GET['msg']))
                                    <div style="color: red">{{$_SESSION['errors']['email1']}}</div>
                                @endif
                                @if(isset($_SESSION['errors']) && isset($_GET['msg']))
                                    <div style="color: red">{{$_SESSION['errors']['email2']}}</div>
                                @endif

                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user"
                                       id="username" placeholder="Nhập tên tài khoản" name="username">
                                @if(isset($_SESSION['errors']) && isset($_GET['msg']))
                                    <div style="color: red">{{$_SESSION['errors']['username']}}</div>
                                @endif
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user"
                                           id="password" placeholder="Nhập Password" name="password">
                                    @if(isset($_SESSION['errors']) && isset($_GET['msg']))
                                        <div style="color: red">{{$_SESSION['errors']['password']}}</div>
                                    @endif
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user"
                                           id="exampleRepeatPassword" placeholder="Nhập lại Password" name="request_password">

                                    @if(isset($_SESSION['errors']) && isset($_GET['msg']))
                                        <div style="color: red">{{$_SESSION['errors']['request_password']}}</div>
                                    @endif

                                </div>
                            </div>
                            @if(isset($_SESSION['success']) && isset($_GET['msg']))
                                <span style="color: green">{{$_SESSION['success']}} <a href="{{ route('list-customer') }}">Quay Lại</a></span>
                            @endif
                            <input type="submit" class="btn btn-success btn-user btn-block" name="create_account" value="Tạo tài khoản">

                        </form>
                        <hr>
                        @if(isset($_SESSION['auth']))
                            <div class="text-center">
                                <a class="small" href="{{ route('dashboard') }}">Quay lại Dashboar</a>
                            </div>
                        @endif
                        <div class="text-center">
                            <a class="small" href="?">Quên mật khẩu?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="{{route('login')}}">Bạn đã có tài khoản rồi</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection