<div class="section section-padding pt-0">
    <div class="container">
        <div class="row">

            <div class="section-title text-left col col mb-30">
                <h1>Các sản phẩm liên quan</h1>
            </div>
            <div class="related-product-slider related-product-slider-1 col-12 p-0">
                @foreach($itemsRelated as $item)

                <div class="col">

                    @include('news.partials.product.product-item')
                </div>
                @endforeach




            </div>
        </div>
    </div>
</div><!-- Related Product Section End -->
