<?php

namespace App\Http\Controllers\News;
use App\Helpers\URL;
use App\Models\DiscountModel;
use App\Models\ProductModel;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Models\CartModel as MainModel;
use App\Mail\MailService;

class CartController extends FrontendController
{

    public function __construct()
    {
        $this->pathViewController = 'news.pages.cart.';
        $this->controllerName = 'cart';
        $this->model = new MainModel();
        parent::__construct();
    }



    public function coupon(Request $request)
    {
        $params=$request->data;
        $discount=new DiscountModel();
        $result=$discount->getItem($params,['task'=>'check']);
        $total=Cart::subtotal()-$result['discount'];
        session(['discount'=>$result['discount']]);


        return response()->json([
            'message'=>$result,
            'total'=>$total,
            'coupon'=>session('discount')

        ]);

    }
    public function add(Request $request)
    {
        $params=$request->data;
        $productModel=new ProductModel();
        $product=$productModel->getItem($params,['task'=>'cart']);
        $link=URL::linkProduct($product);
        //add to cart
        Cart::add($product->id, $product->name, $params['qty'], $params['price'],
            ['thumb'=>$params['image'],'color'=>$params['color'],'link'=>$link]
        );
        //xoa coupon
        session(['discount'=>0]);


        return response()->json([
            'message'=>'bạn đã thêm '.$params['qty'].' sản phẩm vào giỏ hàng!',
            'count'=>Cart::count(),
            'subTotal'=>Cart::subtotal()
        ]);


    }
    public function remove(Request $request)
    {
        $params=$request->data;
        Cart::remove($params['rowId']);
        session(['discount'=>0]);
        return response()->json([
            'message'=>'bạn đã xóa 1 sản phẩm trong giỏ hàng',
            'subTotal'=>Cart::subTotal(),
            'count'=>Cart::count(),
            'total'=>Cart::subtotal()

        ]);

    }

    public function update(Request $request)
    {
        $params=$request->data;
        Cart::update($params['rowId'], $params['qty']); // Will update the quantity
        //xoa coupon
        session(['discount'=>0]);
        return response()->json([
            'message'=>'bạn đã cập nhật lại số lượng sản phẩm trong giỏ hàng',
            'subEach'=> $params['price']*$params['qty'],
            'count'=>Cart::count(),
            'subTotal'=>Cart::subtotal(),
            'total'=>Cart::subtotal()
        ]);

    }


    public function index(Request $request)
    {

        if(Cart::count()==0){
            return redirect()->route('home');
        }
        $cart=Cart::content();

        return view($this->pathViewController . 'index',compact(
            'cart'

        ));
    }


 
}