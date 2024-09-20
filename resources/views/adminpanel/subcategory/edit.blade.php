@extends('adminpanel.layouts.master')

@section('title','subcategory | create')

@push('css')
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
<div class="row gy-4">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form class="row gy-3 needs-validation" action="{{route('subcategory.update', $subcategory->id)}}" method="post" enctype="multipart/form-data" novalidate>
                    @csrf

                    @method('PUT')
                    <div class="col-md-6">
                        <label class="form-label">Name</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="basil:stack-outline" class="menu-icon"></iconify-icon>
                            </span>
                            <input type="text" name="name" class="form-control" placeholder="Enter Name" value="{{$subcategory->name}}" required />
                            <div class="invalid-feedback">
                                Please enter sub-category name
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Category</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="basil:stack-outline" class="menu-icon"></iconify-icon>
                            </span>
                            <select name="category_id" class="form-control" id="">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                <option value="{{$category->id}}" @if(isset($subcategory->category_id))@if( $category->id == $subcategory->category_id) selected @endif>{!! $category->name !!} @endif</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please provide Name
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="4" cols="50" placeholder="Enter a description...">{!! $subcategory->description !!}</textarea>
                    </div>
                    <div class="col-md-6">
                        <div class="card h-100 p-0">
                            <label class="form-label">Image</label>
                            <label for="file-upload-name" class="border border-neutral-600 fw-medium text-secondary-light px-16 radius-12 d-inline-flex align-items-center gap-2 bg-hover-neutral-200">
                                <iconify-icon icon="solar:upload-linear" class="text-xl"></iconify-icon>
                                Click to upload
                                <input type="file" name="image" class="form-control w-auto mt-24 form-control-lg" id="file-upload-name" multiple hidden>
                                <img src="{{url('public/uploads/subcategory/'.$subcategory->image)}}" alt="default.png" class="d-flex img-thumbnail" height="100" width="100">
                            </label>
                            <ul id="uploaded-img-names" class=""></ul>
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

<script>
    // =============================== Upload Single Image js start here ================================================
    const fileInput = document.getElementById("upload-file");
    const imagePreview = document.getElementById("uploaded-img__preview");
    const uploadedImgContainer = document.querySelector(".uploaded-img");
    const removeButton = document.querySelector(".uploaded-img__remove");

    fileInput.addEventListener("change", (e) => {
        if (e.target.files.length) {
            const src = URL.createObjectURL(e.target.files[0]);
            imagePreview.src = src;
            uploadedImgContainer.classList.remove('d-none');
        }
    });
    removeButton.addEventListener("click", () => {
        imagePreview.src = "";
        uploadedImgContainer.classList.add('d-none');
        fileInput.value = "";
    });
    // =============================== Upload Single Image js End here ================================================

    // ================================================ Upload Multiple image js Start here ================================================
    const fileInputMultiple = document.getElementById("upload-file-multiple");
    const uploadedImgsContainer = document.querySelector(".uploaded-imgs-container");

    fileInputMultiple.addEventListener("change", (e) => {
        const files = e.target.files;

        Array.from(files).forEach(file => {
            const src = URL.createObjectURL(file);

            const imgContainer = document.createElement('div');
            imgContainer.classList.add('position-relative', 'h-120-px', 'w-120-px', 'border', 'input-form-light', 'radius-8', 'overflow-hidden', 'border-dashed', 'bg-neutral-50');

            const removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.classList.add('uploaded-img__remove', 'position-absolute', 'top-0', 'end-0', 'z-1', 'text-2xxl', 'line-height-1', 'me-8', 'mt-8', 'd-flex');
            removeButton.innerHTML = '<iconify-icon icon="radix-icons:cross-2" class="text-xl text-danger-600"></iconify-icon>';

            const imagePreview = document.createElement('img');
            imagePreview.classList.add('w-100', 'h-100', 'object-fit-cover');
            imagePreview.src = src;

            imgContainer.appendChild(removeButton);
            imgContainer.appendChild(imagePreview);
            uploadedImgsContainer.appendChild(imgContainer);

            removeButton.addEventListener('click', () => {
                URL.revokeObjectURL(src);
                imgContainer.remove();
            });
        });

        // Clear the file input so the same file(s) can be uploaded again if needed
        fileInputMultiple.value = '';
    });
    // ================================================ Upload Multiple image js End here  ================================================

    // ================================================ Upload image & show it's name js start  ================================================
    document.getElementById('file-upload-name').addEventListener('change', function(event) {
        var fileInput = event.target;
        var fileList = fileInput.files;
        var ul = document.getElementById('uploaded-img-names');

        // Add show-uploaded-img-name class to the ul element if not already added
        ul.classList.add('show-uploaded-img-name');

        // Append each uploaded file name as a list item with Font Awesome and Iconify icons
        for (var i = 0; i < fileList.length; i++) {
            var li = document.createElement('li');
            li.classList.add('uploaded-image-name-list', 'text-primary-600', 'fw-semibold', 'd-flex', 'align-items-center', 'gap-2');

            // Create the Link Iconify icon element
            var iconifyIcon = document.createElement('iconify-icon');
            iconifyIcon.setAttribute('icon', 'ph:link-break-light');
            iconifyIcon.classList.add('text-xl', 'text-secondary-light');

            // Create the Cross Iconify icon element
            var crossIconifyIcon = document.createElement('iconify-icon');
            crossIconifyIcon.setAttribute('icon', 'radix-icons:cross-2');
            crossIconifyIcon.classList.add('remove-image', 'text-xl', 'text-secondary-light', 'text-hover-danger-600');

            // Add event listener to remove the image on click
            crossIconifyIcon.addEventListener('click', (function(liToRemove) {
                return function() {
                    ul.removeChild(liToRemove); // Remove the corresponding list item
                };
            })(li)); // Pass the current list item as a parameter to the closure

            // Append both icons to the list item
            li.appendChild(iconifyIcon);

            // Append the file name text to the list item
            li.appendChild(document.createTextNode(' ' + fileList[i].name));

            li.appendChild(crossIconifyIcon);

            // Append the list item to the unordered list
            ul.appendChild(li);
        }
    });
    // ================================================ Upload image & show it's name js end ================================================
</script>
@endpush