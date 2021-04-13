@php
    use App\Helpers\Template;

@endphp
@extends('news.main')
@section('content')
    @include("news.templates.breadcumb",['name'=>'login & register'])


    <div class="page-section section section-padding">
        <div class="container">
            <div class="row mbn-40">
                @include('news.pages.customer.child-login-register.login')

                <div class="col-lg-2 col-12 mb-40 text-center">
                    <span class="login-register-separator"></span>
                </div>
                @include('news.pages.customer.child-login-register.register')



            </div>
        </div>
    </div><!-- Page Section End -->



@stop
