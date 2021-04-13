<div class="banner-section section mt-40">
    <div class="container-fluid">
        <div class="row row-10 mbn-20">

            @forelse($ad['top'] as $item )
                @php
                    $thumb=$item->thumb;
                    $description=$item->description;
                    $link=$item->link;
                @endphp
            <div class="col-lg-4 col-md-6 col-12 mb-20">
                <div class="banner banner-1 content-left content-middle">

                    <a href="{{$link}}" class="image"><img width="377" height="212" src="{{asset($thumb)}}" alt="Banner Image"></a>

                    <div class="content">
                        {!! $description !!}
                        <a href="{{$link}}" data-hover="SHOP NOW">SHOP NOW</a>
                    </div>


                </div>
            </div>
            @empty
                <p></p>
            @endforelse



        </div>
    </div>
</div>