@php
    use App\Helpers\Template;
    use App\Helpers\URL;
@endphp
<div class="sidebar">
    <h4 class="sidebar-title">Bài viết cùng chuyên mục</h4>
    <div class="sidebar-blog-wrap">
        @forelse($itemsRecent as $item)
            @php

                $thumb=$item->thumb;
                $content=Template::showContent($item->content,100);
                $name=$item->name;
                $link=URL::linkArticle($item);
                $date=date("d F",strtotime($item->created));
            @endphp
        <div class="sidebar-blog">
            <a href="{{$link}}" class="image"><img src="{{asset($thumb)}}" alt=""></a>
            <div class="content">
                <a href="{{$link}}" class="title">{{$name}}</a>
                <span class="date">{{$date}}</span>
            </div>
        </div>
        @empty
        <p>chua co bai viet nao</p>
        @endforelse

    </div>
</div>
