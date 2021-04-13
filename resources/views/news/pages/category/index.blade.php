@php
    use App\Helpers\Template;
    use App\Helpers\URL;
@endphp
@extends('news.main')
@section('content')
    @include("news.templates.breadcumb",['name'=>$breadItem->name,'itemsBread'=>$breadItems,'type'=>'category'])
    <div class="page-section section section-padding">
        <div class="container">
            <div class="row row-30 mbn-40">

                <div class="col-xl-9 col-lg-8 col-12 order-1 order-lg-2 mb-40">
                    <div class="row">

                        <div class="col-12">
                            <div class="product-show">
                                <h4>Show:</h4>
                                <select class="nice-select">
                                    <option>8</option>
                                    <option>12</option>
                                    <option>16</option>
                                    <option>20</option>
                                </select>
                            </div>
                            <div class="product-short">
                                <h4>Short by:</h4>
                                <select class="nice-select">
                                    <option>Name Ascending</option>
                                    <option>Name Descending</option>
                                    <option>Date Ascending</option>
                                    <option>Date Descending</option>
                                    <option>Price Ascending</option>
                                    <option>Price Descending</option>
                                </select>
                            </div>
                        </div>
                        @include('news.pages.category.category_list')




                        @include('news.templates.pagination')


                    </div>
                </div>

                @include('news.pages.category.category_sidebar')
            </div>
        </div>
    </div><!-- Page Section End -->


@stop
