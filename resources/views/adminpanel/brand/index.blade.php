@extends('adminpanel.layouts.master')

@section('title','Brand')

@push('css')
@endpush

@section('content')
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Product Brands</h6>
    <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium">
            <a href="{{route('brand.create')}}" class="d-flex align-items-center gap-1 btn btn-primary">
                <iconify-icon icon="basil:add-outline" width="1.2em" height="1.2em" class="icon text-lg"></iconify-icon>
                Add Brand
            </a>
        </li>
    </ul>
</div>
@include('adminpanel.layouts.partials.message')
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table bordered-table mb-0">
                    <thead>
                        <tr>
                            <th scope="col">SL</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Image</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($brands as $key=>$brand)
                        <tr>
                            <td>{!! $key+1 !!}</td>
                            <td>{!! $brand->name !!}</td>
                            <td>{!! $brand->description !!}</td>
                            <td>
                                <div class="align-items-center">
                                    <img src="{{url('public/uploads/brand/'.$brand->image)}}" alt="" class="img-thumbnail" height="100" width="100">
                                </div>
                            </td>
                            <td>
                                @if($brand->status == 1)
                                <span class="badge text-sm fw-semibold rounded-pill bg-success-600 px-20 py-9 radius-4 text-white">Active</span>
                                @else
                                <span class="badge text-sm fw-semibold rounded-pill bg-danger-600 px-20 py-9 radius-4 text-white">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{route('brand.destroy', $brand->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{route('brand.edit', $brand->id)}}" class="btn btn-primary btn-sm"><iconify-icon icon="mingcute:edit-line"></iconify-icon></a>
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you Sure?')"><iconify-icon icon="uiw:delete"></iconify-icon></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    {!! $brands->links() !!}
                </table>
            </div>
        </div>
    </div><!-- card end -->
</div>
@endsection

@push('js')
@endpush