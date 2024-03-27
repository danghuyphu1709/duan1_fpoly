<?php
namespace App\controllers\admin;
use App\Controllers\BaseController;
use App\models\admin\voucher;

class voucherController extends BaseController{
    public $voucher;
    public function __construct()
    {
        $this->voucher =  new voucher();
    }

    public function index(){
        $data = $this->voucher->getListVoucher();
        $this->render('voucher.view',compact('data'));
    }

    public function searchVoucher(){
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $keyword = trim($_POST['keyword']);
            $errors = [];
            if(!empty($keyword)){
                $data = $this->voucher->searchVoucher($keyword);
                return $this->render('voucher.view',compact('data'));
            }else{
                $errors['keyword'] = "Vui lòng điền tên danh mục muốn tìm kiếm";
            }
            if(!empty($errors)){
                flash('errors',$errors,'voucher');
            }
        }
    }

    public function addVoucher(){
        $this->render('voucher.add');
    }
    public function actionAddVoucher(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $code = $this->voucher->create_code();
            $name = $_POST['name'];
            $minimum_amount = $_POST['minimum_amount'];
            $value = $_POST['value'];
            $quantity = $_POST['quantity'];
            $create_at = create_at();
            $create_by = $_SESSION['username'];
            $date_start = $_POST['startTime'];
            $discount_code = $_POST['discount_code'];
            $date_now = date_now();
            $date_end = $_POST['endTime'];
            $checktime = $_POST['forever'];
            // name
            if(strlen($name) < 3 || strlen($name) > 255){
                $errors['name'] = "Độ dài của tên từ 3 đến 255 kí tự";
            }
            //discount
            if(strlen($discount_code) < 3 || strlen($discount_code) > 255){
                $errors['discount_code'] = "Độ dài của tên từ 3 đến 255 kí tự";
            }
            // value
            if(empty($value)){
                $errors['value'] = "Nhập giá trị cho khuyến mãi";
            }
            //minimum_amount
            if(empty($minimum_amount)){
                $errors['minimum_amount'] = "Nhập giá trị cho trường này";
            }
            // quantity
            if(empty($quantity)){
                $errors['quantity'] = "Nhập số lượng cho trường này";
            }
            // time
            if(!isset($checktime)) {
                if ($date_now > $date_start) {
                    $errors['startTime'] = "Thời gian bắt đầu phải lớn hoặc bằng thời gian hiện tại";
                }
                if ($date_start <= $date_end) {
                    $errors['endTime'] = "Thời gian kết thúc phải lớn hơn thời gian bắt đầu";
                }
            }
            if(isset($checktime)){
                $date_start = null;
                $date_end = null;
            }
            if(!empty($errors)){
                flash('errors',$errors,'add-voucher');
            }
            if(empty($errors)){
                   $result = $this->voucher->postVoucher($code,$discount_code, $name, $minimum_amount, $value, $quantity, $date_start, $date_end, $create_at, $create_by);
                if($result){
                    flash('success','Thêm thành công','add-voucher');
                }
            }
        }
    }

    public function editVoucher($id){
        $voucher = $this->voucher->getDetailVoucher($id);
        $this->render('voucher.edit',compact('voucher'));
    }

    public function actionEditVoucher($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $name = $_POST['name'];
            $minimum_amount = $_POST['minimum_amount'];
            $value = $_POST['value'];
            $quantity = $_POST['quantity'];
            $discount_code = $_POST['discount_code'];
            $update_at = create_at();
            $update_by = $_SESSION['username'];
            $date_start = $_POST['startTime'];
            $date_now = date_now();
            $date_end = $_POST['endTime'];
            $checktime = $_POST['forever'];
            $deleted = $_POST['deleted'];
            // name
            if(strlen($name) < 3 || strlen($name) > 255){
                $errors['name'] = "Độ dài của tên từ 3 đến 255 kí tự";
            };
            if(strlen($discount_code) < 3 || strlen($discount_code) > 255){
                $errors['discount_code'] = "Độ dài của tên từ 3 đến 255 kí tự";
            }
            // value
            if(empty($value)){
                $errors['value'] = "Nhập giá trị cho khuyến mãi";
            }
            //minimum_amount
            if(empty($minimum_amount)){
                $errors['minimum_amount'] = "Nhập giá trị cho trường này";
            }
            // quantity
            if(empty($quantity)){
                $errors['quantity'] = "Nhập số lượng cho trường này";
            }
            // time
            if(!isset($checktime)) {
                if ($date_now > $date_start) {
                    $errors['startTime'] = "Thời gian bắt đầu phải lớn hoặc bằng thời gian hiện tại";
                }
                if ($date_start <= $date_end) {
                    $errors['endTime'] = "Thời gian kết thúc phải lớn hơn thời gian bắt đầu";
                }
            }
            if(isset($checktime)){
                $date_start = null;
                $date_end = null;
            }
            if(!empty($errors)){
                flash('errors',$errors,'edit-voucher/'.$id);
            }
            if(empty($errors)){
                $result = $this->voucher->putVoucher($name,$discount_code, $minimum_amount, $value, $quantity, $date_start, $date_end, $update_at, $update_by,$deleted,$id);
                if($result){
                    flash('success','Sửa thành công','edit-voucher/'.$id);
                }
            }
        }
    }

    public function detailVoucher($id){
        $voucher = $this->voucher->getDetailVoucher($id);
        $this->render('voucher.detail',compact('voucher'));
    }

    public function deletedVoucher($id){
       $resutl = $this->voucher->deletedVoucher(1,$id);
       if($resutl){
           echo "<script>
                               alert('Xóa thành công');
                               window.location.href = 'http://localhost/duan1_fpoly/voucher';
                 </script>";
       }
    }

}