@extends('frontpanel.layouts.master')

@section('title','Login')

@push('css')
@endpush

@section('content')
<div class="register-section section mt-90 mb-90">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <!-- Login -->
            <div class="col-md-4 col-12">
                <div class="ee-register">
                    @include('frontpanel.layouts.partials.message')
                    <h1>Login</h1>
                    <!-- Login Form -->
                    <form method="POST" action="{{ route('check.login') }}">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-12 mb-30"><input type="email" name="email" placeholder="Your email" required></div>
                            <div class="col-12 mb-30"><input type="password" name="password" placeholder="Your password" required></div>
                            <div class="col-6 mb-30"><input type="submit" value="Login"></div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('js')
@endpush