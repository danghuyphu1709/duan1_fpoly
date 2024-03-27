<?php
namespace App\controllers\admin;

use App\Controllers\BaseController;

class statisticalController extends BaseController{

    public function index (){
        return $this->render('statistical.main');
    }
}
