<?php

namespace App\Models;

use App\Models\AdminModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use DB; 
class PermissionModel extends AdminModel
{

        protected $table               = 'permissions';
        protected $folderUpload        = 'permission' ;
        protected $fieldSearchAccepted = ['id', 'name', 'email', 'fullname'];
        protected $crudNotAccepted     = ['_token','thumb_current', 'password_confirmation', 'taskAdd', 'taskChangePassword', 'taskChangeLevel', 'taskEditInfo'];

    protected $guarded=[];
    public function listItems($params = null, $options = null) {
     
        $result = null;

        if($options['task'] == "admin-list-items") {
            $query = $this;
               
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
            $result = self::where('id', $params['id'])->first();
        }
        if($options['task'] == 'get-item-for-checkbox') {
            $result = self::select('id','name')->pluck('name','id');
        }


        return $result;
    }

    public function saveItem($params = null, $options = null) {

        if($options['task'] == 'add-item') {
            $params['guard_name'] = "web";
//            $params['created']    = date('H:i:s Y-m-d');
            self::create($this->prepareParams($params));
        }

        if($options['task'] == 'edit-item') {


//            $params['modified_by']   = "hailan";
//            $params['modified']      = date('Y-m-d');
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
            $modifiedBy = session('permissionInfo')['name'];
            $modified   = date('Y-m-d H:i:s');
            $this->where('id', session('permissionInfo')['id'])->update([
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

