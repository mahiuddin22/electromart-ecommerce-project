@extends('adminpanel.layouts.master')

@section('title','subcategory | create')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Edit Sub Category</h6>
    <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium">
            <a href="index.html" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                Dashboard
            </a>
        </li>
        <li>-</li>
        <li class="fw-medium">Edit Sub Category</li>
    </ul>
</div>
@include('adminpanel.layouts.partials.message')
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Edit Product</h6>
    <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium">
            <a href="index.html" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                Dashboard
            </a>
        </li>
        <li>-</li>
        <li class="fw-medium">Edit Product</li>
    </ul>
</div>
@include('adminpanel.layouts.partials.message')
<div class="row gy-4">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
                <form class="row gy-3 needs-validation" action="{{route('product.update', $product->id)}}" method="post" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="col-md-4">
                        <label class="form-label">Name</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="ic:sharp-drive-file-rename-outline" class="menu-icon"></iconify-icon>
                            </span>
                            <input type="text" name="name" class="form-control" placeholder="Enter Name" value="{{ $product->name }}" required />
                            <div class="invalid-feedback">
                                Please enter product name
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Category</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="basil:stack-outline" class="menu-icon"></iconify-icon>
                            </span>
                            <select name="category_id" class="form-control" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                <option value="{{$category->id}}" @if( $category->id == $product->category_id) selected @endif >{!! $category->name !!}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please select category
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Sub-Category</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="basil:stack-outline" class="menu-icon"></iconify-icon>
                            </span>
                            <select name="subcategory_id" class="form-control" required>
                                <option value="">Select Sub-category</option>
                                @foreach($subcategories as $subcategory)
                                <option value="{{$subcategory->id}}" @if( $subcategory->id == $product->subcategory_id) selected @endif >{!! $subcategory->name !!}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please select subcategory
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Brand</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="basil:stack-outline" class="menu-icon"></iconify-icon>
                            </span>
                            <select name="brand_id" class="form-control" required>
                                <option value="">Select Brand</option>
                                @foreach($brands as $brand)
                                <option value="{{$brand->id}}" @if( $brand->id == $product->brand_id) selected @endif >{!! $brand->name !!}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please select brand
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Price</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="material-symbols-light:price-change-outline-rounded" class="menu-icon"></iconify-icon>
                            </span>
                            <input type="number" name="price" class="form-control" placeholder="Enter Price" value="{{ $product->price }}" required />
                            <div class="invalid-feedback">
                                Please provide price
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Short Description</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="basil:stack-outline" class="menu-icon"></iconify-icon>
                            </span>
                            <input type="text" name="short_des" class="form-control" placeholder="Enter Short Description" value="{{ $product->short_des }}" required />
                            <div class="invalid-feedback">
                                Please provide short description
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <label class="form-label">Long Description</label>
                        <textarea name="long_des" class="form-control" id="summernote" rows="1" cols="50" placeholder="Enter brief description...">{{ $product->long_des }}</textarea>
                    </div>

                    <div class="col-lg-6">
                        <label class="form-label">Specifications</label>
                        <textarea class="form-control" name="specifications" id="summernote2" rows="4" cols="50" placeholder="Enter specifications...">{{ $product->specifications }}</textarea>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Quantity</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="fluent-mdl2:quantity" class="menu-icon"></iconify-icon>
                            </span>
                            <input type="number" name="quantity" class="form-control" placeholder="Enter Quantity" value="{{ $product->quantity }}" required />
                            <div class="invalid-feedback">
                                Please provide quantity
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Discount</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="hugeicons:discount-01" class="menu-icon"></iconify-icon>
                            </span>
                            <input type="number" name="discount" class="form-control" placeholder="Enter Discount" value="{{ $product->discount }}" required />
                            <div class="invalid-feedback">
                                Please provide discount
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Status</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="lets-icons:status-list" class="menu-icon"></iconify-icon>
                            </span>
                            <select name="status" class="form-control" required>
                                <option value="">Select Select Status</option>
                                <option value="1" {{$product->status == 1?'selected':''}}>Active</option>
                                <option value="2">Inactive</option>
                            </select>
                            <div class="invalid-feedback">
                                Please provide status
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <label class="form-label">Image</label>
                        <input class="form-control form-control" name="image" type="file">
                        <div class="invalid-feedback">
                            Please insert image
                        </div>
                        <img src="{{url('public/uploads/product/'.$product->image)}}" alt="default.png" class="img-thumbnail" height="100" width="100">
                    </div>

                    <div class="col-md-4">
                        <div class="form-switch switch-success d-flex align-items-center gap-3 mt-5">
                            <input class="form-check-input" type="checkbox" role="switch" name="featured" id="horizontal3">
                            <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="horizontal3">Featured</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <button class="btn btn-primary-600" type="submit">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 200,
        });

        $('#summernote2').summernote({
            height: 200,
        });
    });
</script>
<script>
    (() => {
        "use strict";

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll(".needs-validation");

        // Loop over them and prevent submission
        Array.from(forms).forEach((form) => {
            form.addEventListener(
                "submit",
                (event) => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }

                    form.classList.add("was-validated");
                },
                false
            );
        });
    })();
</script>
@endpush