@php
    use App\Helpers\Template;                
@endphp
<div class="single-product-content">

    <div class="head">
        <div class="head-left">

            <h3 class="title">{{$name}}</h3>

            <div class="ratting">
                <div class="my-rating-4" data-rating="4"></div>
            </div>

        </div>

        <div class="head-right">
            <span class="price">{!! $price !!}</span>
            <input type="hidden" name="price" value="{{$item->price}}">
            <input type="hidden" name="color" value="">
        </div>
    </div>

    <div class="description">
{{--        {!! $description !!}--}}
    </div>

    <span class="availability">Tình trạng: <span>
            @if($qty>0)
                Còn hàng
                @else
                Hết hàng
            @endif
        </span></span>

    <div class="quantity-colors">

        <div class="quantity">
            <h5>Quantity:</h5>
            <div class="pro-qty">
                <input type="text" value="1" id="cart_qty">

            </div>
        </div>


        <div class="colors">
            <h5>Color:</h5>
            <div class="color-options">
{{--                @dd($item->colors->toArray());--}}
                {!! Template::showColor($item->colors) !!}
            </div>
        </div>
        <input type="hidden" value="{{$item->id}}" id="cart_id">
        <input type="hidden" value="{{route('cart/add-cart')}}" id="cart_url">

    </div>

    <div class="actions">

        <button id="addToCart"><i class="ti-shopping-cart"></i><span>ADD TO CART</span></button>
{{--        <button class="box" data-tooltip="Compare"><i class="ti-control-shuffle"></i></button>--}}
{{--        <button class="box" data-tooltip="Wishlist"><i class="ti-heart"></i></button>--}}


    </div>

    <div class="tags">

        <h5>Tags:</h5>
        @foreach($item->tags as $tag)
            <a href="{{route('category/tag',[Str::slug($tag->name),$tag->id])}}">{{$tag->name}}</a>
        @endforeach

    </div>


</div>