<?php
namespace App\models\account;
use App\Models\BaseModel;

class account extends BaseModel {
    public $table = 'account';

    public function getListAccount(){
        // load phân tran ajax
        $sql = "SELECT *,account.code as codeAccount,account.id as idAccount  FROM account INNER JOIN role ON account.role_id = role.id ORDER BY `create_at` DESC;";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function getDetailAccount($id){
        $sql = "SELECT *,account.code as codeAccount,account.id as idAccount FROM account INNER JOIN role ON account.role_id = role.id WHERE account.id = ?";
        $this->setQuery($sql);
        return $this->loadRow([$id]);
    }

    public function searchAccount($keyword){
        $sql = "SELECT *,account.code as codeAccount,account.id as idAccount  FROM account INNER JOIN role ON account.role_id = role.id  WHERE  account.username like CONCAT('%', ?, '%')";
        $this->setQuery($sql);
        return $this->loadAllRows([$keyword]);
    }

    public function getRoleAccount(){
        $sql = "SELECT * FROM `role`";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function putAccount($role_id,$update_at,$update_by,$id){
        $sql = "UPDATE account SET `role_id`= ?,`update_at`= ?,`update_by`= ? WHERE id = ?";
        $this->setQuery($sql);
        return $this->execute([$role_id,$update_at,$update_by,$id]);
    }

}