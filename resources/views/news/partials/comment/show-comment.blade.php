@if($controllerName=='article')
    <div class="comment-wrap mt-40">
@else
    <div class="tab-pane active" id="reviews" >
@endif

    <h3>{{$itemsComment->count()>0? $itemsComment->count() ." Comments":"Chưa có bình luận nào" }}</h3>
    @if(count($itemsComment))
    <ul class="comment-list">
        {!! Template::showNestedComment($itemsComment) !!}
    </ul>

    @else
        <p>Hãy là người comment đầu tiên cho bài viết!</p>
    @endif


    @include('news.partials.comment.form-reply')

</div>
