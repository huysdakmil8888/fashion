<div class="brand-section section section-padding pt-0">
    <div class="container-fluid">
        <div class="row">
            <div class="brand-slider">
                @forelse($adFooter as $item)
                <div class="brand-item col">
                    <a href="{{$item->link}}"><img src="{{asset($item->thumb)}}"></a>
                </div>
                @empty
                <p></p>
                @endforelse
            </div>
        </div>
    </div>
</div>