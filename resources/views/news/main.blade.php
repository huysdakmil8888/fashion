<!doctype html>
<html class="no-js" lang="en">

<head>
    @include("news.elements.head")
    @yield('css')
</head>

<body>
<div id="abc"></div>

<div class="main-wrapper" >

    <!-- Modal structure -->
    <!-- Modal structure -->
    <div id="modal"> <!-- data-iziModal-fullscreen="true"  data-iziModal-title="Welcome"  data-iziModal-subtitle="Subtitle"  data-iziModal-icon="icon-home" -->
        <!-- Modal content -->
        <div class="iziModal-content" >

        </div>
    </div>

    <!-- Trigger to open Modal -->


    <!-- Trigger to open Modal -->
    <div class="header-section section">
        @include("news.elements.top-bar")
        @include("news.elements.menu")
        @yield('slider')

    </div>


    <!-- Link to open the modal -->
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