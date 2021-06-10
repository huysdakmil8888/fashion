<?php

namespace App\Models;

use App\Models\AdminModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class GroupModel extends AdminModel
{

    protected $table = 'roles';
    protected $folderUpload = 'group';
    protected $fieldSearchAccepted = ['id', 'name', 'email', 'fullname'];
    protected $crudNotAccepted = ['_token', 'thumb_current', 'password_confirmation', 'taskAdd', 'taskChangePassword', 'taskChangeLevel', 'taskEditInfo'];
    protected $guarded = ['permission_ids'];
    protected $guard_name = 'web';
    use HasRoles;


    public function listItems($params = null, $options = null)
    {

        $result = null;

        if ($options['task'] == "admin-list-items") {
            $query = $this;

            if ($params['filter']['status'] !== "all") {
                $query->where('status', '=', $params['filter']['status']);
            }

            if ($params['search']['value'] !== "") {
                if ($params['search']['field'] == "all") {
                    $query->where(function ($query) use ($params) {
                        foreach ($this->fieldSearchAccepted as $column) {
                            $query->orWhere($column, 'LIKE', "%{$params['search']['value']}%");
                        }
                    });
                } else if (in_array($params['search']['field'], $this->fieldSearchAccepted)) {
                    $query->where($params['search']['field'], 'LIKE', "%{$params['search']['value']}%");
                }
            }

            $result = $query->orderBy('id', 'desc')
                ->paginate($params['pagination']['totalItemsPerPage']);

        }
        if ($options['task'] == 'news-list-items') {
            $query = $this->select('id', 'name', 'job', 'status', 'thumb')
                ->where('status', '=', 'active')
                ->limit(5);

            $result = $query->get();
        }


        return $result;
    }

    public function countItems($params = null, $options = null)
    {

        $result = null;

        if ($options['task'] == 'admin-count-items-group-by-status') {

            $query = $this::groupBy('status')
                ->select(DB::raw('status , COUNT(id) as count'));

            if ($params['search']['value'] !== "") {
                if ($params['search']['field'] == "all") {
                    $query->where(function ($query) use ($params) {
                        foreach ($this->fieldSearchAccepted as $column) {
                            $query->orWhere($column, 'LIKE', "%{$params['search']['value']}%");
                        }
                    });
                } else if (in_array($params['search']['field'], $this->fieldSearchAccepted)) {
                    $query->where($params['search']['field'], 'LIKE', "%{$params['search']['value']}%");
                }
            }

            $result = $query->get()->toArray();


        }

        return $result;
    }

    public function getItem($params = null, $options = null)
    {
        $result = null;

        if ($options['task'] == 'get-item') {
            $result = Role::with('permissions')->where('id', $params['id'])->first();
        }
        if ($options['task'] == 'get-item-for-select-box') {
            $result = self::select('id', 'name')->pluck('name', 'name');
        }


        return $result;
    }

    public function saveItem($params = null, $options = null)
    {
        if ($options['task'] == 'add-item') {
            $role = Role::create(['name' => $params['name']]);
            $role->syncPermissions(array_keys($params['permission_ids']));

        }

        if ($options['task'] == 'edit-item') {

            $role = Role::find($params['id']);
            $role->update(['name' => $params['name']]);

            $role->syncPermissions(array_keys($params['permission_ids']));
        }

        if ($options['task'] == 'change-level') {
            $level = $params['currentLevel'];
            self::where('id', $params['id'])->update(['level' => $level]);
        }

        if ($options['task'] == 'change-level-post') {
            $level = $params['level'];
            self::where('id', $params['id'])->update(['level' => $level]);
        }

        if ($options['task'] == 'change-password') {
            $password = md5($params['password']);
            self::where('id', $params['id'])->update(['password' => $password]);
        }

        if ($options['task'] == 'change-logged-password') {
            $password = md5($params['password']);
            $modifiedBy = session('groupInfo')['name'];
            $modified = date('Y-m-d H:i:s');
            $this->where('id', session('groupInfo')['id'])->update([
                'password' => $password,
                'modified' => $modified,
                'modified_by' => $modifiedBy
            ]);
        }
    }

    public function deleteItem($params = null, $options = null)
    {
        if ($options['task'] == 'delete-item') {
            self::where('id', $params['id'])->delete();
        }
    }

}

