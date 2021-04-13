<?php

namespace App\Http\Controllers\News;
use App\Models\ArticleModel;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\CategoryModel as MainModel;

class CategoryController extends FrontendController
{

    public function __construct()
    {
        $this->pathViewController = 'news.pages.category.';
        $this->controllerName = 'category';
        $this->model = new MainModel();
        parent::__construct();
    }

    public function index(Request $request)
    {
        $params['id']=$params['category_id']=$request->id;
        $params['price']['price_min'] = $request->input('price_min' ) ;
        $params['price']['price_max'] = $request->input('price_max' ) ;


        //lay danh sach san pham
        $productModel= new ProductModel();
        $items = $productModel->getItem($params, ['task' => 'news-get-item-category-id']);

        //lay breadcrumb
        $cat=new CategoryModel();
        $breadItem= $cat->getItem($params,['task'=>'news-get-item']);
        $breadItems = $cat->getItem($params,['task'=>'breadcrumbs']);

        //get all category with number article sidebar
        $params['parent_id']=$breadItem->parent_id;
        $cats=$cat->listItems($params,['task'=>'news-list-items-for-count']);

        //get product ban chay
        $itemsBestBuy=$productModel->getItem($params,['task'=>'news-get-item-buy']);

        //lay het cac tag cua product
        $tagModel=new Tag();
        $tags=$tagModel->getItem(null,['task'=>'get-list-items-for-product']);


        return view($this->pathViewController .  'index', compact(
            'items','breadItem',
            'breadItems','cats','itemsBestBuy','tags'

        ));
    }
 

}