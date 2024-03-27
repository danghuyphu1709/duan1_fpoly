<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Dashboard</title>

    @php
        if(!isset($_SESSION['role'])) {
                header('Location: ' . BASE_URL . 'login');
            }
        elseif($_SESSION['role'] === 0){
            header('Location: /404');
            }
    @endphp
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">
     @include('layout.source')
</head>
@include('layout.header')
@yield('main-content')
@include('layout.footer')
