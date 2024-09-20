@extends('frontpanel.layouts.master')

@section('title','Brand | Product')

@push('css')
@endpush

@section('content')
<!-- Feature Product Section Start -->
<div class="product-section section mt-90 mb-40">
    <div class="container">
        <div class="row">
            @include('frontpanel.layouts.partials.message')
            <div class="col-xl-9 col-lg-8 col-12 order-lg-2 mb-50">

                <!-- Shop Product Wrap Start -->
                <!-- Shop Product Wrap Start -->
                <div class="shop-product-wrap grid with-sidebar row">
                    @if(!empty($brandproducts->count() != 0))
                    @foreach($brandproducts as $product)
                    <div class="col-xl-4 col-md-6 col-12 pb-30 pt-10">

                        <!-- Product Start -->
                        <div class="ee-product">

                            <!-- Image -->
                            <div class="image">

                                <a href="{{route('productdetails', $product->id)}}" class="img"><img src="{{url('public/uploads/product/'. $product->image)}}" alt="{{url('public/uploads/default.png')}}" style="height: 330px;"></a>
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

                                    <a href="{{route('category.product', $product->category->id)}}" class="cat">{!! $product->category->name !!}</a>
                                    <h5 class="title"><a href="{{route('productdetails', $product->id)}}">{!! $product->name !!}</a></h5>

                                </div>

                                <!-- Price & Ratting -->
                                <div class="price-ratting">

                                    <h5 class="price">BDT {!! $product->price !!}</h5>
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
                    @else
                    <div class="card">
                        <div class="card-header">
                            <h2 class="text-center">No product found</h2>
                        </div>
                        <div class="card-body">
                            <p class="text-center">No product available in this brand at this moment</p>
                        </div>
                        <div class="card-footer">
                            <a href="{{route('shop')}}" class="btn btn-primary btn-sm text-white col-12">go to shop</a>
                        </div>
                    </div>
                    @endif
                </div><!-- Shop Product Wrap End -->

                <div class="row mt-30">
                    <div class="col">

                        {!! $brandproducts->links() !!}

                    </div>
                </div>

            </div>

            <div class="shop-sidebar-wrap col-xl-3 col-lg-4 col-12 order-lg-1 mb-15">

                <div class="shop-sidebar mb-35">

                    <h4 class="title">CATEGORIES</h4>

                    <ul class="sidebar-category">
                        @foreach($categories as $category)
                        <li><a href="javascript:void(0)">{!! $category->name !!}</a>
                            <ul class="children">
                                @foreach($category->subcategories as $subcat)
                                <li><a href="{{route('subcategory.product', $subcat->id)}}">{!! $subcat->name !!}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        @endforeach
                    </ul>

                </div>

                <div class="shop-sidebar mb-35">

                    <h4 class="title">Brand</h4>

                    <ul class="sidebar-brand">
                        @foreach($brands as $brand)
                        <li><a href="{{route('brand.product',$brand->id)}}">{!! $brand->name !!}</a></li>
                        @endforeach
                    </ul>

                </div>

            </div>

        </div>
    </div>
</div><!-- Feature Product Section End -->

<!-- Brands Section Start -->
<div class="brands-section section mb-90">
    <div class="container">
        <div class="row">

            <!-- Brand Slider Start -->
            <div class="brand-slider col">
                @foreach($brands as $brand)
                <div class="brand-item col"><img src="{{url('public/uploads/brand/'. $brand->image)}}" alt="Brands"></div>
                @endforeach
            </div><!-- Brand Slider End -->

        </div>
    </div>
</div><!-- Brands Section End -->
@endsection

@push('js')
@endpush