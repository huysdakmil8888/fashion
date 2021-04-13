<?php
namespace App\Models;

use App\Models\AdminModel;
use App\Models\ProductImageModel;
use App\Models\AttributeModel;
use App\Models\ProductAttributeModel;
use App\Models\CommentModel;
use App\Models\CategoryModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductModel extends AdminModel
{
    protected $table               = 'product';
    protected $folderUpload        = 'product' ;
    protected $fieldSearchAccepted = ['id', 'name', 'product_code'];
    protected $crudNotAccepted     = ['tag','changeInfo','changeSeo','changeCategory','changePrice','changeAttribute','changeSpecial','changeDropzone','dropzone','_token','thumb_current','id','attribute','nameImage','alt','res'];
    protected $guarded=[];

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
    public function attribute()
    {
        return $this->hasMany(ProductAttributeModel::class,'product_id');
    }

    public function image()
    {
        return $this->hasMany(ProductImageModel::class,'product_id');
    }

    public function listItems($params = null, $options = null) {
        $result = null;

        if($options['task'] == "admin-list-items") {
            $query = $this->select('id','product_code','sale', 'name','price','category_id','thumb','status')->with('image');

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
                            ->paginate($params['pagination']['totalItemsPerPage']);

        }

        // Home - New Products
        if($options['task'] == 'news-list-items') {
            $query = self::select('id', 'name', 'thumb', 'price', 'slug','rating')
                ->where('status', '=', 'active' )
                ->where('sale', '=', null )
                ->orderBy('id', 'desc')
                ->limit(8);

            $result = $query->get();
        }

        // home - product sale
        if($options['task'] == 'news-list-items-for-sale') {
            $query = self::select('id', 'name', 'slug','thumb', 'sale','price')
                ->where('status', '=', 'active' )
                ->where('sale', '>', 0 )
                ->where('date_start','<=',strtotime(now()))
                ->where('date_end','>=',strtotime(now()))
                ->orderBy('id', 'desc')
                ->limit(8);
            $result = $query->get();
        }
        // home - product sale
        if($options['task'] == 'news-list-items-for-deal') {
            $query = self::with('image')->select('id', 'name', 'slug','thumb', 'sale','price','date_end')
                ->where('status', '=', 'active' )
                ->where('sale', '>', 0 )
                ->where('best_deal', '=', 1 )
                ->where('date_start','<=',strtotime(now()))
                ->where('date_end','>=',strtotime(now()))
                ->orderBy('id', 'desc')
                ->limit(2);
            $result = $query->get();
        }

        // Product Detail - Related Product
        if($options['task'] == 'news-list-items-related-in-product') {
            $category_id = self::getItem($params, ['task' => 'news-get-category-id']);
            $query       = self::select('id', 'name', 'price', 'sale', 'thumb', 'slug')
                ->where('category_id', $category_id)
                ->where('status', 'active')
                ->where('id', '!=', $params['product_id'])
                ->orderBy('ordering', 'asc')
                ->take(4)
            ;
            $result = $query->get()->toArray();
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

        //edit product
        if($options['task'] == 'get-item') {
            $result = self::where('id', $params['id'])
                ->with('attribute')
                ->first();
        }
        //lay san pham khi add to cart
        if($options['task'] == 'cart') {
            $result = self::where('id', $params['id'])
                ->select('thumb','name','price','id')
                ->first();
        }

        if($options['task'] == 'news-get-item-product-detail') {
            $result = self::with('image','tags')->select('id', 'category_id', 'product_code', 'name', 'quantity',
                'thumb', 'price', 'sale', 'slug', 'description','rating','content','datasheet')
            ->where('status','active')
            ->where('id', $params["id"])
            ->first();
        }
        //get related product
        if($options['task'] == 'news-get-item-product-related') {
            $result = self::select('id', 'name', 'quantity','rating',
                'thumb', 'price', 'sale', 'slug')
                ->where([['status','active'],['id','<>',$params['id']],['category_id',$params['category_id']]])
                ->take(7)
                ->get();
        }

        //trang category
        if($options['task'] == 'news-get-item-category-id') {
            $query = self::select('id', 'category_id', 'rating','product_code', 'name', 'thumb', 'price', 'sale', 'slug', 'description')
            ->where('status','active')
            ->where('category_id', $params["category_id"]);
             if ($params['price']['price_min'] !== NULL)  {
                     $query->whereBetween('price', [$params['price']['price_min'],$params['price']['price_max']]);
             }



            $result=$query->paginate(15);
        }
        //sidebar san pham ban chay nhat
        if($options['task'] == 'news-get-item-buy') {
            $result = self::select('id', 'buy', 'name', 'thumb', 'price','slug')
                ->where('status','active')
                ->where('category_id', $params["category_id"])
                ->orderBy('buy','desc')
                ->take(3)
                ->get()
            ;
        }


        return $result;


    }

    public function saveItem($params = null, $options = null) {
        //loai bo dau .
        if(isset($params['price'])){
            $params['price']=str_replace(".", "", $params['price']);
        }
        if(isset($params['sale'])){
            $params['sale']=str_replace(".", "", $params['sale']);
        }
        if(isset($params['date_start'])){
            $params['date_start']=strtotime($params['date_start']);
        }
        if(isset($params['date_end'])){
            $params['date_end']=strtotime($params['date_end']);

        }



        if($options['task'] == 'add-item') {

            $params['product_code']="PET".rand(100,999);

            self::insert($this->prepareParams($params));
            /*================================= dropzone =============================*/
            $product=$this->find($lastId=DB::getPdo()->lastInsertId());
            $product->image()->createMany($params['dropzone']);

        }
        /*================================= form-edit-info =============================*/
        if($options['task']=='change-info-product'){
            // $params['special']=isset($params['special'])?1:0;

            $product=self::find($params['id']);
            $product->update($this->prepareParams($params));

            if(isset($params['tag'])){
                //luu tag
                $this->saveTag($params,$product);
            }

        }
        /*================================= form-dropzone =============================*/
        if($options['task'] == 'edit-item') {

            self::where('id', $params['id'])->update($this->prepareParams($params));

            /*================================= dropzone =============================*/
            ProductImageModel::where('product_id',$params['id'])->delete();
            $product=$this->find($params['id']);
            $product->image()->createMany($params['dropzone']);
            
        }
        /*================================= attribute =============================*/
        if($options['task'] == 'change-attribute-product') {
            if(isset($params['attribute'])){
                $productAttr=new ProductAttributeModel();
                $productAttr->saveItem(['attr'=>$params['attribute'],'id'=>$params['id']],['task'=>'edit-item']);
            }
        }
        /*================================= status index =============================*/
        if ($options['task'] == 'change-status') {
            $status = $params['currentStatus'] == 'active' ? 'inactive' : 'active';
            $this->where('id', $params['id'])->update(['status' => $status]);

            $result = [
                'id' => $params['id'],
                'status' => ['name' => config("zvn.template.status.$status.name"), 'class' => config("zvn.template.status.$status.class")],
                'link' => route($params['controllerName'] . '/status', ['status' => $status, 'id' => $params['id']]),
                'message' => config('zvn.notify.success.update')
            ];

            return $result;
        }
        /*================================= change category =============================*/
        if ($options['task'] == 'change-category') {
            // $params['modified_by']  = session('userInfo')['username'];
            // $params['modified']     = date('Y-m-d H:i:s');
            $this->where('id', $params['id'])->update($this->prepareParams($params));

            $result = [
                'id' => $params['id'],
                // 'modified' => Template::showItemHistory($params['modified_by'], $params['modified']),
                'message' => config('zvn.notify.success.update')
            ];

            return $result;
        }


    }

    public function deleteItem($params = null, $options = null) 
    { 
        if($options['task'] == 'delete-item') {

            
            
            /*================================= xoa image va xoa row =============================*/
            $image=$this->where('id',$params['id'])->first()->image->toArray();
            foreach ($image as $item) {
                $this->deleteThumb($item['name']);
            }
            ProductImageModel::where('product_id',$params['id'])->delete();


            // $item   = self::getItem($params, ['task'=>'get-thumb']);
            // $this->deleteThumb($item['thumb']);
            self::where('id', $params['id'])->delete();
        }
    }

    public function getComment($params = null, $options = null) 
    { 
        if($options['task'] == 'in-product-detail') {

            $commentModel = new CommentModel();
            // echo '<pre style="color:red";>$params === '; print_r($params);echo '</pre>';

            $result = $commentModel->getItem($params, ['task' => 'in-product-detail']);
            // echo '<pre style="color:red";>$result === '; print_r($result);echo '</pre>';
            // echo '<h3>Die is Called </h3>';die;
            return $result;

        }
    }


}

