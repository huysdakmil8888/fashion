<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Mail\MailService;
use App\Models\AdModel;
use App\Models\ArticleModel;
use App\Models\CustomerModel;
use App\Models\MenuModel;
use App\Models\ProductModel;
use App\Models\SubscribeModel;
use App\Models\TestimonialModel;
use Illuminate\Database\Eloquent\Model;
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
    public function subscribe(Request $request)
    {
        $params=$request->data;

        $subscribeModel=new SubscribeModel();
        $result=$subscribeModel->getItem($params,['task'=>'get-email']);
        if($result){
            $message=0;
        }else{
            $subscribeModel->saveItem($params,['task'=>'add-item']);
            $message=1;
            //send email
            $data = [
                'name' => '',
                'email' => $params['email'],
                'message' => route("home/unsubscribe",["email"=>$params['email']]),
            ];


//            $mailService = new MailService();
//            $mailService->sendSubscribe($data);

        }
        return response()->json([
           'message'=>$message
        ]);
    }
    public function unsubscribe()
    {
        return view($this->pathViewController . 'unsubscribe');
    }
    public function delete_unsubscribe(Request $request)
    {
        $params['email']=$request->email;

        $subscribeModel=new SubscribeModel();
        $result=$subscribeModel->getItem($params,['task'=>'get-email']);
        if($result){
            $message=0;
            $subscribeModel->getItem($params,['task'=>'change-status']);
        }else{
            $message=1;

        }
        echo "ban da huy dang ki web cua chung toi <br />vui long nhap vao <a href='".route('home')."'>day</a> de quay lai trang chu";
    }


}