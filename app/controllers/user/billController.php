<?php
namespace App\controllers\user;
use App\controllers\BaseController;
use App\models\user\bill;
class billController extends BaseController  {

    public function __construct()
    {
        $this->bill = new bill();
    }

    public function index()
    {
        $bill = $this->bill->listBill($_SESSION['auth']);
        return $this->render('bill.bill',compact(['bill']));
    }

    public function updateBill($key,$id)
    {
        if(isset($id) && isset($key)){
            $result = $this->bill->updateBill($key,$id);
            if($result){
                header('Location: ' . BASE_URL . 'bill');
            }
        }
    }
    public function billDetail($id)
    {
        $detail = $this->bill->billDetail($id);
        $listDetail = $this->bill->listBillDetail($id);
        return $this->render('bill.detail',compact(['detail','listDetail']));

    }

}
