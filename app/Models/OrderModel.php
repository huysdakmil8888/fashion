<?php

namespace App\Models;

use App\Models\AdminModel;
use App\Models\ProductModel;
use Illuminate\Support\Facades\DB; 

class OrderModel extends AdminModel
{
        protected $table               = 'order';
        protected $folderUpload        = 'order' ;
        protected $fieldSearchAccepted = ['id', 'name', 'description', 'link'];
        protected $crudNotAccepted     = ['create_account','_token','thumb_current','_method','password','accept','password_confirmation'];
        protected $guarded=[];

    public function customer()
    {
        return $this->belongsTo(CustomerModel::class);
    }
    public function payment()
    {
        return $this->belongsTo(PaymentModel::class);
    }

    public function products()
    {
        return $this->belongsToMany(ProductModel::class,'order_product','order_id','product_id')->withPivot(['qty','price','color']);
    }
    public function listItems($params = null, $options = null) {
     
        $result = null;

        if($options['task'] == "admin-list-items") {
            $query = $this->select('id', 'status','note','quantity','name','amount','order_code',
                'customer_id','payment_id','created', 'created_by', 'modified', 'modified_by')
              ->with(['customer','payment','products']);
            if ($params['filter']['status'] !== "all")  {
                $query->where('status', '=', $params['filter']['status'] );
            }

            if ($params['search']['value'] !== "")  {
                if($params['search']['field'] == "all") {
                    $query->where(function($query) use ($params){
                        foreach($this->fieldSearchAccepted as $column){
                            $query->orWhere($column, 'LIKE',  "%{$params['search']['value']}%" );
                        }
                    });
                } else if(in_array($params['search']['field'], $this->fieldSearchAccepted)) { 
                    $query->where($params['search']['field'], 'LIKE',  "%{$params['search']['value']}%" );
                } 
            }

            $result =  $query->orderBy('id', 'desc')
                            ->paginate($params['pagination']['totalItemsPerOrder']);

        }

        if($options['task'] == 'news-list-items') {
            $query = $this->select('id', 'name', 'description', 'link', 'thumb')
                        ->where('status', '=', 'active' )
                        ->limit(5);

            $result = $query->get();
        }

        return $result;
    }

    public function countItems($params = null, $options  = null) {
     
        $result = null;

        if($options['task'] == 'admin-count-items-group-by-status') {
         
            $query = $this::groupBy('status')
                        ->select( DB::raw('status , COUNT(id) as count') );

            if ($params['search']['value'] !== "")  {
                if($params['search']['field'] == "all") {
                    $query->where(function($query) use ($params){
                        foreach($this->fieldSearchAccepted as $column){
                            $query->orWhere($column, 'LIKE',  "%{$params['search']['value']}%" );
                        }
                    });
                } else if(in_array($params['search']['field'], $this->fieldSearchAccepted)) { 
                    $query->where($params['search']['field'], 'LIKE',  "%{$params['search']['value']}%" );
                } 
            }

            $result = $query->get()->toArray();
           

        }

        return $result;
    }

    public function getItem($params = null, $options = null) { 
        $result = null;
        
        if($options['task'] == 'get-item') {
            $result = self::with('products')->select('id','name','phone','email','address','note','quantity','amount','order_code','customer_id','payment_id', 'status')->where('id', $params['id'])->first();
        }

        if($options['task'] == 'get-thumb') {
            $result = self::select('id', 'thumb')->where('id', $params['id'])->first();
        }

        if($options['task'] == 'news-list-items-get-product-info-in-cart') {
            $productModel = new ProductModel();
            $result       = $productModel->listItems($params, ['task' => 'news-list-items-get-product-info-in-cart']);
        }

        if($options['task'] == 'news-list-items-get-product-attribute-in-cart') {
            $productModel = new ProductModel();
            $result       = $productModel->listItems($params, ['task' => 'news-list-items-get-product-attribute-in-cart']);
        }

        if($options['task'] == 'news-list-items-get-product-attribute-value-in-cart') {
            $productModel = new ProductModel();
            // echo '<pre style="color:red";>$params === '; print_r($params);echo '</pre>';
            // echo '<h3>Die is Called </h3>';die;
            $result       = $productModel->listItems($params, ['task' => 'news-list-items-get-product-attribute-value-in-cart']);
        }

        return $result;
    }

    public function saveItem($params = null, $options = null) { 
        if ($options['task'] == 'change-status-ajax') {
            $status=$params['change-status'];
            self::where('id', $params['id'])->update(['status' => $params['change-status']]);

            $result = [
                'id' => $params['id'],
                'status' => ['name' => config("zvn.template.status.$status.name")],
                'link' => route($params['controllerName'] . '/order', ['change_status' => $status, 'id' => $params['id']]),
                'message' => config('zvn.notify.success.update')
            ];

            return $result;
        }

        if($options['task'] == 'add-item') {
            $params['created_by'] = session('userInfo')['username'];
            $params['created']    = date('Y-m-d');
            return self::create($this->prepareParams($params));
        }

        if($options['task'] == 'edit-item') {

/*            if(!empty($params['thumb'])){
                $this->deleteThumb($params['thumb_current']);
                $params['thumb'] = $this->uploadThumb($params['thumb']);
            }*/
            $params['modified_by'] = session('userInfo')['username'];
            $params['modified']    = date('Y-m-d');
            self::where('id', $params['id'])->update($this->prepareParams($params));
        }
    }

    public function deleteItem($params = null, $options = null) 
    { 
        if($options['task'] == 'delete-item') {
/*            $item   = self::getItem($params, ['task'=>'get-thumb']); //
            $this->deleteThumb($item['thumb']);*/
            self::where('id', $params['id'])->delete();
        }
    }

}

