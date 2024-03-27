<?php

use Phroute\Phroute\RouteCollector;

$url = !isset($_GET['url']) ? "/" : $_GET['url'];
$router = new RouteCollector();


if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

///

// filter check đăng nhập
$router->filter('auth', function(){
    if(!isset($_SESSION['auth']) || empty($_SESSION['auth'])){
        header('location: ' . BASE_URL . 'login');die;
    }
});

// khu vực cần quan tâm -----------
// bắt đầu định nghĩa ra các đường dẫn
$router->get('/', function(){
    if (!isset($_SESSION['auth']) || empty($_SESSION['auth'])) {
        header('Location: ' . BASE_URL . 'login');
        exit;
    }else{
        header('Location: ' . BASE_URL . 'dashboard');
    }
});
//đăng xuât
$router->get('logout',[\App\controllers\account\loginController::class,'logout']);
/// đăng nhập
$router->get('login',[\App\controllers\account\loginController::class,'login']);

$router->get('profile/{id}',[\App\controllers\account\loginController::class,'profile']);

$router->post('update/profile/{id}',[\App\controllers\account\loginController::class,'updateProfile']);

$router->post('checkAccount',[\App\controllers\account\loginController::class,'checkAccount']);
/// Đăng ký
$router->get('register',[\App\controllers\account\loginController::class,'register']);
$router->post('create-account',[\App\controllers\account\loginController::class,'createAccount']);
// Thống kê
$router->get('dashboard',[\App\controllers\admin\statisticalController::class,'index']);
// danh mục
$router->get('manage/category',[\App\controllers\admin\categoryController::class,'index']);
$router->post('search-category',[\App\controllers\admin\categoryController::class,'searchCategory']);
$router->get('detail-category/{id}',[\App\controllers\admin\categoryController::class,'detailCategory']);
$router->get('add-category',[\App\controllers\admin\categoryController::class,'addCategory']);
$router->post('action-add-category',[\App\controllers\admin\categoryController::class,'actionAddCategory']);
$router->get('edit-category/{id}',[\App\controllers\admin\categoryController::class,'editCategory']);
$router->post('action-edit-category/{id}',[\App\controllers\admin\categoryController::class,'actionEditCategory']);
$router->get('deleted-category/{id}',[\App\controllers\admin\categoryController::class,'deletedCategory']);
// product
$router->get('manage/product',[\App\controllers\admin\productController::class,'index']);
$router->post('search-product',[\App\controllers\admin\productController::class,'searchProduct']);
$router->get('add-product',[\App\controllers\admin\productController::class,'addProduct']);
$router->post('action-add-product',[\App\controllers\admin\productController::class,'actionAddProduct']);
$router->get('detail-product/{id}',[\App\controllers\admin\productController::class,'detailProduct']);
$router->get('edit-product/{id}',[\App\controllers\admin\productController::class,'editProduct']);
$router->post('action-edit-product/{id}',[\App\controllers\admin\productController::class,'actionEditProduct']);
$router->get('deleted-product/{id}',[\App\controllers\admin\productController::class,'deletedProduct']);
// account
$router->get('manage/account',[\App\controllers\admin\accountController::class,'index']);
$router->post('search-account',[\App\controllers\admin\accountController::class,'searchAccount']);
$router->get('detail-account/{id}',[\App\controllers\admin\accountController::class,'detailAccount']);
$router->get('edit-account/{id}',[\App\controllers\admin\accountController::class,'editAccount']);
$router->post('action-edit-account/{id}',[\App\controllers\admin\accountController::class,'actionEditAccount']);
// promotion
$router->get('manage/promotion',[\App\controllers\admin\promotionController::class,'index']);
$router->post('search-promotion',[\App\controllers\admin\promotionController::class,'searchPromotion']);
$router->get('add-promotion',[\App\controllers\admin\promotionController::class,'addPromotion']);
$router->post('action-add-promotion',[\App\controllers\admin\promotionController::class,'actionAddPromotion']);
$router->get('edit-promotion/{id}',[\App\controllers\admin\promotionController::class,'editPromotion']);
$router->post('action-edit-promotion/{id}',[\App\controllers\admin\promotionController::class,'actionEditPromotion']);
$router->get('detail-promotion/{id}',[\App\controllers\admin\promotionController::class,'promotionDetail']);
$router->get('deleted-promotion/{id}',[\App\controllers\admin\promotionController::class,'promotionDeleted']);
$router->get('apply-now',[\App\controllers\admin\promotionController::class,'listPromotionApplyNow']);
// promotionDetail
// view
$router->get('apply-promotion',[\App\controllers\admin\promotionController::class,'applyPromotion']);
// search
$router->post('search-product-promotion',[\App\controllers\admin\promotionController::class,'searchProduct']);
// add
$router->get('add-PromotionDetail/{id}',[\App\controllers\admin\promotionController::class,'addPromotionDetail']);
$router->post('action-add-detail-promotion/{id}',[\App\controllers\admin\promotionController::class,'actionAddPromotionDetail']);
// edit
$router->get('edit-promotionDetail/{id}',[\App\controllers\admin\promotionController::class,'editPromotionDetail']);
$router->post('action-edit-detail-promotion/{id}',[\App\controllers\admin\promotionController::class,'actionEditPromotionDetail']);
// ajax jquery check
$router->post('checkAfterPrice',[\App\controllers\admin\promotionController::class,'checkAfterPrice']);
// detail
$router->get('detail-promotionDetail/{id}',[\App\controllers\admin\promotionController::class,'detailPromotionDetail']);
// deleted
$router->get('deleted-promotionDetail/{id}',[\App\controllers\admin\promotionController::class,'deletedPromotionDetail']);
// size
$router->get('manage/size',[\App\controllers\admin\sizeController::class,'index']);
$router->post('search-size',[\App\controllers\admin\sizeController::class,'searchSize']);
$router->get('add-size',[\App\controllers\admin\sizeController::class,'addSize']);
$router->post('action-add-size',[\App\controllers\admin\sizeController::class,'actionAddSize']);
$router->get('edit-size/{id}',[\App\controllers\admin\sizeController::class,'editSize']);
$router->post('action-edit-size/{id}',[\App\controllers\admin\sizeController::class,'actionEditSize']);
$router->get('detail-size/{id}',[\App\controllers\admin\sizeController::class,'detailSize']);
$router->get('deleted-size/{id}',[\App\controllers\admin\sizeController::class,'deletedSize']);
// image
$router->get('image-product/{id}',[\App\controllers\admin\imageController::class,'imageProduct']);
$router->post('action-add-image/{id}',[\App\controllers\admin\imageController::class,'actionAddImage']);
$router->get('deleted-image/{id}/{product_id}',[\App\controllers\admin\imageController::class,'deletedImage']);
// voucher
$router->get('manage/voucher',[\App\controllers\admin\voucherController::class,'index']);
$router->post('search-voucher',[\App\controllers\admin\voucherController::class,'searchVoucher']);
$router->get('add-voucher',[\App\controllers\admin\voucherController::class,'addVoucher']);
$router->post('action-add-voucher',[\App\controllers\admin\voucherController::class,'actionAddVoucher']);
$router->get('edit-voucher/{id}',[\App\controllers\admin\voucherController::class,'editVoucher']);
$router->post('action-edit-voucher/{id}',[\App\controllers\admin\voucherController::class,'actionEditVoucher']);
$router->get('detail-voucher/{id}',[\App\controllers\admin\voucherController::class,'detailVoucher']);
$router->get('deleted-voucher/{id}',[\App\controllers\admin\voucherController::class,'deletedVoucher']);
//$router->get('image',[App\Controllers\imageController::class,'index']);
//định nghĩa đường dẫn trỏ đến Product Controller
// bill
$router->get('manage/bill',[\App\controllers\admin\billController::class,'index']);
$router->post('search-bill',[\App\controllers\admin\billController::class,'searchBill']);
$router->get('manage/update/bill/{key}/{id}',[\App\controllers\admin\billController::class,'updateStatus']);


/// user
/// hom-page
$router->get('home-page',[\App\controllers\user\homePageController::class,'index']);
// product
$router->get('shop',[\App\controllers\user\productsController::class,'index']);
$router->post('shop/search',[\App\controllers\user\productsController::class,'searchProduct']);
// pagination
$router->get('product/{page}',[\App\controllers\user\productsController::class,'pagination']);
// getListCatagory
$router->get('category/{id}/{page}',[\App\controllers\user\productsController::class,'paginationFilterCategory']);
$router->get('category/{id}',[\App\controllers\user\productsController::class,'filterCategory']);
// product detail
$router->get('productDetail/{id}',[\App\controllers\user\productsController::class,'productDetail']);
// add to cart
$router->post('cart',[\App\controllers\user\cartController::class,'addToCart']);
// cart index
$router->get('cart',[\App\controllers\user\cartController::class,'index']);
// deleted cart
$router->get('cartDelete/{id}',[\App\controllers\user\cartController::class,'cartDelete']);
// updateform
$router->post('checkoutCart',[\App\controllers\user\cartController::class,'checkoutCart']);
// discount voucher
$router->post('checkDiscount',[\App\controllers\user\cartController::class,'discountVoucher']);
// khu vực cần quan tâm -----------
$router->get('/address/add',[\App\controllers\user\addressController::class,'add']);
//
$router->post('add-to-address',[\App\controllers\user\addressController::class,'addToAddress']);
//$router->get('test', [App\Controllers\ProductController::class, 'index']);

$router->get('cart/end',[\App\controllers\user\cartController::class,'cartEnd']);

// bill
$router->get('bill',[\App\controllers\user\billController::class,'index']);
$router->get('updateBill/{key}/{id}',[\App\controllers\user\billController::class,'updateBill']);
$router->get('bill/detail/{id}',[\App\controllers\user\billController::class,'billDetail']);

// route product ajax
$router->post('profile',[\App\controllers\account\loginController::class,'editData']);

$router->post('filter',[\App\controllers\user\productsController::class,'filter']);
$router->post('price',[\App\controllers\user\productsController::class,'price']);
$router->post('comment',[\App\controllers\user\productsController::class,'comment']);
$router->post('discountPublic',[\App\controllers\user\cartController::class,'discountPublic']);
$router->post('district',[\App\controllers\user\addressController::class,'district']);
$router->post('ward',[\App\controllers\user\addressController::class,'ward']);
$router->post('village',[\App\controllers\user\addressController::class,'village']);

# NB. You can cache the return value from $router->getData() so you don't have to create the routes each request - massive speed gains
$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());

$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $url);

// Print out the value returned from the dispatched function
echo $response;
?>