<?php
namespace App\models\user;
use App\models\BaseModel;
class homePage extends BaseModel {

    public function getListCategory()
    {
        $sql = "SELECT * FROM `category` WHERE deleted = 0";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }

    public function getListProduct($location,$quantity)
    {
        $sql = "SELECT * FROM `products`  WHERE deleted = 0 ORDER BY `create_at` DESC LIMIT $location,$quantity";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }

    public function checkSale($id)
    {
        $sql = "SELECT promotion.value FROM product_detail INNER JOIN promotion_detail ON product_detail.id = promotion_detail.product_detail_id INNER JOIN
promotion ON promotion_detail.promotion_id = promotion.id WHERE product_detail.product_id = ?";
        $this->setQuery($sql);
        return $this->loadRow([$id]);
    }


    public function getProductDetailSale()
    {
        $sql = "SELECT products.id as product_id,product_detail.price,products.name as product_name,products.avata as products_avata,size.name as namesize,promotion_detail.id as promotionDetail_id,promotion_detail.price_after_reduction FROM `product_detail` INNER JOIN products ON product_detail.product_id = products.id INNER JOIN size ON size.id = product_detail.size_id INNER JOIN promotion_detail ON promotion_detail.product_detail_id = product_detail.id WHERE products.deleted = 0 AND product_detail.id IN (SELECT product_detail_id FROM promotion_detail)";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }




}
