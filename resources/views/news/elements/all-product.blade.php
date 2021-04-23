@php
    use App\Helpers\Template;
    use App\Helpers\URL;
@endphp
<div class="product-section section section-padding">
    <div class="container">


        <!-- Trigger to open Modal -->




        <div class="row mbn-40">
            <!-- Modal HTML embedded directly into document -->
            <!-- Modal structure -->



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