<?php
namespace App\models\user;
use App\models\BaseModel;

class cart extends BaseModel {

    public function addToCart($account_id,$product_id,$product_detail_id,$quantity,$create_at,$create_by)
    {
           $sql = "INSERT INTO `cart` (`account_id`, `products_id`, `product_detail_id`, `quantity`, `create_at`, `create_by`) VALUES (?,?,?,?,?,?)";
           $this->setQuery($sql);
           return $this->execute([$account_id,$product_id,$product_detail_id,$quantity,$create_at,$create_by]);
    }

    public function listCart($id)
    {
        $sql = "SELECT cart.id AS cart_id,products.name as product_name, products.id AS products_id,products.avata,product_detail.price,cart.quantity,
    size.name ,
    promotion_detail.price_after_reduction,product_detail.quantity as quantity_max 
FROM 
    cart
INNER JOIN 
    products ON cart.products_id = products.id
INNER JOIN 
    product_detail ON cart.product_detail_id = product_detail.id
LEFT JOIN 
    size ON product_detail.size_id = size.id 
LEFT JOIN 
    promotion_detail ON product_detail.id = promotion_detail.product_detail_id 
WHERE 
    cart.account_id = ?";
        $this->setQuery($sql);
        return $this->loadAllRows([$id]);
    }

    public function checkCart($id_products,$product_detail_id)
    {
        $sql = "SELECT cart.id,cart.quantity FROM `cart` WHERE cart.products_id = ? AND cart.product_detail_id = ?";
        $this->setQuery($sql);
        return $this->loadRow([$id_products,$product_detail_id]);

    }
    public function updateQuantityCart($quantity,$id)
    {
        $sql = "UPDATE `cart` SET `quantity`= ? WHERE id = ?";
        $this->setQuery($sql);
        return $this->execute([$quantity,$id]);
    }

    public function cartDelete($id)
    {
        $sql = "DELETE FROM `cart` WHERE id = ?";
        $this->setQuery($sql);
        return $this->execute([$id]);

    }

    public function filterDiscountCodeVoucher()
    {
      $sql = "SELECT id, name, minimum_amount,value
            FROM voucher 
            WHERE deleted = 0 ";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function address()
    {
        $sql = "SELECT id, name, phone,address_detail
            FROM delivery_address 
            WHERE deleted = 0 ";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function payment()
    {
        $sql = "SELECT *
            FROM payment 
            WHERE deleted = 0 ";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }

    public function createBill($account,$payment,$adress,$voucher,$code,$total_mony_after_reduction,$total_mony_before_reduction,$total_mony,$create_at,$create_by)
    {
        $sql = "INSERT INTO `bill`(`account_id`, `payment_id`, `adress_id`, `voucher_id`, `code`, `total_mony_after_reduction`, `total_mony_before_reduction`, `total_mony`, `create_at`, `create_by`)
               VALUES (?,?,?,?,?,?,?,?,?,?)";
        $this->setQuery($sql);
        $success = $this->execute([$account,$payment,$adress,$voucher,$code,$total_mony_after_reduction,$total_mony_before_reduction,$total_mony,$create_at,$create_by]);
        if($success){
            $lastid = $this->getLastId();
            return $lastid;
        }
        return null;
    }
    public function product_cart($id)
    {
        $sql = "SELECT cart.id as cart_id,product_detail.id AS product_detail_id,product_detail.price,
    promotion_detail.price_after_reduction,product_detail.quantity
FROM 
    cart
INNER JOIN 
    products ON cart.products_id = products.id
INNER JOIN 
    product_detail ON cart.product_detail_id = product_detail.id
LEFT JOIN 
    promotion_detail ON product_detail.id = promotion_detail.product_detail_id 
WHERE 
    cart.account_id = ?";
        $this->setQuery($sql);
        return $this->loadAllRows([$id]);

    }

    public function createBillDetail($bill,$product_detail,$quantity,$price,$promotion_price,$create_at,$create_by)
    {
        $sql = "INSERT INTO `detail_bill`(`bill_id`, `product_detail_id`, `quantity`, `price`, `promotion_price`, `create_at`, `create_by`) 
VALUES (?,?,?,?,?,?,?)";
        $this->setQuery($sql);
        return $this->execute([$bill,$product_detail,$quantity,$price,$promotion_price,$create_at,$create_by]);
    }

    public function searchQuantity($id)
    {
        $sql = "SELECT `id`,`quantity` FROM `product_detail` WHERE id = ?";
        $this->setQuery($sql);
        return $this->loadRow([$id]);
    }
    public function searchProductQuantity($id)
    {
        $sql = "SELECT cart.id,cart.product_detail_id,product_detail.quantity FROM `cart` INNER JOIN product_detail ON cart.product_detail_id = product_detail.id WHERE cart.id = ?";
        $this->setQuery($sql);
        return $this->loadRow([$id]);
    }

    public function updateQuantity($quantity,$id)
    {
        $sql = "UPDATE `product_detail` SET `quantity`= ? WHERE id = ?";
        $this->setQuery($sql);
        return  $this->execute([$quantity,$id]);
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


    public function create_code() {
        $min = 1000000; // Giá trị nhỏ nhất có 7 chữ số
        $max = 9999999; // Giá trị lớn nhất có 7 chữ số
        $randomNumber = mt_rand($min, $max);

        // Kiểm tra số và tạo số mới nếu đã tồn tại trong cơ sở dữ liệu
        while ($this->createcodeExists($randomNumber)) {
            $randomNumber = mt_rand($min, $max);
        }
        return $randomNumber;
    }

    public function createcodeExists($number) {
        $sql = "SELECT * FROM bill WHERE `code` = ?";
        $this->setQuery($sql);
        $result = $this->loadRow([$number]);
        return !empty($result);
    }


}
