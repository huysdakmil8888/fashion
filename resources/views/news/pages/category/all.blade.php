@php
    use App\Helpers\Template;
    use App\Helpers\URL;
@endphp
@extends('news.main')
@section('content')
    @include("news.templates.breadcumb",['name'=>$breadcrumbName])

    <div class="page-section section section-padding">
        <div class="container">
            <div class="row row-30 mbn-40">
                <div class="col-xl-9 col-lg-8 col-12 order-1 order-lg-2 mb-40">
                    <div class="row">

                        @include('news.pages.category.sort')


                        @include('news.pages.category.category_list')






                    </div>
                </div>

                @include('news.pages.category.category_sidebar')
            </div>
        </div>
    </div><!-- Page Section End -->


@stop
