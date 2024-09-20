@extends('frontpanel.layouts.master')

@section('title','Home')

@push('css')
@endpush

@section('content')
<!-- Hero Section Start -->
@if(Session::has('message'))
<div id="notifications" style="display: block;">
    <div class="card" style="position: fixed;top:15px;right:15px;width:300px;background-color: #bbbbbbde;color: #060606;">
        <div class="card-body">
            <strong class="card-title" style="color: #000000eb;">
                Thank you
            </strong>
            <p class="card-text">{{ Session::get('message') }}</p>
        </div>
    </div>
</div>
@endif
@include('frontpanel.layouts.partials.slider')
<!-- Hero Section End -->
<div class="product-section section mb-70">
    <div class="container">
        <div class="row">

            <!-- Section Title Start -->
            <div class="col-12 mb-40">
                <div class="section-title-one">
                    <h1>FEATURED ITEMS</h1>
                </div>
            </div><!-- Section Title End -->

            <!-- Product Tab Content Start -->
            <div class="col-12">
                <div class="tab-content">

                    <!-- Tab Pane Start -->
                    <div class="tab-pane fade show active" id="tab-one">

                        <!-- Product Slider Wrap Start -->
                        <div class="product-slider-wrap product-slider-arrow-one">
                            <!-- Product Slider Start -->
                            <div class="product-slider product-slider-4">
                                @foreach($products as $product)
                                <?php
                                if ($product->discount != null) {
                                    $offerd = $product->price * $product->discount / 100;
                                    $discount = $product->price - $offerd;
                                }
                                ?>
                                <div class="col pb-20 pt-10">
                                    <!-- Product Start -->
                                    <div class="ee-product">
                                    @if($product->discount != null)<div class="bg-danger" style="border-radius: 10px 10px 0 0; position:absolute; z-index: 1; width: 278px"><h4 class="text-white text-center py-2">{!! $product->discount !!}% Discount!</h4></div>@endif
                                        <!-- Image -->
                                        <div class="image text-center">
                                            <a href="{{route('productdetails', $product->id)}}" class="img">
                                                <img src="{{url('public/uploads/product/'. $product->image)}}" alt="Product Image" style="height: 330px;">
                                            </a>
                                            @if($product->quantity > 0)
                                            <a href="{{route('add.to.cart', $product->id)}}" class="btn btn-warning d-block"><i class="ti-shopping-cart"></i><span> ADD TO CART</span></a>
                                            @else
                                            <h4 class="text-danger btn btn-outline-secondary d-block">Out of Stock</h4>
                                            @endif
                                        </div>

                                        <div class="content">

                                            <div class="category-title">
                                                <a href="{{route('category.product', $product->category->id)}}" class="cat">{!! $product->category->name !!}</a>
                                                <h5 class="title"><a href="{{route('productdetails', $product->id)}}">{!! $product->name !!}</a></h5>
                                            </div>

                                            <!-- Price & Ratting -->
                                            <div class="price-ratting">
                                                <h5 class="price">BDT @if($product->discount != null)<del>{!! $product->price !!}</del> {!! $discount !!}@else {!! $product->price !!} @endif</h5>
                                                <div class="ratting">
                                                    <?php
                                                    $reviews = App\Models\Review::where('product_id', $product->id)->get();
                                                    if ($reviews->count() != 0) {
                                                        $rating = $reviews->sum('review') / $reviews->count();
                                                        for ($i = 1; $i <= $rating; $i++) {
                                                            echo '<i class="fa fa-star"></i>';
                                                        }
                                                    } else {
                                                        echo  '<p>No Reviews</p>';
                                                    }
                                                    ?>
                                                </div>

                                            </div>

                                        </div>

                                    </div><!-- Product End -->
                                </div>
                                @endforeach

                            </div><!-- Product Slider End -->
                        </div><!-- Product Slider Wrap End -->

                    </div><!-- Tab Pane End -->

                </div>
            </div><!-- Product Tab Content End -->

        </div>
        <div class="row">

            <!-- Section Title Start -->
            <div class="col-12 mb-40">
                <div class="section-title-one">
                    <h1>Discount Product</h1>
                </div>
            </div><!-- Section Title End -->

            <!-- Product Tab Content Start -->
            <div class="col-12">
                <div class="tab-content">

                    <!-- Tab Pane Start -->
                    <div class="tab-pane fade show active" id="tab-one">

                        <!-- Product Slider Wrap Start -->
                        <div class="product-slider-wrap product-slider-arrow-one">
                            <!-- Product Slider Start -->
                            <div class="product-slider product-slider-4">
                                @foreach($d_product as $product)
                                <?php
                                if ($product->discount != null) {
                                    $offerd = $product->price * $product->discount / 100;
                                    $discount = $product->price - $offerd;
                                }
                                ?>
                                <div class="col pb-20 pt-10">
                                    <!-- Product Start -->
                                    <div class="ee-product" style="position: relative;">
                                    <div class="bg-danger" style="border-radius: 10px 10px 0 0; position:absolute; z-index: 1; width: 278px"><h4 class="text-white text-center py-2">{!! $product->discount !!}% Discount!</h4></div>
                                        <!-- Image -->
                                        <div class="image">
                                            <a href="{{route('productdetails', $product->id)}}" class="img">
                                                <img src="{{url('public/uploads/product/'. $product->image)}}" alt="Product Image" style="height: 330px; height: 330px;border-radius: 10px 10px 0 0;">
                                            </a>
                                            @if($product->quantity > 0)
                                            <a href="{{route('add.to.cart', $product->id)}}" class="btn btn-warning d-block"><i class="ti-shopping-cart"></i><span> ADD TO CART</span></a>
                                            @else
                                            <h4 class="text-danger btn btn-outline-secondary d-block">Out of Stock</h4>
                                            @endif

                                        </div>

                                        <div class="content">

                                            <div class="category-title">
                                                <a href="{{route('category.product', $product->category->id)}}" class="cat">{!! $product->category->name !!}</a>
                                                <h5 class="title"><a href="{{route('productdetails', $product->id)}}">{!! $product->name !!}</a></h5>
                                            </div>

                                            <!-- Price & Ratting -->
                                            <div class="price-ratting">

                                                <h5 class="price">BDT @if($product->discount != null)<del>{!! $product->price !!}</del> {!! $discount !!}@else {!! $product->price !!} @endif</h5>
                                                <div class="ratting">
                                                    <?php
                                                    $reviews = App\Models\Review::where('product_id', $product->id)->get();
                                                    if ($reviews->count() != 0) {
                                                        $rating = $reviews->sum('review') / $reviews->count();
                                                        for ($i = 1; $i <= $rating; $i++) {
                                                            echo '<i class="fa fa-star"></i>';
                                                        }
                                                    } else {
                                                        echo  '<p>No Reviews</p>';
                                                    }
                                                    ?>
                                                </div>

                                            </div>

                                        </div>

                                    </div><!-- Product End -->
                                </div>
                                @endforeach

                            </div><!-- Product Slider End -->
                        </div><!-- Product Slider Wrap End -->

                    </div><!-- Tab Pane End -->

                </div>
            </div><!-- Product Tab Content End -->

        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    setTimeout(function() {
        $('#notifications').fadeOut('fast');
    }, 3000); // <-- time in milliseconds
</script>
@endpush