<?php

namespace App\Models;

use App\Models\AdminModel;
use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;
use DB;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Contracts\Auth\Access\Authorizable;
class UserModel extends AdminModel implements
    \Illuminate\Contracts\Auth\Authenticatable,Authorizable
{


        use HasRoles;
        use Authenticatable;
        protected $table               = 'user';
        protected $folderUpload        = 'user' ;
        protected $fieldSearchAccepted = ['id', 'username', 'email', 'fullname'];
        protected $crudNotAccepted     = ['_token','avatar_current', 'password_confirmation', 'taskAdd', 'taskChangePassword', 'taskChangeLevel', 'taskEditInfo'];
        public $timestamps=false;
        protected $guard_name = 'web';

    public function loginUsername()
    {
        return 'email';
    }
    public function can($ability, $arguments = []){

    }

    public function groups()
    {
        return $this->belongsTo(GroupModel::class,'group','name');
    }

    public function getPermission($user)
    {
        $id=explode(',',$user->groups->permission_ids); //1,2
        $allow=$user->permission_allow; //+3
        $deny=$user->permission_deny; //-2
        array_push($id,$allow);
        $ids=array_diff($id,array($deny));
        return $ids;
    }
    public function listItems($params = null, $options = null) {
     
        $result = null;
//        $role1 = Role::create(['name' => 'editor']);
//        $role2 = Role::create(['name' => 'admin']);
//        $permission1 = Permission::create(['name' => 'list articles']);
//        $permission2 = Permission::create(['name' => 'edit articles']);
//        $role2->syncPermissions($permission1,$permission2);

        if($options['task'] == "admin-list-items") {
            $query = $this->with('roles')->select('id', 'username', 'email', 'fullname', 'thumb', 'status', 'level','created' ,'created_by','modified','modified_by');
               
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


            $result = self::with('roles')->select('id', 'username', 'email', 'status', 'fullname', 'level', 'thumb')->where('id', $params['id'])->first();
        }

        if($options['task'] == 'get-avatar') {
            $result = self::select('id', 'thumb')->where('id', $params['id'])->first();
        }

        if($options['task'] == 'auth-login') {
            $result = self::select('id', 'username', 'fullname', 'email', 'level', 'thumb')
                    ->where('status', 'active')
                    ->where('email', $params['email'])
                    ->where('password', md5($params['password']) )->first();

            if($result) $result = $result->toArray();
        }

        if ($options['task'] == 'check-password') {
            $result = $this->select('id')->where([
                ['username', session('userInfo')['username']],
                ['password', md5($params['old_password'])]
            ])->first();
        }

        if ($options['task'] == 'news-get-user-info') {
            $result = self::select('address', 'phone')
            ->where('username', $params)
            ->first()->toArray()
            ;
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
            $params['created_by'] = "hailan";
            $params['created']    = date('Y-m-d');
//            $params['thumb']      = $this->uploadThumb($params['thumb']);
            $params['password']    = md5($params['password']);
            self::insert($this->prepareParams($params));        
        }

        if($options['task'] == 'edit-item') {

/*            if(!empty($params['thumb'])){
                $this->deleteThumb($params['avatar_current']);
                $params['thumb'] = $this->uploadThumb($params['thumb']);
            }*/


            $params['modified_by']   = "hailan";
            $params['modified']      = date('Y-m-d');
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
            $modifiedBy = session('userInfo')['username'];
            $modified   = date('Y-m-d H:i:s');
            $this->where('id', session('userInfo')['id'])->update([
                'password' => $password,
                'modified' => $modified,
                'modified_by' => $modifiedBy
            ]);
        }
    }

    public function deleteItem($params = null, $options = null) 
    { 
        if($options['task'] == 'delete-item') {
            $item   = self::getItem($params, ['task'=>'get-avatar']); // 
            $this->deleteThumb($item['thumb']);
            self::where('id', $params['id'])->delete();
        }
    }

}

