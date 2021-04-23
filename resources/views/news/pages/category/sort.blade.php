@php
    use App\Helpers\Template;

    $show=Template::showAreaShow($controllerName,$itemsNum); //category
    $short=Template::showAreaShort($controllerName,$itemsOrder) //category

@endphp

        <div class="col-12">
            <div class="product-show">
                <h4>Show:</h4>
                {!! $show !!}
            </div>
            <div class="product-short">
                <h4>Sort by:</h4>
                {!! $short !!}
            </div>
        </div>

