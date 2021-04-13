@php
    use App\Helpers\URL;
    use App\Helpers\Template;
@endphp
<div class="product-section section section-padding pt-0">
    <div class="container">
        <div class="row mbn-40">

            @include('news.elements.best-deal')
            <div class="col-lg-8 col-md-6 col-12 pl-3 pl-lg-4 pl-xl-5 mb-40">

                <div class="row">
                    <div class="section-title text-left col mb-30">
                        <h1>Các sản phẩm đang giảm giá</h1>
                        <p>Tất cả các sản phẩm nổi bật có thể tìm thấy ở đây</p>
                    </div>
                </div>

                <div class="small-product-slider row row-7 mbn-40">
                    @forelse($itemsProductSale as $item)
                        @php
                            $name=$item->name;
                            $thumb=$item->thumb;
                            $link=URL::linkProduct($item);
                            $price=Template::format_price($item->price);
                            $sale=Template::format_price($item->sale);
                        @endphp
                    <div class="col mb-40">

                        <div class="on-sale-product">
                            <a href="{{$link}}" class="image"><img
                                        src="{{asset($thumb)}}" alt=""></a>
                            <div class="content text-center">
                                <h4 class="title"><a href="{{$link}}">{{$name}}</a></h4>
                                <span class="price">{!! $sale !!} <span class="old">{!! $price !!}</span></span>
                                <div class="ratting">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                            </div>
                        </div>

                    </div>
                    @empty
                    <p>chua co san pham sale nao</p>
                    @endforelse



                </div>

            </div>

        </div>
    </div>
</div>