<?php
namespace App\controllers\user;
use App\models\user\products;
use App\controllers\BaseController;

class productsController extends BaseController
{
    public $number_product_page = 9;
    public $number_product_category = 3;

    public $number_comment = 6;
    public function __construct()
    {
        $this->product = new products();
    }

    public function index(){
        $this->pagination(1);
    }

    public function getStatic()
    {
        $category = $this->product->getListCategory();
        $productAll = count($this->product->getAllProduct());
        return ['category'=>$category,'productAll'=>$productAll];
    }

    public function pagination($page)
    {
        if(isset($page)){
            $productAll =  $this->getStatic()['productAll'];
            $number_page = ceil($productAll / $this->number_product_page);
            $number_page = intval($number_page);
            $start = ($page - 1) * $this->number_product_page;
            $category = $this->getStatic()['category'];
            $product = $this->product->pagination($start,$this->number_product_page);
            $this->render('product-user.products',compact(['category','number_page','productAll','product']));
        }
    }

    public function searchProduct()
    {
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $keyword = trim($_POST['keyword']);
            $errors = [];
            if(!empty($keyword)){
                $product = $this->product->searchProduct($keyword);
                $category = $this->getStatic()['category'];
                $this->render('product-user.products',compact(['category','product']));
            }
        }
    }


    public function filter()
    {
       if(isset($_POST['page'])){
           if($_POST['page'] == 0) {
               $product = $this->product->pagination(0,$this->number_product_page);
           }if($_POST['page'] == 1){
               $product = $this->product->paginationOld(0,$this->number_product_page);
           };
           echo json_encode($product);
       }
    }

    public function filterCategory($id)
    {
        $this->paginationFilterCategory($id,1);
    }

    public function paginationFilterCategory($id,$page)
    {
        $categoryProduct = $this->product->filterCategory($id);
        $countCategoryProduct = count($categoryProduct);
        $number_page = ceil($countCategoryProduct / $this->number_product_category);
        $category = $this->getStatic()['category'];
        $number_page = intval($number_page);
        $start = ($page - 1) * $this->number_product_category;
        $dataCategoryProduct = $this->product->paginationfilterCategory($id,$start,$this->number_product_category);
        $this->render('product-user.categoryProduct',compact(['category','number_page','countCategoryProduct','dataCategoryProduct','id']));
    }

   public function productDetail($id)
   {
       $product = $this->product->productDetail($id);
       $size = $this->product->getSizeName($id);
       $relatedProducts = $this->product->relatedProducts($product->category_id);
       $comment = $this->product->getComment($id,0,$this->number_comment);
       $image = $this->product->getImage($id);
       $this->render('product-user.productDetail',compact(['product','size','relatedProducts','comment','image']));
   }

   public function price()
   {
     if(isset($_POST['detail_id'])){
         $detail_id = $_POST['detail_id'];
         $data = $this->product->getPriceSize($detail_id);
         echo json_encode($data);
     }
   }
   // comment detail
    public function comment()
    {
        if(isset($_POST['id'])){
            $id_product = $_POST['id'];
            $id_user = $_SESSION['auth'];
            $code = $this->product->create_code();
            $create_at = create_at();
            $create_by = $_SESSION['username'];
            $description = $_POST['description'];
            $result = $this->product->createComment($id_user,$id_product,$code,$description,$create_at,$create_by);
            if($result){
                  $commentNew = $this->product->getOneComment($result);
                  echo json_encode($commentNew);
            }

        }

    }


}