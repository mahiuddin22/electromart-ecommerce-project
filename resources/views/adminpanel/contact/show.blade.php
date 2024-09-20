@extends('adminpanel.layouts.master')

@section('title','Show')

@push('css')
@endpush

@section('content')
@include('adminpanel.layouts.partials.message')
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
        <li>-</li>
        <li class="fw-medium">Details</li>
    </ul>
</div>

<div class="card">
    <div class="card-body py-40">
        <div class="row justify-content-center" id="invoice">
            <div class="col-lg-8">
                <div class="shadow-4 border radius-8">
                    <div class="py-28 px-20">
                        <div class="d-flex flex-wrap justify-content-between align-items-end gap-3">
                            <div>
                                <h6 class="text-md">Message From:</h6>
                                <table class="text-sm text-secondary-light">
                                    <tbody>
                                        <tr>
                                            <td>Name</td>
                                            <td class="ps-8">: {!! $contact->name !!}</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td class="ps-8">: {!! $contact->email !!}</td>
                                        </tr>
                                        <tr>
                                            <td>Subject</td>
                                            <td class="ps-8">: {!! $contact->subject !!}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                <table class="text-sm text-secondary-light">
                                    <tbody>
                                        <tr>
                                            <td>Message Date</td>
                                            <td class="ps-8">: {!! $contact->created_at !!}</td>
                                        </tr>
                                        <tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="mt-24">
                            <div class="table-responsive scroll-sm">
                                <table class="table bordered-table text-sm">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-sm">Message</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="6">{!! $contact->description !!}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="flex-wrap align-items-end mt-64" style="float: right;">
                            <div class="text-sm border-top d-inline-block"><a href="{{route('contact.info')}}" class="btn btn-danger btn-sm">Back</a></div>
                            <div class="text-sm border-top d-inline-block"><a href="{{route('contact.change.status', $contact->id)}}" class="btn btn-success btn-sm">Mark Read</a></div>
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