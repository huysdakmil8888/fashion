<div class="feature-section bg-theme-two section section-padding fix"
     style="background-image: url(assets/images/pattern/pattern-dot.png);">
    <div class="container">
        <div class="feature-wrap row justify-content-between mbn-30">
            @forelse($ad['bottom'] as $item )
                @php
                    $thumb=$item->thumb;
                    $description=$item->description;
                    $link=$item->link;
                @endphp
            <div class="col-md-4 col-12 mb-30">
                <div class="feature-item text-center">

                    <div class="icon"><img src="{{asset($thumb)}}" alt=""></div>
                    <div class="content">{!! $description !!}</div>

                </div>
            </div>
            @empty
            <p></p>
            @endforelse


        </div>
    </div>
</div>