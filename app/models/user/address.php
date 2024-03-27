<?php
namespace App\models\user;
use App\models\BaseModel;

class address extends BaseModel {


    public function addressCity()
    {
        $sql = "SELECT * FROM `province_city` WHERE status = 0";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function addressDistrict($id)
    {
        $sql = "SELECT * FROM `district` WHERE status = 0 AND province_city_id = ?";
        $this->setQuery($sql);
        return $this->loadAllRows([$id]);
    }

    public function addressWard($id)
    {
        $sql = "SELECT * FROM `ward` WHERE status = 0 AND district_id = ?";
        $this->setQuery($sql);
        return $this->loadAllRows([$id]);
    }
    public function addressVillage($id)
    {
        $sql = "SELECT * FROM `village` WHERE status = 0 AND ward_id = ?";
        $this->setQuery($sql);
        return $this->loadAllRows([$id]);
    }

    public function createDeliveryAddress($account,$village,$ward,$district,$city_province,$name,$phone,$address_detail)
    {
        $sql ="INSERT INTO `delivery_address`(`account_id`, `village_id`, `ward_id`, `district_id`, `city_province_id`, `name`, `phone`, `address_detail`) VALUES (?,?,?,?,?,?,?,?)";
        $this->setQuery($sql);
        return $this->execute([$account,$village,$ward,$district,$city_province,$name,$phone,$address_detail]);
    }

}