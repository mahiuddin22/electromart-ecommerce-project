@extends('frontpanel.layouts.master')

@section('title','Subcategory | Product')

@push('css')
@endpush

@section('content')
<!-- Feature Product Section Start -->
<div class="product-section section mt-90 mb-40">
    <div class="container">
        <div class="row">
            @include('frontpanel.layouts.partials.message')
            <div class="shop-sidebar-wrap col-xl-3 col-lg-4 col-12 order-lg-1 mb-15">

                <div class="shop-sidebar mb-35">

                    <h4 class="title">My Account</h4>

                    <ul class="sidebar-category">
                        <li><a href="{!! route('user.account') !!}"><strong>Account Details</strong></a></li>
                        <li><a href="{!! route('user.myoders') !!}"><strong>My Orders</strong></a></li>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <li><button type="submit" class="btn btn-primary text-white">Logout</button></li>
                        </form>
                    </ul>

                </div>
            </div>
            <div class="col-xl-9 col-lg-8 col-12 order-lg-2 mb-50">
                <div id="printableArea">
                    <div class="row">
                        <h3 class="bg-secondary text-white text-center">Electromart Invoice</h3>
                    </div>
                    <div class="row col-md-12">
                        <div class="col-md-8">
                            <table style="padding-left: 10px;">
                                <tr>
                                    <td><strong>Name</strong> : {!! $user->name !!}</td>
                                </tr>
                                <tr>
                                    <td><strong>Shipping address</strong> : {!! $checkout->shipping_address !!}</td>
                                </tr>
                                <tr>
                                    <td><strong>Payment method</strong> : {!! $checkout->payment_method !!}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-4 text-end">
                            <strong>Date</strong> : {!! $checkout->created_at->toDateString() !!} <br>
                            <strong>Contact</strong> : {!! $checkout->mobile?$checkout->mobile:'--' !!}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <table class="table">
                            <thead class="px-5">
                                <tr class="text-center">
                                    <th scope="col" width="">#SL</th>
                                    <th scope="col" width="">Item Name</th>
                                    <th scope="col" width="">Price</th>
                                    <th scope="col" width="">Quantity</th>
                                    <th scope="col" width="">Subtotal</th>
                                    <th scope="col" width="">Order Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $key=>$order)
                                <?php
                                $product = \App\Models\Product::where('id', $order->product_id)->first();
                                ?>
                                <tr class="text-center">
                                    <th scope="row">{!! $key+1 !!}</th>
                                    <td>{!! $product->name!!}</td>
                                    <td>{!! $order->product_price!!}</td>
                                    <td>{!! $order->product_quantity!!}</td>
                                    <td>{!! $order->product_subtotal!!}</td>
                                    <td>{!! $order->created_at->toDateString()!!}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row col-md-12">
                        <div class="col-md-4"></div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4 text-end">
                            <table style="float: right;">
                                <tr>
                                    <td><strong>Subtotal</strong> : {!! $checkout->grand_total - 100 !!} tk</td>
                                </tr>
                                <tr>
                                    <td><strong>Shipping Cost</strong> : 100 tk</td>
                                </tr>
                                <tr>
                                    <td><strong>Grand Total</strong> : {!! $checkout->grand_total !!} tk</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4"><button class="text-center btn btn-primary text-white" onclick="printInvoice()">Print</button></div>
                    <div class="col-md-4"></div>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection

@push('js')
<script>
    function printInvoice() {
        var printContents = document.getElementById('printableArea').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
@endpush