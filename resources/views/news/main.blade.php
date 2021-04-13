<!doctype html>
<html class="no-js" lang="en">

<head>
    @include("news.elements.head")
    @yield('css')
</head>

<body>

<div class="main-wrapper">

    <div class="header-section section">
        @include("news.elements.top-bar")
        @include("news.elements.menu")
        @yield('slider')
    </div>
@yield('content')


@include("news.elements.brand")


<!-- Brand Section End -->

    <!-- Footer Top Section Start -->
    <!-- Footer Top Section End -->
@include("news.elements.footer-top")
@include("news.elements.footer-bottom")

<!-- Footer Bottom Section Start -->
    <!-- Footer Bottom Section End -->

</div>

@include("news.elements.scripts")
@yield('script')


</body>

</html>