<?php

namespace App\Http\Controllers\News;

use App\Models\CategoryModel;
use App\Models\CommentModel;
use App\Models\ProductModel;
use App\Models\RatingModel;
use App\Models\SettingModel;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Helpers\Functions;
use App\Models\ProductModel as MainModel;
use Illuminate\Support\Facades\Cookie;
use Psy\Util\Json;

class ProductController extends NewsController
{
    private $pathViewController = 'news.pages.product.';  // slider
    private $controllerName     = 'product';
    public function __construct()
    {
        view()->share('controllerName', $this->controllerName);
        $this->controllerName     = 'product';
        $this->model              = new MainModel();
        parent::__construct();
    }


    public function index(Request $request)
    {
        $params["id"]   = $request->product_id;
        //lay thong tin chi tiet san pham
        $item = $this->model->getItem($params, ['task' => 'news-get-item-product-detail']);
        $params['category_id']=$item->category_id;

        //lay related product
        $itemsRelated = $this->model->getItem($params, ['task' => 'news-get-item-product-related']);

        //get breadcrumbs
        $cat=new CategoryModel();
        $params['category_id']=$item->category_id;
        $breadItems = $cat->getItem($params,['task'=>'breadcrumbs']);

        //lay share button facebook,twitter
        $setting=new SettingModel();
        $share_setting=$setting->getItem(null,['task'=>'share']);
        //lay list comment
        $rating=new RatingModel();
        $itemsComment=$rating->listItems($params,['task'=>'news-list-items']);



        return view($this->pathViewController . 'index',compact(
            'item','breadItems','itemsRelated','share_setting','itemsComment'

        ));
    }
    
    //save comment
    public function comment(Request $request)
    {
        $params=$request->all();
        $params['product_id']=$request->product_id;

        $ratingModel=new RatingModel();
        $ratingModel->saveItem($params, ['task' => 'add-item']);
        return redirect(url()->previous() .'#reviews')->with(
            ['notify'=>'comment đang chờ duyệt,xin vui lòng đợi']
        );

    }

    public function modal(Request $request)
    {
        //lay thong tin chi tiet san pham

        $id=$request->id;
        $item = $this->model->getItem(['id'=>$id], ['task' => 'news-get-item-product-detail']);
        return view($this->pathViewController . 'modal',compact('item'));
    }





}