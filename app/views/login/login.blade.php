@extends('layout-login.main')
@section('main-content')
<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Chào mừng bạn!</h1>
                                </div>
                                <form class="user" action="{{ route('checkAccount')}}" method="post">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user"
                                               id="exampleInputEmail" aria-describedby="emailHelp"
                                               placeholder="Enter Email Address..." name="username">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user"
                                               id="exampleInputPassword" placeholder="Password" name="password">
                                    </div>
                                    @if(isset($_SESSION['errors']) && isset($_GET['msg']))
                                        <div style="color: red">{{$_SESSION['errors']['username']}}</div>
                                    @endif
                                    @if(isset($_SESSION['errors']) && isset($_GET['msg']))
                                        <div style="color: red">{{$_SESSION['errors']['password']}}</div>
                                    @endif
                                    <input type="submit" class="btn btn-success btn-user btn-block" value="Login">
                                    <hr>
                                </form>
                                @if(isset($_SESSION['auth']))
                                    <div class="text-center">
                                        <a class="small" href="{{ route('dashboard') }}">Quay lại Dashboar</a>
                                    </div>
                                @endif
                                <div class="text-center">
                                    <a class="small" href="/">Quên mật khẩu?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="{{ route('register') }}">Tạo tài khoản !</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection
