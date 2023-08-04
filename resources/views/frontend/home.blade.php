@extends('frontend.layouts.master')

@section('content')
    <!-- Tranding news  carousel-->
    @include('frontend.home-components.breaking-news')
    <!-- End Tranding news carousel -->

    <!-- Hero Slider news -->
    @include('frontend.home-components.hero-slider')
    <!-- End Hero Slider news -->

    <div class="large_add_banner">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="large_add_banner_img">
                        <img src="{{ asset('frontend/assets/images/placeholder_large.jpg') }}" alt="adds">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Popular news category -->
    @include('frontend.home-components.main-new')
    <!-- End Popular news category -->
@endsection
