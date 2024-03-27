<?php
namespace App\controllers\admin;
use App\Controllers\BaseController;
use App\models\admin\promotion;

class promotionController extends BaseController{
    public $promotion;

    public function __construct()
    {
        $this->promotion = new promotion();
    }

    public function index(){
          $data = $this->promotion->getPromotion();
          $this->render('promotion.view',compact('data'));
    }
   /// search

    public function searchPromotion(){
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $keyword = trim($_POST['keyword']);
            $errors = [];
            if(!empty($keyword)){
                $data = $this->promotion->searchPromotion($keyword);
                return $this->render('promotion.view',compact('data'));
            }else{
                $errors['keyword'] = "Vui lòng điền tên danh mục muốn tìm kiếm";
            }
            if(!empty($errors)){
                flash('errors',$errors,'promotion');
            }
        }
    }
    public function addPromotion(){
        $this->render('promotion.add');
    }

    public function actionAddPromotion(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $code = $this->promotion->create_code();
            $name = $_POST['name'];
            $desc = $_POST['desc'];
            $value = $_POST['value'];
            $create_at = create_at();
            $create_by = $_SESSION['username'];
            $date_start = $_POST['startTime'];
            $date_now = date_now();
            $date_end = $_POST['endTime'];
            // name
            if(strlen($_POST['name']) < 3 || strlen($_POST['name']) > 255){
                $errors['name'] = "Độ dài của tên từ 3 đến 255 kí tự";
            }
            // value
            if(empty($_POST['value'])){
                $errors['value'] = "Nhập giá trị cho khuyến mãi";
            }
            if(!isset($_POST['forever'])) {
                if ($date_now > $date_start) {
                    $errors['startTime'] = "Thời gian bắt đầu phải lớn hoặc bằng thời gian hiện tại";
                }
                if ($date_start <= $date_end) {
                    $errors['endTime'] = "Thời gian kết thúc phải lớn hơn thời gian bắt đầu";
                }
            }
            if(isset($_POST['forever'])){
                $date_start = null;
                $date_end = null;
            }
            if( strlen($_POST['desc']) < 10 || strlen($_POST['name']) > 500){
                $errors['desc'] = "Độ dài của tên từ 10 đến 500 kí tự";
            }
            if(!empty($errors)){
                flash('errors',$errors,'add-promotion');
            }
            if(empty($errors)){
              $resutl = $this->promotion->postPromotion($code,$name,$desc,$value,$date_start,$date_end,$create_at,$create_by);
              if($resutl){
                  flash('success','Thêm thành công','add-promotion');
              }
            }
        }
    }
    public function editPromotion($id){
      $data = $this->promotion->getPromotionDetail($id);
      $this->render('promotion.edit',compact(['data','id']));
    }

    public function actionEditPromotion($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $deleted = $_POST['deleted'];
            $name = $_POST['name'];
            $desc = $_POST['desc'];
            $value = $_POST['value'];
            $update_at = create_at();
            $update_by = $_SESSION['username'];
            $date_start = $_POST['startTime'];
            $date_now = date_now();
            $date_end = $_POST['endTime'];
            // name
            if(strlen($_POST['name']) < 3 || strlen($_POST['name']) > 255){
                $errors['name'] = "Độ dài của tên từ 3 đến 255 kí tự";
            }
            // value
            if(empty($_POST['value'])){
                $errors['value'] = "Nhập giá trị cho khuyến mãi";
            }
            if(!isset($_POST['forever'])) {
                if ($date_now > $date_start) {
                    $errors['startTime'] = "Thời gian bắt đầu phải lớn hoặc bằng thời gian hiện tại";
                }
                if ($date_start <= $date_end) {
                    $errors['endTime'] = "Thời gian kết thúc phải lớn hơn thời gian bắt đầu";
                }
            }
            if(isset($_POST['forever'])){
                $date_start = null;
                $date_end = null;
            }
            if( strlen($_POST['desc']) < 10 || strlen($_POST['name']) > 500){
                $errors['desc'] = "Độ dài của tên từ 10 đến 500 kí tự";
            }
            if(!empty($errors)){
                flash('errors',$errors,'edit-promotion/'.$id);
            }
            if(empty($errors)){
                $resutl = $this->promotion->putPromotion($name,$desc,$value,$date_start,$date_end,$update_at,$update_by,$deleted,$id);
                if($resutl){
                    flash('success','Sửa thành công','edit-promotion/'.$id);
                }
            }
        }
    }


    public function promotionDetail($id){
        $promotion = $this->promotion->getPromotionDetail($id);
        $this->render('promotion.detail',compact(['promotion']));
    }


    public function promotionDeleted($id){
        $result = $this->promotion->deletedPromotion(1,$id);
        if($result){
            echo "<script>
                               alert('Khóa thành công');
                               window.location.href = 'http://localhost/duan1_fpoly/promotion';
                               </script>";
        }
    }
    public function applyPromotion(){
        $data = $this->promotion->getAllCategory();
        $data2 = $this->promotion->getAllProduct();
        $this->render('promotion_detail.apply',compact(['data','data2']));
    }
    public function searchProduct(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $category_id = $_POST['category'];
            $product_name = trim($_POST['product_name']);
            $data = $this->promotion->getAllCategory();
             if($category_id == 0 && empty($product_name)){
               $data2 = $this->promotion->getAllProduct();
               if($data2){
                   $this->render('promotion_detail.search',compact(['data','data2']));
               }else{
                   $this->render('promotion_detail.search',compact(['data']));
               }
             }

            if($category_id != 0 && empty($product_name)){
                $data2 = $this->promotion->searchProductCategory($category_id);
                if($data2){
                    $this->render('promotion_detail.search',compact(['data','data2']));
                }else{
                    $this->render('promotion_detail.search',compact(['data']));
                }
            }
            if($category_id != 0 && !empty($product_name)){
                $data2 = $this->promotion->searchSynthetics($category_id,$product_name);
                if($data2){
                    $this->render('promotion_detail.search',compact(['data','data2']));
                }else{
                    $this->render('promotion_detail.search',compact(['data']));
                }
            }
            if($category_id == 0 && !empty($product_name)){
                $data2 = $this->promotion->searchKeyWord($product_name);
                if($data2){
                    $this->render('promotion_detail.search',compact(['data','data2']));
                }else{
                    $this->render('promotion_detail.search',compact(['data']));
                }
            }
        }
    }
    public function listPromotionApplyNow(){
        $data2 = $this->promotion->getApplyNow();
        $this->render('promotion_detail.applynow',compact(['data2']));
    }

    public function addPromotionDetail($id){
        $check = $this->promotion->checkPromotionDetail($id);
        $product = $this->promotion->getDataProductDetail($id);
        $promotion = $this->promotion->getPromotionAll();
        $apply_now = ($check) ? true : false;
        $this->render('promotion_detail.add-PromotionDetail',compact(['product','promotion','apply_now']));
    }
    public function checkAfterPrice(){
        if(isset($_POST['id'])){
            $id = $_POST['id'];
            $price = $_POST['price'];
            if($id != 0){
                $data = $this->promotion->getPromotionDetail($id);
                // công thức tính giá tiền sau áp dụng
                $giaSauKhiGiamGia = $price - ($price * $data->value / 100);
                echo "<span>".number_format($giaSauKhiGiamGia, 0, ',', '.').".VNĐ"."</span> 
                 <input type='hidden' name='price_after' value='$giaSauKhiGiamGia'> ";
            }else{
                echo "<span></span>";
            }
        }
    }
    public function actionAddPromotionDetail($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $product_id = $id;
            $promotion_id = $_POST['promotion'];
            $quantity = $_POST['quantity'];
            $price_after = $_POST['price_after'];
            $errors = [];
            if(empty($quantity)){
                 $errors['quantity'] = "Vui lòng nhập số lượng khuyến mai cho sản phẩm";
            }
            if($price_after == 0){
                $errors['price'] = "Vui lòng chọn mã khuyến mãi cho sản phẩm";
            }
            if(!empty($errors)){
                flash('errors',$errors,'add-PromotionDetail/'.$id);
            }
            if(empty($errors)){
                $create_at = create_at();
                $create_by = $_SESSION['username'];
                   $result = $this->promotion->postDetailPromotion($product_id,$promotion_id,$quantity,$price_after,$create_at,$create_by);
                if($result){
                    if ($result) {
                        echo "<script>
                               alert('Thêm thành công');
                               window.location.href = 'http://localhost/duan1_fpoly/apply-now';
                               </script>";
                    }
                }

            }

        }
    }

    public function detailPromotionDetail($id){
        $promotionDetail = $this->promotion->getOnePromotionDetail($id);
        $product = $this->promotion->getDataProductDetail($promotionDetail->product_detail_id);
        $this->render('promotion_detail.detail-PromotionDetail',compact(['promotionDetail','product']));
    }
    public function editPromotionDetail($id){
        $promotionDetail = $this->promotion->getOnePromotionDetail($id);
        $product = $this->promotion->getDataProductDetail($promotionDetail->product_detail_id);
        $promotion = $this->promotion->getPromotionAll();
        $this->render('promotion_detail.edit-PromotionDetail',compact(['promotionDetail','product','promotion']));
    }

    public function actionEditPromotionDetail($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $promotionDetail_id = $id;
            $product_id = $_POST['product_id'];
            $promotion_id = $_POST['promotion'];
            $quantity = $_POST['quantity'];
            $price_after = $_POST['price_after'];
            $errors = [];
            if(empty($quantity)){
                $errors['quantity'] = "Vui lòng nhập số lượng khuyến mai cho sản phẩm";
            }
            if($price_after == 0){
                $errors['price'] = "Vui lòng chọn mã khuyến mãi cho sản phẩm";
            }
            if(!empty($errors)){
                flash('errors',$errors,'add-PromotionDetail/'.$id);
            }
            if(empty($errors)){
                $update_at = create_at();
                $update_by = $_SESSION['username'];
                $result = $this->promotion->putPromotionDetail($product_id,$promotion_id,$quantity,$price_after,$update_at,$update_by,$promotionDetail_id);
                if($result){
                    if ($result) {
                        echo "<script>
                               alert('Sửa thành công');
                               window.location.href = 'http://localhost/duan1_fpoly/apply-now';
                               </script>";
                    }
                }

            }

        }
    }
    public function deletedPromotionDetail($id){
        $result = $this->promotion->deletedPromotionDetail($id);
        if ($result) {
            echo "<script>
                               alert('Xóa thành công');
                               window.location.href = 'http://localhost/duan1_fpoly/apply-now';
                               </script>";
        }
    }

}