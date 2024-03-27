<?php
const DBNAME = "duan1_fpoly";
const DBUSER = "root";
const DBPASS = "";
const DBCHARSET = "utf8";
const DBHOST = "127.0.0.1";
const BASE_URL = "http://localhost/duan1_fpoly/";

function route($url){
    return BASE_URL.$url;
}

function flash($key,$msg,$route){
    $_SESSION[$key] = $msg;
    switch ($key){
        case 'success':
            unset($_SESSION['errors']);
            break;
        case 'errors':
            unset($_SESSION['success']);
            break;
    }
    header('location:'.BASE_URL.$route.'?msg='.$key);die;
}




function create_at(){
    $datetime = date('Y-m-d H:i:s');
    return $datetime;
}
function date_now() {
    $datetime = date('Y-m-d\TH:i');
    return $datetime;
}
