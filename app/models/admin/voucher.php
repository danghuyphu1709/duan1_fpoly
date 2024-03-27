<?php
namespace App\models\admin;
use App\Models\BaseModel;

class voucher extends BaseModel {
    public $table = "voucher";
    public function getListVoucher(){
        $sql = "SELECT * FROM ".$this->table." ORDER BY `create_at` DESC";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function searchVoucher($keyword){
        $sql = "SELECT * FROM ".$this->table."  WHERE  name like CONCAT('%', ?, '%')";
        $this->setQuery($sql);
        return $this->loadAllRows([$keyword]);
    }
    public function getDetailVoucher($id){
        $sql = "SELECT * FROM ".$this->table." WHERE id = ?";
        $this->setQuery($sql);
        return $this->loadRow([$id]);
    }
    public function postVoucher($code,$discount_code,$name, $minimum_amount, $value, $quantity, $start_time, $end_time, $create_at, $create_by){
       $sql = "INSERT INTO ".$this->table."  (`code`,`discount_code`,`name`, `minimum_amount`, `value`, `quantity`, `start_time`, `end_time`, `create_at`, `create_by`) VALUES (?,?,?,?,?,?,?,?,?,?)";
       $this->setQuery($sql);
       return $this->execute([$code,$discount_code,$name, $minimum_amount, $value, $quantity, $start_time, $end_time, $create_at, $create_by]);
    }

    public function putVoucher($name,$discount_code, $minimum_amount, $value, $quantity, $start_time, $end_time, $create_at, $create_by,$deleted,$id){
        $sql = "UPDATE `voucher` SET `name`= ?,`discount_code` = ?,`minimum_amount`= ?,`value`= ? ,`quantity`= ?,`start_time`= ?,`end_time`= ?,`update_at`= ?,`update_by`= ?,`deleted`= ? WHERE id = ?";
        $this->setQuery($sql);
        return $this->execute([$name,$discount_code,$minimum_amount, $value, $quantity, $start_time, $end_time, $create_at, $create_by,$deleted,$id]);
    }

    public function deletedVoucher($key,$id){
        $sql = "UPDATE `voucher` SET `deleted`= ? WHERE id = ?";
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