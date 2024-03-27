<?php
namespace App\models\user;
use App\models\BaseModel;

class products extends BaseModel
{
    public function getListCategory()
    {
        $sql = "SELECT * FROM `category` WHERE deleted = 0";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }

    public function searchProduct($keyword)
    {
        $sql = "SELECT products.id,products.name,products.avata,products.price_max,products.price_min,category.name as category_name,products.category_id FROM `products` INNER JOIN category ON products.category_id = category.id WHERE products.deleted = 0 AND products.name like CONCAT('%', ?, '%') ORDER BY products.create_at";
        $this->setQuery($sql);
        return $this->loadAllRows([$keyword]);
    }

    public function getAllProduct()
    {
        $sql = "SELECT * FROM `products`  WHERE deleted = 0";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }

    public function pagination($location,$quantity)
    {
        $sql = "SELECT products.id,products.name,products.avata,products.price_max,products.price_min,category.name as category_name,products.category_id FROM `products` INNER JOIN category ON products.category_id = category.id WHERE products.deleted = 0 ORDER BY products.create_at DESC LIMIT $location,$quantity";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }

    public function paginationOld($location,$quantity)
    {
        $sql = "SELECT products.id,products.name,products.avata,products.price_max,products.price_min,category.name as category_name,products.category_id FROM `products` INNER JOIN category ON products.category_id = category.id WHERE products.deleted = 0 ORDER BY products.create_at ASC LIMIT $location,$quantity";
        $this->setQuery($sql);
        return $this->loadAllRows();

    }

    public function filterCategory($id)
    {
        $sql = "SELECT * FROM `products`  WHERE deleted = 0 AND category_id = ?";
        $this->setQuery($sql);
        return $this->loadAllRows([$id]);
    }

    public function paginationfilterCategory($id,$location,$quantity)
    {
        $sql = "SELECT products.id,products.name,products.avata,products.price_max,products.price_min,category.name as category_name,products.category_id FROM `products` INNER JOIN category ON products.category_id = category.id WHERE products.deleted = 0 AND products.category_id = ? ORDER BY products.create_at DESC LIMIT $location,$quantity";
        $this->setQuery($sql);
        return $this->loadAllRows([$id]);
    }

    public function productDetail($id)
    {
        $sql = "SELECT products.id,products.name,products.avata,products.price_max,products.price_min,products.description,products.category_id,category.name as category_name FROM `products` INNER JOIN category ON products.category_id = category.id WHERE products.deleted = 0 AND products.id = ?";
        $this->setQuery($sql);
        return $this->loadRow([$id]);
    }

    public function getSizeName($id)
    {
       $sql = "SELECT size.name,size.id,product_detail.id as detail_id,product_detail.quantity FROM `product_detail` INNER JOIN size ON product_detail.size_id = size.id WHERE product_detail.product_id = ?";
        $this->setQuery($sql);
        return $this->loadAllRows([$id]);
    }

    public function getPriceSize($id)
    {
        $sql = "SELECT product_detail.price,promotion_detail.price_after_reduction FROM product_detail LEFT JOIN promotion_detail ON product_detail.id = promotion_detail.product_detail_id WHERE 
             product_detail.id = ?";
        $this->setQuery($sql);
        return $this->loadRow([$id]);
    }

    public function relatedProducts($id)
    {
        $sql = "SELECT products.id,products.name,products.avata,products.price_max,products.price_min,category.name as category_name,products.category_id FROM `products` INNER JOIN category ON products.category_id = category.id WHERE products.deleted = 0 AND products.category_id = ? ";
        $this->setQuery($sql);
        return $this->loadAllRows([$id]);

    }

    public function createComment($id_user,$id_product,$code,$description,$create_at,$create_by)
    {
       $sql = "INSERT INTO `comment`(`account_id`, `product_id`, `code`, `content`, `create_at`, `create_by`) VALUES (?,?,?,?,?,?)";
       $this->setQuery($sql);
       $result = $this->execute([$id_user,$id_product,$code,$description,$create_at,$create_by]);
       if($result){
           $lastid = $this->getLastId();
           return $lastid;
       }else{
           return null;
       }

    }

    public function getComment($id,$location,$quantity)
    {
        $sql = "SELECT comment.id,comment.account_id,comment.content,comment.create_at,account.name,account.avatar,role.name_role FROM `comment` INNER JOIN account ON comment.account_id = account.id INNER JOIN role ON account.role_id = role.id WHERE comment.product_id = ?  ORDER BY 
            comment.create_at DESC LIMIT $location,$quantity";
        $this->setQuery($sql);
        return $this->loadAllRows([$id]);

    }

    public function getOneComment($id)
    {
        $sql = "SELECT comment.id,comment.account_id,comment.content,comment.create_at,account.name,account.avatar,role.name_role FROM `comment` INNER JOIN account ON comment.account_id = account.id INNER JOIN role ON account.role_id = role.id WHERE comment.id = ?";
        $this->setQuery($sql);
        return $this->loadRow([$id]);

    }

    public function getImage($id)
    {
        $sql = "SELECT source FROM `image` WHERE product_id = ?";
        $this->setQuery($sql);
        return $this->loadAllRows([$id]);
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
        $sql = "SELECT * FROM comment WHERE `code` = ?";
        $this->setQuery($sql);
        $result = $this->loadRow([$number]);
        return !empty($result);
    }



}