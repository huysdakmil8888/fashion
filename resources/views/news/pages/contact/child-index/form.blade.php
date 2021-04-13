<div class="contact-form-wrap col-md-6 col-12 mb-40">
    <h3>Leave a Message</h3>
    @include('news.templates.notify')
    <form id="contact-foras" action="{{route('contact/contact')}}" method="post">
        @csrf
        @method('POST')
        <div class="contact-form">
            <div class="row">
                <div class="col-lg-6 col-12 mb-30">
                    <input type="text" name="name" placeholder="Your Name">
                    <span class="color-red">{{$errors->first('name')}}</span>
                </div>
                <div class="col-lg-6 col-12 mb-30">
                    <input type="email" name="email" placeholder="Email Address">
                    <span class="color-red">{{$errors->first('email')}}</span>
                </div>
                <div class="col-12 mb-30">
                    <textarea name="message" placeholder="Message"></textarea>
                    <span class="color-red">{{$errors->first('message')}}</span>
                </div>
                <div class="col-12"><input type="submit" value="send"></div>
            </div>
        </div>
    </form>
{{--    <p class="form-messege"></p>--}}
</div>

