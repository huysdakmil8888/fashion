@php
    use App\Helpers\URL;
@endphp
<div class="sidebar">
    
    <h4 class="sidebar-title">Archive</h4>
    <ul class="sidebar-list">
        @foreach($itemsArchive as $key=>$item)
            <li><a href="{{URL::linkArchive($key)}}">{{$key}}</a></li>
        @endforeach
    </ul>
</div>
