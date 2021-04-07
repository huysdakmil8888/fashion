<div class="hero-section section">

    <!-- Hero Slider Start -->
    <div class="hero-slider hero-slider-one fix">

        <!-- Hero Item Start -->
        @foreach($itemsSlider as $item)
            @php
                $thumb=$item->thumb;
                $description=$item->description;
                $link=$item->link;
            @endphp

        <div class="hero-item" style="background-image: url({{$thumb}})">

            <!-- Hero Content -->
            <div class="hero-content">

                <h1>{!!$description!!}</h1>
                <a href="{{$link}}">Mua Ngay!</a>

            </div>

        </div><!-- Hero Item End -->
    @endforeach

        <!-- Hero Item Start -->

    </div><!-- Hero Slider End -->

</div>