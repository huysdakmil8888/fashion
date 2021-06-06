<!-- menu profile quick info -->
<div class="profile clearfix">
    <div class="profile_pic">
        <img src="{{ @asset(session('userInfo')['thumb']) }}" alt="..." class="img-circle profile_img">
    </div>
    <div class="profile_info">

        <h2><span>{{__('message.welcome')}},</span>
            {{ @session('userInfo')['username'] }} <br>

            <a href=""><img width="30" src="{{asset('images/logo/en.png')}}" alt=""></a>
            &nbsp; <a href=""><img width="30" src="{{asset('images/logo/vi.png')}}"
                                                             alt=""></a>
        </h2>

    </div>
</div>
<!-- /menu profile quick info -->
<br/>
<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section active">
        {{-- <div class="menu_section"> --}}

        <h3>Menu</h3>
        <ul class="nav side-menu">
            <li id="dashboard"><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i> {{__('message.dashboard')}}
                </a></li>
            <li>
                <a><i class="fa fa-product-hunt"></i> Quản lý sản phẩm <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li id="product"><a href="{{ route('product') }}"> Sản phẩm</a></li>
                    <li id="category"><a href="{{ route('category') }}"> Danh mục</a></li>
                    <li id="discount"><a href="{{ route('discount') }}"> Coupon</a></li>
                    <li id="attribute"><a href="{{ route('attribute') }}"> Thuộc tính</a></li>
                    <li id="shipping"><a href="{{ route('shipping') }}"> Phí ship</a></li>
                    <li id="payment"><a href="{{ route('payment') }}"> Phương thức thanh toán</a></li>
                    <li id="order"><a href="{{ route('order') }}">Đơn Hàng</a></li>
                    <li id="color"><a href="{{ route('color') }}">Màu sắc</a></li>
                    <li id="comment_article"><a href="{{ route('rating') }}"> Đánh giá khách hàng</a></li>
                </ul>
            </li>
            <li>
                <a><i class="fa fa-archive"></i> Quản lý bài viết <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li id="article"><a href="{{ route('article') }}"> Article</a></li>
                    <li id="categoryArticle"><a href="{{ route('categoryArticle') }}"> Danh mục bài viết</a></li>
                    <li id="comment_article"><a href="{{ route('comment') }}"> Comment</a></li>
                    <li id="testimonial"><a href="{{ route('testimonial') }}"> Testimonial</a></li>
                    <li id="subscribe"><a href="{{ route('subscribe') }}"> Subscriber</a></li>
                </ul>
            </li>


            <li>
                <a><i class="fa fa-file"></i> Quản lý trang và tag <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li id="page"><a href="{{ route('page') }}"> Quản lý Trang</a></li>
                    <li id="tag"><a href="{{ route('tag') }}"> Quản lý Tag</a></li>

                </ul>
            </li>
            <li>
                <a><i class="fa fa-image"></i> hình ảnh & video <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li id="gallery"><a href="{{ route('gallery') }}"> Gallery</a></li>
                    <li id="video"><a href="{{ route('video') }}"> Video</a></li>

                </ul>
            </li>
            <li>
                <a><i class="fa fa-sliders"></i> Slider & Quảng cáo <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li id="slider"><a href="{{ route('slider') }}"> Slider</a></li>
                    <li id="ad"><a href="{{ route('ad') }}"> Quảng cáo</a></li>

                </ul>
            </li>
            <li>
                <a><i class="fa fa-envelope-o"></i>Menu & Liên hệ <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li id="menu"><a href="{{ route('menu') }}"> Menu</a></li>
                    <li id="contact"><a href="{{ route('contact') }}"> Liên hệ</a></li>

                </ul>
            </li>
            <li class="none">
                <a href="{{ route('user/change-logged-password') }}"><i class="fa fa-sliders"></i> Change Password</a>
            </li>

            @role('admin')

            <li>
                <a><i class="fa fa-user"></i> Quản lý thành viên <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li id="user"><a href="{{ route('user') }}"> User</a></li>
                    <li id="group"><a href="{{ route('group') }}"> {{ucFirst('group')}}</a></li>
                    <li id="permission"><a href="{{ route('permission') }}"> {{ucFirst('permission')}}</a></li>

                </ul>
            </li>


            <li>
                <a><i class="fa fa-cog"></i> {{__('message.config')}} <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li id="setting"><a href="{{ route('setting', ['type' => 'general']) }}">Cấu hình chung</a></li>
                    <li id="setting"><a href="{{ route('setting', ['type' => 'email']) }}">Email</a></li>
                    <li id="setting"><a href="{{ route('setting', ['type' => 'social']) }}">Social</a></li>
                    <li id="setting"><a href="{{ route('setting', ['type' => 'share']) }}">Share button</a></li>
                    <li id="logs"><a href="{{ route('logs') }}">Log error</a></li>
                </ul>
            </li>
            @endrole


        </ul>
    </div>
</div>
<!-- /sidebar menu -->
