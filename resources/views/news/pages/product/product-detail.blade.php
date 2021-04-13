@php
    use App\Helpers\Template;$name=$item->name;
    $price=Template::format_price($item->price);
    $description=$item->description;
    $content=$item->content;
    $datasheet=$item->datasheet;
    $type = Request::input('type', 'reviews');
    $qty=$item->quantity;
@endphp
<div class="page-section section section-padding">
    <div class="container">
        <div class="row row-30 mbn-50">

            <div class="col-12">
                <div class="row row-20 mb-10">

                    <div class="col-lg-6 col-12 mb-40">
                        @include("news.pages.product.child-index.dropzone")

                    </div>

                    <div class="col-lg-6 col-12 mb-40">
                        @include("news.pages.product.child-index.content")

                    </div>

                </div>

                <div class="row mb-50" id="tab-content">
                    <!-- Nav tabs -->
                    <div class="col-12">
                        <ul class="pro-info-tab-list section nav">
                            <li><a @if ($type == 'moreinfo') class="active" @endif href="{{ route('product/index', ['product_id'=>$item->id,'product_slug'=>$item->slug,'type' => 'moreinfo']) }}#tab-content" >More info</a></li>
                            <li><a @if ($type == 'datasheet') class="active" @endif href="{{ route('product/index', ['product_id'=>$item->id,'product_slug'=>$item->slug,'type' => 'datasheet']) }}#tab-content" >Data sheet</a></li>
                            <li><a @if ($type == 'reviews') class="active" @endif href="{{ route('product/index', ['product_id'=>$item->id,'product_slug'=>$item->slug,'type' => 'reviews']) }}#tab-content" >Reviews</a></li>
                        </ul>
                    </div>
                    <!-- Tab panes -->
                    <div class="tab-content col-12" >
                        @switch($type)
                            @case('moreinfo')
                            <div class="pro-info-tab tab-pane active" id="more-info">
                                {!! $content !!}
                            </div>
                            @break
                            @case('datasheet')
                            <div class="pro-info-tab tab-pane active" id="data-sheet">
                                {!! $datasheet !!}
                            </div>
                            @break
                            @case('reviews')
                            @include('news.pages.product.child-tab.comment')
                            @break
                        @endswitch

                    </div>
                </div>

            </div>

        </div>
    </div>
</div><!-- Page Section End -->
