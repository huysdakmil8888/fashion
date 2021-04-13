<?php

namespace App\Models;

use App\Models\AdminModel;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use DB; 
class Tag extends AdminModel
{

        protected $table               = 'tags';
        protected $folderUpload        = 'tag' ;
        protected $fieldSearchAccepted = ['id', 'name', 'email', 'fullname'];
        protected $crudNotAccepted     = ['_token','thumb_current', 'password_confirmation', 'taskAdd', 'taskChangePassword', 'taskChangeLevel', 'taskEditInfo'];
        protected $guarded=[];

    public function products()
    {
        return $this->morphedByMany(ProductModel::class, 'taggable');
    }

    public function articles()
    {
        return $this->morphedByMany(ArticleModel::class, 'taggable');
    }
    public function related()
    {
        return $this->hasMany(Taggable::class);
    }


    public function listItems($params = null, $options = null) {
     
        $result = null;

        if($options['task'] == "admin-list-items") {
            $query = $this->with('products','articles');

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
        if($options['task'] == 'news-list-items') {
            $query = $this->select('id', 'name', 'job','status', 'thumb')
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
            $result = self::select('id', 'name', 'status')->where('id', $params['id'])->first();
        }
        //get-list-items-for-product

        if($options['task'] == 'get-list-items-for-product') {
            $result = self::with('related')
                ->whereHas('related', function($q){
                    $q->where('taggable_type','App\Models\ProductModel');
                })
                ->get();
        }


        return $result;
    }

    public function saveItem($params = null, $options = null) {
        /*================================= change ajax status =============================*/
        if($options['task'] == 'change-status') {
            $status = ($params['currentStatus'] == "active") ? "inactive" : "active";
            self::where('id', $params['id'])->update(['status' => $status ]);
            return  [
                'id' => $params['id'],
                'status' => ['name' => config("zvn.template.status.$status.name"), 'class' => config("zvn.template.status.$status.class")],
                'link' => route($params['controllerName'] . '/status', ['status' => $status, 'id' => $params['id']]),
                'message' => config('zvn.notify.success.update')
            ];
        }

        if($options['task'] == 'add-item') {
            self::insert($this->prepareParams($params));
        }

        if($options['task'] == 'edit-item') {

/*            if(!empty($params['thumb'])){
                $this->deleteThumb($params['avatar_current']);
                $params['thumb'] = $this->uploadThumb($params['thumb']);
            }*/


            self::where('id', $params['id'])->update($this->prepareParams($params));
        }

        if($options['task'] == 'change-level') {
            $level = $params['currentLevel'];
            self::where('id', $params['id'])->update(['level' => $level]);
        }

        if($options['task'] == 'change-level-post') {
            $level = $params['level'];
            self::where('id', $params['id'])->update(['level' => $level]);
        }
        
        if($options['task'] == 'change-password') {
            $password       = md5($params['password']);
            self::where('id', $params['id'])->update(['password' => $password]);
        }

        if ($options['task'] == 'change-logged-password') {
            $password   = md5($params['password']);
            $modifiedBy = session('tagInfo')['name'];
            $modified   = date('Y-m-d H:i:s');
            $this->where('id', session('tagInfo')['id'])->update([
                'password' => $password,
                'modified' => $modified,
                'modified_by' => $modifiedBy
            ]);
        }
    }

    public function deleteItem($params = null, $options = null) 
    { 
        if($options['task'] == 'delete-item') {
            self::where('id', $params['id'])->delete();
        }
    }

}

