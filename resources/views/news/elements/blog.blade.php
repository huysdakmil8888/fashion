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

                    <div class="col-12 mb-40">
                        <div class="blog-item">
                            <div class="image-wrap">
                                <h4 class="date">May <span>25</span></h4>
                                <a class="image" href="single-blog.html"><img src="assets/images/blog/blog-1.jpg"
                                                                              alt=""></a>
                            </div>
                            <div class="content">
                                <h4 class="title"><a href="single-blog.html">Lates and new Trens for baby
                                        fashion</a></h4>
                                <div class="desc">
                                    <p>Jadusona is one of the most of a exclusive Baby shop in the</p>
                                </div>
                                <ul class="meta">
                                    <li><a href="#"><img src="assets/images/blog/blog-author-1.jpg"
                                                         alt="Blog Author">Muhin</a></li>
                                    <li><a href="#">25 Likes</a></li>
                                    <li><a href="#">05 Views</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mb-40">
                        <div class="blog-item">
                            <div class="image-wrap">
                                <h4 class="date">May <span>20</span></h4>
                                <a class="image" href="single-blog.html"><img src="assets/images/blog/blog-2.jpg"
                                                                              alt=""></a>
                            </div>
                            <div class="content">
                                <h4 class="title"><a href="single-blog.html">New Collection New Trend all New
                                        Style</a></h4>
                                <div class="desc">
                                    <p>Jadusona is one of the most of a exclusive Baby shop in the</p>
                                </div>
                                <ul class="meta">
                                    <li><a href="#"><img src="assets/images/blog/blog-author-2.jpg"
                                                         alt="Blog Author">Takiya</a></li>
                                    <li><a href="#">25 Likes</a></li>
                                    <li><a href="#">05 Views</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>