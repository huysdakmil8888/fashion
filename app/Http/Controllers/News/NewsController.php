<?php

namespace App\Http\Controllers\News;
use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\MenuModel;

class NewsController extends Controller
{
    public function __construct()
    {
        $menuModel = new MenuModel();
        $itemsMenu = $menuModel->listItems(null, ['task' => 'news-list-items']);

        $categoryModel = new CategoryModel();
        $itemsCategory = $categoryModel->listItems(null, ['task' => 'news-list-items']);
        view()->share(['itemsMenu'=> $itemsMenu,'itemsCategory'=>$itemsCategory]);
    }


}