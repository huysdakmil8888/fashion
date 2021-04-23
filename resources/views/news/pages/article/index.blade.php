@php
    use App\Helpers\Template;
    use App\Helpers\URL;

@endphp
@extends('news.main')
@section('content')
    @isset($author)
        @include("news.templates.breadcumb",['name'=>'Bài viết của tác giả '.$author])
    @else
        @include("news.templates.breadcumb",['name'=>$breadItem->name,'itemsBread'=>$breadItems,'type'=>'categoryArticle'])
    @endisset
    <div class="blog-section section section-padding">
        <div class="container">
            <div class="row">
                @forelse($items as $item)
                <div class="col-lg-6 col-12 mb-50">
                    @include("news.partials.article.blog")
                </div>
                @empty
                    <p>Chưa có bài viết trong chuyên mục này</p>
                @endforelse



            @include('news.templates.pagination')
            </div>
        </div>
    </div><!-- Blog Section End -->


@stop
