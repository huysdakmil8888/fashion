@php
    use App\Helpers\Template;
    use App\Helpers\URL;

@endphp
@section('css')
    <style>
        img{
            max-width: 100%;
        }
    </style>
@stop
@extends('news.main')
@section('content')
    @include("news.templates.breadcumb",['name'=>$items->name])

    <div class="blog-section section section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-11">
                    {!! $items->content !!}

                </div>
            </div>
        </div>
    </div><!-- Blog Section End -->


@stop
