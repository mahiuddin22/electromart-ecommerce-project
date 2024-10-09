@extends('adminpanel.layouts.master')

@section('title','Contact')

@push('css')
@endpush

@section('content')
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">User List</h6>
    <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium">
            <a href="index.html" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                Dashboard
            </a>
        </li>
        <li>-</li>
        <li class="fw-medium">User</li>
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
                            <th scope="col">Email</th>
                            <th scope="col">Mobile</th>
                            <th scope="col">Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $key=>$user)
                        <tr>
                            <td>{!! $key+1 !!}</td>
                            <td>{!! $user->name !!}</td>
                            <td>{!! $user->email !!}</td>
                            <td>{!! isset($user->mobile)?$user->mobile:'not updated' !!}</td>
                            <td>{!! isset($user->address)?$user->address:'not updated' !!}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    {!! $users->links() !!}
                </table>
            </div>
        </div>
    </div><!-- card end -->
</div>
</div>
@endsection

@push('js')
@endpush