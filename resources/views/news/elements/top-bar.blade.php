<div class="header-top header-top-one bg-theme-two">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-center">

            <div class="col mt-10 mb-10 d-none d-md-flex">
                <!-- Header Top Left Start -->
                <div class="header-top-left">
                    <p>{!! $setting_general['introduce'] !!}</p>
                    <p>Hotline: <a href="tel:{{$setting_general['hotline']}}">{{$setting_general['hotline']}}</a></p>
                </div><!-- Header Top Left End -->
            </div>

            <div class="col mt-10 mb-10">
                <!-- Header Language Currency Start -->
                <ul class="header-lan-curr">


                    <a href="{{route('language','en')}}">
                        <img width="25" src="{{asset('admin/images/logo/en.png')}}" alt="">
                    </a>
                    &nbsp; <a href="{{route('language','vi')}}">
                        <img width="25" src="{{asset('admin/images/logo/vi.png')}}"
                                                                     alt="">
                    </a>

                </ul><!-- Header Language Currency End -->
            </div>

            <div class="col mt-10 mb-10">
                <!-- Header Shop Links Start -->
                <div class="header-top-right">
                    @if(session()->has('customerInfo'))
                        <p><a href="{{route('customer/my-account')}}">@lang('message.account')</a></p>
                        <p><a href="{{route('customer/logout')}}"> Logout </a></p>
                    @else
                        <p>
                            <a href="{{route('customer/register-login')}}">Register</a>
                            <a href="{{route('customer/register-login')}}">Login</a>
                        </p>
                    @endif


                </div><!-- Header Shop Links End -->
            </div>

        </div>
    </div>
</div>
