<div class="sidebar">
    <h4 class="sidebar-title">Archive</h4>
    <ul class="sidebar-list">
        @foreach($itemsArchive as $key=>$item)
            <li><a href="{{route('article/archive',$key)}}">{{$key}}</a></li>
        @endforeach
    </ul>
</div>
