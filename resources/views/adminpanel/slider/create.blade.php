@extends('adminpanel.layouts.master')

@section('title','slider | create')

@push('css')
@endpush

@section('content')
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Add New Slider</h6>
    <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium">
            <a href="index.html" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                Dashboard
            </a>
        </li>
        <li>-</li>
        <li class="fw-medium">Add Slider</li>
    </ul>
</div>
@include('adminpanel.layouts.partials.message')
<div class="row gy-4">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form class="row gy-3 needs-validation" action="{{route('slider.store')}}" method="post" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('POST')
                    <div class="col-md-6">
                        <label class="form-label">Name</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="basil:stack-outline" class="menu-icon"></iconify-icon>
                            </span>
                            <input type="text" name="name" class="form-control" placeholder="Enter Name" required />
                            <div class="invalid-feedback">
                                Please provide Name
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Product</label>
                        <select name="product_id" class="form-control" required>
                            <option value="">Select Product</option>
                            @foreach($products as $product)
                            <option value="{!! $product->id !!}">{!! $product->name !!}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please provide Status
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control" required>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                        <div class="invalid-feedback">
                            Please provide Status
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card h-100 p-0">
                            <div class="card-header border-bottom bg-base py-16 px-24">
                                <label class="form-label">Image</label>
                            </div>
                            <div class="card-body p-24">
                                <label for="file-upload-name" class="mb-16 border border-neutral-600 fw-medium text-secondary-light px-16 py-12 radius-12 d-inline-flex align-items-center gap-2 bg-hover-neutral-200">
                                    <iconify-icon icon="solar:upload-linear" class="text-xl"></iconify-icon>
                                    Click to upload
                                    <input type="file" name="image" class="form-control w-auto mt-24 form-control-lg" id="file-upload-name" multiple hidden>
                                </label>
                                <ul id="uploaded-img-names" class=""></ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-primary-600" type="submit">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
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