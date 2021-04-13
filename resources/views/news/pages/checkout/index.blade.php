@php
    use App\Helpers\Template;

@endphp
@extends('news.main')
@section('content')
    @include("news.templates.breadcumb",['name'=>'Check out'])
    <div class="page-section section section-padding">
        <div class="container">

            <!-- Checkout Form s-->
            <form action="{{route('checkout/order')}}" method="post" class="checkout-form">
                @csrf
                @method('post')
                <div class="row row-50 mbn-40">

                    <div class="col-lg-7">

                        <!-- Billing Address -->
                    @include('news.pages.checkout.child-index.address')
                    <!-- Shipping Address -->


                    </div>

                    <div class="col-lg-5">
                        <div class="row">
                        @include('news.pages.checkout.child-index.money')
                        <!-- Cart Total -->
                        @include('news.pages.checkout.child-index.payment')

                        <!-- Payment Method -->

                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div><!-- Page Section End -->


@stop
