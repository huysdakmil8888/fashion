@forelse($items as $item)


    <div class="col-xl-4 col-md-6 col-12 mb-40">
        @include('news.partials.product.product-item')
    </div>
@empty
    <p>Không có sản phẩm nào</p>
@endforelse
@include('news.templates.pagination')
