@extends('adminpanel.layouts.master')

@section('title','product')

@push('css')
@endpush

@section('content')
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Product</h6>
    <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium">
            <a href="{{route('product.create')}}" class="d-flex align-items-center gap-1 btn btn-primary">
                <iconify-icon icon="basil:add-outline" width="1.2em" height="1.2em" class="icon text-lg"></iconify-icon>
                Add Product
            </a>
        </li>
    </ul>
</div>
@include('adminpanel.layouts.partials.message')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table bordered-table mb-0">
                    <thead>
                        <tr>
                            <th scope="col">SL</th>
                            <th scope="col">Name</th>
                            <th scope="col">Product</th>
                            <th scope="col">Short Description</th>
                            <th scope="col">Long Description</th>
                            <th scope="col">Image</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Discount</th>
                            <th scope="col">Featured</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $key=>$product)
                        <?php
                        $category = App\Models\Category::where('id', $product->category_id)->first();
                        $subcategory = App\Models\SubCategory::where('id', $product->subcategory_id)->first();
                        $brand = App\Models\Brand::where('id', $product->brand_id)->first();
                        ?>
                        <tr>
                            <td>{!! $key+1 !!}</td>
                            <td>{!! isset($product->name)? $product->name:'' !!}</td>
                            <td>
                                <strong>Brand: </strong>{!! isset($brand->name)?$brand->name:'' !!}<br>
                                <strong>Category: </strong>{!! $category->name !!} <br>
                                <strong>Sub-category: </strong>{!! $subcategory->name !!}
                            </td>
                            <td>{!! $product->short_des !!}</td>
                            <td>{!! Str::limit($product->long_des, 20) !!}</td>
                            <td>
                                <div class="align-items-center">
                                    <img src="{{url('public/uploads/product/'.$product->image)}}" alt="" class="img-thumbnail" height="100" width="100">
                                </div>
                            </td>
                            <td>{!! $product->price !!} taka</td>
                            <td>{!! $product->quantity !!}</td>
                            <td>{!! $product->discount !!} {!! $product->discount != null ? '%' : 'NO' !!}</td>

                            @if($product->featured == 'on')
                            <td><span class="badge text-sm fw-semibold bg-info-600 px-20 py-9 radius-4 text-white">YES</span></td>
                            @else
                            <td><span class="badge text-sm fw-semibold border border-info-600 text-info-600 bg-transparent px-20 py-9 radius-4 text-white">NO</span></td>
                            @endif

                            @if($product->status == 1)
                            <td><span class="badge text-sm fw-semibold rounded-pill bg-success-600 px-20 py-9 radius-4 text-white">Active</span></td>
                            @else
                            <td><span class="badge text-sm fw-semibold rounded-pill bg-danger-600 px-20 py-9 radius-4 text-white">Inactive</span></td>
                            @endif
                            <td>
                                <form action="{{route('product.destroy', $product->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{route('product.edit', $product->id)}}" title="Edit" class="btn btn-primary btn-sm"><iconify-icon icon="mingcute:edit-line"></iconify-icon></a>
                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you Sure?')"><iconify-icon icon="uiw:delete"></iconify-icon></button> 
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    {!! $products->links() !!}
                </table>
            </div>
        </div>
    </div><!-- card end -->
</div>
@endsection

@push('js')
@endpush