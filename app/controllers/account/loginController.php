<?php
namespace App\controllers\account;
use App\Controllers\BaseController;
use App\models\account\login;

class loginController extends BaseController {
    public function __construct()
    {
        $this->login = new login();
    }

    public function login(){
        $this->render('login.login');
    }
    public function checkAccount(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $userName = $this->login->checkUserName($_POST['username']);
            if($userName){
                $errors = [];
                if(password_verify($_POST['password'],$userName->password)){
                    $_SESSION['auth'] = $userName->account_id;
                    $_SESSION['role'] = $userName->role;
                    $_SESSION['username'] = $userName->username;
                    header('location: ' . BASE_URL . 'home-page');die;
                }else{
                    $errors['password'] = "Tài khoản mật khẩu không chính xác";
                }
            }else{
                $errors['username'] = "Tài khoản không tồn tại!";
            }
            if(!empty($errors)){
                $_SESSION['errors']['username'] = isset($errors['username']) ? $errors['username'] : null;
                $_SESSION['errors']['password'] = isset($errors['password']) ? $errors['password'] : null;
                flash('errors',$errors,'login');
            }
        }
    }
    public function register(){
        return $this->render('login.register');
    }

    public function logout()
    {
        session_unset();
        header('location: ' . BASE_URL . 'login');die;
    }

    public function profile($id)
    {
        $profile = $this->login->getAccount($id);
        return $this->render('account.profile',compact('profile'));
    }
    public function editData()
    {
        $profile = $this->login->getAccount($_SESSION['auth']);
        echo json_encode($profile);
    }


    public function updateProfile($id)
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone =$_POST['phone'];
        $urlAvataOld = $_POST['avataold'];
        $file = $_FILES['avata'];
        $fileName = $file['name'];
        $update_at = create_at();
        $errors = [];

        if(!empty($file['name'])){
            $target_dir = "upload/";
            $target_file = $target_dir . basename($fileName);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                $errors['avatar'] = 'File upload không phải là ảnh ';
                flash('errors',$errors,'profile');
            }else{
                move_uploaded_file($_FILES["avata"]["tmp_name"], $target_file);
            }
        }
        if(empty($file['name']) && empty($urlAvataOld)){
            $fileName = 'null';
        }
        if(empty($file['name']) && !empty($urlAvataOld)){
            $fileName = $urlAvataOld;
        }

        if(empty($errors)){
            $resutl = $this->login->putAccount($name,$phone,$email,$fileName,$update_at,$id);
           if($resutl){
             flash('success','Chỉnh sửa thông tin thành công','profile/'.$id);
           }
        }

    }
    public function createAccount(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $errors = [];
            /// name
               if(strlen($_POST['name']) < 3 || strlen($_POST['name']) > 30) {
                   $errors['name'] = "Tên không hợp lệ";
               }
            // số điện thoại
            if(strlen($_POST['phone']) == 10) {
                 $phone = $this->login->getPhone($_POST['phone']);
                if($phone){
                    $errors['phone1'] = 'Số điện thoại đã tồn tại';
                }
            }else{
                $errors['phone2'] = "Số điện thoại không đúng định dạng";
            }
            // check email
            if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
              $email = $this->login->getEmail($_POST['email']);
              if($email){
                  $errors['email1'] = 'Email đã tồn tại';
              }
            }else{
                $errors['email1']= 'Email không hợp lệ';
            }
            // check username
            if(strlen($_POST['username']) < 3 || strlen($_POST['username']) > 30){
                $errors['username'] =  "Tên tài khoản từ 3 đến 30 kí tự";
            }

            // check password
            if(strlen($_POST['password']) >= 6 && strlen($_POST['password']) <= 12){
               if($_POST['password'] !== $_POST['request_password']){
                   $errors['request_password'] = "Mật khẩu không giống nhau";
               }
            }else{
                $errors['password'] =  "Nhập mật khẩu từ 6 đến 12 kí tự";
            }
            if(!empty($errors)){
            flash('errors',$errors,'register');
            }

            if(empty($errors)){
                $role_id = 1;
                $code = $this->login->create_code();
                $encode = $this->login->encode($_POST['password']);
                $create_at = create_at();
                $result  = $this->login->create_account($role_id, $code, $_POST['name'], $_POST['username'], $encode, $_POST['phone'], $_POST['email'],$create_at);
                 if($result){
                     flash('success','Đăng ký thành công','register');
                 }

            }
        }
    }

}