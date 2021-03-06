<?php

namespace App\Http\Controllers\Admin;

use App\Models\AttributeModel;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\ProductModel as MainModel;
use App\Http\Requests\ProductRequest as MainRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductController extends AdminController
{
    public function __construct()
    {
        $this->pathViewController = 'admin.pages.product.';
        $this->controllerName = 'product';
        $this->model = new MainModel();
        $this->params["pagination"]["totalItemsPerPage"] = 10;
        parent::__construct();
    }

    public function getImage($id)
    {
        $params['id'] = $id;
        $itemProduct = $this->model->getItem($params, ['task' => 'get-item']);
        $productImage = $itemProduct->image->toArray();
        return json_encode($productImage);
    }

    public function form(Request $request)
    {

        $item = null;
        $newArr = [];
        $categoryModel  = new CategoryModel();
        $itemsCategory  = $categoryModel->listItems(null, ['task' => 'admin-list-items-in-select-box']);

        if ($request->id !== null) {
            $params["id"] = $request->id;
            $item = $this->model->getItem($params, ['task' => 'get-item']);


            /*============ lay gia tri tu bang product attribute =============================*/
            $productAttribute = $item->attribute->toArray();
            foreach ($productAttribute as $value) {
                $newArr[$value['attribute_id']][] = $value['value'];
            }
            $newArr = array_map(function ($value) {
                return implode(',', $value);
            }, $newArr);




        }
        $attribute = new AttributeModel();
        $attribute = $attribute->listItems(null, ['task' => 'admin-list-items-for-product']);

        return view($this->pathViewController . 'form',
            compact('item', 'attribute', 'newArr','itemsCategory')
        );
    }

    public function image(Request $request)
    {
        /*================================= object file =============================*/
        $file = $request->file('file');

        
        /*================================= tra ve ten file image =============================*/
        return $this->model->uploadThumb($file, 'tmp');
    }

    public function save(MainRequest $request)
    {

        if ($request->method() == 'POST') {

            $params = $request->all();
            //luu hinh tu tmp -> product
            $params['dropzone'] = $this->model->dropzone($params);
            //them ten
            $params['thumb']='assets/images/product/product-small/'.array_column($params['dropzone'],'name')[0];



            if(empty($params['slug']) && isset($params['name'])){
                $params['slug']=Str::slug($params['name']);
            }



            $params['status']='active';
            $task = "add-item";
            $notify = "Th??m ph???n t??? th??nh c??ng!";


            if ($params['id'] !== null) {
                $task = "edit-item";
                $notify = "C???p nh???t ph???n t??? th??nh c??ng!";
                $params['dropzone'] = $this->model->dropzone($params);

            }

            $this->model->saveItem($params, ['task' => $task]);
            if ($params['id'] !== null) {
                return redirect()->back()->with("zvn_notify", $notify);
            }else{
                return redirect()->route($this->controllerName)->with("zvn_notify", $notify);
            }

        }
    }
    public function changeInfo(MainRequest $request)
    {
        if ($request->method() == 'POST') {
            $params = $request->all();

            $this->model->saveItem($params, ['task' => 'change-info-product']);
            return redirect()->back()->with("zvn_notify", "C????p nh????t th??ng tin sa??n ph????m th??nh c??ng!");
        }
    }
    public function changeContent(Request $request)
    {
        if ($request->method() == 'POST') {
            $params = $request->all();

            $this->model->saveItem($params, ['task' => 'change-info-product']);
            return redirect()->back()->with("zvn_notify", "C????p nh????t th??ng tin sa??n ph????m th??nh c??ng!");
        }
    }

    public function changeAttribute(MainRequest $request)
    {
        if ($request->method() == 'POST') {
            $params = $request->all();


            $this->model->saveItem($params, ['task' => 'change-color-product']);
            return redirect()->back()->with("zvn_notify", "C????p nh????t th??ng tin sa??n ph????m th??nh c??ng!");
        }
    }
    public function changeCategory(Request $request) {
        $params['category_id'] = $request->category_id;
        $params['id'] = $request->id;
        $result = $this->model->saveItem($params, ['task' => 'change-category']);
        return response()->json($result);
    }
}