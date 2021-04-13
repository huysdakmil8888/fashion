@php
    use App\Helpers\URL;
    use App\Helpers\Template;
@endphp
<div class="col-lg-4 col-md-6 col-12 mb-40">

    <div class="row">
        <div class="section-title text-left col mb-30">
            <h1>Best Deal</h1>
            <p>Exclusive deals for you</p>
        </div>
    </div>

    <div class="best-deal-slider w-100">
        @forelse($itemsProductDeal as $item)
            @php
                $name=$item->name;
                $thumb=$item->image[0]->name;
                $link=URL::linkProduct($item);
                $price=Template::format_price($item->price);
                $sale=Template::format_price($item->sale);
                $date_end=date("Y/m/d",$item->date_end);

            @endphp
        <div class="slide-item">
            <div class="best-deal-product">

                <div class="image"><img src="{{asset('assets/images/product/'.$thumb)}}" alt=""></div>

                <div class="content-top">

                    <div class="content-top-left">
                        <h4 class="title"><a href="{{$link}}">{{$name}}</a></h4>
                        <div class="ratting">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                        </div>
                    </div>

                    <div class="content-top-right">
                        <span class="price">{!! $sale !!} <span class="old">{!! $price !!}</span></span>
                    </div>

                </div>

                <div class="content-bottom">
                    <div class="countdown" data-countdown="{{$date_end}}"></div>
                    <a href="{{$link}}" data-hover="SHOP NOW">SHOP NOW</a>
                </div>

            </div>
        </div>
        @empty
            <p>chua co san pham sale nao</p>
        @endforelse




    </div>

</div>