<div class="footer-top-section section bg-theme-two-light section-padding">
    <div class="container">
        <div class="row mbn-40">

            <div class="footer-widget col-lg-3 col-md-6 col-12 mb-40">
                <h4 class="title">CONTACT US</h4>
                {!! $setting_general['contact_us'] !!}
            </div>

            <div class="footer-widget col-lg-3 col-md-6 col-12 mb-40">
                <h4 class="title">PRODUCTS</h4>
                <ul>
                    <li><a href="#">New Arrivals</a></li>
                    <li><a href="#">Best Seller</a></li>
                    <li><a href="#">Trendy Items</a></li>
                    <li><a href="#">Best Deals</a></li>
                    <li><a href="#">On Sale Products</a></li>
                    <li><a href="#">Featured Products</a></li>
                </ul>
            </div>

            <div class="footer-widget col-lg-3 col-md-6 col-12 mb-40">
                <h4 class="title">INFORMATION</h4>
                <ul>
                    <li><a href="#">About us</a></li>
                    <li><a href="#">Terms & Conditions</a></li>
                    <li><a href="#">Payment Method</a></li>
                    <li><a href="#">Product Warranty</a></li>
                    <li><a href="#">Return Process</a></li>
                    <li><a href="#">Payment Security</a></li>
                </ul>
            </div>

            <div class="footer-widget col-lg-3 col-md-6 col-12 mb-40">
                <h4 class="title">NEWSLETTER</h4>
                <p>Subscribe our newsletter and get all update of our product</p>

                <form id="mc-form" class="mc-form footer-subscribe-form" novalidate="true">
                    <input id="mc-email" autocomplete="off" placeholder="Enter your email here" name="EMAIL"
                           type="email">
                    <button id="mc-submit"><i class="fa fa-paper-plane-o"></i></button>
                </form>
                <!-- mailchimp-alerts Start -->
                <div class="mailchimp-alerts">
                    <div class="mailchimp-submitting"></div><!-- mailchimp-submitting end -->
                    <div class="mailchimp-success"></div><!-- mailchimp-success end -->
                    <div class="mailchimp-error"></div><!-- mailchimp-error end -->
                </div><!-- mailchimp-alerts end -->

                <h5>FOLLOW US</h5>
                <p class="footer-social">
                    <a href="{{$setting_general['facebook']}}" target="_blank">Facebook</a> -
                    <a href="{{$setting_general['twitter']}}"  target="_blank">Twitter</a> -
                    <a href="{{$setting_general['google']}}"  target="_blank">Google+</a>
                </p>

            </div>

        </div>
    </div>
</div>