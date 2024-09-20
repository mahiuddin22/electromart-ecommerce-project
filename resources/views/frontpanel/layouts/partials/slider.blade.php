<div class="hero-section section mb-30">
    <div class="container">
        <div class="row">
            <div class="col position-relative">

                <!-- Header Category -->
                <div class="hero-side-category">

                    <!-- Category Toggle Wrap -->
                    <div class="category-toggle-wrap">
                        <!-- Category Toggle -->
                        <button class="category-toggle">Categories <i class="ti-menu"></i></button>
                    </div>

                    <!-- Category Menu -->
                    <nav class="category-menu">
                        <ul>
                            @foreach($categories as $category)
                            <li><a href="{{route('category.product', $category->id)}}">{!! $category->name !!}</a></li>
                            @endforeach
                        </ul>
                    </nav>

                </div><!-- Header Bottom End -->

                <!-- Hero Slider Start -->
                <div class="hero-slider hero-slider-two fix">
                    @foreach($sliders as $slider)
                    <?php
                        $product = \App\Models\Product::where('id',$slider->product_id)->first();
                    ?>
                    <!-- Hero Item Start -->
                    <div class="hero-item-two">
                        <div class="row align-items-center justify-content-between">
                            <!-- Hero Content -->
                            <div class="hero-content-two col">

                                <h2 class="offer">{!! $product->discount !!}% <span>OFF</span></h2>
                                <h1>{!! $slider->name !!}</h1>
                                <a href="{{route('productdetails', $product->id)}}">get it now</a>

                            </div>

                            <!-- Hero Image -->
                            <div class="hero-image-two col">
                                <img src="{{url('public/uploads/slider/'.$slider->image)}}" alt="Hero Image" style="height: 250px;">
                            </div>

                        </div>
                    </div><!-- Hero Item End -->
                    @endforeach
                </div><!-- Hero Slider End -->

            </div>
        </div>
    </div>
</div>