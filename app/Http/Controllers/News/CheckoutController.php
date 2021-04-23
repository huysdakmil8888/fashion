<?php
namespace App\Http\Controllers\News;

use App\Helpers\Template;
use App\Http\Requests\CheckoutRequest;
use App\Mail\MailService;
use App\Models\CustomerModel;
use App\Models\OrderModel;
use App\Models\PaymentModel;
use App\Models\ShippingModel;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends FrontendController
{

    public function __construct()
    {
        $this->pathViewController = 'news.pages.checkout.';
        $this->controllerName = 'checkout';
        parent::__construct();
    }

    public function shipping(Request $request)
    {
        //ajax gia ship
        $data=$request->data;
        $shippingModel=new ShippingModel();
        $shipping=$shippingModel->getItem(['id'=>$data['id']],['task'=>'get-fee']);
        $fee=$shipping->fee;
        $total=Cart::subTotal()+$fee-session('coupon');
        return response()->json([
            'fee'=>$fee,
            'total'=>$total,
            'method'=>$shipping->name
        ]);
    }


    public function index(Request $request)
    {

        if(Cart::count()==0){
            return redirect()->route('home');
        }
        $cart=Cart::content();


        //phuong thuc van chuyen
        $shipping=DB::table("shipping")->pluck('name','id');



        //phuong thuc thanh toan
        $paymentModel=new PaymentModel();
        $payment=$paymentModel->getItem(null,['task'=>'news-get-items']);
        
        return view($this->pathViewController . 'index',compact(
            'payment','cart','shipping'

        ));

    }
    public function order(CheckoutRequest $request)
    {
        $cart=Cart::content();
        $params = $request->all();
        //luu vao bang customer neu khach chon them tai khoan
        if(isset($params['create_account'])){
            $customerModel=new CustomerModel();
            $customerModel->saveItem($params,['task'=>'add-item']);
            $params['customer_id']=DB::getPdo()->lastInsertId();
            //$params=array_diff_key($params,array_flip(['name','email','phone','address','create_account','password','password_confirmation']));
        }
        //luu vao bang order
        $params['quantity']=Cart::count();
        $params['status']='order_pending';
        $params['order_code']=Template::generate_string(5);
        $orderModel=new OrderModel();
        $order=$orderModel->saveItem($params,['task'=>'add-item']);

        //luu vao bang trung gian order_product
        foreach ($cart as $item) {
            $order->products()->attach($item->id, [
                'qty' => $item->qty,
                'price'=>$item->price,
                'color'=>$item->options->color,
            ]);
        }
        Cart::destroy();
        

       return redirect()->route('home')->with('notify','Bạn đã đặt hàng thành công,chúng tôi sẽ liên hệ lại với bạn
       trong thời gian sớm nhất!,xin cảm ơn bạn');
    }



}