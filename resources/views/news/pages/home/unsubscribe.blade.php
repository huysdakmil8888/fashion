@php
    use App\Helpers\Template;

@endphp
@extends('news.main')
@section('content')
    <div class="page-banner-section section" style="background-image: url({{asset('assets/images/hero/hero-1.jpg')}})">
        <div class="container">
            <div class="row">
                <div class="page-banner-content col">

                    <h1>Hủy đăng kí trang web</h1>
                    <ul class="page-breadcrumb">
                        <li><a href="{{route('home')}}">Home</a></li>
                    </ul>

                </div>
            </div>
        </div>
    </div><!-- Page Banner Section End -->
    <div class="page-section section section-padding">
        <div class="container">
            <div class="row">

                <div class="col-lg-6 col-md-8 col-12 mx-auto">
                    <form action="{{route('home/delete_unsubscribe')}}">
                        @csrf
                        <label for="">Vui lòng nhập email đã đăng kí</label>
                        <input type="text" name="email">
                        <input type="submit">
                    </form>
                </div>

            </div>
        </div>
    </div><!-- Page Section End -->



@stop
