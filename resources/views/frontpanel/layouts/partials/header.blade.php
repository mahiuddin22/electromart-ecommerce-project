<div class="header-section section">
    <?php
    if (isset(auth()->user()->id)) {
        $cartcount = \App\Models\Cart::where('user_id', auth()->user()->id)->count();
        $carts = \App\Models\Cart::where('user_id', auth()->user()->id)->get();
    }
    ?>
    <!-- Header Top Start -->
    <div class="header-top header-top-two header-top-border pt-10 pb-10">
        <div class="container">
            <div class="row align-items-center justify-content-between">

                <div class="col mt-10 mb-10">

                </div>

                <div class="col order-2  order-md-1 mt-10 mb-10 ms-auto">
                    <!-- Header Shop Links Start -->
                    <div class="header-shop-links">
                        @if(isset($cartcount))
                        <!-- Cart -->
                        <a href="javascript:void(0);" class="header-cart"><i class="ti-shopping-cart"></i> <span class="number">{!! $cartcount !!}</span></a>
                        @else
                        <a href="javascript:void(0);" class="header-cart"><i class="ti-shopping-cart"></i> <span class="number">0</span></a>
                        @endif
                    </div><!-- Header Shop Links End -->
                </div>

                <div class="col order-md-2 mt-10 mb-10">
                    <!-- Header Account Links Start -->
                    <div class="header-account-links">
                        @if (Auth::guest())
                        <a href="{{route('login')}}"><i class="fa fa-sign-in" aria-hidden="true"></i><span class="d-block">Login</span></a>
                        @else
                        <a href="{{route('user.account')}}"><i class="icofont icofont-user-alt-7"></i> <span class="d-block">my account</span></a>
                        @endif
                    </div><!-- Header Account Links End -->
                </div>

            </div>
        </div>
    </div><!-- Header Top End -->

    <!-- Header Top Start -->
    <div class="header-bottom header-bottom-two header-sticky">
        <div class="container">
            <div class="row align-items-center justify-content-between">

                <div class="col mt-15 mb-15">
                    <!-- Logo Start -->
                    <div class="header-logo">
                        <a href="{{route('home')}}">
                            @if($settings != null)
                            <img src="{{url('public/uploads/system/'.$settings->logo)}}" alt="logo.png">
                            @else
                            <img src="{{url('public/uploads/system/2024-07-19-669a10f411986.png')}}" alt="logo.png">
                            @endif
                        </a>
                    </div><!-- Logo End -->
                </div>

                <div class="col order-2 order-lg-1 d-none d-lg-block">
                    <div class="main-menu">
                        <nav>
                            <ul>
                                <li class="{{Request::is('/*')?'active':''}}"><a href="{{route('home')}}">HOME</a></li>
                                <li class="{{Request::is('shop*')?'active':''}}"><a href="{{route('shop')}}">Shop</a></li>
                                <li class="{{Request::is('contact-us*')?'active':''}}"><a href="{{route('contactus')}}">Reach Out to Us</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>

                <div class="col order-lg-2">
                    <div class="row justify-content-between align-items-center">

                        <div class="col">
                            <!-- Header Call Us Start -->
                            <div class="header-call-us">
                                @if(isset($settings->phone))
                                <h4>call us <br> <span><a href="tel:{!! $settings->phone !!}">{!! $settings->phone !!}</a></span></h4>
                                @endif
                            </div><!-- Header Call Us End -->
                        </div>

                        <!-- <div class="col">
                            <div class="header-search">
                                <button class="search-toggle"><i class="icofont icofont-search-alt-1"></i></button>
                            </div>
                        </div> -->

                    </div>
                </div>

                <!-- Mobile Menu -->
                <div class="mobile-menu order-12 d-block d-lg-none col"></div>

            </div>

            <div class="row">
                <div class="col">
                    <div class="header-search-container">
                        <form action="javascript:void()" class="header-search-form">
                            <input type="text" placeholder="Search your product">
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div><!-- Header Top End -->

</div>

<!-- Mini Cart Wrap Start -->
<div class="mini-cart-wrap">

    <!-- Mini Cart Top -->
    <div class="mini-cart-top">

        <button class="close-cart">Close Cart<i class="icofont icofont-close"></i></button>

    </div>

    <!-- Mini Cart Products -->
    <ul class="mini-cart-products">
        @if(isset($carts))
        @foreach($carts as $cart)
        <?php $product = App\Models\Product::where('id', $cart->product_id)->first() ?>
        <li>
            @if(isset($product->image))
            <a class="image"><img src="{{url('public/uploads/product/'. $product->image)}}" alt="Product"></a>
            @endif
            <div class="content">
                <a href="{{route('productdetails', $cart->product_id)}}" class="title">{!! $cart->product_name !!}</a>
                <span class="price">Price: {!! $cart->product_price !!}</span>
                <span class="qty">Qty: {!! $cart->product_quantity !!}</span>
            </div>
            <form action="{{route('cart.destroy', $cart->id)}}" method="post">
                @csrf
                @method('DELETE')
                <button class="remove" type="submit"><i class="fa fa-trash-o"></i></button>
            </form>
        </li>
        @endforeach
        @endif
    </ul>

    <!-- Mini Cart Bottom -->
    <div class="mini-cart-bottom">
        @if(isset($carts))
        <h4 class="sub-total">Total: <span>BDT {!! $carts->sum('product_subtotal') !!}</span></h4>
        @endif
        <div class="button">
            @if(isset($cartcount))
            @if(!empty($cartcount))
            <a href="{{route('cart.details')}}">Cart Details</a>
            @endif
            @endif
        </div>

    </div>

</div>

<!-- Mini Cart Wrap End -->

<!-- Cart Overlay -->
<div class="cart-overlay"></div>