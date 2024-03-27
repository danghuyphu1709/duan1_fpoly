<?php
namespace App\models\admin;
use App\Models\BaseModel;

date_default_timezone_set("Asia/Ho_Chi_Minh");
class promotion extends BaseModel{
    public $table = 'promotion';
    // promotion
    public function getPromotion (){
        // load phân tran ajax
        $sql = "SELECT * FROM ".$this->table." ORDER BY `create_at` DESC";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }

    // search
    public function searchPromotion($keyword){
        $sql = "SELECT * FROM ".$this->table."  WHERE  name like CONCAT('%', ?, '%')";
        $this->setQuery($sql);
        return $this->loadAllRows([$keyword]);
    }
    public function getPromotionDetail($id){
        $sql = "SELECT * FROM ".$this->table." WHERE id = ?";
        $this->setQuery($sql);
        return $this->loadRow([$id]);
    }
    public function postPromotion($code,$name,$desc,$value,$startTime,$endTime,$create_at,$create_by){
        $sql = "INSERT INTO ".$this->table."(`code`,`name`, `description`, `value`,`start_time`, `end_time`, `create_at`, `create_by`) VALUES (?,?,?,?,?,?,?,?)";
        $this->setQuery($sql);
        return $this->execute([$code,$name,$desc,$value,$startTime,$endTime,$create_at,$create_by]);
    }

    public function putPromotion($name,$desc,$value,$startTime,$endTime,$update_at,$update_by,$deleted,$id){
        $sql = "UPDATE `promotion` SET `name`= ?,`description`= ?,`value`= ?,`start_time`= ?,`end_time`= ?,`update_at`= ?,`update_by`= ?,`deleted`= ? WHERE id = ?";
        $this->setQuery($sql);
        return $this->execute([$name,$desc,$value,$startTime,$endTime,$update_at,$update_by,$deleted,$id]);
    }

    public function deletedPromotion($key,$id){
       $sql = "UPDATE `promotion` SET `deleted`= ? WHERE id = ?";
       $this->setQuery($sql);
       return $this->execute([$key,$id]);
    }

    /// promotion detail
    public function searchProductCategory($category_id){
        $sql = "SELECT product_detail.*,products.code as code,products.name as product_name,products.avata as products_avata,size.name as mamesize FROM `product_detail` INNER JOIN products ON product_detail.product_id = products.id INNER JOIN size ON size.id = product_detail.size_id INNER JOIN category ON products.category_id = category.id WHERE product_detail.status = 0 AND category.id = ? AND product_detail.id NOT IN (SELECT product_detail_id FROM promotion_detail)";
        $this->setQuery($sql);
        return $this->loadAllRows([$category_id]);
    }

    public function searchSynthetics($id,$keyword){
        $sql = "SELECT product_detail.*,products.code as code,products.name as product_name,products.avata as products_avata,size.name as mamesize FROM `product_detail` INNER JOIN products ON product_detail.product_id = products.id INNER JOIN size ON size.id = product_detail.size_id INNER JOIN category ON products.category_id = category.id WHERE product_detail.status = 0 AND category.id = ? AND products.name like CONCAT('%', ?, '%') AND product_detail.id NOT IN (SELECT product_detail_id FROM promotion_detail)";
        $this->setQuery($sql);
        return $this->loadAllRows([$id,$keyword]);
    }

    public function searchKeyWord($keyword){
        $sql = "SELECT product_detail.*,products.code as code,products.name as product_name,products.avata as products_avata,size.name as mamesize FROM `product_detail` INNER JOIN products ON product_detail.product_id = products.id INNER JOIN size ON size.id = product_detail.size_id WHERE product_detail.status = 0 AND products.name like CONCAT('%', ?, '%') AND product_detail.id NOT IN (SELECT product_detail_id FROM promotion_detail)";
        $this->setQuery($sql);
        return $this->loadAllRows([$keyword]);
    }
    public function getAllCategory(){
        $sql = "SELECT * FROM `category` WHERE `deleted` = 0";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function getAllProduct(){
        $sql = "SELECT product_detail.*,products.code as code,products.name as product_name,products.avata as products_avata,size.name as mamesize FROM `product_detail` INNER JOIN products ON product_detail.product_id = products.id INNER JOIN size ON size.id = product_detail.size_id WHERE product_detail.status = 0 AND product_detail.id NOT IN (SELECT product_detail_id FROM promotion_detail)";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function getApplyNow(){
        $sql = "SELECT product_detail.*,products.code as code,products.name as product_name,products.avata as products_avata,size.name as mamesize,promotion_detail.id as promotionDetail_id FROM `product_detail` INNER JOIN products ON product_detail.product_id = products.id INNER JOIN size ON size.id = product_detail.size_id INNER JOIN promotion_detail ON promotion_detail.product_detail_id = product_detail.id WHERE product_detail.id IN (SELECT product_detail_id FROM promotion_detail)";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function postDetailPromotion($product_detail_id,$promotion_id,$quantity,$price_after_reduction,$create_at,$create_by){
        $sql = "INSERT INTO `promotion_detail`(`product_detail_id`, `promotion_id`, `quantity`, `price_after_reduction`, `create_at`, `create_by`) VALUES (?,?,?,?,?,?)";
        $this->setQuery($sql);
        return $this->execute([$product_detail_id,$promotion_id,$quantity,$price_after_reduction,$create_at,$create_by]);
    }

    public function putPromotionDetail($product_detail_id,$promotion_id,$quantity,$price_after_reduction,$update_at,$update_by,$id){
        $sql = "UPDATE `promotion_detail` SET `product_detail_id`= ? ,`promotion_id`= ?,`quantity`= ? ,`price_after_reduction`= ?,`update_at`= ?,`update_by`= ? WHERE id =  ?";
        $this->setQuery($sql);
        return $this->execute([$product_detail_id,$promotion_id,$quantity,$price_after_reduction,$update_at,$update_by,$id]);
    }

    public function getDataProductDetail($id){
        $sql = "SELECT products.name as nameproduct,product_detail.id,product_detail.quantity,product_detail.price,size.name as namesize
 FROM products
INNER JOIN product_detail ON products.id = product_detail.product_id
INNER JOIN size ON product_detail.size_id = size.id
WHERE product_detail.id = ?;";
        $this->setQuery($sql);
        return $this->loadRow([$id]);
    }


    public function getPromotionAll(){
        $sql = "SELECT * FROM `promotion` WHERE `deleted` = 0";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }

    /// promotion_detail
    public function checkPromotionDetail($id){
        $sql = "SELECT * FROM `promotion_detail` WHERE product_detail_id = ?";
        $this->setQuery($sql);
        return $this->loadRow([$id]);
    }
    public function  deletedPromotionDetail($id){
        $sql = "DELETE FROM `promotion_detail` WHERE id = ?";
        $this->setQuery($sql);
        return $this->execute([$id]);
    }
    public function getOnePromotionDetail($id){
        $sql = "SELECT promotion_detail.*,promotion.name,promotion.value FROM `promotion_detail` INNER JOIN promotion ON promotion_detail.promotion_id = promotion.id WHERE promotion_detail.id = ?";
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
        $sql = "SELECT * FROM ".$this->table." WHERE `code` = ?";
        $this->setQuery($sql);
        $result = $this->loadRow([$number]);
        return !empty($result);
    }
}