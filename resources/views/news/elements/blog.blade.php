@php
    use App\Helpers\URL;
    use App\Helpers\Template;
@endphp
<div class="blog-section section section-padding">
    <div class="container">
        <div class="row mbn-40">

            <div class="col-xl-6 col-lg-5 col-12 mb-40">

                <div class="row">
                    <div class="section-title text-left col mb-30">
                        <h1>Trải nghiệm khách hàng</h1>
                        <p>Khách hàng nói gì về chúng tôi</p>
                    </div>
                </div>

                <div class="row mbn-40">
                    @foreach($itemsTestimonial as $item)
                        @php
                            $thumb=$item->thumb;
                            $content=$item->content;
                            $name=$item->name;
                            $job=$item->job;
                        @endphp
                    <div class="col-12 mb-40">
                        <div class="testimonial-item">
                            {!! $content !!}
                            <div class="testimonial-author">
                                <img src="{{$thumb}}" alt="">
                                <div class="content">
                                    <h4>{{$name}}</h4>
                                    <p>{{$job}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach


                </div>

            </div>

            <div class="col-xl-6 col-lg-7 col-12 mb-40">

                <div class="row">
                    <div class="section-title text-left col mb-30">
                        <h1>FROM THE BLOG</h1>
                        <p>Find all latest update here</p>
                    </div>
                </div>

                <div class="row mbn-40">
                    @foreach($itemsArticle as $item)
                    <div class="col-12 mb-40">
                        @include("news.partials.article.blog")
                    </div>

                    @endforeach
                </div>

            </div>

        </div>
    </div>
</div>