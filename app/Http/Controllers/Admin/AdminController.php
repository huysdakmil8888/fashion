<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class AdminController extends Controller
{
    protected $pathViewController = '';  
    protected $controllerName     = '';
    protected $params             = [];
    protected $model;
    protected $mrequest;

    public function __construct()
    {

        $this->params["pagination"]["totalItemsPerPage"] = 10;
        view()->share('controllerName', $this->controllerName);
        $this -> middleware('can:thay đổi trạng thái')->only('status');
        $this -> middleware('can:trang form')->only('form');
        $this -> middleware('can:Xóa bài')->only('delete');

    }

    public function index(Request $request)
    {
        $this->params['filter']['status'] = $request->input('filter_status', 'all' ) ;
        $this->params['filter']['category'] = $request->input('filter_category', 'all' ) ;
        $this->params['search']['field']  = $request->input('search_field', '' ) ; // all id description
        $this->params['search']['value']  = $request->input('search_value', '' ) ;

        $items              = $this->model->listItems($this->params, ['task'  => 'admin-list-items']);
        $itemsStatusCount   = $this->model->countItems($this->params, ['task' => 'admin-count-items-group-by-status']); // [ ['status', 'count']]

        return view($this->pathViewController .  'index', [
            'params'        => $this->params,
            'items'         => $items,
            'itemsStatusCount' =>  $itemsStatusCount
        ]);
    }

    public function form(Request $request)
    {
        $item = null;
        if($request->id !== null ) {
            $params["id"] = $request->id;
            $item = $this->model->getItem( $params, ['task' => 'get-item']);
        }


        return view($this->pathViewController .  'form', [
            'item'        => $item
        ]);
    }

    public function status(Request $request)
    {

        $params["currentStatus"]  = $request->status;
        $params["id"]             = $request->id;
        $params['controllerName'] = $this->controllerName;

        $result = $this->model->status($params, ['task' => 'change-status']);

        echo json_encode($result);
    }
    public function ordering(Request $request)
    {
        $this->params['ordering'] = $request->ordering;
        $this->params['id'] = $request->id;
        $result = $this->model->ordering($this->params, ['task' => 'change-ordering']);
        echo json_encode($result);
    }

    public function delete(Request $request)
    {
        $params["id"]             = $request->id;
        $this->model->deleteItem($params, ['task' => 'delete-item']);
        return redirect()->route($this->controllerName)->with('zvn_notify', 'Xóa phần tử thành công!');
    }

    public function view(Request $request)
    {
        $params["id"] = $request->id;

        $item = $this->model->getItem( $params, ['task' => 'get-item']);

        return view($this->pathViewController .  'view', [
            'item'        => $item
        ]);
    }

}