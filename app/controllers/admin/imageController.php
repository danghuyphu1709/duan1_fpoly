<?php
namespace App\controllers\admin;
use App\Controllers\BaseController;
use App\models\admin\image;

class imageController extends BaseController{

    public $image;

    public function __construct()
    {
        $this->image = new image();
    }
    public function imageProduct($id){
        $data = $this->image->getImage($id);
        $this->render('image.view',compact(['id','data']));
    }
    public function actionAddImage($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $create_at = create_at();
            $create_by = $_SESSION['username'];
           $fileImages = $_FILES['image'];
           $numImages = count($fileImages['name']);
           $errors = [];
            if(strlen($fileImages['name'][0]) != 0){
                $invalidImages = ['svg','webp','tif','tiff','bmp','gif','png','jpg','jpeg'];
                for ($i = 0; $i < $numImages; $i++) {
                    $extension = pathinfo($fileImages['name'][$i], PATHINFO_EXTENSION);
                    $checkimage = in_array($extension,$invalidImages);
                    if($checkimage){
                        $urlupload ='./upload/'.$fileImages['name'][$i];;
                        move_uploaded_file($fileImages["tmp_name"][$i],$urlupload);
                    }else{
                        $errors['image'] = "vui lòng chọn lại có file không phải là ảnh";
                    }
                }
            }else{
                $errors['image'] = "Vui lòng chọn hình ảnh";
            }

            if(!empty($errors)){
                flash('errors',$errors,'image-product/'.$id);
            }

            if(empty($errors)){
                $resutl = '';
                for ($i = 0; $i < $numImages; $i++){
                    $code = $this->image->create_code();
                    $resutl = $this->image->postImage($id,$code,$fileImages['name'][$i],$create_at,$create_by);
                }
              if($resutl){
                  flash('success','thêm thành công','image-product/'.$id);
              }
            }

        }
    }

    public function deletedImage($id,$product_id){
        $result = $this->image->deletedImage($id);
        if($result){
            echo "<script>
                               alert('Xóa thành công');
                               window.location.href = 'http://localhost/duan1_fpoly/image-product/'+$product_id;
                 </script>";
        }
    }

}