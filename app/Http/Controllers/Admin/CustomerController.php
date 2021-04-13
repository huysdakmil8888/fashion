<?php

namespace App\Http\Controllers\Admin;
use App\Models\CustomerModel as MainModel;
use App\Http\Requests\CustomerRequest as MainRequest;
use Illuminate\Http\Request;
use App\Helpers\Functions;

class CustomerController extends AdminController
{
    public function __construct()
    {
        $this->pathViewController = 'admin.pages.customer.';
        $this->controllerName = 'customer';
        $this->model = new MainModel();
        parent::__construct();
    }

    public function index(Request $request)
    {
        $this->params['filter']['status']   = $request->input('filter_status', 'all' ) ;
        $this->params['filter']['category'] = $request->input('filter_category', 'all' ) ;
        $this->params['search']['field']    = $request->input('search_field', '' ) ;
        $this->params['search']['value']    = $request->input('search_value', '' ) ;

        // Items Customer
        $items              = $this->model->listItems($this->params, ['task'  => 'admin-list-items-customer']);
        $itemsStatusCount   = $this->model->countItems($this->params, ['task' => 'admin-count-items-group-by-status']);

        // Items Customer
        $itemsCustomer      = $this->model->listItems($this->params, ['task'  => 'admin-list-items']);
        $attribute_name = $this->model->listItems(null, ['task'  => 'admin-list-items-get-all-attribute-name']);
        $prepareParams  = $this->model->fixArray($itemsCustomer, ['task' => 'fix-array-01']);

        $params['main']           = $prepareParams;
        $params['attribute_name'] = $attribute_name;
        $params    = $this->model->fixArray($params, ['task' => 'fix-array-02']);
        $attribute = $this->model->fixArray($params, ['task' => 'fix-array-03']);

        $params['main']      = $itemsCustomer;
        $params['attribute'] = $attribute;

        $itemsCustomer = $this->model->fixArray($params, ['task'  => 'fix-array-04']);
        $itemsCustomer = Functions::merge_05($itemsCustomer);

        foreach ($items as $key => $value) $items[$key]['detail'] = $itemsCustomer[$key];
        // $items = $items->toArray();

        // echo '<pre style="color:red";>$items === '; print_r($items);echo '</pre>';
        // echo '<h3>Die is Called Controller</h3>';die;

        return view($this->pathViewController .  'index', [
            'params'           => $this->params,
            'items'            => $items,
            'itemsStatusCount' => $itemsStatusCount,
        ]);
    }

    public function view(Request $request)
    {
        $params["id"] = $request->id;

        // Items Customer
        $item = $this->model->getItem( $params, ['task' => 'get-item']);

        // Items Payment
        $item['payment'] = $this->model->getItem( $item['payment_id'], ['task' => 'get-payment-name-from-id']);
        unset($item['payment_id']);

        // Items Customer
        $itemsCustomer      = $this->model->listItems($item['order_code'], ['task'  => 'admin-list-items-view-customer']);
        $attribute_name = $this->model->listItems(null, ['task'  => 'admin-list-items-get-all-attribute-name']);
        $prepareParams  = $this->model->fixArray($itemsCustomer, ['task' => 'fix-array-01']);

        $params['main']           = $prepareParams;
        $params['attribute_name'] = $attribute_name;
        $params    = $this->model->fixArray($params, ['task' => 'fix-array-02']);
        $attribute = $this->model->fixArray($params, ['task' => 'fix-array-03']);

        $params['main']      = $itemsCustomer;
        $params['attribute'] = $attribute;
                $itemsCustomer   = $this->model->fixArray($params, ['task'  => 'fix-array-04']);
        $item   ['detail']   = $itemsCustomer;
        
        return view($this->pathViewController .  'view', [
            'item'        => $item
        ]);
    }
}