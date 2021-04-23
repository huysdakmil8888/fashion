<?php

namespace App\Http\Controllers\News;
use App\Http\Controllers\Controller;
use App\Models\CategoryPageModel;
use App\Models\CommentPageModel;
use App\Models\CommentModel;
use App\Models\SettingModel;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use App\Models\PageModel;
use App\Models\CategoryModel;

class PageController extends NewsController
{
    private $pathViewController = 'news.pages.page.';  // slider
    private $controllerName     = 'page';
    private $params             = [];
    private $model;

    public function __construct()
    {
        view()->share('controllerName', $this->controllerName);
        parent::__construct();
    }

    public function index(Request $request)
    {

        $params['id']=$request->id;
        //lay breadcrumb
        $cat=new PageModel();
        $breadItem= $cat->getItem($params,['task'=>'news-get-item']);
        $breadItems = $cat->getItem($params,['task'=>'breadcrumbs']);


         $pageModel  = new PageModel();
         $items = $pageModel->getItem($params, ['task' => 'get-item']);


        return view($this->pathViewController .  'index', compact(
            'items','breadItem','breadItems'

        ));
    }




}