@php
    use App\Helpers\Hightlight;
    use App\Helpers\URL;
    $name=Hightlight::showFrontend($item->name,@$_GET['search']);
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

                    <button class="addToCart trigger" href="{{$item->id}}">add to cart</button>


                    <input type="hidden" value="{{$item->id}}" class="cart_id">
                    <input type="hidden" value="{{route('cart/add-cart')}}" class="cart_url">
                    <input type="hidden" value="1" class="cart_qty">
                    <input type="hidden" name="color-item" value="" class="color-item">
                    <input type="hidden" name="price-item" value="" class="price-item">


                    <button class="wishlist">add to wishlist</button>
                    <input type="hidden" value="{{route('category/addWishList')}}" class="addWishList">

                </div>
            </div>

        </div>

        <div class="content">

            <div class="content-left">

                <h4 class="title"><a href="{{$url}}">{!! $name !!}</a></h4>

                <div class="ratting">
                    <div class="my-rating-4" data-rating="{{$rating}}"></div>
                </div>

{{--                <h5 class="size">Size: <span>S</span><span>M</span><span>L</span><span>XL</span></h5>--}}

                <h5 class="color">Color:
                    {!! Template::showColor($item->colors,'span') !!}


                </h5>



            </div>

            <div class="content-right">
                <span class="price-item">{!! $price !!}</span>
            </div>

        </div>

    </div>
</div>
