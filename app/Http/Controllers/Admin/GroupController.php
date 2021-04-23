<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GroupModel as MainModel;
use App\Http\Requests\GroupRequest as MainRequest ;
use Illuminate\Support\MessageBag;

class GroupController extends AdminController
{
    
    public function __construct() 
    {
        $this->pathViewController = 'admin.pages.group.';
        $this->controllerName = 'group';
        $this->model = new MainModel();
        $this->params["pagination"]["totalItemsPerPage"] = 10;
        parent::__construct();
    }

    public function save(MainRequest $request)
    {
        if ($request->method() == 'POST') {
            $params = $request->except('_token'); //loai bo token


            $task   = "add-item";
            $notify = "Thêm phần tử thành công!";

            if($params['id'] !== null) {
                $task   = "edit-item";
                $notify = "Cập nhật phần tử thành công!";
            }
            $this->model->saveItem($params, ['task' => $task]);
            return redirect()->back()->with("zvn_notify", $notify);
        }
    }

    public function changeLevel(MainRequest $request)
    {
        if ($request->method() == 'POST') {
            $params = $request->all();
            $this->model->saveItem($params, ['task' => 'change-level-post']);
            return redirect()->back()->with("zvn_notify", "Thay đổi level thành công!");
        }
    }

    public function changePassword(MainRequest $request)
    {
        if ($request->method() == 'POST') {
            $params = $request->all();
            $this->model->saveItem($params, ['task' => 'change-password']);
            return redirect()->back()->with("zvn_notify", "Thay đổi mật khẩu thành công!");
        }
    }

    public function level(Request $request) {
        $params["currentLevel"]   = $request->level;
        $params["id"]               = $request->id;
        $this->model->saveItem($params, ['task' => 'change-level']);
        return redirect()->route($this->controllerName)->with("zvn_notify", "Cập nhật kiểu hiện thị thành công!");
    }

    public function changeLoggedPassword()
    {
        return view($this->pathViewController . 'form_change_logged_password');
    }

    public function postChangeLoggedPassword(MainRequest $request, MessageBag $messageBag)
    {
        if ($request->method() == 'POST') {
            $params = $request->all();
            
            $groupModel = new MainModel();
            $groupInfo = $groupModel->getItem($params, ['task' => 'check-password']);

            if (!$groupInfo) {
                $messageBag->add('old_password', 'Old password is wrong');
                return redirect()->route($this->controllerName . '/change-logged-password')->withErrors($messageBag);
            }

            $this->model->saveItem($params, ['task' => 'change-logged-password']);
            return redirect()->route($this->controllerName)->with('zvn_notify', 'Thay đổi mật khẩu thành công!');
        }
    }

}