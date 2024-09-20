@extends('adminpanel.layouts.master')

@section('title','Contact')

@push('css')
@endpush

@section('content')
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Contact List</h6>
    <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium">
            <a href="index.html" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                Dashboard
            </a>
        </li>
        <li>-</li>
        <li class="fw-medium">Contact</li>
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
                            <th scope="col">Subject</th>
                            <th scope="col">Description</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contacts as $key=>$contact)
                        <tr>
                            <td>{!! $key+1 !!}</td>
                            <td>{!! $contact->name !!}</td>
                            <td>{!! $contact->email !!}</td>
                            <td>{!! $contact->subject !!}</td>
                            <td>{!! $contact->description !!}</td>
                            <td>
                                @if($contact->status == 1)
                                <span class="badge text-sm fw-semibold rounded-pill bg-success-600 px-20 py-9 radius-4 text-white">Read</span>
                                @else
                                <span class="badge text-sm fw-semibold rounded-pill bg-danger-600 px-20 py-9 radius-4 text-white">Unread</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('contact.show', $contact->id)}}" class="btn btn-info btn-sm">View</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    {!! $contacts->links() !!}
                </table>
            </div>
        </div>
    </div><!-- card end -->
</div>
</div>
@endsection

@push('js')
@endpush