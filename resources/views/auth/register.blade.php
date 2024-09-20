@extends('frontpanel.layouts.master')

@section('title','Register')

@push('css')
@endpush

@section('content')
<div class="register-section section mt-90 mb-90">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Register -->
            <div class="col-md-4 col-12">
                <div class="row ee-register">
                    @include('frontpanel.layouts.partials.message')
                    <h1>Registration</h1>
                    <!-- Register Form -->
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-12 mb-10"><input type="text" name="name" placeholder="Your name" required></div>
                            <div class="col-12 mb-10"><input type="text" name="username" placeholder="Your username" required></div>
                            <div class="col-12 mb-10"><input type="email" name="email" placeholder="Your email" required></div>
                            <div class="col-12 mb-10"><input type="password" name="password" placeholder="Your password" required></div>
                            <div class="col-12 mb-10"><input type="password" name="password_confirmation" id="password-confirm" placeholder="Conform password"></div>
                            <div class="col-12"><input type="submit" value="Submit"></div>
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