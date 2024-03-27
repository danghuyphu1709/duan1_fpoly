<?php
namespace App\controllers\admin;
use App\Controllers\BaseController;
use App\models\admin\product;

class productController extends BaseController{
    public $product;
    public $quantity = 0;

    public $all;
    public function __construct()
    {
        $this->product = new product();
    }
    public function index(){
        $data = $this->product->getProduct();
        $category = $this->product->getAllCategory();
        for ($i = 0; $i < count($data); $i++) {
            $productDetail = $this->product->getDataProductDetail($data[$i]->product_id);
            for ($j = 0; $j < count($productDetail); $j++) {
                if($productDetail[$j]->quantity == 0){
                    $this->product->putStatusDetail(1,$productDetail[$j]->id);
                };
            }

        }
      return $this->render('products.view',compact(['data','category']));
    }
    public function addProduct(){
        $data =  $this->product->getAllSize();
        $data2 = $this->product->getAllCategory();
        return $this->render('products.add',compact(['data','data2']));
    }

    public function detailProduct($id){
        $data = $this->product->getAllProductDetail($id);
        $data_image = $this->product->getImage($id);
        return $this->render('products.detail',compact(['data','data_image']));
    }
    public function actionAddProduct(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $category_id = $_POST['category'];
            $sizeValues = $_POST['size'];
            $priceValues = $_POST["price"];
            $quantityValues = $_POST["quantity"];
            $fileAvata = $_FILES['avataImage'];
            $errors = [];
            // name
            if( strlen($_POST['name']) < 3 || strlen($_POST['name']) > 30){
                $errors['name'] = "Độ dài của tên từ 3 đến 30 kí tự";
            }
            if( strlen($_POST['desc']) < 10 || strlen($_POST['name']) > 500){
                $errors['desc'] = "Độ dài của tên từ 10 đến 500 kí tự";
            }
            //// image
            if(!empty($fileAvata['name'])){
                $invalidImages = ['svg','webp','tif','tiff','bmp','gif','png','jpg','jpeg'];
                $extension = pathinfo($fileAvata['name'],PATHINFO_EXTENSION);
                if(in_array($extension,$invalidImages)){
                    $urlupload ='./upload/'.$fileAvata['name'];;
                    move_uploaded_file($fileAvata["tmp_name"],$urlupload);
                }else{
                    $errors['image'] = "File này không phải là ảnh ";
                }
            }else{
               $errors['image'] = "vui lòng chọn ảnh";
            }
            // desc
            if(empty($_POST['name']) || strlen($_POST['name']) < 3 || strlen($_POST['name']) > 30){
                $errors['name'] = "Độ dài của tên từ 3 đến 30 kí tự";
            }
              ///// size
            if(isset($sizeValues)){
                foreach($priceValues as $iteams){
                    if(strlen($iteams) == 0){
                        $errors['price'] = "Vui lòng điển đủ thông tin giá";
                    }
                }
                foreach($quantityValues as $iteams){
                    if(strlen($iteams) == 0){
                        $errors['quantity'] = "Vui lòng điển đủ thông tin số lượng";
                    }
                }
            }else{
                $errors['size'] = "Vui lòng chọn size";
            }
            if(!empty($errors)){

            flash('errors',$errors,'add-product');
            }

            $price_max = $priceValues[0];
            $price_min = $priceValues[0];
            for ($i= 0 ; $i < count($sizeValues) ; $i++){
             if($price_max < $priceValues[$i]){
                 $price_max = $priceValues[$i];
             };
                if($price_min > $priceValues[$i]){
                    $price_min = $priceValues[$i];
                };
            }
            ;
           if(empty($errors)){
//               create product
                $code = $this->product->create_code();
                $name = $_POST['name'];
                $desc = $_POST['desc'];
                $create_at = create_at();
                $create_by = $_SESSION['username'];
                $lastId = $this->product->postProduct($category_id,$code,$name,$desc,$fileAvata['name'],intval($price_max),intval($price_min),$create_at,$create_by);
                $result = '';
                 // product detail
                for ($i= 0 ; $i < count($sizeValues) ; $i++){
                        $result = $this->product->postProductDetail($lastId,$sizeValues[$i],$quantityValues[$i],$priceValues[$i]);
                }
                    if($result){
                        flash('success',"Thêm thành công",'add-product');
                    }
               }
            }
        }
    public function editProduct($id){
        $product = $this->product->getDetailProduct($id);
        $image = $this->product->getImage($id);
        $productDetail = $this->product->getDataProductDetail($id);
        $category = $this->product->getAllCategory();
        return $this->render('products.edit',compact(['product','productDetail','category','image']));
    }

    public function searchProduct(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $category_id = $_POST['category'];
            $product_name = trim($_POST['product_name']);
            $category = $this->product->getAllCategory();
            if($category_id == 0 && empty($product_name)){
                $data = $this->product->getAllProduct();
                if($data){
                    $this->render('products.view',compact(['category','data']));
                }else{
                    $this->render('products.view',compact(['category']));
                }
            }
            if($category_id != 0 && empty($product_name)){
                $data = $this->product->searchProductCategory($category_id);
                if($data){
                    $this->render('products.view',compact(['category','data']));
                }else{
                    $this->render('products.view',compact(['category']));
                }
            }
            if($category_id != 0 && !empty($product_name)){
                $data = $this->product->searchSynthetics($product_name,$category_id);
                if($data){
                    $this->render('products.view',compact(['category','data']));
                }else{
                    $this->render('products.view',compact(['category']));
                }
            }
            if($category_id == 0 && !empty($product_name)){
                $data = $this->product->searchKeyWord($product_name);
                if($data){
                    $this->render('products.view',compact(['category','data']));
                }else{
                    $this->render('products.view',compact(['category']));
                }
            }
        }
    }

    public function actionEditProduct($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $category_id = $_POST['category'];
            $sizeValues = $_POST['size'];
            $priceValues = $_POST["price"];
            $quantityValues = $_POST["quantity"];
            $status = $_POST['status'];
            $fileAvata = $_FILES['avataImage'];
            $imageOld = $_POST['avataImageOld'];
            if(empty($fileAvata['name'])){
                $fileAvata['name'] = $imageOld;
            }
            $errors = [];
            // name
            if( strlen($_POST['name']) < 3 || strlen($_POST['name']) > 30){
                $errors['name'] = "Độ dài của tên từ 3 đến 30 kí tự";
            }
            if( strlen($_POST['desc']) < 10 || strlen($_POST['name']) > 500){
                $errors['desc'] = "Độ dài của tên từ 10 đến 500 kí tự";
            }
            //// image
            if(!empty($fileAvata['name'])){
                $invalidImages = ['svg','webp','tif','tiff','bmp','gif','png','jpg','jpeg'];
                $extension = pathinfo($fileAvata['name'],PATHINFO_EXTENSION);
                if(in_array($extension,$invalidImages)){
                    $urlupload ='./upload/'.$fileAvata['name'];;
                    move_uploaded_file($fileAvata["tmp_name"],$urlupload);
                }else{
                    $errors['image'] = "File này không phải là ảnh ";
                }
            }else{
                $errors['image'] = "vui lòng chọn ảnh";
            }
            // desc
            if(empty($_POST['name']) || strlen($_POST['name']) < 3 || strlen($_POST['name']) > 30){
                $errors['name'] = "Độ dài của tên từ 3 đến 30 kí tự";
            }
            ///// size
            if(isset($sizeValues)){
                foreach($priceValues as $iteams){
                    if(strlen($iteams) == 0){
                        $errors['price'] = "Vui lòng điển đủ thông tin giá";
                    }
                }
                foreach($quantityValues as $iteams){
                    if(strlen($iteams) == 0){
                        $errors['quantity'] = "Vui lòng điển đủ thông tin số lượng";
                    }
                }
            }else{
                $errors['size'] = "Vui lòng chọn size";
            }
            if(!empty($errors)){

                flash('errors',$errors,'edit-product/'.$id);
            }

            $price_max = $priceValues[0];
            $price_min = $priceValues[0];
            for ($i= 0 ; $i < count($sizeValues) ; $i++){
                if($price_max < $priceValues[$i]){
                    $price_max = $priceValues[$i];
                };
                if($price_min > $priceValues[$i]){
                    $price_min = $priceValues[$i];
                };
            }
            ;
            if(empty($errors)){
//                create product
                $code = $this->product->create_code();
                $name = $_POST['name'];
                $desc = $_POST['desc'];
                $update_at = create_at();
                $update_by = $_SESSION['username'];
                $deleted = $_POST['deleted'];
                $result = '';
                $result = $this->product->putProduct($category_id,$name,$desc,$fileAvata['name'],intval($price_max),intval($price_min),$update_at,$update_by,$deleted,$id);
                // product detail
                for ($i=0 ; $i < count($sizeValues) ; $i++){
                    $result = $this->product->putProductDetail($quantityValues[$i],$priceValues[$i],$status[$i],$id,$sizeValues[$i]);
                }
                if($result){
                    flash('success',"Sửa thành công",'edit-product/'.$id);
                }
            }
        }
    }


    public function deletedProduct($id){
        $result = $this->product->deletedProduct(1,$id);
        if($result){
            echo "<script type='text/javascript'>alert('Khóa thành công');
               window.location.href = 'http://localhost/duan1_fpoly/product';</script>";
        }
    }

}