@php
    use App\Helpers\Template;
    use Gloudemans\Shoppingcart\Facades\Cart;
        $subTotal=Cart::subTotal();
        $coupon= session('coupon');
        $ship=0;
        $total=$subTotal-$coupon+$ship;
@endphp
<div class="col-12 mb-40">

    <h4 class="checkout-title">Thanh toán</h4>

    <div class="checkout-cart-total">

        <h4>Sản phẩm <span>Số tiền</span></h4>

        <ul>
            @foreach($cart as $item)
             <li>{{$item->name}} X {{$item->qty}} <span>{!! Template::format_price($item->qty*$item->price) !!}</span></li>
            @endforeach
        </ul>

        <p>Tiền chưa tính ship <span>{{ Template::format_price($subTotal) }}</span></p>
        <p>Phí Ship <span class="fee">0 đ</span></p>
        <p>Giảm giá coupon <span>-{{ Template::format_price($coupon) }}</span></p>

        <h4>Tổng cộng <span class="total">{{ Template::format_price($total) }}</span></h4>
        <input type="hidden" name="amount" value="">

    </div>

</div>
