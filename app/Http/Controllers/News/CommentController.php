<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\News\FrontendController;
use App\Models\commentModel as MainModel;
use App\Http\Requests\commentRequest as MainRequest;

class CommentController extends FrontendController
{
    public function __construct()
    {
        $this->controllerName = 'rating';
        $this->model = new MainModel();
        parent::__construct();
    }

    public function addcomment(MainRequest $request)
    {
        if ($request->method() == 'POST') {
            $params = $request->all();

            // echo '<pre style="color:red";>$params === '; print_r($params);echo '</pre>';

            // echo '<h3>Die is Called rating COntroller</h3>';die;

            $notify = "Gửi rating thành công, Pet Shop xin cám ơn!";

            $this->model->saveItem($params, ['task' => 'add-item-news']);
            return redirect()->back()->with("news_notify", $notify);
        }
    }

}