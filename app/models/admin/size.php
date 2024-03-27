<?php
namespace App\models\admin;
use App\Models\BaseModel;

class size extends BaseModel{
    public $table = "size";
    public function getListSize(){
        $sql = "SELECT * FROM ".$this->table." ORDER BY `create_at` DESC";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    // search
    public function searchSize($keyword){
        $sql = "SELECT * FROM ".$this->table."  WHERE  name like CONCAT('%', ?, '%')";
        $this->setQuery($sql);
        return $this->loadAllRows([$keyword]);
    }
    public function getDetailSize($id){
        $sql = "SELECT * FROM ".$this->table." WHERE id = ?";
        $this->setQuery($sql);
        return $this->loadRow([$id]);
    }
    public function postSize($code,$name,$create_at,$create_by){
          $sql = "INSERT INTO ".$this->table." (`code`, `name`, `create_at`, `create_by`) VALUES (?,?,?,?)";
          $this->setQuery($sql);
          return $this->execute([$code,$name,$create_at,$create_by]);
    }
    public  function putSize($name,$update_at,$update_by,$deleted,$id){
        $sql = "UPDATE $this->table SET `name`= ? ,`update_at`= ? ,`update_by`= ?,`deleted`= ? WHERE id = ?";
        $this->setQuery($sql);
        return $this->execute([$name,$update_at,$update_by,$deleted,$id]);
    }
    public function deletedSize($key,$id){
        $sql = "UPDATE $this->table SET `deleted` = ? WHERE id = ?";
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
        $sql = "SELECT * FROM ".$this->table." WHERE `code` = ?";
        $this->setQuery($sql);
        $result = $this->loadRow([$number]);
        return !empty($result);
    }
}