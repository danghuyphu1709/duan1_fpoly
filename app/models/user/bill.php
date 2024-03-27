<?php
namespace App\models\user;
use App\models\BaseModel;

class bill extends BaseModel {


    public function listBill($id)
    {
         $sql = "SELECT bill.id,bill.code,bill.total_mony_after_reduction,bill.total_mony_before_reduction,bill.total_mony,bill.status,bill.create_at FROM `bill` WHERE deleted = 0 AND account_id = ? ORDER BY
    create_at DESC";
         $this->setQuery($sql);
         return $this->loadAllRows([$id]);

    }
    public function updateBill($key,$id)
    {
        $sql = "UPDATE `bill` SET `status` = ? WHERE id = ?";
        $this->setQuery($sql);
        return $this->execute([$key,$id]);
    }
    public function billDetail($id)
    {
        $sql = "SELECT bill.status,bill.code ,bill.total_mony_after_reduction,bill.total_mony_before_reduction,bill.total_mony,bill.create_at,voucher.name as name_voucher,payment.name as name_payment,delivery_address.name as name_user,delivery_address.phone,
                delivery_address.address_detail,province_city.name as name_city,district.name as name_district,ward.name as name_ward,village.name as name_village FROM bill INNER JOIN payment ON payment.id = bill.payment_id INNER JOIN delivery_address ON delivery_address.id = bill.adress_id 
                INNER JOIN province_city ON delivery_address.city_province_id = province_city.id INNER JOIN district ON district.id = delivery_address.district_id INNER JOIN ward ON ward.id = delivery_address.ward_id 
                INNER JOIN village ON village.id = delivery_address.village_id LEFT JOIN voucher ON voucher.id = bill.voucher_id WHERE bill.id = ?";
        $this->setQuery($sql);
        return $this->loadRow([$id]);
    }
    public function listBillDetail($id)
    {
        $sql = "SELECT products.name,products.avata,size.name as size_name,detail_bill.product_detail_id,detail_bill.quantity,detail_bill.price,detail_bill.promotion_price FROM `detail_bill` INNER JOIN product_detail ON detail_bill.product_detail_id = product_detail.id INNER JOIN size ON size.id = product_detail.size_id INNER JOIN products ON products.id = product_detail.product_id WHERE detail_bill.bill_id = ?";
        $this->setQuery($sql);
        return $this->loadAllRows([$id]);
    }
}