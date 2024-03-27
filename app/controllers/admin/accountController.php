<?php
namespace App\controllers\admin;
use App\controllers\BaseController;
use App\models\account\account;

class accountController extends BaseController {
    public $account;
    public function __construct()
    {
        $this->account = new account();
    }

    public function index(){
        $data = $this->account->getListAccount();
        return $this->render('account.view',compact('data'));
    }

    // sreach
    public function searchAccount(){
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $keyword = trim($_POST['keyword']);
            $errors = [];
            if(!empty($keyword)){
                $data = $this->account->searchAccount($keyword);
                return $this->render('account.view',compact('data'));
            }else{
                $errors['keyword'] = "Vui lòng điền username account muốn tìm kiếm";
            }
            if(!empty($errors)){
                flash('errors',$errors,'account');
            }
        }
    }
    public function detailAccount($id){
        $data = $this->account->getDetailAccount($id);
        return $this->render('account.detail',compact('data'));
    }

    public function editAccount($id){
        $data = $this->account->getDetailAccount($id);
        $data_role = $this->account->getRoleAccount();
        return $this->render('account.edit',compact(['data','data_role']));
    }

    public function actionEditAccount($id){
       if($_SERVER['REQUEST_METHOD'] == 'POST'){
           $role_id = $_POST['role'];
           $update_at = create_at();
           $update_by = $_SESSION['username'];
           $resutl = $this->account->putAccount($role_id,$update_at,$update_by,$id);
           if($resutl){
               flash('success','Sửa thành công','edit-account/'.$id);
           }
       }
    }

}