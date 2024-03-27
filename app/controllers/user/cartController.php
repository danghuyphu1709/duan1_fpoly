<?php
namespace App\controllers\user;
use App\controllers\BaseController;
use App\models\user\cart;

class cartController extends BaseController
{
    public $cart;


    public function discount()
    {
        $discount = $this->cart->filterDiscountCodeVoucher();
        return $discount;

    }
    public function address()
    {
        $address = $this->cart->address();
        return $address;

    }
    public function paymet()
    {
          $payment = $this->cart->payment();
          return $payment;
    }


    public function __construct()
    {
        $this->cart = new cart();

    }


    public function index()
    {

        $productCart = $this->cart->listCart($_SESSION['auth']);
        $discount = $this->discount();
        $address = $this->address();
        $payment = $this->paymet();
        return $this->render('cart.cart',compact(['productCart','discount','address','payment']));

    }

    public function addToCart()
    {
        if(!isset($_SESSION['auth'])) {
            header('Location: ' . BASE_URL . 'login');
        }
       if($_SESSION['role'] == 0){
           if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']){
               $checkCart = $this->cart->checkCart($_POST['product_id'],$_POST['product_detail_id']);
               if($checkCart){
                   $updateQuantity = $checkCart->quantity + $_POST['quantity'];
                   $this->cart->updateQuantityCart($updateQuantity,$checkCart->id);
               }else{
                   // add to cart
                   $account_id = $_SESSION['auth'];
                   $product_id = $_POST['product_id'];
                   $product_detail_id = $_POST['product_detail_id'];
                   $quantity = $_POST['quantity'];
                   $create_at = create_at();
                   $create_by = $_SESSION['username'];
                   $this->cart->addToCart($account_id,$product_id,$product_detail_id,$quantity,$create_at,$create_by);
               }
           }
           $payment = $this->paymet();
           $address = $this->address();
           $discount = $this->discount();
           $productCart = $this->cart->listCart($_SESSION['auth']);
           unset($_SESSION['csrf_token']);
           return $this->render('cart.cart',compact(['productCart','discount','address','payment']));
       }else{
           $errors = "Bạn không thể mua hàng với tài khoản ".$_SESSION['username'];
           return $this->render('cart.cart',compact('errors'));
       }

    }

    public function cartDelete($id)
    {
        $resutl = $this->cart->cartDelete($id);
        if($resutl){
            header('Location: ' . BASE_URL . 'cart');
        }

    }

    public function checkoutCart()
    {
        if(isset($_POST['update'])){
              $cart_id = $_POST['cart_id'];
              $quantity = $_POST['quantity'];
              for ($i = 0 ; $i < count($cart_id) ; $i++ ){
                  if($quantity[$i] == ''){
                      $errors['quantity'] = 'Chọn giá trị cho sản phẩm';
                      flash('errors',$errors,'cart');
                  }else{
                      $quantity_max = $this->cart->searchProductQuantity($cart_id[$i]);
                      if($quantity_max->quantity >= +$quantity[$i]){
                          $resutl = $this->cart->updateQuantityCart($quantity[$i],$cart_id[$i]);
                          if($resutl){
                              header('Location: ' . BASE_URL . 'cart');
                          }
                      }else{
                          $errors['quantity'] = 'Số lượng mua lớn hơn số lượng trong kho';
                          flash('errors',$errors,'cart');
                      }
                  }
              }
              unset($_SESSION['csrf_token']);
        }

        if(isset($_POST['checkout'])){
            if($_POST['total_cart'] == $_SESSION['total_cart']){
                $account = $_SESSION['auth'];
                $discount = $_POST['discount'];
                $payment = $_POST['address'];
                $address = $_POST['address'];
                $total = $_POST['total_cart'];
                $quantity = $_POST['quantity'];
                $code = $this->cart->create_code();
                $create_at = create_at();
                $create_by = $_SESSION['username'];
                if($discount ==! 0){
                    $foundValue = null;
                    foreach ($this->discount() as $item) {
                        // Kiểm tra nếu thuộc tính "id" của đối tượng bằng $targetId
                        if ($item->id == $discount) {
                            // Gán giá trị "value" của đối tượng này vào biến $foundValue
                            $foundValue = $item->value;
                            // Dừng vòng lặp sau khi tìm thấy đối tượng
                            break;
                        }
                    }
                    if($foundValue != null){
                        $price_after_apply = ($foundValue / 100) * $total;
                        $total_apply_discount = $total - $price_after_apply;
                        $bill_id = $this->cart-> createBill($account,$payment,$address,$discount,$code,$total,$total_apply_discount,$total_apply_discount,$create_at,$create_by);
                        if($bill_id){
                            $kq = $this->createBillDetail($bill_id,$quantity);
                            if($kq){
                                $this->cartEnd($bill_id);
                            }
                        }
                    }else{
                        header('Location: ' . BASE_URL . 'cart');
                    }
                }else{
                    $total_apply_discount = null;
                    $discount = null;
                    $bill_id = $this->cart-> createBill($account,$payment,$address,$discount,$code,$total,$total_apply_discount,$total,$create_at,$create_by);
                    if($bill_id){
                       $kq = $this->createBillDetail($bill_id,$quantity);
                       if($kq){
                           $this->cartEnd($bill_id);
                       }
                    }
                }
            }else{
                header('Location: ' . BASE_URL . 'cart');
            }
        }
    }

    public function createBillDetail($bill_id,$quantity)
    {
        $create_at = create_at();
        $create_by = $_SESSION['username'];
        $product_cart = $this->cart->product_cart($_SESSION['auth']);
        $check = true;
        for ($i = 0; $i < count($product_cart) ;$i++){;
            if($product_cart[$i]->price_after_reduction === null){
                $product_cart[$i]->price_after_reduction = 0;
            }
             $listQuantity = $this->cart->searchQuantity($product_cart[$i]->product_detail_id);
             $quantityNew = $listQuantity->quantity - $quantity[$i];
             $this->cart->updateQuantity($quantityNew,$listQuantity->id);
             $result = $this->cart->createBillDetail($bill_id,$product_cart[$i]->product_detail_id,$quantity[$i],$product_cart[$i]->price,$product_cart[$i]->price_after_reduction,$create_at,$create_by);
            if($result == true){
                $this->cart->cartDelete($product_cart[$i]->cart_id);
            }else{
                $check = false;
            }
        }
           return $check;
    }

    public function discountPublic()
    {
        if(isset($_POST['id'])){
            $id = $_POST['id'];
                    // Biến lưu giá trị "value" của đối tượng có id bằng 1 (nếu tìm thấy)
            $foundValue = null;
            foreach ($this->discount() as $item) {
                    // Kiểm tra nếu thuộc tính "id" của đối tượng bằng $targetId
                if ($item->id == $id) {
                    // Gán giá trị "value" của đối tượng này vào biến $foundValue
                    $foundValue = $item->value;
                    // Dừng vòng lặp sau khi tìm thấy đối tượng
                    break;
                }
            }
            if($foundValue != null){
                $price_after_apply = ($foundValue / 100) * $_SESSION['total_cart'];
                $total_apply_discount = $_SESSION['total_cart'] - $price_after_apply;
                echo json_encode(['price_after_apply'=>$price_after_apply ,'value' =>$foundValue,'total_apply_discount'=>$total_apply_discount]);
            }else{
                echo json_encode(['check'=>0,'total_cart'=>$_SESSION['total_cart']]);
            }


        }
    }

    public function cartEnd($id)
    {
        $bill = $this->cart->billDetail($id);
        return $this->render('cart.cartEnd',compact('bill'));
    }


}
