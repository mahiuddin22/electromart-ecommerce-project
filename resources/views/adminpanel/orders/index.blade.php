@extends('adminpanel.layouts.master')

@section('title','Orders')

@push('css')
@endpush

@section('content')
<!-- Feature Product Section Start -->
<div class="product-section section mt-90 mb-40">
    <div class="container">
        <div class="row">
            @include('adminpanel.layouts.partials.message')
            <div class="col-xl-12 col-lg-12 col-12 order-lg-12 mb-50">
                <div class="row">
                    <form class="form-inline" action="{!! route('admin.order.pending') !!}" method="get">
                        <div class="row mb-50">
                            <div class="col-6">
                                <label for="from_date">Order Date</label>
                                <input type="date" id="from_date" name="order_date" class="form-control" placeholder="Enter Order Date">
                            </div>
                            <div class="col-6">
                                <label for="order_no">Order Number</label>
                                <input type="text" id="order_no" name="order_no" class="form-control" placeholder="Enter Order Number">
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
                                <th scope="col">Status</th>
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
                                <td>
                                    @if($checkout->status == 0)
                                    <span class="badge text-sm fw-semibold bg-danger-600 px-20 py-9 radius-4 text-white">Pending</span>
                                    @else
                                    <span class="badge text-sm fw-semibold bg-success-600 px-20 py-9 radius-4 text-white">Approved</span>
                                    @endif
                                </td>
                                <td>{!! $checkout->created_at->toDateString()!!}</td>
                                <td>
                                    <a href="{!! route('admin.order.details', $checkout->id) !!}" class="btn btn-primary btn-xs" title="show details"><iconify-icon icon="oi:eye"></iconify-icon></a>
                                </td>
                                @if($checkout->status == 0)
                                <td>
                                    <a href="{!! route('admin.order.approve', $checkout->id) !!}" class="text-center btn btn-success text-white" onclick="return confirm('Are you sure !!')"><iconify-icon icon="fluent:approvals-app-28-regular"></iconify-icon></a>
                                </td>
                                @endif
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