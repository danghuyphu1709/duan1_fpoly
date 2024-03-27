<?php
namespace App\controllers\user;
use App\controllers\BaseController;
use App\models\user\address;
class addressController extends BaseController  {


    public function __construct()
    {
        $this->address = new address();
    }

    public function add()
    {
       $provinceCity = $this->address->addressCity();
       $this->render('addressCart.add',compact('provinceCity'));
    }

    public function addToAddress()
    {
        if(isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']){
           $account = $_SESSION['auth'];
           $name = $_POST['name'];
           $phone = $_POST['phone'];
           $address_detail = $_POST['address_detail'];
           $province = $_POST['province'];
           $district = $_POST['district'];
           $ward = $_POST['ward'];
           $village = $_POST['village'];
           $result = $this->address->createDeliveryAddress($account,$village,$ward,$district,$province,$name,$phone,$address_detail);
           if($result){
               flash('success','Thêm địa chỉ thành công','address/add');
           }

        }
    }



    /// ajjax

    public function district()
    {
        if(isset($_POST['id'])){
              $id = $_POST['id'];
              $distric = $this->address->addressDistrict($id);
              $_SESSION['distric'] = $distric;
              echo  json_encode($distric);
        }

    }
    public function ward()
    {
        if(isset($_POST['id'])){
            $id = $_POST['id'];
            $ward = $this->address->addressWard($id);
            echo  json_encode($ward);
        }

    }

    public function village()
    {
        if(isset($_POST['id'])){
            $id = $_POST['id'];
            $village = $this->address->addressVillage($id);
            echo  json_encode($village);
        }

    }
}
