@extends('news.main')
@include('news.templates.notify')
@section('content')
    @section('slider')
        @include("news.elements.slider")
    @stop
        <!-- Banner Section Start -->
    @include("news.elements.banner-top")
    <!-- Banner Section End -->

    <!-- Product Section Start -->
    @include("news.elements.all-product")

    <!-- Product Section End -->
    @include("news.elements.banner-middle")

    <!-- Banner Section Start -->
    <!-- Banner Section End -->

    <!-- Product Section Start -->
    @include("news.elements.sale-product")

    <!-- Product Section End -->

    <!-- Feature Section Start -->
    @include("news.elements.banner-bottom")

    <!-- Feature Section End -->

    <!-- Blog Section Start -->
    @include("news.elements.blog")

    <!-- Blog Section End -->

    <!-- Brand Section Start -->
@stop