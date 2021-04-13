<div class="sidebar">
    @if(count($item->tags))
    <h3 class="sidebar-title">Tags</h3>
    <ul class="sidebar-tag">
        @foreach($item->tags as $tag)
            <li><a href="{{route('article/tag',[Str::slug($tag->name),$tag->id])}}">{{$tag->name}}</a></li>
        @endforeach
    </ul>
    @endif
</div>
