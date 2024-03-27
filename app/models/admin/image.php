<?php
namespace App\models\admin;
use App\Models\BaseModel;

class image extends BaseModel{
    public $table = 'image';

    public function getImage($id){
        $sql = "SELECT * FROM ".$this->table." WHERE `product_id` = ? ORDER BY `create_at` DESC";
        $this->setQuery($sql);
        return $this->loadAllRows([$id]);
    }

    public function postImage($product_id,$code,$source, $create_at,$create_by){
        $sql = "INSERT INTO `image`(`product_id`, `code`, `source`, `create_at`,`create_by`) VALUES (?,?,?,?,?)";
        $this->setQuery($sql);
        return $this->execute([$product_id,$code,$source, $create_at,$create_by]);
    }

    public function deletedImage($id){
        $sql = "DELETE FROM ".$this->table." WHERE id = ?";
        $this->setQuery($sql);
        return $this->execute([$id]);
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