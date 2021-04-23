<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthLoginRequest as MainRequest;
use App\Http\Requests\CustomerRequest;
use App\Models\AdModel;
use App\Models\ArticleModel;
use App\Models\CustomerModel;
use App\Models\MenuModel;
use App\Models\ProductModel;
use App\Models\TestimonialModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\SliderModel;
use App\Models\CategoryModel;

class CustomerController extends NewsController
{
    private $pathViewController = 'news.pages.customer.';
    private $controllerName = 'customer';
    private $params = [];
    private $model;

    public function __construct()
    {
        view()->share('controllerName', $this->controllerName);
        $this->model=new CustomerModel();
        parent::__construct();
    }


    public function myAccount(Request $request)
    {
        $params['id']=session('customerInfo')['id'];
        $item=$this->model->getItem($params,['task'=>'get-item-for-news']);
        return view($this->pathViewController . 'my-account',compact('item'));

    }
    public function edit(CustomerRequest $request)
    {
        $params['data']=$request->data;
        $params['data']['id']=session('customerInfo')['id'];
//        $item=$this->model->getItem($params,['task'=>'get-item-for-news-info']);
        return response()->json([
           'data'=>$params['data']
        ]);

    }
    public function registerLogin(Request $request)
    {
        if (session('customerInfo')) return redirect()->route('home');
        return view($this->pathViewController . 'login-register');
    }

    public function register(CustomerRequest $request)
    {
        $params=$request->all();

        $customerModel=new CustomerModel();
        $customerModel->saveItem($params,['task'=>'add-item']);
        return redirect(url()->previous() .'#form-register')->with(
            ['notify'=>'Tài khoản của bạn đã được đăng kí']
        );
    }
    public function login(Request $request)
    {
        if ($request->method() == 'POST') {
            $params = $request->all();

            $customerModel = new CustomerModel();
            $customerInfo = $customerModel->getItem($params, ['task' => 'auth-login']);

            if (!$customerInfo) return redirect()->back()->with('alert', 'Tài khoản hoặc mật khẩu không chính xác!');

            $request->session()->put('customerInfo', $customerInfo);
            return redirect()->route('customer/my-account');
        }
    }

    public function logout(Request $request)
    {
        if($request->session()->has('customerInfo')) {
            $request->session()->pull('customerInfo');
        }
        return redirect()->route('home');
    }


}