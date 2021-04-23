<?php

namespace App\Http\Controllers\News;
use App\Http\Controllers\Controller;
use App\Models\AdModel;
use App\Models\CategoryArticleModel;
use App\Models\CategoryModel;
use App\Models\MenuModel;
use App\Models\PageModel;
use App\Models\SettingModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class NewsController extends Controller
{
    public function __construct()
    {
        //lay menu
        $menuModel = new MenuModel();
        $itemsMenu = $menuModel->listItems(null, ['task' => 'news-list-items']);

        //lay page
        $pageModel = new PageModel();
        $itemsPage = $pageModel->listItems(null, ['task' => 'news-list-items']);

        //lay category product
        $categoryModel = new CategoryModel();
        $itemsCategory = $categoryModel->listItems(null, ['task' => 'news-list-items']);

        //lay category article
        $categoryArticleModel = new CategoryArticleModel();
        $itemsCategoryArticle = $categoryArticleModel->listItems(null, ['task' => 'news-list-items']);

        //lay setting general
        $settingModel=new SettingModel();
        $setting_general=$settingModel->getItem(null,['task'=>'general']);

        //lay quang cao footer
        $adModel = new AdModel();
        $adFooter=$adModel->getItem(['position'=>'footer'],['task'=>'news-list-items']);




        view()->share(compact(
            'adFooter','itemsPage',
            'setting_general','itemsMenu','itemsCategory','itemsCategoryArticle'
        ));
    }


}