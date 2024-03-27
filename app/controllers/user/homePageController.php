<?php
namespace App\controllers\user;
use App\controllers\BaseController;
use App\models\user\homePage;

class homePageController extends BaseController
{
    public $homePage;

    public function __construct()
    {
        $this->homePage = new homePage();
    }

    public function index()
    {
        $product = $this->homePage->getListProduct(0,8);
        $category = $this->homePage->getListCategory();
        $productDetailSale = $this->homePage->getProductDetailSale();
        $this->render('home-page-user.home-page',compact(['category','product','productDetailSale']));
    }

}