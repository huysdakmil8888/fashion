<div class="header-bottom header-bottom-one header-sticky">
    <div class="container-fluid">
        <div class="row menu-center align-items-center justify-content-between">

            <div class="col mt-15 mb-15">
                <!-- Logo Start -->
                <div class="header-logo">
                    <a href="index.html">
                        <img src="assets/images/logo.png" alt="Jadusona">
                    </a>
                </div><!-- Logo End -->
            </div>

            <div class="col order-2 order-lg-3">
                <!-- Header Advance Search Start -->
                <div class="header-shop-links">

                    <div class="header-search">
                        <button class="search-toggle"><img src="{{asset('assets/images/icons/search.png')}}" alt="Search Toggle"><img class="toggle-close" src="{{asset('assets/images/icons/close.png')}}" alt="Search Toggle"></button>
                        <div class="header-search-wrap">
                            <form action="#">
                                <input type="text" placeholder="Type and hit enter">
                                <button><img src="{{asset('assets/images/icons/search.png')}}" alt="Search"></button>
                            </form>
                        </div>
                    </div>

                    <div class="header-wishlist">
                        <a href="wishlist.html"><img src="{{asset('assets/images/icons/wishlist.png')}}" alt="Wishlist"> <span>02</span></a>
                    </div>

                    <div class="header-mini-cart">
                        <a href="cart.html"><img src="{{asset('assets/images/icons/cart.png')}}" alt="Cart"> <span>02($250)</span></a>
                    </div>

                </div><!-- Header Advance Search End -->
            </div>

            <div class="col order-3 order-lg-2">
                @php
                    use App\Helpers\URL;
                    use App\Models\CategoryModel;
                    use App\Models\MenuModel;
                    $prefix=config('zvn.url.prefix_news')?"/".config('zvn.url.prefix_news'):"";

                @endphp
                <div class="main-menu">
                    <nav>
                        <ul>
                            @foreach($itemsMenu as $item)
                                @php
                                    $class=$controllerName==$item->controllerName?"class=active":"";
                                    $name=$item->name;
                                    $link=$prefix.$item->link;
                                @endphp
                            @switch($item->type_menu)
                            {{--     lam class active sau      --}}
                                @case('link')
                                    <li {{$class}}><a href="{{$link}}">{{$name}}</a></li>
                                @break
                                @case('category_product')
                                    <li  {{$class}}><a href="shop.html">Sản phẩm</a>
                                        <ul class="sub-menu">
                                            @foreach($itemsCategory as $item)
                                                @php
                                                    $name=$item->name;
                                                    $link=$prefix.$item->link;
                                                @endphp
                                            <li><a href="shop.html">{{$name}}</a>
                                                @if(count($item->children))
                                                <ul class="sub-menu">
                                                    @foreach($item->children as $value)
                                                        @php
                                                            $name=$value->name;
                                                            $link=$prefix.$value->link;
                                                        @endphp
                                                        <li><a href="shop.html">{{$name}}</a>
                                                    @endforeach
                                                </ul>
                                                @endif
                                            </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @break
                                @case('category_article')
                                    <li  {{$class}}><a href="shop.html">Bài viết</a>
                                        <ul class="sub-menu">
                                            <li><a href="shop.html">abc</a>
                                                <ul class="sub-menu">
                                                    <li><a href="">shop abc</a></li>
                                                    <li><a href="">shop abc 2</a></li>
                                                    <li><a href="">shop abc 3</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                @break
                                @endswitch

                            @endforeach
                        </ul>
                    </nav>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div class="mobile-menu order-12 d-block d-lg-none col"></div>

        </div>
    </div>
</div>