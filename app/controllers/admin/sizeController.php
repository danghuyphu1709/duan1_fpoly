<?php
namespace App\controllers\admin;
use App\Controllers\BaseController;
use App\models\admin\size;

class sizeController extends BaseController {

    public $size;

    public function __construct()
    {
        $this->size = new size();
    }
    public function index(){
        $data = $this->size->getListSize();
        return $this->render('size.view',compact('data'));
    }

    // search
    public function searchSize(){
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $keyword = trim($_POST['keyword']);
            $errors = [];
            if(!empty($keyword)){
                $data = $this->size->searchSize($keyword);
                return $this->render('size.view',compact('data'));
            }else{
                $errors['keyword'] = "Vui lòng điền tên danh mục muốn tìm kiếm";
            }
            if(!empty($errors)){
                flash('errors',$errors,'size');
            }
        }
    }
    public function addSize(){
        return $this->render('size.add');
    }
    public function actionAddSize(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $errors = [];
            if( strlen($_POST['name']) < 3 || strlen($_POST['name']) > 30){
                $errors['name'] = "Độ dài của tên từ 3 đến 30 kí tự";
            }
            if(!empty($errors)){
                flash('errors',$errors,'add-size');
            }
            if(empty($errors)){
                $code = $this->size->create_code();
                $name = $_POST['name'];
                $create_at = create_at();
                $create_by = $_SESSION['username'];
                $resutl = $this->size->postSize($code,$name,$create_at,$create_by);
                if($resutl){
                    flash('success','Thêm thành công','add-size');
                }
            }
        }
    }

    public  function editSize($id){
        $data = $this->size->getDetailSize($id);
        return $this->render('size.edit',compact('data'));
    }

    public function actionEditSize($id){
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $errors = [];
            if(strlen($_POST['name']) < 3 || strlen($_POST['name']) > 30){
                $errors['name'] = "Độ dài của tên từ 3 đến 30 kí tự";
            }
            if(!empty($errors)){
                flash('errors',$errors,'edit-size'.'/'.$id);
            }
            if(empty($errors)){
                $name = $_POST['name'];
                $update_at = create_at();
                $update_by = $_SESSION['username'];
                $deleted = $_POST['deleted'];
                $resutl = $this->size->putSize($name,$update_at,$update_by,$deleted,$id);
                if($resutl){
                    flash('success','Sửa thành công','edit-size'.'/'.$id);
                }
            }
        }
    }
    public function detailSize($id){
        $data = $this->size->getDetailSize($id);
        return $this->render('size.detail',compact('data'));
    }

    public function deletedSize($id){
        $keydeleted = 1;
        $resutl = $this->size->deletedSize($keydeleted,$id);
        if($resutl){
            echo"<script type='text/javascript'>alert('Xóa thành công');</script>";
            flash('success','success','size');
        }
    }

}