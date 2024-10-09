@extends('adminpanel.layouts.master')

@section('title','About Us')

@push('css')
@endpush

@section('content')
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Dashboard</h6>
    <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium">E-Commerce</li>
    </ul>
</div>
<div class="row row-cols-xxxl-5 row-cols-lg-3 row-cols-sm-2 row-cols-1 gy-4">
    <div class="col">
        <div class="card shadow-none border bg-gradient-start-1 h-100">
            <div class="card-body p-20">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <p class="fw-medium text-primary-light mb-1">Total Category</p>
                        <h6 class="mb-0">{!! $category !!}</h6>
                    </div>
                    <div class="w-50-px h-50-px bg-cyan rounded-circle d-flex justify-content-center align-items-center">
                        <iconify-icon icon="iconamoon:category-fill" width="30" height="30" style="color: black"></iconify-icon>
                    </div>
                </div>
                <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                    <a href="{!! route('category') !!}">Click to view categories</a>
                </p>
            </div>
        </div><!-- card end -->
    </div>
    <div class="col">
        <div class="card shadow-none border bg-gradient-start-2 h-100">
            <div class="card-body p-20">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <p class="fw-medium text-primary-light mb-1">Total Subcategory</p>
                        <h6 class="mb-0">{!! $subcategory !!}</h6>
                    </div>
                    <div class="w-50-px h-50-px bg-purple rounded-circle d-flex justify-content-center align-items-center">
                        <iconify-icon icon="tabler:category-filled" width="30" height="30" style="color: black"></iconify-icon>
                    </div>
                </div>
                <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                <a href="{!! route('subcategory') !!}">Click to view subcategories</a>
                </p>
            </div>
        </div><!-- card end -->
    </div>
    <div class="col">
        <div class="card shadow-none border bg-gradient-start-3 h-100">
            <div class="card-body p-20">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <p class="fw-medium text-primary-light mb-1">Contact Info </p>
                        <h6 class="mb-0">{!! $contact !!}</h6>
                    </div>
                    <div class="w-50-px h-50-px bg-info rounded-circle d-flex justify-content-center align-items-center">
                        <iconify-icon icon="fluent:people-20-filled" class="text-white text-2xl mb-0"></iconify-icon>
                    </div>
                </div>
                <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                <a href="{!! route('contact.info') !!}">Click to view contact info</a>
                </p>
            </div>
        </div><!-- card end -->
    </div>
    <div class="col">
        <div class="card shadow-none border bg-gradient-start-4 h-100">
            <div class="card-body p-20">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <p class="fw-medium text-primary-light mb-1">Total Product</p>
                        <h6 class="mb-0">{!! $product !!}</h6>
                    </div>
                    <div class="w-50-px h-50-px bg-success-main rounded-circle d-flex justify-content-center align-items-center">
                        <iconify-icon icon="lsicon:order-edit-filled" width="30" height="30" style="color: black"></iconify-icon>
                    </div>
                </div>
                <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                <a href="{!! route('product') !!}">Click to view contact poducts</a>
                </p>
            </div>
        </div><!-- card end -->
    </div>
    <div class="col">
        <div class="card shadow-none border bg-gradient-start-5 h-100">
            <div class="card-body p-20">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <p class="fw-medium text-primary-light mb-1">Total Orders</p>
                        <h6 class="mb-0">{!! $order !!}</h6>
                    </div>
                    <div class="w-50-px h-50-px bg-red rounded-circle d-flex justify-content-center align-items-center">
                        <iconify-icon icon="material-symbols:order-play-outline" width="30" height="30" style="color: black"></iconify-icon>
                    </div>
                    <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                <a href="{!! route('admin.order.pending') !!}">Click to view contact poducts</a>
                </p>
                </div>
            </div><!-- card end -->
        </div>
    </div>
</div>
@endsection

@push('js')
@endpush