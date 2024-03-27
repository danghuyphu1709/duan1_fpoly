<?php
namespace App\controllers\admin;
use App\Controllers\BaseController;
use App\models\admin\category;

class categoryController extends BaseController{
    public $category;
    public function __construct()
    {
        $this->category = new category();
    }
    public function index (){
        $data  = $this->category->getListCategory();
        return $this->render('category.view',compact('data'));
    }

    // sreach
    public function searchCategory(){
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $keyword = trim($_POST['keyword']);
            $errors = [];
            if(!empty($keyword)){
                $data = $this->category->searchCategory($keyword);
                return $this->render('category.view',compact('data'));
            }else{
                 $errors['keyword'] = "Vui lòng điền tên danh mục muốn tìm kiếm";
            }
            if(!empty($errors)){
                flash('errors',$errors,'category');
            }
        }
    }
    public function detailCategory($id){
        $data = $this->category->getCategory($id);
        return $this->render('category.detail',compact('data'));
    }
    public function addCategory(){
        return $this->render('category.add');
    }
    public function actionAddCategory(){
       if($_SERVER['REQUEST_METHOD'] == 'POST'){
           $errors = [];
          if( strlen($_POST['name']) < 3 || strlen($_POST['name']) > 30){
                $errors['name'] = "Độ dài của tên từ 3 đến 30 kí tự";
          }
       if(!empty($errors)){
           flash('errors',$errors,'add-category');
       }
       if(empty($errors)){
           $code = $this->category->create_code();
           $name = $_POST['name'];
           $create_at = create_at();
           $create_by = $_SESSION['username'];
           $resutl = $this->category->postCategory($code,$name,$create_at,$create_by);
           if($resutl){
               flash('success','Thêm thành công','add-category');
           }
       }
       }
    }
    public function editCategory($id){
        $data = $this->category->getCategory($id);
        return $this->render('category.edit',compact('data'));
    }

    public function actionEditCategory($id){
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $errors = [];
        if(strlen($_POST['name']) < 3 || strlen($_POST['name']) > 30){
                $errors['name'] = "Độ dài của tên từ 3 đến 30 kí tự";
            }
        if(!empty($errors)){
                flash('errors',$errors,'edit-category'.'/'.$id);
            }
        if(empty($errors)){
                $name = $_POST['name'];
                $update_at = create_at();
                $update_by = $_SESSION['username'];
                $deleted = $_POST['deleted'];
                $resutl = $this->category->putCategory($name,$update_at,$update_by,$deleted,$id);
                if($resutl){
                    flash('success','Sửa thành công','edit-category'.'/'.$id);
                }
            }
        }
    }
    public function deletedCategory($id){
       $keydeleted = 1;
       $resutl = $this->category->deletedCategory($keydeleted,$id);
       if($resutl){
           echo "<script type='text/javascript'>alert('Khóa thành công');
               window.location.href = 'http://localhost/duan1_fpoly/category';</script>";
       }
    }
}