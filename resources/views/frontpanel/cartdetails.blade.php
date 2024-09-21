@extends('frontpanel.layouts.master')

@section('title','cart-details')

@push('css')
@endpush

@section('content')
<!-- Cart Page Start -->
<div class="page-section section pt-90 pb-50">
    <div class="container">
        @include('frontpanel.layouts.partials.message')
        <div class="row">
            <div class="col-12">
                <!-- Cart Table -->
                <div class="cart-table table-responsive mb-40">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="pro-thumbnail">Image</th>
                                <th class="pro-title">Product</th>
                                <th class="pro-price">Price</th>
                                <th class="pro-quantity">Quantity</th>
                                <th class="pro-subtotal">Total</th>
                                <th class="pro-remove">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($carts as $cart)
                            <?php
                            $product = App\Models\Product::where('id', $cart->product_id)->first();
                            $prpduct_id = $product->id;
                            if ($product->discount != null) {
                                $offerd = $product->price * $product->discount / 100;
                                $discount_price = $offerd * $cart->product_quantity;
                            }
                            ?>
                            <tr>
                                <td class="pro-thumbnail" width=""><a href="{!! route('productdetails',$cart->product_id) !!}"><img src="{{url('public/uploads/product/'.$product->image)}}" alt="Product"></a></td>
                                <td class="pro-title" width=""><a href="{!! route('productdetails',$cart->product_id) !!}">{!! $cart->product_name !!}</a></td>
                                <td class="pro-price" width=""><span>{!! $cart->product_price !!}</span></td>
                                <td class="pro-quantity" width="">
                                    <form action="{{route('cart.update', $cart->id)}}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div style="display: flex;">
                                            <div class="" style="border: 1px solid #ccc; border-radius:18px; width:125px; padding:0 5px;">
                                                <button type="button" onclick="increment()" style="border: none;">+</button>
                                                <input type="number" name="product_quantity" id="quantity" min="1" readonly @if($product->quantity < 10) max="{{$product->quantity}}" @else max="10" @endif value="{!! $cart->product_quantity !!}" style="border:1px solid #ccc; padding-left: 15px; padding-right: 15px; width: 65px;" />
                                                <button type="button" onclick="decrement()" style="border: none; ">-</button>
                                            </div>


                                            <button class="btn btn-primary d-flex" title="Update" type="submit" style="padding: 7px; margin-left:5px;"><i class="fa fa-check"></i></button>
                                        </div>
                                    </form>
                                </td>
                                <td class="pro-subtotal" width=""><span>BDT {!! $cart->product_subtotal !!}</span></td>
                                <td width="">
                                    <form action="{{route('cart.destroy', $cart->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit" title="Remove" onclick="return confirm('Are you Sure?')"><i class="fa fa-trash-o"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <form action="{{url('/pay')}}" method="post">
                    @csrf
                    @method('POST')
                    <div class="row">

                        <div class="col-lg-6 col-12 mb-15">
                            <!-- Calculate Shipping -->
                            <div class="calculate-shipping">
                                <h4>Shipping Address</h4>

                                <div class="row">
                                    @if(auth()->user()->address != null)
                                    <div class=" col-12">
                                        <input type="checkbox" class="form-check-input" name="old_address" onclick="prev_add()" id="old_add">
                                        <span><strong>Use My Account Address</strong></span>
                                        @error('old_address')<p class="text-danger">{{ $message }}</p>@enderror
                                    </div>
                                    @endif
                                    <div class="col-md-12 col-12 mb-25">
                                        <textarea name="shipping_address" id="ship_add" cols="20" rows="4" class="form-control" placeholder="Enter Shipping Address..."></textarea>
                                        @error('shipping_address')<p class="text-danger">{{ $message }}</p>@enderror
                                    </div>
                                    @if(auth()->user()->mobile != null)
                                    <div class="col-12">
                                        <input type="checkbox" class="form-check-input" name="old_mobile" onclick="prev_mob()" id="old_mobile">
                                        <span><strong>Use My Account Mobile</strong></span>
                                    </div>
                                    @endif
                                    <div class="col-md-12 col-12 mb-25">
                                        <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Enter Mobile Number">
                                        @error('mobile')<p class="text-danger">{{ $message }}</p>@enderror
                                    </div>
                                </div>

                            </div>

                            <div class="discount-coupon">
                                <span><strong>Payment Method</strong></span>
                                <div class="row">
                                    <div class="col-md-6 col-12 mb-25">
                                        <select name="payment_method" id="payment_method" class="form-control">
                                            <option value="">--select one--</option>
                                            <option value="online">online payment</option>
                                            <option value="cod">cash on delivery</option>
                                        </select>
                                        @error('payment_method')<p class="text-danger">{{ $message }}</p>@enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Cart Summary -->
                        <div class="col-lg-6 col-12 mb-40 d-flex">
                            <div class="cart-summary">




                                <div class="cart-summary-wrap">
                                    <h4>Cart Summary</h4>
                                    <p>Sub Total <span>BDT {!! $subtotal !!}</span></p>
                                    <p>Discount <span>BDT {!! isset($discount_price)?$discount_price:'0' !!}</span></p>
                                    <p>Shipping Cost <span>BDT {!! $shipping_cost !!}</span></p>
                                    <h2>Grand Total <span>BDT {!! $subtotal+$shipping_cost !!}</span></h2>
                                </div>
                                <input type="hidden" name="grand_total" value="{!! $subtotal+$shipping_cost !!}">
                                <div class="cart-summary-button">
                                    <button type="submit" class="checkout-btn">Checkout</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Cart Page End -->
@endsection

@push('js')
<script>
    function prev_add() {
        var checkBox = document.getElementById("old_add");
        var add = document.getElementById("ship_add");
        if (checkBox.checked == true) {
            add.style.display = "none";
        } else {
            add.style.display = "block";
        }
    }

    function prev_mob() {
        var checkBox = document.getElementById("old_mobile");
        var add = document.getElementById("mobile");
        if (checkBox.checked == true) {
            add.style.display = "none";
        } else {
            add.style.display = "block";
        }
    }
</script>
<script src="{{url('public/front/assets/js/script.js')}}"></script>
@endpush