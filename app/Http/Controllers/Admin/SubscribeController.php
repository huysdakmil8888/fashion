<?php

namespace App\Http\Controllers\Admin;
use App\Mail\MailService;
use App\Models\SubscribeModel as MainModel;
use App\Http\Requests\SubscribeRequest as MainRequest;

class SubscribeController extends AdminController
{
    public function __construct()
    {
        $this->pathViewController = 'admin.pages.subscribe.';
        $this->controllerName = 'subscribe';
        $this->model = new MainModel();
        $this->params["pagination"]["totalItemsPerPage"] = 5;
        parent::__construct();
    }

    public function save(MainRequest $request)
    {
        if ($request->method() == 'POST') {
            $params = $request->except('_token');
            $listSubscribe=$this->model->listItems(null,['task'=>'news-list-items']);
            $params['email']=$listSubscribe[0]['email'];
            unset($listSubscribe[0]);
            $params['bcc']=array_column($listSubscribe,'email');

            $mailService = new MailService();
            $mailService->sendSubscribe($params);




            return redirect()->back()->with('zvn_notify', 'Đã gửi email cho subscriber thành công!');
        }
    }
}