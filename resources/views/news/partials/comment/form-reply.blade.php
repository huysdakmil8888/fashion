<h3 id="comment-form">Leave a Comment

</h3>

{{--@if(session('customerInfo'))--}}
{{--    <img style="border-radius: 100%" width="40" src="{{session('customerInfo')['thumb']}}" alt="">--}}
{{--    <span>{{session('customerInfo')['name']}}</span>--}}
{{--@endif--}}
@include('news.templates.alert')
@include('news.templates.notify')
@include('news.templates.error')
<div class="comment-form" >

    <form action="{{route($controllerName.'/comment')}}" method="post">
        @csrf
        @method('post')
        <div class="row row-10">

            @if($controllerName=='product')
            <div class="col-md-12 col-12 mb-20">
                <div class="ratting">
                    <div class="my-rating-3" data-rating="0"></div>
                </div>
                <input type="hidden" name="score">
            </div>
            @endif

            <div class="col-md-6 col-12 mb-20">
                <input placeholder="Name" required type="text" name="name" value="{{old('name',@session('customerInfo')['name'])}}">
                <span class="color-red">{{$errors->first('name')}}</span>
            </div>
            <div class="col-md-6 col-12 mb-20">
                <input placeholder="Email" required type="email" name="email" value="{{old('email',@session('customerInfo')['email'])}}">
                <span class="color-red">{{$errors->first('name')}}</span>
            </div>
            <div class="col-12 mb-20">
                <textarea placeholder="Message" name="message">{{old('message')}}</textarea>
                <span class="color-red">{{$errors->first('name')}}</span>
            </div>
            <div class="col-12">
                <input type="hidden" name="{{$controllerName}}_id" value="{{$item->id}}">
                <input type="hidden" name="customer_id" value="{{@session('customerInfo')['id']}}">
                <input value="submit" type="submit">
            </div>
        </div>
    </form>
</div>
@section('script')
    <script type="text/javascript">
        $(function() {
            $(".reply").one('click',(function(e){
                parent_id=$(this).data('field');
                console.log(parent_id);

                $(this).parent().parent().parent().after('' +
                    '<div class="comment-form" >'+
                    '<form action="{{route($controllerName.'/comment')}}" method="post">'+
                    '@csrf' +
                    '@method('post')' +
                    '   <div class="row row-10">' +
                    '       <div class="col-md-6 col-12 mb-20">' +
                    '               <input placeholder="Name" required type="text" name="name" value="{{old('name',@session('customerInfo')['name'])}}">' +
                    '                   <span class="color-red">{{$errors->first('name')}}</span>' +
                    '           </div>' +
                    '           <div class="col-md-6 col-12 mb-20">' +
                    '               <input placeholder="Email" required type="email" name="email" value="{{old('email',@session('customerInfo')['email'])}}">' +
                    '                   <span class="color-red">{{$errors->first('email')}}</span>' +
                    '           </div>' +
                    '           <div class="col-12 mb-20">' +
                    '               <textarea required placeholder="Message" name="message">{{old('message')}}</textarea>' +
                    '               <span class="color-red">{{$errors->first('message')}}</span>' +
                    '           </div>' +
                    '           <div class="col-12">' +
                    '                <input type="hidden" name="{{$controllerName}}_id" value="{{$item->id}}">'+
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
