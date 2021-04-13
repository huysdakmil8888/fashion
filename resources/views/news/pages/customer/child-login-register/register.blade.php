<div class="col-lg-6 col-12 mb-40 ml-auto">
    <div class="login-register-form-wrap" id="form-register">
        <h3>Register</h3>
        @include('news.templates.notify')
        <form action="{{route('customer/register')}}" method="post">
            @csrf
            @method('post')
            <div class="row">
                <div class="col-md-6 col-12 mb-15">
                    <input type="text" placeholder="Your Name" name="name" value="{{old('name')}}">
                    <span class="color-red">{{$errors->first('name')}}</span>
                </div>
                <div class="col-md-6 col-12 mb-15">
                    <input type="text" placeholder="Your Phone" name="phone" value="{{old('phone')}}">
                    <span class="color-red">{{$errors->first('phone')}}</span>
                </div>
                <div class="col-md-6 col-12 mb-15">
                    <input type="text" placeholder="Your Email" name="email" value="{{old('email')}}">
                    <span class="color-red">{{$errors->first('email')}}</span>
                </div>
                <div class="col-md-6 col-12 mb-15">
                    <input type="password" placeholder="Your Password" name="password" value="{{old('password')}}">
                    <span class="color-red">{{$errors->first('password')}}</span>
                </div>
                <div class="col-md-6 col-12 mb-15">
                    <input type="password" placeholder="Your Password confirmation" name="password_confirmation" value="{{old('password_confirmation')}}">
                    <span class="color-red">{{$errors->first('password_confirmation')}}</span>
                </div>
                <div class="col-md-6 col-12">
                    <input type="submit" value="Register" name="register">
                </div>
            </div>
        </form>
    </div>
</div>
