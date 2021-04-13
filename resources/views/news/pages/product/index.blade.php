@extends('news.main')
@section('content')
    @include("news.templates.breadcumb",['name'=>$item->name,'itemsBread'=>$breadItems,'type'=>'category'])
    @include("news.pages.product.product-detail")
    @include("news.pages.product.related")
@endsection
