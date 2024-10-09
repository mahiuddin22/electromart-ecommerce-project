@extends('frontpanel.layouts.master')

@section('title','product details')

@push('css')
@endpush

@section('content')
<!-- Single Product Section Start -->
<div class="product-section section mt-90 mb-90">
    <div class="container">

        <div class="row mb-90">
            @include('frontpanel.layouts.partials.message')
            <div class="col-lg-6 col-12 mb-50">
                <div>
                    <div id="single-image-1">
                        <img src="{{url('public/uploads/product/'. $product->image)}}" alt="Big Image">
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-12 mb-50">

                <!-- Content -->
                <div class="single-product-content">

                    <!-- Category & Title -->
                    <div class="head-content">

                        <div class="category-title">
                            <a href="javaecript:void(0)" class="cat">{{$product->category->name}}</a>
                            <h5 class="title">{{$product->name}}</h5>
                        </div>
                        <?php
                        if ($product->discount != null) {
                            $offerd = $product->price * $product->discount / 100;
                            $discount = $product->price - $offerd;
                        }
                        ?>
                        <h5 class="price">BDT @if($product->discount != null)<del>{!! $product->price !!}</del> {!! $discount !!}@else {!! $product->price !!} @endif</h5>

                    </div>

                    <div class="single-product-description">

                        <div class="ratting">
                            <?php
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

                        <div class="desc">
                            <p>{{$product->short_des}}</p>
                        </div>

                        <span class="availability">Availability: <span>{!! $product->quantity >= 0? 'In Stock':'Out of Stock' !!}</span> <span>{!! $product->quantity >= 0? $product->quantity:'' !!}</span></span>

                        <form action="{{route('add.to.cart', $product->id)}}" method="get">
                            @csrf
                            <div class="quantity-colors">

                                <h5><strong>Quantity</strong></h5>
                                <div style="border: 1px solid #ccc; border-radius:18px; width:125px; padding:0 5px;">
                                    <button type="button" onclick="increment()" style="border: none;">+</button>
                                    <input type="number" name="quantity" id="quantity" value="1" min="1" readonly @if($product->quantity < 10) max="{{$product->quantity}}" @else max="10" @endif style=" border: 1px solid #ccc; padding-left: 15px; padding-right: 15px; width: 65px;" />
                                    <button type="button" onclick="decrement()" style="border: none; ">-</button>
                                </div>

                            </div>

                            @if($product->quantity > 0)
                            <div class="actions">
                                <button class="btn btn-warning" type="submit"><i class="ti-shopping-cart"></i><span> ADD TO CART</span></button>
                            </div>
                            @else
                            <h4 class="text-danger btn btn-outline-secondary d-block">Out of Stock</h4>
                            @endif

                        </form>
                    </div>

                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-lg-10 col-12 ml-auto mr-auto">

                <ul class="single-product-tab-list nav">
                    <li><a href="#product-description" class="active" data-bs-toggle="tab">description</a></li>
                    <li><a href="#product-specifications" data-bs-toggle="tab">specifications</a></li>
                    <li><a href="#product-reviews" data-bs-toggle="tab">reviews</a></li>
                </ul>

                <div class="single-product-tab-content tab-content">
                    <div class="tab-pane fade show active" id="product-description">

                        <div class="row">
                            <div class="single-product-description-content col-lg-8 col-12">
                                <h4>{!! $product->name !!}</h4>
                                <p>{!! $product->long_des !!}</p>
                            </div>
                            <div class="single-product-description-image col-lg-4 col-12">
                                <img src="{{url('public/uploads/product/'. $product->image)}}" alt="description">
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="product-specifications">
                        <div class="single-product-specification">
                            {!! $product->specifications !!}
                        </div>
                    </div>
                    <div class="tab-pane fade" id="product-reviews">

                        <div class="product-ratting-wrap">
                            <div class="pro-avg-ratting">
                                <h4>{!! $reviews->count() > 0 ? round($reviews->sum('review')/$reviews->count(), 2): '0' !!}<span> (Overall)</span></h4>
                                <span>Based on {!! $reviews->count() !!} Comments</span>
                            </div>

                            <div class="rattings-wrapper">
                                @if($reviews->count() != 0)
                                @foreach($reviews as $review)
                                <div class="sin-rattings">
                                    <div class="ratting-author">
                                        <h3>{!! $review->customer_name !!}</h3>
                                        <div class="ratting-star">
                                            <?php
                                            for ($i = 1; $i <= $review->review; $i++) {
                                                echo '<i class="fa fa-star"></i>';
                                            }
                                            ?>
                                            <span>({!! $review->review !!})</span>
                                        </div>
                                    </div>
                                    <p>{!! $review->description !!}</p>
                                    @endforeach
                                </div>
                                @else
                                <div class="card">
                                    <div class="card-body">
                                        <p>Be the first reviewer!</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="ratting-form-wrapper fix">
                                <h3>Add your Comments</h3>
                                <form action="{{route('review.store')}}" method="post">
                                    @csrf
                                    @method('POST')
                                    <div class="row">
                                        <div class="col-12 mb-15">
                                            <h5>Rating:</h5>
                                            <div>
                                                <input type="radio" name="review" class="form-check-input mr-2" value="1" id="1"><label for="1" style="margin:0 10px">1 </label>
                                                <input type="radio" name="review" class="form-check-input mr-2" value="2" id="2"><label for="2" style="margin:0 10px">2 </label>
                                                <input type="radio" name="review" class="form-check-input mr-2" value="3" id="3"><label for="3" style="margin:0 10px">3 </label>
                                                <input type="radio" name="review" class="form-check-input mr-2" value="4" id="4"><label for="4" style="margin:0 10px">4 </label>
                                                <input type="radio" name="review" class="form-check-input mr-2" value="5" id="5"><label for="5" style="margin:0 10px">5 </label>
                                                <!-- <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i> -->
                                            </div>
                                        </div>
                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                        <div class="col-md-6 col-12 mb-15">
                                            <label for="name">Name:</label>
                                            <input placeholder="Name" class="form-control" name="customer_name" type="text">
                                        </div>
                                        <div class="col-md-6 col-12 mb-15">
                                            <label for="email">Email:</label>
                                            <input placeholder="Email" class="form-control" type="text" name="customer_email">
                                        </div>
                                        <div class="col-12 mb-15">
                                            <label for="your-review">Your Review:</label>
                                            <textarea name="description" class="form-control" id="your-review" rows="6" placeholder="Write a review"></textarea>
                                        </div>
                                        <div class="col-12">
                                            <input value="add review" type="submit">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </div>
</div><!-- Single Product Section End -->

<!-- Related Product Section Start -->
<div class="product-section section mb-70">
    <div class="container">
        <div class="row">

            <!-- Section Title Start -->
            <div class="col-12 mb-40">
                <div class="section-title-one">
                    <h1>RELATED PRODUCT</h1>
                </div>
            </div><!-- Section Title End -->

            <!-- Product Tab Content Start -->
            <div class="col-12">

                <!-- Product Slider Wrap Start -->
                <div class="product-slider-wrap product-slider-arrow-one">
                    <!-- Product Slider Start -->
                    <div class="product-slider product-slider-4">
                        @foreach($releted_products as $rel_p)
                        <?php
                        if ($rel_p->discount != null) {
                            $offerd = $rel_p->price * $rel_p->discount / 100;
                            $discount = $rel_p->price - $offerd;
                        }
                        ?>
                        <div class="col pb-20 pt-10">
                            <!-- Product Start -->
                            <div class="ee-product">

                                <!-- Image -->
                                <div class="image">

                                    <a href="{{route('productdetails', $rel_p->id)}}" class="img"><img src="{{url('public/uploads/product/'. $rel_p->image)}}" alt="Product Image" style="height: 330px;"></a>

                                    @if($product->quantity > 0)
                                    <a href="{{route('add.to.cart', $product->id)}}" class="btn btn-warning d-block"><i class="ti-shopping-cart"></i><span> ADD TO CART</span></a>
                                    @else
                                    <h4 class="text-danger btn btn-outline-secondary d-block">Out of Stock</h4>
                                    @endif

                                </div>

                                <!-- Content -->
                                <div class="content">

                                    <!-- Category & Title -->
                                    <div class="category-title">

                                        <a href="{{route('category.product', $rel_p->category->id)}}" class="cat">{!! $rel_p->category->name !!}</a>
                                        <h5 class="title"><a href="{{route('productdetails', $rel_p->id)}}">{!! $rel_p->name !!}</a></h5>

                                    </div>

                                    <!-- Price & Ratting -->
                                    <div class="price-ratting">

                                        <h5 class="price">BDT @if($rel_p->discount != null)<del>{!! $rel_p->price !!}</del> {!! $discount !!}@else {!! $rel_p->price !!} @endif</h5>
                                        <div class="ratting">
                                            <?php
                                            $reviews = App\Models\Review::where('product_id', $rel_p->id)->get();
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

            </div><!-- Product Tab Content End -->

        </div>
    </div>
</div><!-- Related Product Section End -->
@endsection

@push('js')
<script src="{{url('public/front/assets/js/script.js')}}"></script>
@endpush