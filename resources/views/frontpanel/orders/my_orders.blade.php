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
                <div class="row">
                    <form class="form-inline" action="{!! route('user.myoders') !!}" method="get">
                        <div class="row mb-50">
                            <div class="col-6">
                                <label for="from_date">Order Date</label>
                                <input type="date" id="from_date" name="order_date" class="form-control" placeholder="Order Date">
                            </div>
                            <div class="col-6">
                                <label for="order_no">Order Number</label>
                                <input type="text" id="order_no" name="order_no" class="form-control" placeholder="Order Number">
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-dark text-white py-2" style="height: 40px; margin-top: 22px;">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#SL</th>
                                <th scope="col">Order no</th>
                                <th scope="col">Total</th>
                                <th scope="col">Shipping address</th>
                                <th scope="col">Pyement method</th>
                                <th scope="col">Contact</th>
                                <th scope="col">Order date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($checkouts as $key=>$checkout)
                            <tr>
                                <th scope="row">{!! $key+1 !!}</th>
                                <td>{!! $checkout->order_no!!}</td>
                                <td>{!! $checkout->grand_total!!}</td>
                                <td>{!! $checkout->shipping_address!!}</td>
                                <td>{!! $checkout->payment_method!!}</td>
                                <td>{!! $checkout->mobile? $checkout->mobile:'--'!!}</td>
                                <td>{!! $checkout->created_at->toDateString()!!}</td>
                                <td><a href="{!! route('order.details', $checkout->id) !!}" class="btn btn-primary btn-xs" title="show details"><i class="fa fa-eye"></i></a></td>
                                <td><a href="" class="btn btn-primary btn-success" title="print invoice"><i class="fa fa-print"></i></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $checkouts->links() !!}
                </div>

            </div>

        </div>
    </div>

</div>
@endsection

@push('js')
@endpush