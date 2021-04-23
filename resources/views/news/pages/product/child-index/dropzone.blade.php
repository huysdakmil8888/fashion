@php
    $firstImage=$item->image[0];
@endphp
<div class="pro-large-img mb-10 fix easyzoom easyzoom--overlay easyzoom--with-thumbnails">
    <a href="{{asset('assets/images/product/'.$firstImage['name'])}}">
        <img src="{{asset('assets/images/product/'.$firstImage['name'])}}"/>
    </a>
</div>
<!-- Single Product Thumbnail Slider -->
<ul id="pro-thumb-img" class="pro-thumb-img" >
    @foreach($item->image as $value)
    <li>
        <a href="{{asset('assets/images/product/'.$value['name'])}}"
           data-standard="{{asset('assets/images/product/'.$value['name'])}}">
            <img  src="{{asset('assets/images/product/product-small/'.$value['name'])}}" />
        </a>
    </li>
    @endforeach
</ul>
@section('script')
{{--    <script src="{{asset('assets/js/my-js.js')}}"></script>--}}
@stop