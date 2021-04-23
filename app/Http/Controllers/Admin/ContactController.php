<?php

namespace App\Http\Controllers\Admin;

use App\Models\ContactModel as MainModel;
use Illuminate\Http\Request;

class ContactController extends AdminController
{
    public function __construct()
    {
        $this->controllerName = 'contact';
        $this->pathViewController = 'admin.pages.contact.';
        parent::__construct();
        $this->model = new MainModel();
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
