<!doctype html>
<html class="no-js" lang="en">

<head>
    @include("news.elements.head")
</head>

<body>

<div class="main-wrapper">

    <div class="header-section section">
        @include("news.elements.top-bar")
        @include("news.elements.menu")
        @include("news.elements.slider")
    </div>


    <!-- Banner Section Start -->
@include("news.elements.banner")
<!-- Banner Section End -->

    <!-- Product Section Start -->
@include("news.elements.all-product")

<!-- Product Section End -->
@include("news.elements.banner-second")

<!-- Banner Section Start -->
    <!-- Banner Section End -->

    <!-- Product Section Start -->
@include("news.elements.sale-product")

<!-- Product Section End -->

    <!-- Feature Section Start -->
@include("news.elements.banner-bottom")

<!-- Feature Section End -->

    <!-- Blog Section Start -->
@include("news.elements.blog")

<!-- Blog Section End -->

    <!-- Brand Section Start -->
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


</body>

</html>