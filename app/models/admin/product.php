<?php
namespace App\models\admin;
use App\Models\BaseModel;

class product extends BaseModel{
    public $table_product  = 'products';
    public $table_product_detail = 'product_detail';

    public function getProduct(){
        $sql = "SELECT *,products.code as code_product,products.id as product_id,products.name as nameproduct,products.deleted as deleted_product,category.name as namecate FROM ".$this->table_product." INNER JOIN `category` ON products.category_id = category.id ORDER BY products.create_at DESC";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }

    public function getDetailProduct($id){
        $sql = "SELECT * FROM ".$this->table_product." WHERE id = ?";
        $this->setQuery($sql);
        return $this->loadRow([$id]);
    }

    public function getAllProductDetail($id){
        $sql = "SELECT products.description,products.name AS nameproduct,products.update_at,products.update_by,product_detail.quantity,product_detail.price,product_detail.status,size.name as namesize
                   FROM products
                INNER JOIN product_detail ON products.id = product_detail.product_id
                INNER JOIN size ON product_detail.size_id = size.id
                    WHERE products.id = ?";
        $this->setQuery($sql);
        return $this->loadAllRows([$id]);
    }
    public function getImage($id){
        $sql = "SELECT * FROM `image` WHERE product_id = ?";
        $this->setQuery($sql);
        return $this->loadAllRows([$id]);
    }
    public function getDataProductDetail($id){
        $sql = "SELECT products.id as id_prd,product_detail.product_id as product_id,product_detail.id,product_detail.quantity,product_detail.price,product_detail.status,size.id as idsize ,size.name as namesize
                      FROM products
               INNER JOIN product_detail ON products.id = product_detail.product_id
               INNER JOIN size ON product_detail.size_id = size.id
                      WHERE products.id = ?;";
        $this->setQuery($sql);
        return $this->loadAllRows([$id]);
    }

    public function getAllSize(){
      $sql = "SELECT * FROM `size` WHERE `deleted` = 0";
      $this->setQuery($sql);
      return $this->loadAllRows();
    }
    public function getAllCategory(){
        $sql = "SELECT * FROM `category` WHERE `deleted` = 0";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function postProduct($category_id,$code,$name,$desc,$avata,$price_max,$price_min,$create_at,$create_by){
        $sql = "INSERT INTO ".$this->table_product."(`category_id`,`code`, `name`, `description`,`avata`,`price_max`,`price_min`, `create_at`, `create_by`) VALUES (?,?,?,?,?,?,?,?,?)";
        $this->setQuery($sql);
        $success = $this->execute([$category_id,$code,$name,$desc,$avata,$price_max,$price_min,$create_at,$create_by]);
        if($success){
            $lastid = $this->getLastId();
            return $lastid;
        }
        return null;
    }
    public function postProductDetail($product_id,$size_id,$quantity,$price){
        $sql = "INSERT INTO ".$this->table_product_detail."(`product_id`, `size_id`, `quantity`, `price`) VALUES (?,?,?,?)";
        $this->setQuery($sql);
        return $this->execute([$product_id,$size_id,$quantity,$price]);
    }
    /// search
    public function searchProductCategory($category_id){
        $sql = "SELECT *,products.id as product_id,products.name as nameproduct,products.deleted as deleted_product,category.name as namecate FROM $this->table_product INNER JOIN `category` ON products.category_id = category.id WHERE category_id = ?";
        $this->setQuery($sql);
        return $this->loadAllRows([$category_id]);
    }

    public function searchSynthetics($keyword,$id){
        $sql = "SELECT *,products.id as product_id,products.name as nameproduct,products.deleted as deleted_product,category.name as namecate FROM $this->table_product INNER JOIN `category` ON products.category_id = category.id WHERE products.name like CONCAT('%', ?, '%') AND category_id = ?";
        $this->setQuery($sql);
        return $this->loadAllRows([$keyword,$id]);
    }

    public function searchKeyWord($keyword){
        $sql = "SELECT *,products.id as product_id,products.name as nameproduct,products.deleted as deleted_product,category.name as namecate FROM $this->table_product INNER JOIN `category` ON products.category_id = category.id WHERE  products.name like CONCAT('%', ?, '%')";
        $this->setQuery($sql);
        return $this->loadAllRows([$keyword]);
    }

    public function getAllProduct(){
        $sql = "SELECT *,products.id as product_id,products.name as nameproduct,products.deleted as deleted_product,category.name as namecate FROM $this->table_product INNER JOIN `category` ON products.category_id = category.id";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
///
    public function putProduct($category_id,$name,$desc,$avata,$price_max,$price_min,$update_at,$update_by,$deleted,$id){
        $sql = "UPDATE $this->table_product SET `category_id`= ?,`name`= ?,`description`= ?,`avata`=?,`price_max`= ?,`price_min` = ?,`update_at`= ?,`update_by`= ?,`deleted`= ? WHERE id = ?";
        $this->setQuery($sql);
        return $this->execute([$category_id,$name,$desc,$avata,$price_max,$price_min,$update_at,$update_by,$deleted,$id]);
    }

    public function putProductDetail($quantity,$price,$status,$id,$size){
        $sql = "UPDATE $this->table_product_detail SET `quantity`= ?,`price`= ?,`status`= ?  WHERE product_id = ? AND  size_id = ?";
        $this->setQuery($sql);
        return $this->execute([$quantity,$price,$status,$id,$size]);
    }

    public function deletedProduct($key,$id){
        $sql = 'UPDATE `products` SET `deleted`= ? WHERE id = ?';
        $this->setQuery($sql);
        return $this->execute([$key,$id]);
    }
    public function putStatusDetail($key,$id){
        $sql = 'UPDATE `product_detail` SET `status`= ? WHERE id = ?';
        $this->setQuery($sql);
        return $this->execute([$key,$id]);
    }
    public function putStatusProduct($key,$id){
        $sql = 'UPDATE `product` SET `deleted`= ? WHERE id = ?';
        $this->setQuery($sql);
        return $this->execute([$key,$id]);
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
        $sql = "SELECT * FROM ".$this->table_product." WHERE `code` = ?";
        $this->setQuery($sql);
        $result = $this->loadRow([$number]);
        return !empty($result);
    }


    public function create_code_image() {
        $min = 1000000; // Giá trị nhỏ nhất có 7 chữ số
        $max = 9999999; // Giá trị lớn nhất có 7 chữ số
        $randomNumber = mt_rand($min, $max);

        // Kiểm tra số và tạo số mới nếu đã tồn tại trong cơ sở dữ liệu
        while ($this->createcodeExists($randomNumber)) {
            $randomNumber = mt_rand($min, $max);
        }
        return $randomNumber;
    }
    public function createcodeExistsImage($number) {
        $sql = "SELECT * FROM `image` WHERE `code` = ?";
        $this->setQuery($sql);
        $result = $this->loadRow([$number]);
        return !empty($result);
    }
}