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
                        <li><a href="javascript:void()"><strong>My Orders</strong></a></li>
                        <li><a href="javascript:void()"><strong>Downloads</strong></a></li>
                        <li><a href="javascript:void()"><strong>Addresses</strong></a></li>
                        <li><a href="javascript:void()"><strong>Account Details</strong></a></li>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <li><button type="submit" class="btn btn-primary text-white">Logout</button></li>
                        </form>
                    </ul>

                </div>
            </div>
            <div class="col-xl-9 col-lg-8 col-12 order-lg-2 mb-50">
                <div class="shop-product-wrap grid with-sidebar row p-3">
                    <form action="{!! route('user.update', $user->id) !!}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row col-md-12">
                            <div class="form-group col-md-6">
                                <h3 id="exampleInputEmail1" aria-describedby="emailHelp">{!! $user->username !!}</h3>
                                <hr>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="file" style="float: right; cursor:pointer;">
                                    <img src="{!! url('public/uploads/default.png') !!}" alt="default.png" class="img-thumbnail" style="float: right;">
                                    <input type="file" name="image" id="file" style="display: none;">
                                </label>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="form-group col-md-4">
                                <label for="">Name:</label>
                                <input type="text" class="form-control" name="name" id="" value="{!! $user->name !!}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">Email:</label>
                                <input type="email" class="form-control" name="email" value="{!! $user->email !!}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">Mobile:</label>
                                <input type="text" class="form-control" name="mobile" value="{!! $user->mobile !!}">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="form-group col-md-4">
                                <label for="">Password:</label>
                                <input type="password" name="password" class="form-control" placeholder="Enter new password">
                            </div>
                            <div class="form-group col-md-8">
                                <label for="">Address:</label>
                                <textarea class="form-control" name="address" style="height: 100px;" id="" aria-describedby="emailHelp">{!! $user->address !!}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12 mt-2">
                                <button type="submit" class="btn btn-primary text-white">Update</button>
                            </div>
                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>

</div>
@endsection

@push('js')
@endpush