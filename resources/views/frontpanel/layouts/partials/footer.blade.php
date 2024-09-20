<div class="footer-section section bg-ivory">

    <!-- Footer Top Section Start -->
    <div class="footer-top-section section pt-90 pb-50">
        <div class="container">

            <div class="row">
                <!-- Footer Widget Start -->
                <div class="col-lg-3 col-md-6 col-12 mb-40">
                    <div class="footer-widget">

                        <span class="widget-title">
                            <div class="footer-image" style="margin-bottom: 8px; margin-top: -13px; margin-left: -7px;">
                                @if($settings != null)
                                <img src="{{url('public/uploads/system/'.$settings->logo)}}" alt="logo.png">
                                @else
                                <img src="{{url('public/uploads/system/2024-07-19-669a10f411986.png')}}" alt="logo.png">
                                @endif
                        </span>
                    </div>
                    <p>
                        @if($settings != null)
                        {!! $settings->description !!}
                        @endif
                    </p>

                </div>
            </div><!-- Footer Widget End -->

            <!-- Footer Widget Start -->
            <div class="col-lg-3 col-md-6 col-12 mb-40">
                <div class="footer-widget">

                    <h4 class="widget-title">Top Categories</h4>
                    <div class="footer-news">
                        @foreach($limitcategories as $category)
                        <div class="sidebar-blog p-0 mb-4 border-0">
                            <a href="{{route('category.product', $category->id)}}" class="image"><img class="opacity-100" src="{{url('public/uploads/category/', $category->image)}}" alt="product.png"></a>
                            <div class="content">
                                <h5><a href="{{route('category.product', $category->id)}}">{!! $category->name !!}</a></h5>
                                <span>{!! $category->created_at !!}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>

                </div>
            </div><!-- Footer Widget End -->

            <!-- Footer Widget Start -->
            <div class="col-lg-3 col-md-6 col-12 mb-40">
                <div class="footer-widget">
                    <?php
                    $aboutus = App\Models\Aboutus::latest()->first();
                    ?>
                    <h4 class="widget-title">{!! $aboutus->title ? $aboutus->title :'About us Title will show here' !!}</h4>

                    <div class="footer-news">
                        <div class="sidebar-blog p-0 mb-4 border-0">
                            <div class="image">
                                @if(isset($aboutus))
                                <img src="{{url('public/uploads/system/'.$aboutus->image)}}" alt="">
                                @else
                                <img src="{{url('public/uploads/system/2024-07-25-66a20fe807c83.jpg')}}" alt="">
                                @endif
                            </div>
                            <div class="content">
                                @if(isset($aboutus))
                                <p>{!! Str::limit($aboutus->description, 200, '...') !!}<a href="{!!route('aboutus')!!}"><strong>read more</strong></a></p>
                                @else
                                <p>About us Description will show here</p>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div><!-- Footer Widget End -->

            <!-- Footer Widget Start -->
            <div class="col-lg-3 col-md-6 col-12 mb-40">
                <div class="footer-widget">

                    <h4 class="widget-title">CONTACT INFO</h4>

                    <p class="contact-info">
                        <span>Address</span>
                        @if($settings != null){!! $settings->address !!}@endif
                    </p>

                    <p class="contact-info">
                        <span>Phone</span>
                        <a href="tel:01234567890">@if($settings != null){!! $settings->phone !!}@endif</a>
                        <a href="tel:01234567891">@if($settings != null){!! $settings->alt_phone !!}@endif</a>
                    </p>

                    <p class="contact-info">
                        <span>Web</span>
                        <a href="mailto:info@example.com">@if($settings != null){!! $settings->email !!}@endif</a>
                    </p>

                </div>
            </div><!-- Footer Widget End -->

        </div>

    </div>
</div><!-- Footer Bottom Section Start -->

<!-- Footer Bottom Section Start -->
<div class="footer-bottom-section section">
    <div class="container">
        <div class="row">

            <!-- Footer Copyright -->
            <div class="col-lg-6 col-12">
                <div class="footer-copyright">
                    <p>&copy; Copyright, All Rights Reserved by <a href="javascript:void(0);">@if($settings != null){!! $settings->copyright !!}@endif</a></p>
                </div>
            </div>

            <!-- Footer Payment Support -->
            <div class="col-lg-6 col-12">
                <div class="footer-payments-image"><img src="{{url('public/front/assets/images/payment-support.png')}}" alt="Payment Support Image"></div>
            </div>

        </div>
    </div>
</div><!-- Footer Bottom Section Start -->

</div>