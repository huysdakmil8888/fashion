@php
    use App\Helpers\Template;
@endphp
<div class="comment-wrap mt-40">

    <h3>{{$itemsComment->count()>0? $itemsComment->count() ." Comments":"Chưa có bình luận nào" }}</h3>
    @if(count($itemsComment))
    <ul class="comment-list">
        {!! Template::showNestedComment($itemsComment) !!}
    </ul>
    @else
        <p>chua co binh luan nao</p>
    @endif


    @include('news.partials.article.form-reply')

</div>
@section('script')
    <script type="text/javascript">
        $(function() {
            $(".reply").one('click',(function(e){
                parent_id=$(this).data('field');
                console.log(parent_id);

                $(this).parent().parent().parent().after('' +
                    '<div class="comment-form" >'+
                        '<form action="{{route('article/comment')}}" method="post">'+
                    '@csrf' +
                        '@method('post')' +
                    '   <div class="row row-10">' +
                '       <div class="col-md-6 col-12 mb-20">' +
                '               <input placeholder="Name" type="text" name="name" value="{{old('name')}}">' +
                '                   <span class="color-red">{{$errors->first('name')}}</span>' +
                '           </div>' +
                '           <div class="col-md-6 col-12 mb-20">' +
                '               <input placeholder="Email" type="email" name="email" value="{{old('email')}}">' +
                '                   <span class="color-red">{{$errors->first('name')}}</span>' +
                '           </div>' +
                '           <div class="col-12 mb-20">' +
                '               <textarea placeholder="Message" name="message">{{old('message')}}</textarea>' +
                '               <span class="color-red">{{$errors->first('name')}}</span>' +
                '           </div>' +
                '           <div class="col-12">' +
                '           <input type="hidden" name="parent_id" value="'+parent_id+'">'+
                '               <input value="submit" type="submit">' +
                '           </div>' +
                '           </div>' +
                '       </form>' +
                '   </div>')
                e.preventDefault();

            }));
        });
    </script>
@stop
