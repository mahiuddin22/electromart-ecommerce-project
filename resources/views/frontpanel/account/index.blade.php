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
                <div class="shop-product-wrap grid with-sidebar row">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{!! route('user.edit', $user->id) !!}" class="btn btn-primary btn-xs text-white mb-2" style="float: right;"><i class="fa fa-edit"></i></a>
                        </div>
                        <hr>
                    </div>
                    <div class="row col-md-12">
                        <div class="form-group col-md-6">
                            <h3 id="exampleInputEmail1" aria-describedby="emailHelp">{!! $user->username !!}</h3>
                            <hr>
                        </div>
                        @if($user->image != null)
                        <div class="form-group col-md-6">
                            <img src="{!! url('public/uploads/user.png') !!}" alt="default.png" class="img-thumbnail" style="float: right;">
                        </div>
                        @else
                        <div class="form-group col-md-6">
                            <img src="{!! url('public/uploads/default.png') !!}" alt="default.png" class="img-thumbnail" style="float: right;">
                        </div>
                        @endif
                        
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="exampleInputEmail1">Name:</label>
                            <p class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">{!! $user->name !!}</p>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleInputEmail1">Email:</label>
                            <p class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">{!! $user->email !!}</p>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleInputEmail1">Mobile:</label>
                            <p class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">{!! $user->mobile !!}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Address:</label>
                            <p class="form-control" style="height: 100px;" id="exampleInputEmail1" aria-describedby="emailHelp">{!! $user->address !!}</p>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>

</div>
@endsection

@push('js')
@endpush