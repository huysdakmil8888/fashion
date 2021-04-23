

    @php
        use App\Helpers\Template;$name=$item->name;
        $price=Template::format_price($item->price);
        $description=$item->description;
        $content=$item->content;
        $datasheet=$item->datasheet;
        $type = Request::input('type', 'reviews');
        $qty=$item->quantity;
    @endphp
    <div class="page-section section" style="padding-top: 20px">
        <div class="container">
            <div class="row row-30 mbn-50">

                <div class="col-12">
                    <div class="row row-20 mb-10">

                        <div class="col-lg-6 col-12 mb-40">
                            @include("news.pages.product.child-index.dropzone")

                        </div>

                        <div class="col-lg-6 col-12 mb-40">
                            @include("news.pages.product.child-index.content-modal")

                        </div>

                    </div>



                </div>

            </div>
        </div>
    </div><!-- Page Section End -->
