@extends('frontpanel.layouts.master')

@section('title','Contact')

@push('css')
@endpush

@section('content')
<!-- Register Section Start -->
<div class="register-section section mt-90 mb-90">
    <div class="container">
        <div class="row">

            <!-- Register -->
            <div class="col-md-12 col-12 d-flex">
                <div class="ee-register">
                    @include('frontpanel.layouts.partials.message')
                    <h3>Share with us your query</h3>
                    <!-- Contact Form -->
                    <form action="{{route('contact.store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="col-12 mb-30">
                                    <input type="text" name="name" placeholder="Your name here">
                                    @error('name')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>
                                <div class="col-12 mb-30">
                                    <input type="email" name="email" placeholder="Your email here">
                                    @error('email')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>
                                <div class="col-12 mb-30">
                                    <input type="text" name="subject" placeholder="Your subject here">
                                    @error('subject')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="col-12 mb-30">
                                    <textarea name="description" id="" cols="30" rows="10" class="form-control" placeholder="your description..."></textarea>
                                    @error('description')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div class="col-12"><input type="submit" value="send"></div>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div><!-- Register Section End -->
@endsection

@push('js')
<script>
    function button() {
        document.getElementById("removeDiv").style.display = "none";
    }
</script>
@endpush