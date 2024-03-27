<?php
namespace App\controllers\admin;
use App\controllers\BaseController;
use App\models\admin\bill;

class billController extends BaseController
{
    public function __construct()
    {
        $this->bill = new bill();
    }

    public function index()
    {
          $bill = $this->bill->listBill();
          return $this->render('manageBill.view',compact(['bill']));
    }
    public function updateStatus($key,$id)
    {
         if(isset($key) && isset($id)){
             $result = $this->bill->updateBill($key,$id);
             if($result){
                 header('Location: ' . BASE_URL . 'manage/bill');
             }
         }
    }
    public function searchBill()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $code = $_POST['code'];
            $bill = $this->bill->searchBill($code);
            if(empty($bill)){
                $errors['code'] = "không tìm thấy đơn hàng nào";
                flash('errors',$errors,'manage/bill');
            }
            return $this->render('manageBill.view',compact(['bill']));
        }

    }
}