@extends('adminpanel.layouts.master')

@section('title','Category')

@push('css')
@endpush

@section('content')
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Product Categories</h6>
    <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium">
            <a href="{{route('category.create')}}" class="d-flex align-items-center gap-1 btn btn-primary">
                <iconify-icon icon="basil:add-outline" width="1.2em" height="1.2em" class="icon text-lg"></iconify-icon>
                Add Category
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
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $key=>$category)
                        <tr>
                            <td>{!! $key+1 !!}</td>
                            <td>{!! $category->name !!}</td>
                            <td>{!! $category->description !!}</td>
                            <td>
                                <div class="align-items-center">
                                    <img src="{{url('public/uploads/category/'.$category->image)}}" alt="" class="img-thumbnail" height="100" width="100">
                                </div>
                            </td>
                            <td>
                                <form action="{{route('category.destroy', $category->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{route('category.edit', $category->id)}}" class="btn btn-primary btn-sm"><iconify-icon icon="mingcute:edit-line"></iconify-icon></a>
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you Sure?')"><iconify-icon icon="uiw:delete"></iconify-icon></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    {!! $categories->links() !!}
                </table>
            </div>
        </div>
    </div><!-- card end -->
</div>
@endsection

@push('js')
@endpush