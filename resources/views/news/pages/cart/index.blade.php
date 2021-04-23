@php
    use App\Helpers\Template;

@endphp
@extends('news.main')
@section('content')
    @include("news.templates.breadcumb",['name'=>'Giỏ hàng của bạn'])
    <div class="page-section section section-padding">
        <div class="container">

                <div class="row mbn-40">
                    <div class="col-12 mb-40">
                        <div class="cart-table table-responsive">
                           @include("news.pages.cart.child-index.table")
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-7 col-12 mb-40">
                        <div class="cart-buttons mb-30">
{{--                            <input type="submit" value="Update Cart" />--}}
                            <a href="{{route('category/productnews')}}">Continue Shopping</a>
                        </div>
                        <div class="cart-coupon">
                            <h4>Coupon</h4>
                            <p>Enter your coupon code if you have one.</p>
                            <div class="cuppon-form">
                                <input type="text" placeholder="Coupon code" id="code" />
                                <input type="submit" value="Apply Coupon" id="coupon"/>
                                <input type="hidden" class="url" value="{{route('cart/coupon')}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-5 col-12 mb-40">
                        <div class="cart-total fix">
                            <h3>Cart Totals</h3>
                            <table>
                                <tbody>
                                <tr class="cart-subtotal">
                                    <th>Số tiền</th>
                                    <td><span id="subTotal">{!! Template::format_price(Cart::subTotal())!!}</span></td>
                                </tr>
                                @php
                                    Cart::coupon('price',100000);
                                @endphp
                                <tr class="cart-subtotal">
                                    <th>Giảm giá</th>
                                    <td><span class="discount"></span></td>
                                </tr>
                                @php
;
                                @endphp
                                <tr class="order-total">
                                    <th>Tổng tiền</th>
                                    <td>

                                        <strong><span class="amount total">{!! Template::format_price(Cart::subTotal())!!}</span></strong>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="proceed-to-checkout section mt-30">
                                <a href="{{route('checkout')}}">Proceed to Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>

        </div>
        @php
        
        @endphp
    </div><!-- Page Section End -->


@stop
