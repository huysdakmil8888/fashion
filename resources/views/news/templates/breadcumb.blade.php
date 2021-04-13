@php
       use App\Helpers\URL;
@endphp
<div class="page-banner-section section" style="background-image: url({{asset('assets/images/hero/hero-1.jpg')}})">
    <div class="container">
        <div class="row">
            <div class="page-banner-content col">

                <h1>{{$name}}</h1>
                <ul class="page-breadcrumb">
                    <li><a href="{{route('home')}}">Home</a></li>
                    @isset($itemsBread)
                        @foreach($itemsBread as $value)
                            @if($type=='category')
                                <li><a href="{{URL::linkCategory($value)}}">{{$value->name}}</a></li>
                            @else
                                <li><a href="{{URL::linkCategoryArticle($value)}}">{{$value->name}}</a></li>
                            @endif
                        @endforeach
                    @endisset
                </ul>

            </div>
        </div>
    </div>
</div><!-- Page Banner Section End -->
