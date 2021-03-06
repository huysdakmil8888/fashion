<?php

namespace App\Models;

use App\Helpers\Template;
use App\Models\AdminModel;
use App\Models\SettingModel;
use Illuminate\Support\Facades\DB; 
use Kalnoy\Nestedset\NodeTrait;
class RatingModel extends AdminModel
{
    use NodeTrait;

    protected $table = 'rating';
    protected $guarded = [];


    public function customer()
    {
        return $this->belongsTo(CustomerModel::class,'customer_id');
    }
    public function product()
    {
        return $this->belongsTo(ProductModel::class,'product_id');
    }
    public function listItems($params = null, $options = null) {
     
        $result = null;

        if($options['task'] == "admin-list-items") {
            $result = self::withDepth()
//                ->having('depth', '>', 0)
                ->defaultOrder()
                ->get()
                ->toFlatTree()
            ;
        }
        /*================================= lay rating da cap o frontend =============================*/
        if($options['task'] == 'news-list-items') {
            $result = self::with('customer')->withDepth()
//                ->having('depth', '>', 0)
                ->defaultOrder()
                ->where('status', 'accept')
                ->where('product_id',$params['id'])
                ->get()
                ->toTree();

        }

        if($options['task'] == 'news-list-items-rating') {
            $result = self::withDepth()
                ->having('depth', '>', 0)
                ->defaultOrder()
                ->where('status', 'active')
                ->get()
                ->toTree()
                ->toArray();
        }


        if($options['task'] == 'news-list-items-is-home') {
            $query = $this->select('id', 'name')
                ->where('status', '=', 'active' )
                ->where('is_home', '=', 'yes' );

            $result = $query->get();
          
        }

        if ($options['task'] == 'admin-list-items-in-select-box-for-article') {
            $nodes = self::select('id', 'name')
                ->withDepth()
                ->having('depth', '>', 0)
                ->defaultOrder()
                ->get()
                ->toFlatTree()
                ->toArray();

            foreach ($nodes as $value) {
                $result[$value['id']] = str_repeat('|---- ', $value['depth'] - 1) . $value['name'];
            }
        }

        if($options['task'] == "admin-list-items-in-select-box") {
            $query = self::select('id', 'name')->withDepth()->defaultOrder();
       
           
            /*================================= truong hop edit =============================*/
            if (isset($params['id'])) {
                $node = self::find($params['id']);
                $query->where('_lft', '<', $node->_lft)->orWhere('_lft', '>', $node->_rgt);
            }
            
            $nodes = $query->get();

            foreach ($nodes as $value) {
                $result[$value['id']] = str_repeat('|---- ', $value['depth']) . $value['name'];
            }
        }

        if ($options['task'] == 'news-breadcrumbs') {
            $result = self::withDepth()->having('depth', '>', 0)->defaultOrder()->ancestorsAndSelf($params['rating_id'])->toArray();
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
            $result = self::select('id','parent_id', 'message', 'status')->where('id', $params['id'])->first();
        }
        //for breadcrumb
        if($options['task'] == 'breadcrumbs') {
            $result = self::defaultOrder()->ancestorsAndSelf($params['rating_id']);
            unset($result[0]);
        }

        if($options['task'] == 'news-get-item') {
            $result = self::select('id','slug', 'name')
            ->where('id', $params['rating_id'])
            ->first();

        }



        
        return $result;
    }

    public function saveItem($params = null, $options = null) { 
        if($options['task'] == 'change-status') {
            $status = ($params['currentStatus'] == "active") ? "inactive" : "active";
            $modifiedBy = session('userInfo')['username'];
            $modified   = date('Y-m-d H:i:s');
            self::where('id', $params['id'])->update(['status' => $status, 'modified' => $modified, 'modified_by' => $modifiedBy]);

            $result = [
                'id' => $params['id'],
                'modified' => Template::showItemHistory($modifiedBy, $modified),
                'status' => ['name' => config("zvn.template.status.$status.name"), 'class' => config("zvn.template.status.$status.class")],
                'link' => route($params['controllerName'] . '/status', ['status' => $status, 'id' => $params['id']]),
                'message' => config('zvn.notify.success.update')
            ];

            return $result;
        }


        if($options['task'] == 'add-item') {
            if ($options['task'] == 'add-item') {
             $params['created_by'] = session('userInfo')['username'];
             $params['created'] = date('Y-m-d H:i:s');
                $parent=null;
                if(isset($params['parent_id'])){
                    $parent = self::find($params['parent_id']);
                }
                self::create($this->prepareParams($params), $parent);
            }
        }

        if ($options['task'] == 'edit-item') {
            $params['created_by'] = session('userInfo')['username'];
            $parent = self::find($params['parent_id']);
            $query = $current = self::find($params['id']);
            $query->update($this->prepareParams($params,$parent));
//            if($current->parent_id != $params['parent_id']) $query->prependToNode($parent)->save();
        }

        if ($options['task'] == 'change-ordering') {
            $ordering   = $params['ordering'];
            $modifiedBy = session('userInfo')['username'];
            $modified   = date('Y-m-d H:i:s');

            self::where('id', $params['id'])->update(['ordering' => $ordering, 'modified' => $modified, 'modified_by' => $modifiedBy]);

            $result = [
                'id' => $params['id'],
                'modified' => Template::showItemHistory($modifiedBy, $modified),
                'message' => config('zvn.notify.success.update')
            ];

            return $result;
        }
    }

    public function deleteItem($params = null, $options = null) 
    { 
        if ($options['task'] == 'delete-item') {
            $node = self::find($params['id']);
            $node->delete();
        }
    }

    public function move($params = null, $options = null)
    {
        $node = self::find($params['id']);
        $historyBy = session('userInfo')['username'];
        $this->where('id', $params['id'])->update(['modified_by' => $historyBy]);
        if ($params['type'] == 'down') $node->down();
        if ($params['type'] == 'up') $node->up();
    }

}

