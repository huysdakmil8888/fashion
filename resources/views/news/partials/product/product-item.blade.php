@php
    use App\Helpers\Template;
    use App\Helpers\URL;
    $name=$item->name;
    $thumb=$item->thumb;
    $url=URL::linkProduct($item);
    $price=Template::format_price($item->price);
    $rating=$item->rating;
@endphp
<div class="product-item">

    <div class="product-inner">

        <div class="image">
            <img src="{{asset($thumb)}}" alt="">

            <div class="image-overlay">
                <div class="action-buttons">

                    <button class="addToCart">add to cart</button>
                    <input type="hidden" value="{{$item->id}}" class="cart_id">
                    <input type="hidden" value="{{route('cart/add-cart')}}" class="cart_url">
                    <input type="hidden" value="1" class="cart_qty">

                    <button>add to wishlist</button>
                </div>
            </div>

        </div>

        <div class="content">

            <div class="content-left">

                <h4 class="title"><a href="{{$url}}">{{$name}}</a></h4>

                <div class="ratting">
                    <div class="my-rating-4" data-rating="{{$rating}}"></div>
                </div>

                <h5 class="size">Size: <span>S</span><span>M</span><span>L</span><span>XL</span></h5>
                <h5 class="color">Color: <span style="background-color: #ffb2b0"></span><span
                            style="background-color: #0271bc"></span><span
                            style="background-color: #efc87c"></span><span style="background-color: #00c183"></span>
                </h5>

            </div>

            <div class="content-right">
                <span class="price">{!! $price !!}</span>
            </div>

        </div>

    </div>
</div>
