<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\CategoryArticleModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use App\Models\ArticleModel as MainModel;
use App\Models\CategoryModel;
use App\Http\Requests\ArticleRequest as MainRequest ;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ArticleController extends AdminController
{
    public function __construct()
    {
        $this->pathViewController = 'admin.pages.article.';
        $this->controllerName = 'article';
        $this->model = new MainModel();
        parent::__construct();


    }

    public function form(Request $request)
    {

//        Auth::user()->can('sửa xóa bài viết');

        $categoryModel=new CategoryArticleModel();
        $itemsCategoryArticle  = $categoryModel->listItems(null, ['task' => 'admin-list-items-in-select-box']);


        $item = null;
        if($request->id !== null ) {
            $params["id"] = $request->id;
            $item = $this->model->getItem( $params, ['task' => 'get-item']);
        }


        return view($this->pathViewController .  'form', [
            'item'        => $item,
            'itemsCategoryArticle'=>$itemsCategoryArticle
        ]);
    }

    public function save(Request $request)
    {
        if ($request->method() == 'POST') {
            $params = $request->all();

            if(empty($params['slug'])){
                $params['slug']=Str::slug($params['name']);
            }
            $params['user_id']=session('userInfo')['id'];

            
            $task   = "add-item";
            $notify = "Thêm phần tử thành công!";

            if($params['id'] !== null) {
                $task   = "edit-item";
                $notify = "Cập nhật phần tử thành công!";
            }
            $this->model->saveItem($params, ['task' => $task]);
            return redirect()->route($this->controllerName)->with("zvn_notify", $notify);
        }
    }

    public function type(Request $request) {

        $params["currentType"]    = $request->type;
        $params["id"]             = $request->id;
        $result=$this->model->saveItem($params, ['task' => 'change-type']);
        echo json_encode($result);

    }

}