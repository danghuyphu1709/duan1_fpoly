<?php
namespace App\models\account;
use App\Models\BaseModel;

class login extends BaseModel {
    private $table = 'account';
 public function checkUserName($username){
     $sql = "SELECT *,account.id as account_id FROM  ".$this->table." INNER JOIN role ON account.role_id = role.id WHERE username like ?";
     $this->setQuery($sql);
     return $this->loadRow([$username]);
 }

 public function getPhone($phone){
     $sql = "SELECT * FROM ".$this->table." WHERE phone = ?";
     $this->setQuery($sql);
     return $this->loadRow([$phone]);
 }

 public function getEmail($email){
        $sql = "SELECT * FROM ".$this->table." WHERE email = ?";
        $this->setQuery($sql);
        return $this->loadRow([$email]);
    }

 public function getUsername($username){
        $sql = "SELECT * FROM ".$this->table." WHERE username = ?";
        $this->setQuery($sql);
        return $this->loadRow([$username]);
 }
 public function create_account($role_id, $code, $name, $username, $password, $phone, $email,$create_at){
     $sql = "INSERT INTO ".$this->table." (`role_id`, `code`, `name`, `username`, `password`, `phone`, `email`, `create_at`) VALUES(?,?,?,?,?,?,?,?)";
     $this->setQuery($sql);
     return $this->execute([$role_id, $code, $name, $username, $password, $phone, $email,$create_at]);
 }

 public function getAccount($id)
 {
     $sql = "SELECT account.id,account.name,account.username,account.email,account.phone,role.name_role,account.avatar FROM `account` INNER JOIN role ON account.role_id = role.id WHERE account.id = ?";
     $this->setQuery($sql);
     return $this->loadRow([$id]);
 }

 public function putAccount($name,$phone,$email,$avatar,$update_at,$id)
 {
     $sql = "UPDATE `account` SET `name`= ?,`phone`=?,`email`= ?,`avatar`=?,`update_at`= ? WHERE id = ?";
     $this->setQuery($sql);
     return $this->execute([$name,$phone,$email,$avatar,$update_at,$id]);
 }


 function encode($password){
        $hash = password_hash($password,PASSWORD_DEFAULT);
        return $hash;
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