@extends('layouts.index')
@section('javascript')
    <script>
        // $('.carousel').carousel({
        //     interval: 500
        // })
    </script>
@endsection
@section('content')
    <div class="d-flex justify-content-center">
        <div id="Bo" class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center ">
            <div class="col-md-5 p-lg-5 mx-auto my-5 text-white">
                <h1 class="display-4 font-weight-normal">MTN POS - ระบบบริหารจัดการหน้าร้าน
                    ที่ใช้งานง่ายสุดๆ</h1>
                {{-- <p class="lead font-weight-normal">And an even wittier subheading to boot. Jumpstart your marketing efforts with this example based on Apple's marketing pages.</p> --}}
                <a class="btn btn-success" href="{{ url('download2') }}">Download App</a>
            </div>
            <div class="product-device box-shadow d-none d-md-block"></div>
            <div class="product-device product-device-2 box-shadow d-none d-md-block"></div>
        </div>

    </div>
    <div class="d-flex justify-content-center">
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel" style="width: 75%;">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('images/posapp/seller.png') }}" alt="หน้าขาย">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('images/posapp/menu.png') }}" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('images/posapp/customer.png') }}" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('images/posapp/ข้อมูลใบเสร็จ.png') }}" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('images/posapp/ข้อมูลสินค้า.png') }}" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('images/posapp/cash.png') }}" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('images/posapp/ทอนเงิน.png') }}" alt="Second slide">
                </div>
            </div>
        </div>
    </div>
    <style>
        #Bo {
            /* color: rgba(255, 166, 0, 0.966); */
            background-color: #FE7200;
            background-repeat: no-repeat, repeat;
            background-size: 50%;
            background-repeat: no-repeat;
            background-origin: padding-box;
            /* background-color: #cccccc; */
        }

    </style>
@endsection
