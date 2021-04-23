@php
    use App\Helpers\URL;
use App\Helpers\Template;
@endphp
<div class="col-xl-3 col-lg-4 col-12 order-2 order-lg-1 mb-40">
    <div class="sidebar">
        <h3 class="sidebar-title">Price</h3>

        <div class="sidebar-price">

            <div id="price-range"></div>
            <form action="" method="get">
            <input type="text" id="price-amount" readonly style="width: 100%">
            <input type="hidden" name="price_min" value="300000">
            <input type="hidden" name="price_max" value="1500000">
               @isset($_GET['show'])
                <input type="hidden" name="show" value="{{$itemsNum}}">
                @endisset
                @isset($_GET['order'])
                <input type="hidden" name="order" value="{{$itemsOrder}}">
                @endisset
                @isset($_GET['search'])
                    <input type="hidden" name="search" value="{{$_GET['search']}}">
                @endisset


                <div class="comment-form">
                <input value="lọc" type="submit" style="padding: 2px 14px;margin-top: 10px;text-transform: capitalize;">
            </div>
            </form>

        </div>
    </div>

    @isset($cats)
    <div class="sidebar">
        <h4 class="sidebar-title">Category</h4>
        <ul class="sidebar-list">
            @forelse($cats as $item)
                <li><a href="{{URL::linkCategory($item)}}">{{$item->name}} <span class="num">{{$item->product_count}}</span></a></li>
            @empty
                <p>Chưa có chuyên mục nào</p>
            @endforelse
        </ul>
    </div>
    @endisset


    <div class="sidebar">
        <h4 class="sidebar-title">colors</h4>
        <ul class="sidebar-list">
            <li><a href="#"><span class="color" style="background-color: #000000"></span> Black</a></li>
            <li><a href="#"><span class="color" style="background-color: #FF0000"></span> Red</a></li>
            <li><a href="#"><span class="color" style="background-color: #0000FF"></span> Blue</a></li>
            <li><a href="#"><span class="color" style="background-color: #28901D"></span> Green</a></li>
            <li><a href="#"><span class="color" style="background-color: #FF6801"></span> Orange</a></li>
        </ul>
    </div>
    @isset($itemsBestBuy)

    <div class="sidebar">
        <h4 class="sidebar-title">Sản phẩm bán chạy</h4>
        <div class="sidebar-product-wrap">
            @forelse($itemsBestBuy as $item)
                @php
                    $name=$item->name;
                    $thumb=$item->thumb;
                    $price=Template::format_price($item->price);
                    $sale=Template::format_price($item->sale);
                    $url=URL::linkProduct($item);
                @endphp
            <div class="sidebar-product">
                <a href="single-product.html" class="image"><img src="{{asset($thumb)}}" alt=""></a>
                <div class="content">
                    <a href="{{$url}}" class="title">{{$name}}</a>
                    <span class="price">
                        @if($item->sale)
                        {!! $sale !!} <span class="old">{!! $price !!}
                        @else
                        {!! $price !!}
                        @endif
                    </span></span>
                    <div class="ratting">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                    </div>
                </div>
            </div>
            @empty
            <p></p>
            @endforelse
        </div>
    </div>
    @endisset


    <div class="sidebar">
        @if(count($tags))
            <h3 class="sidebar-title">Tags</h3>
            <ul class="sidebar-tag">
                @foreach($tags as $tag)
                    <li><a href="{{route('category/tag',[Str::slug($tag->name),$tag->id])}}">{{$tag->name}}</a></li>
                @endforeach
            </ul>
        @endif
    </div>


</div>
@section('script')
<script>
/*------------Price Range Slider------------------------*/
    $('#price-range').slider({
        range: true,
        min: {{$setting_general['price_min']}}, //100 ngan
        max: {{$setting_general['price_max']}}, //2 trieu
        step: {{$setting_general['price_range']}},
        values: [ {{$_GET['price_min']??300000}}, {{$_GET['price_max']??1500000}} ],
        //luc thay doi
        slide: function( event, ui ) {
            $min=format(ui.values[ 0 ]);
            $max=format(ui.values[ 1 ]);

            $('#price-amount').val("Giá từ: "+$min+'  đến  '+$max);
            $("[name='price_min']").val(ui.values[ 0 ])
            $("[name='price_max']").val(ui.values[ 1 ])
        }
    });
        //luc ban dau
        $minRange=format($('#price-range').slider( 'values', 0 ));
        $maxRange=format($('#price-range').slider( 'values', 1 ));
        $('#price-amount').val("Giá từ: "+$minRange + '  đến   '+$maxRange);
</script>
@stop
