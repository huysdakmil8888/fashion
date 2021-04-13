<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Models\AdModel;
use App\Models\ArticleModel;
use App\Models\CustomerModel;
use App\Models\MenuModel;
use App\Models\ProductModel;
use App\Models\TestimonialModel;
use Illuminate\Http\Request;
use App\Models\SliderModel;
use App\Models\CategoryModel;

class HomeController extends NewsController
{
    private $pathViewController = 'news.pages.home.';
    private $controllerName = 'home';
    private $params = [];
    private $model;

    public function __construct()
    {
        view()->share('controllerName', $this->controllerName);
        parent::__construct();
    }

    public function index(Request $request)
    {

        /*================================= lay slider ==========================*/
        $sliderModel = new SliderModel();
        $itemsSlider = $sliderModel->listItems(null, ['task' => 'news-list-items']);

        /*================================= lay testimonial ==========================*/
        $testimonialModel = new TestimonialModel();
        $itemsTestimonial = $testimonialModel->listItems(null, ['task' => 'news-list-items']);

        /*================================= lay recent product ==========================*/
        $productModel  = new ProductModel();
        $itemsProductRecent         = $productModel->listItems(null, ['task' => 'news-list-items']);

        /*================================= lay sale product ==========================*/
        $productModel  = new ProductModel();
        $itemsProductSale         = $productModel->listItems(null, ['task' => 'news-list-items-for-sale']);

        /*================================= lay deal product ==========================*/
        $productModel  = new ProductModel();
        $itemsProductDeal        = $productModel->listItems(null, ['task' => 'news-list-items-for-deal']);
        /*================================= lay recent article ==========================*/
        $articleModel = new ArticleModel();
        $itemsArticle = $articleModel->listItems(null, ['task' => 'news-list-items']);

        //lay quang cao bottom
        $adModel = new AdModel();
        $adList=$adModel->listItems(null,['task'=>'news-list-items']);
        foreach ($adList as $item) {
           $ad[$item->position][]=$item;
        }

        return view($this->pathViewController . 'index',compact(
            'itemsSlider',
        'itemsTestimonial',
                    'itemsProductRecent',
                    'itemsArticle',
                    'ad',
                    'itemsProductSale',
                    'itemsProductDeal'
        ));
    }

    public function notFound(Request $request)
    {
        return view($this->pathViewController . 'not-found');
    }
    public function myAccount(Request $request)
    {
        return view($this->pathViewController . 'my-account');
    }
    public function registerLogin(Request $request)
    {
        return view($this->pathViewController . 'login-register');
    }

    public function register(CustomerRequest $request)
    {
        $params=$request->all();

        $customerModel=new CustomerModel();
        $customerModel->saveItem($params,['task'=>'add-item']);
        return redirect(url()->previous() .'#form-register')->with(
            ['news_notify'=>'Tài khoản của bạn đã được đăng kí']
        );
    }


}