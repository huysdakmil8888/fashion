@forelse($items as $item)

    <div class="col-xl-4 col-md-6 col-12 mb-40">
        @include('news.partials.product.product-item')
    </div>
@empty
    <p>Chưa có sản phẩm trong chuyên mục này</p>
@endforelse