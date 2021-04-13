@php
    use App\Helpers\Template;
    use App\Helpers\URL;
@endphp
<div class="product-section section section-padding">
    <div class="container">

        <div class="row">
            <div class="section-title text-center col mb-30">
                <h1>Sản phẩm mới nhất</h1>
                <p>Tất cả các sản phẩm phổ biến có thể tìm thấy ở đây</p>
            </div>
        </div>

        <div class="row mbn-40">
            @foreach($itemsProductRecent as $item)
                @php
                    $name=$item->name;
                    $thumb=$item->thumb;
                    $link=URL::linkProduct($item);
                    $price=Template::format_price($item->price);
                @endphp
            <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-40">

                @include('news.partials.product.product-item')

            </div>
            @endforeach


        </div>

    </div>
</div>