<h3 id="comment-form">Leave a Comment</h3>
@include('news.templates.alert')
<div class="comment-form" >
    <form action="{{route('article/comment')}}" method="post">
        @csrf
        @method('post')
        <div class="row row-10">
            <div class="col-md-6 col-12 mb-20">
                <input placeholder="Name" type="text" name="name" value="{{old('name')}}">
                <span class="color-red">{{$errors->first('name')}}</span>
            </div>
            <div class="col-md-6 col-12 mb-20">
                <input placeholder="Email" type="email" name="email" value="{{old('email')}}">
                <span class="color-red">{{$errors->first('name')}}</span>
            </div>
            <div class="col-12 mb-20">
                <textarea placeholder="Message" name="message">{{old('message')}}</textarea>
                <span class="color-red">{{$errors->first('name')}}</span>
            </div>
            <div class="col-12">
                <input value="submit" type="submit">
            </div>
        </div>
    </form>
</div>