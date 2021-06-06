@php
    use App\Helpers\Template;
    use App\Helpers\URL;

@endphp
@extends('news.main')
@section('content')
    @include("news.templates.breadcumb",['name'=>$item->name,'itemsBread'=>@$breadItems,'type'=>'categoryArticle'])

    @php
        $thumb=$item->thumb;
        $content=Template::showContent($item->content,100);
        $name=$item->name;
        $view=$item->view;
        $like=$item->like;
        $linkAuthor=URL::linkAuthor($item->user);
        $link=URL::linkArticle($item);
        $date=date("d",strtotime($item->created));
        $month=date("F",strtotime($item->created));
        $author=$item->user->username;
        $avatar=$item->user->thumb;
    @endphp

    <div class="blog-section section section-padding">
        <div class="container">
            <div class="row row-30 mbn-40">

                <div class="col-xl-9 col-lg-8 col-12 order-1 order-lg-2 mb-40">
                    <div class="single-blog">
                        <div class="image-wrap">
                            <h4 class="date">{{$month}}<span>{{$date}}</span></h4>
                            <a class="image" href="{{$link}}"><img src="{{asset('assets/images/blog/single-blog.jpg')}}" alt=""></a>
                        </div>
                        <div class="content">
                            <h1 style="margin-bottom: 20px">{{$name}}</h1>
                            <ul class="meta">
                                <li><a href="{{$linkAuthor}}"><img src="{{asset($avatar)}}"
                                                             alt="Blog Author">{{$author}}</a></li>
                                <li><a href="{{URL::linkLike($item)}}" id="like">
                                        <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li><a href="#">{{$like}} Likes</a></li>
                                <li><a href="#">{{$view}} Views</a></li>
                            </ul>
                            <div class="desc">
                                {!! $item->content !!}
                            </div>

                            <div class="blog-footer row mt-45">

                                @if(count($item->tags))
                                <div class="post-tags col-lg-6 col-12 mv-15">
                                    <h4>Tags:</h4>
                                    <ul class="tag">
                                        @foreach($item->tags as $tag)
                                            <li><a href="{{route('article/tag',[Str::slug($tag->name),$tag->id])}}">{{$tag->name}}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif

                               @include("news.partials.article.share")

                            </div>
                        </div>
                    </div>
                    @include("news.partials.comment.show-comment")

                </div>



                @include('news.pages.article.sidebar')
            </div>
        </div>
    </div><!-- Blog Section End -->


@stop
