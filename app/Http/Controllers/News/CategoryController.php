<?php

namespace App\Http\Controllers\News;
use App\Models\ArticleModel;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\CategoryModel as MainModel;
use Illuminate\Support\Facades\Cookie;

class CategoryController extends FrontendController
{

    public function __construct()
    {
        $this->pathViewController = 'news.pages.category.';
        $this->controllerName = 'category';
        $this->model = new MainModel();

        //price min max
        $this->params['price']['price_min'] = request()->input('price_min' ) ;
        $this->params['price']['price_max'] = request()->input('price_max' ) ;
        $itemsNum=$this->params['show'] = request()->input('show',15 ) ;
        $itemsOrder=$this->params['order'] = request()->input('order','id_desc' ) ;

        //lay het cac tag cua product
        $tagModel=new Tag();
        $tags=$tagModel->getItem(null,['task'=>'get-list-items-for-product']);

        //object product
        $this->productModel=new ProductModel();


        view()->share(compact(
            'tags','itemsNum','itemsOrder'
        ));

        parent::__construct();
    }

    public function index(Request $request)
    {
        $this->params['id']=$this->params['category_id']=$request->id;
        $this->params['price']['price_min'] = $request->input('price_min' ) ;
        $this->params['price']['price_max'] = $request->input('price_max' ) ;


        //lay danh sach san pham
        $productModel= new ProductModel();
        $items = $productModel->getItem($this->params, ['task' => 'news-get-item-category-id']);

        //lay breadcrumb
        $cat=new CategoryModel();
        $breadItem= $cat->getItem($this->params,['task'=>'news-get-item']);
        $breadItems = $cat->getItem($this->params,['task'=>'breadcrumbs']);

        //get all category with number article sidebar
        $this->params['parent_id']=$breadItem->parent_id;
        $cats=$cat->listItems($this->params,['task'=>'news-list-items-for-count']);

        //get product ban chay
        $itemsBestBuy=$productModel->getItem($this->params,['task'=>'news-get-item-buy']);

        //lay het cac tag cua product
        $tagModel=new Tag();
        $tags=$tagModel->getItem(null,['task'=>'get-list-items-for-product']);


        return view($this->pathViewController .  'index', compact(
            'items','breadItem',
            'breadItems','cats','itemsBestBuy'

        ));
    }
    public function addWishList(Request $request)
    {
        $data=$request->data;
        $params=json_decode($request->cookie('ids'))??[]; //convert to array

        $ids=$params;
        if(in_array($data['id'],$params)){
            $message=0;
        }else{
            $ids[]=$data['id'];
            $message=1;
        }
        return response()->json([
            'message'=>$message,
            'count'=>count($ids)
        ])
            ->withCookie('ids', json_encode($ids), 100000) //convert to string
            ;
    }
    public function wishlist(Request $request)
    {
        $this->params['ids']=json_decode(Cookie::get('ids')); //convert to string

        //lay danh sach san pham
        if($this->params['ids']){
            $items = $this->productModel->listItems($this->params, ['task' => 'news-get-product','type'=>'wishlist']);
        }else{
            $items=[];
        }


        $breadcrumbName='Danh m???c ??a th??ch';
        return view($this->pathViewController .  'all', compact(
        'items','breadcrumbName'
        ));


    }
    public function productnews()
    {
        //lay danh sach san pham
        $items = $this->productModel->listItems($this->params, ['task' => 'news-get-product','type'=>'news']);

        $breadcrumbName='S???n ph???m m???i nh???t';
        return view($this->pathViewController .  'all', compact(
            'items','breadcrumbName'
        ));


    }
    public function productbestbuy()
    {
        //lay danh sach san pham
        $items = $this->productModel->listItems($this->params, ['task' => 'news-get-product','type'=>'bestbuy']);

        $breadcrumbName='S???n ph???m b??n ch???y nh???t';
        return view($this->pathViewController .  'all', compact(
            'items','breadcrumbName'
        ));


    }
    public function productbestdeal()
    {
        //lay danh sach san pham
        $items = $this->productModel->listItems($this->params, ['task' => 'news-get-product','type'=>'bestdeal']);

        $breadcrumbName='S???n ph???m c?? gi?? h???p l?? nh???t';
        return view($this->pathViewController .  'all', compact(
            'items','breadcrumbName'
        ));


    }
    public function productsale()
    {
        //lay danh sach san pham
        $items = $this->productModel->listItems($this->params, ['task' => 'news-get-product','type'=>'sale']);

        $breadcrumbName='S???n ph???m ??ang gi???m gi??';
        return view($this->pathViewController .  'all', compact(
            'items','breadcrumbName'
        ));


    }
    public function productfeatured()
    {
        //lay danh sach san pham
        $items = $this->productModel->listItems($this->params, ['task' => 'news-get-product','type'=>'featured']);

        $breadcrumbName='S???n ph???m n???i b???t';
        return view($this->pathViewController .  'all', compact(
            'items','breadcrumbName'
        ));


    }
    public function search(Request $request)
    {
        //lay danh sach san pham
        $this->params['name']=$request->search;
        $items = $this->productModel->listItems($this->params, ['task' => 'news-get-product','type'=>'search']);

        $breadcrumbName="T??m ki???m v???i t??? kh??a: {$this->params['name']}";
        return view($this->pathViewController .  'all', compact(
            'items','breadcrumbName'
        ));


    }
    public function tag(Request $request)
    {
        //lay danh sach san pham
        $this->params['id']=$request->tag_id;
        $tagModel=new Tag();
        $tag=$tagModel->getItem($this->params,['task'=>'get-item']);
        $items = $this->productModel->listItems($this->params, ['task' => 'news-get-item-by-tag','type'=>'search']);




        $breadcrumbName="T??m ki???m v???i tag: ".$tag->name;

        return view($this->pathViewController .  'all', compact(
            'items','breadcrumbName'
        ));


    }

 

}