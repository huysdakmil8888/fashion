@php
    use App\Helpers\Template;
    use App\Helpers\URL;
@endphp
<div class="blog-item">
    @php
    $thumb=$item->thumb;
    $content=Template::showContent($item->content,130);
    $name=$item->name;
    $view=$item->view;
    $like=$item->like;

    $link=URL::linkArticle($item);
    $linkAuthor=URL::linkAuthor($item->user);
    $date=date("d",strtotime($item->created));
    $month=date("F",strtotime($item->created));
    $author=$item->user->username;
    $avatar=$item->user->thumb;
    @endphp
    <div class="image-wrap">
        <h4 class="date">{{$month}} <span>{{$date}}</span></h4>
        <a class="image" href="{{$link}}"><img src="{{asset($thumb)}}"
                                               alt=""></a>
    </div>
    <div class="content">
        <h4 class="title"><a href="{{$link}}">{{$name}}</a></h4>
        <div class="desc">
            {!! $content !!}
        </div>
        <ul class="meta">
            <li><a href="{{$linkAuthor}}"><img src="{{asset($avatar)}}"
                                         alt="Blog Author">{{$author}}</a></li>
            <li><a href="#">{{$like}} Likes</a></li>
            <li><a href="#">{{$view}} Views</a></li>
        </ul>
    </div>
</div>
