<div class="pro-info-tab tab-pane active" id="reviews" >

    <ul class="comment-list">
        <li>
            <div class="single-comment">
                <div class="image"><img src="{{asset('assets/images/blog/author-1.jpg')}}" alt=""></div>
                <div class="content">
                    <h4>Frank Warren</h4>
                    <span>29/06/2018 &nbsp;&nbsp;</span>
                    <p >orem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incidi ut labore et dolo magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
                </div>
            </div>
        </li>

    </ul>
    <h3 id="comment-form">Leave a Comment</h3>
    @include('news.templates.alert')
    @include('news.templates.notify')
    <div class="comment-form" >
        <form action="" method="post">
            @csrf
            @method('post')
            <input type="hidden" name="rating" >
            <div class="row row-10">
                <div class="col-md-12 col-12 mb-20">
                    <div class="ratting">
                        <div class="my-rating-3" data-rating="0"></div>
                    </div>
                </div>
                <div class="col-md-6 col-12 mb-20">
                    <input placeholder="Name" type="text" name="name" value="{{old('name')}}" required>
                    <span class="color-red">{{$errors->first('name')}}</span>
                </div>
                <div class="col-md-6 col-12 mb-20">
                    <input placeholder="Email" type="email" name="email" value="{{old('email')}}" required>
                    <span class="color-red">{{$errors->first('name')}}</span>
                </div>
                <div class="col-12 mb-20">
                    <textarea placeholder="Message" name="message" required>{{old('message')}}</textarea>
                    <span class="color-red">{{$errors->first('name')}}</span>
                </div>
                <div class="col-12">
                    <input value="submit" type="submit">
                </div>
            </div>
        </form>
    </div>
</div>