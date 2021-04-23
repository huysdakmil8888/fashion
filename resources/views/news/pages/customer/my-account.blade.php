@php
    use App\Helpers\Template;
    $type = Request::input('type', 'dashboard');
@endphp
@extends('news.main')
@section('content')
    @include("news.templates.breadcumb",['name'=>"Trang cá nhân của khách hàng "])
    <div class="page-section section section-padding" id="tablist">
        <div class="container">
            <div class="row mbn-30">

                <!-- My Account Tab Menu Start -->
                <div class="col-lg-3 col-12 mb-30">
                    <div class="myaccount-tab-menu nav" role="tablist" >
                        <a href="{{ route('customer/my-account', ['type' => 'dashboard']) }}#tablist" @if ($type == 'dashboard') class="active" @endif ><i class="fa fa-dashboard"></i>
                            Dashboard</a>
                        <a href="{{ route('customer/my-account', ['type' => 'order']) }}" @if ($type == 'order') class="active" @endif><i class="fa fa-cart-arrow-down"></i> Orders</a>


                        <a href="{{ route('customer/my-account', ['type' => 'download']) }}#tablist" @if ($type == 'download') class="active" @endif><i class="fa fa-cloud-download"></i> Downloads</a>

                        <a href="{{ route('customer/my-account', ['type' => 'payment']) }}#tablist" @if ($type == 'payment') class="active" @endif><i class="fa fa-credit-card"></i> Payments</a>

                        <a href="{{ route('customer/my-account', ['type' => 'address']) }}#tablist" @if ($type == 'address') class="active" @endif><i class="fa fa-map-marker"></i> Address</a>

                        <a href="{{ route('customer/my-account', ['type' => 'detail']) }}#tablist" @if ($type == 'detail') class="active" @endif><i class="fa fa-user"></i> Detail</a>


                        <a href="{{route('customer/logout')}}"><i class="fa fa-sign-out"></i> Logout</a>
                    </div>
                </div>
                <!-- My Account Tab Menu End -->

                <!-- My Account Tab Content Start -->
                <div class="col-lg-9 col-12 mb-30">
                    <div class="tab-content" id="myaccountContent">
                        <!-- Single Tab Content Start -->
                        <!-- Single Tab Content End -->

                        @switch($type)
                            @case('dashboard')
                            @include('news.pages.customer.child-my-account.dashboard')
                            @break
                            @case('order')
                            @include('news.pages.customer.child-my-account.order')
                            @break
                            @case('download')
                            @include('news.pages.customer.child-my-account.download')
                            @break
                            @case('payment')
                            @include('news.pages.customer.child-my-account.payment')
                            @break
                            @case('address')
                            @include('news.pages.customer.child-my-account.address')
                            @break
                            @case('detail')
                            @include('news.pages.customer.child-my-account.detail')
                            @break
                        @endswitch
                    </div>
                </div>
                <!-- My Account Tab Content End -->

            </div>
        </div>
    </div><!-- Page Section End -->




@stop
