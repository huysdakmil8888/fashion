<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\UserModel;
use Illuminate\Http\Request;
use App\Models\UserModel as MainModel;
use App\Http\Requests\UserRequest as MainRequest ;
use Illuminate\Support\MessageBag;

class UserController extends AdminController
{
    
    public function __construct() 
    {
        $this->pathViewController = 'admin.pages.user.';
        $this->controllerName = 'user';
        $this->model = new MainModel();
        $this->params["pagination"]["totalItemsPerPage"] = 10;
        $this -> middleware('role:admin')->except('changeLoggedPassword','postChangeLoggedPassword');

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

    //change level in form
    public function changeLevel(MainRequest $request)
    {
        if ($request->method() == 'POST') {
            $params = $request->all();
            $user=UserModel::find($params['id']);
            $user->syncRoles($params['level']);
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

    //change level in index
    public function level(Request $request) {
        $params["currentLevel"]   = $request->level;
        $params["id"]               = $request->id;
        $user=UserModel::find($params['id']);
        $user->syncRoles($params['currentLevel']);
        echo json_encode([
            'message'=>'cập nhật quyền thành công!'
        ]);
    }

    public function changeLoggedPassword()
    {
        return view($this->pathViewController . 'form_change_logged_password');
    }

    public function postChangeLoggedPassword(MainRequest $request, MessageBag $messageBag)
    {
        if ($request->method() == 'POST') {
            $params = $request->all();
            
            $userModel = new MainModel();
            $userInfo = $userModel->getItem($params, ['task' => 'check-password']);

            if (!$userInfo) {
                $messageBag->add('old_password', 'Old password is wrong');
                return redirect()->route($this->controllerName . '/change-logged-password')->withErrors($messageBag);
            }

            $this->model->saveItem($params, ['task' => 'change-logged-password']);
            return redirect()->route($this->controllerName)->with('zvn_notify', 'Thay đổi mật khẩu thành công!');
        }
    }

}