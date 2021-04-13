@php
    use App\Helpers\URL;                
@endphp
<div class="sidebar">
    <h4 class="sidebar-title">Category</h4>
    <ul class="sidebar-list">
        @forelse($cats as $item)
        <li><a href="{{URL::linkCategoryArticle($item)}}">{{$item->name}} <span class="num">{{$item->children_count}}</span></a></li>
        @empty
        <p>Chưa có chuyên mục nào</p>
        @endforelse
    </ul>
</div>
