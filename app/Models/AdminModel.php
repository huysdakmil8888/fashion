<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use DB;
use Intervention\Image\Facades\Image;

class AdminModel extends Model
{
     
    public $timestamps = false;
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    protected $table            = '';
    protected $folderUpload     = '' ;
    protected $fieldSearchAccepted   = [
        'id',
        'name'
    ]; 

    protected $crudNotAccepted = [
        '_token',
        'thumb_current',
    ];


    public function uploadThumb($thumbObj,$dir='') {

        $thumbName        = $thumbObj->getClientOriginalName() . '.' . $thumbObj->clientExtension();

        $thumbObj->storeAs(!empty($dir)?$dir:$this->folderUpload, $thumbName, 'zvn_storage_image' );
        return $thumbName;
    }

    /*============== chuyen file tu tmp sang product,sắp xếp lại mảng để lưu vào database =============================*/
    public function dropzone($params)
    {
        foreach ($params['nameImage'] as $value) {
            if(file_exists(public_path('assets/images/tmp/'.$value))){
                rename(public_path('assets/images/tmp/'.$value),public_path('assets/images/product/'.$value));

            // resize image
            $img = Image::make(public_path('assets/images/product/'.$value));
            $smallPath = public_path('assets/images/product/product-small/'.$value);
            $mediumPath = public_path('assets/images/product/product-medium/'.$value);

            $img->resize(270,320);
            $img->save($smallPath);

            $img->resize(700,700);
            $img->save($mediumPath);



            }
        }
        $res = array_map(null, $params['nameImage'], $params['alt']);
        $keys = array("name", "alt");
        return array_map(function ($e) use ($keys) {
            return array_combine($keys, $e);
        }, $res);
    }

    public function deleteThumb($thumbName){
        Storage::disk('zvn_storage_image')->delete($this->folderUpload . '/' . $thumbName);
    }

    public function prepareParams($params){
        return array_diff_key($params, array_flip($this->crudNotAccepted));
    }


    public static function countItemsDashboad($params = null){
        return self::count();
    }


    public function status($params,$options)
    {
        if($options['task'] == 'change-status') {
            switch ($params['currentStatus']){
                case "active":
                    $status="inactive";
                    break;
                case "inactive":
                    $status="active";
                    break;
                case "pending":
                    $status="confirmed";
                    break;
                case "confirmed":
                    $status="cancel";
                    break;
                case "cancel":
                    $status="pending";
                    break;
                case "trash":
                    $status="accept";
                    break;
                case "accept":
                    $status="trash";
                    break;
                case "order_pending":
                    $status="order_confirmed";
                    break;
                case "order_confirmed":
                    $status="order_delivery";
                    break;
                case "order_delivery":
                    $status="order_success";
                    break;
                case "order_success":
                    $status="order_fail";
                    break;
                case "order_fail":
                    $status="order_pending";
                    break;}
            self::where('id', $params['id'])->update(['status' => $status
//                ,'modified'=>now(),'modified_by'=>session()->get('userInfo')['username']
            ]);
            $result = [
                'id' => $params['id'],
                'status' => ['name' => config("zvn.template.status.$status.name"), 'class' => config("zvn.template.status.$status.class")],
                'link' => route($params['controllerName'] . '/status', ['status' => $status, 'id' => $params['id']]),
                'message' => config('zvn.notify.success.update')
            ];

            return $result;
        }
    }

    public function ordering($params,$options)
    {
        if ($options['task'] == 'change-ordering') {
            $ordering = $params['ordering'];
            $this->where('id', $params['id'])->update(['ordering' => $ordering]);
            return [
                'id' => $params['id'],
                'message' => config('zvn.notify.success.update')
            ];
        }
    }

    public function saveTag($params,$article)
    {
        //luu tags
        foreach (explode(",",$params['tag']) as $name) {
            $tag[]=Tag::firstOrCreate(['name'=>$name])->id;
        }
        $article->tags()->sync($tag);
    }


}

