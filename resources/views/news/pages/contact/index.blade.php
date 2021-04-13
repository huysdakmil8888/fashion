@php
    use App\Helpers\Template;

@endphp
@extends('news.main')
@section('content')
    @include("news.templates.breadcumb",['name'=>'Contact'])

    <div class="page-section section section-padding">
        <div class="container">
            <div class="row row-30 mbn-40">

                @include("news.pages.contact.child-index.info")

                @include("news.pages.contact.child-index.form")

            </div>
        </div>
    </div><!-- Page Section End -->


@stop
