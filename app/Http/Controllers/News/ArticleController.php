<?php

namespace App\Http\Controllers\News;
use App\Http\Controllers\Controller;
use App\Models\CategoryArticleModel;
use App\Models\CommentArticleModel;
use App\Models\CommentModel;
use App\Models\SettingModel;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use App\Models\ArticleModel;
use App\Models\CategoryModel;

class ArticleController extends NewsController
{
    private $pathViewController = 'news.pages.article.';  // slider
    private $controllerName     = 'article';
    private $params             = [];
    private $model;

    public function __construct()
    {
        view()->share('controllerName', $this->controllerName);
        parent::__construct();
    }

    public function index(Request $request)
    {

        $params['category_article_id']=$request->category_article_id;
        //lay breadcrumb
        $cat=new CategoryArticleModel();
        $breadItem= $cat->getItem($params,['task'=>'news-get-item']);
        $breadItems = $cat->getItem($params,['task'=>'breadcrumbs']);


         $articleModel  = new ArticleModel();
         $items = $articleModel->getItem($params, ['task' => 'news-get-item']);


        return view($this->pathViewController .  'index', compact(
            'items','breadItem','breadItems'

        ));
    }
    public function archive(Request $request)
    {
        $params['archive']=$request->archive;
        $params['category_article_id']=4;
        $articleModel  = new ArticleModel();
        $name='archive';
        $items = $articleModel->getItem($params, ['task' => 'news-get-item-archive']);

        return view($this->pathViewController .  'archive',compact('items','name'));
    }
    public function tag(Request $request)
    {
        $params['tag']=$request->tag;
        $articleModel  = new ArticleModel();
        $items = $articleModel->getItem($params, ['task' => 'news-get-item-by-tag']);

        $tag=new Tag();

        $n=$tag->getItem(['id'=>$params['tag']],['task'=>'get-item']);

        $name='Tag: '.$n->name;


        return view($this->pathViewController .  'archive',compact('items','name'));
    }
    //chi tiet bai viet
    public function detail(Request $request)
    {
        //lay chi tiet bai viet
        $articleModel  = new ArticleModel();
        $params['id']=$request->id;
        $item = $articleModel->getItem($params, ['task' => 'get-item']);

        //get breadcrumbs
        $cat=new CategoryArticleModel();
        $params['category_article_id']=$item->category_article_id;
        $breadItems = $cat->getItem($params,['task'=>'breadcrumbs']);

        //get all category with number article
        $cats=$cat->listItems(null,['task'=>'news-list-items-for-count']);


        //get all article same category recently
        $itemsRecent=$articleModel->getItem($params,['task'=>'news-get-item-recent']);

        //get archive
        $itemsArchive=$articleModel->getItem($params,['task'=>'news-get-item-archive']);

        //lay share button facebook,twitter
        $setting=new SettingModel();
        $share_setting=$setting->getItem(null,['task'=>'share']);

        //lay list comment
        $comment=new CommentModel();
        $itemsComment=$comment->listItems(null,['task'=>'news-list-items']);


        /*================================= increase view ==========================*/
        if($_SERVER['REMOTE_ADDR']!=session('ip') || strtotime(now())>session('time')+60 || $request->url()!= session('url')){
            session(['ip'=>$_SERVER['REMOTE_ADDR']]);
            session(['time'=>strtotime(now())]);
            session(['url'=>$request->url()]);
            $params['view']=$item->view+1;
            $articleModel->increaseView($params);
        }


        return view($this->pathViewController .  'detail', compact(
            'item','breadItems','cats','itemsRecent',
            'itemsArchive','share_setting','itemsComment'

        ));
    }

    public function increaseLike(Request $request)
    {
        $params['id']=$request->id;
        $articleModel=new ArticleModel();
        $item = $articleModel->getItem($params, ['task' => 'get-item']);

        /*================================= increase view ==========================*/
        if($_SERVER['REMOTE_ADDR']!=session('ip') || strtotime(now())>session('time')+60 ){
            session(['ip'=>$_SERVER['REMOTE_ADDR']]);
            session(['time'=>strtotime(now())]);
            $params['like']=$item->like+1;
            $articleModel->increaseLike($params);
        }
        return response()->json(['like'=>$params['like']]);

    }

    //post comment
    public function comment(Request $request)
    {
        $params=$request->all();
        $commentModel=new CommentModel();
        $commentModel->saveItem($params, ['task' => 'add-item']);

        return redirect(url()->previous() .'#comment-form')->with(
            ['notify'=>'comment đang chờ duyệt,xin vui lòng đợi']
        );


    }



}