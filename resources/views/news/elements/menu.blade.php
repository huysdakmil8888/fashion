@php
    use App\Helpers\Template as Tem;
    $total=Tem::format_price(Cart::subTotal());
@endphp
<div class="header-bottom header-bottom-one header-sticky">
    
    <div class="container-fluid">
        <div class="row menu-center align-items-center justify-content-between">

            <div class="col mt-15 mb-15">
                <!-- Logo Start -->
                <div class="header-logo">
                    <a href="{{route('home')}}">
                        <img src="{{asset('assets/images/logo.png')}}" alt="Jadusona">
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
                        <a href="{{route('cart')}}"><img src="{{asset('assets/images/icons/cart.png')}}" alt="Cart">
                            @if(Cart::count()>0)
{{--                                <span class="badge badge-pill badge-danger">{{Cart::count()}}</span>--}}
                                <span style="color:darkblue" id="cart_count">{{Cart::count()}}</span>
                                <span style="color:dodgerblue" id="cart_total">({!! $total !!})</span>
                            @else
                            <span style="color:darkblue" id="cart_count"></span>
                            <span style="color:dodgerblue" id="cart_total"></span>
                            @endif
                        </a>
                    </div>

                </div><!-- Header Advance Search End -->
            </div>

            <div class="col order-3 order-lg-2">
                @php
                    use App\Helpers\URL;
                    use App\Models\CategoryModel;
                    use App\Models\MenuModel;
                    use App\Helpers\Template;
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
                                    <li {{$class}}><a href="shop.html">Sản phẩm</a>

                                       {!! Template::showNestedMenu($itemsCategory,'category') !!}

                                    </li>
                                @break
                                @case('category_article')
                                    <li  {{$class}}><a href="shop.html">Bài viết</a>
                                        {!! Template::showNestedMenu($itemsCategoryArticle,'article') !!}
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