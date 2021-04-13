<div class="banner-section section section-padding pt-0 fix">
    <div class="row row-5 mbn-10">
        @php
            $i=2;
        @endphp
        @forelse($ad['middle'] as $item )
            @php
                $thumb=$item->thumb;
                $description=$item->description;
                $link=$item->link;
                $i++;
            @endphp

        <div class="col-lg-4 col-md-6 col-12 mb-10">
            <div class="banner banner-{{$i}}">

                <a href="{{$link}}" class="image"><img src="{{asset($thumb)}}" alt="Banner Image"></a>
                @if($i==4)
                    <div class="content">
                    <div class="content-inner">
                        {!! $description !!}
                        <a href="{{$link}}" data-hover="SHOP NOW">SHOP NOW</a>
                    </div>
                    </div>
                @else
                <div class="content" style="background-image: url(assets/images/banner/banner-3-shape.png)">
                    {!! $description !!}
                </div>

                <a href="{{$link}}" class="shop-link" data-hover="SHOP NOW">SHOP NOW</a>
                @endif
            </div>
        </div>

        @empty
            <p></p>
        @endforelse

    </div>
</div>