<?php

namespace App\Http\Controllers\Admin;
use App\Models\OrderModel as MainModel;
use App\Http\Requests\OrderRequest as MainRequest;
use Illuminate\Http\Request;

class OrderController extends AdminController
{
    public function __construct()
    {
        $this->pathViewController = 'admin.pages.order.';
        $this->controllerName = 'order';
        $this->model = new MainModel();
        $this->params["pagination"]["totalItemsPerOrder"] = 10;
        parent::__construct();
    }

    public function save(MainRequest $request)
    {
        if ($request->method() == 'POST') {
            $params = $request->all();
            
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
    public function changeStatus(Request $request)
    {
        $this->params['change-status'] = $request->change_status;
        $this->params['id'] = $request->id;
        $this->params['controllerName']=$this->controllerName;
        $result = $this->model->saveItem($this->params, ['task' => 'change-status-ajax']);
        echo json_encode($result);
    }
}