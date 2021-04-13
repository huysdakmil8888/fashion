<div class="col-lg-4 col-12 mb-40">
    <div class="login-register-form-wrap">
        <h3>Login</h3>
        @include('news.templates.alert')
        <form action="{{route('customer/login')}}" method="post">
            @csrf
            @method('post')
            <div class="row">
                <div class="col-12 mb-15">
                    <input type="text" required placeholder="Phone or Email" name="account" value="{{old('account')}}">
                </div>
                <div class="col-12 mb-15">
                    <input type="password" required placeholder="Password" name="password">
                </div>
                <div class="col-12">
                    <input type="submit" value="Login" name="login">
                </div>
            </div>
        </form>
        <h4>You can also login with...</h4>
        <div class="social-login">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-google-plus"></i></a>
            <a href="#"><i class="fa fa-pinterest"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
        </div>
    </div>
</div>
