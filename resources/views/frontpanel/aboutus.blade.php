@extends('frontpanel.layouts.master')

@section('title','About us')

@push('css')
@endpush

@section('content')
<!-- About Section Start -->
<div class="about-section section mt-90 mb-30">
    <div class="container">

        <div class="row row-30 mb-40">

            <!-- About Image -->
            <div class="about-image col-lg-6 mb-50">
                @if(isset($aboutus))
                <img src="{{url('public/uploads/system/'.$aboutus->image)}}" alt="">
                @else
                <img src="{{url('public/uploads/system/2024-07-25-66a20fe807c83.jpg')}}" alt="">
                @endif
            </div>

            <!-- About Content -->
            <div class="about-content col-lg-6">
                <div class="row">
                    <div class="col-12 mb-50">
                        @if(isset($aboutus))
                        <h1>{!! $aboutus->title !!}</h1>
                        <p>{!! $aboutus->description !!}</p>
                        @else
                        <h1>About us Title will show here</h1>
                        <p>About us Description will show here</p>
                        @endif
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div><!-- About Section End -->
@endsection

@push('js')
@endpush