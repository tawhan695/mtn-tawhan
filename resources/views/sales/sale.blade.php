@extends('sales.layouts.app')
@section('javascript')
    <script src="{{ asset('js/marketing.js') }}" defer></script>    
@endsection
@section('content')
    {{-- <script>--}}
    <style> 
            @media only screen and (max-width: 991px) {
            /* For mobile phones: */
                .order {
                    display: none;
                }
                .order2 {
                    display: block;
                }
                
            }
            @media only screen and (min-width: 992px) {
            /* For mobile phones: */
                .order {
                    display: block;
                }
                .order2 {
                    display: none;
                }
                
            }
            
            .am{
                position: absolute;
                color: #ffff ; 
                background-color: #ffc107 ; 
                width: 40px;height: 40px;
                text-align: center;
                padding-top: 5px;
                margin-left: 80px;
                
            }    
            .am2{
                position: absolute;
                color: #ffff ; 
                background-color: #c72828 ; 
                width: 120px;height: 40px;
                text-align: center;
                padding-top: 6px;
                margin-left: 0px;
                font-size: 20px;
                opacity: 0.8;
                
            }    

            .product .sale {
                flex-direction: row-reverse
            
            }

            .product .card {
                width: fit-content;
                
            }

            .product .card-body {
                width: fit-content
            }

            .product .btn  {
                border-radius: 0;
                width: fit-content;
                background-color: #69F0AE;
                box-shadow: 0px 10px 10px #E0E0E0;
                z-index: 1;
                color: white;
                width: 100px;
                font-size: 14px;
                font-weight: 900
            }

            .product .img-thumbnail  {
                border: none
            }

            .product .card  {
                box-shadow: 0 20px 40px rgba(0, 0, 0, .2);
                border-radius: 5px;
                padding-bottom: 10px;
                float: left;
            }

            .product .card-title  {
                font-size: 14px;
                font-weight: 900
            }

            .product .card-text {
                font-size: 14px;
                /* font-family: sans-serif; */
                font-weight: 500
            }
    </style>


     {{-- endscript --}}
    <div class="row m-2 pt-3">
        
        <div  class="order2 col-xl-3 col-lg-4 col-md-12">
            <button class="btn btn-block btn-info mb-2">ชำระเงิน x0 $0</button>
            <div id="destination"></div>

        </div>
        <div class="product1 col-xl-9 col-lg-8 col-md-12">
            <div class="card">
                <div class="card-header p-2">
                  <ul class="nav nav-pills">
                    <li class="nav-item  "><a class=" nav-link active" href="#all" data-toggle="tab">ทั้งหมด</a></li>
                    @foreach ($catagory as $item)
                        <li class="nav-item  "><a class=" nav-link" href="#catagory{{ $item->id }}" data-toggle="tab">{{ $item->name }}</a></li>
                    @endforeach
                    
                  </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content">
                    <div class="tab-pane active" id="all">
                        <div class="row">
                            @foreach ($products as $product)
                                <div id="P{{$product->id}}" class=" card m-1  p-2" style="width: 140px; height: 200px; margin: auto; " 
                                    @if (intval($product->qty) > 0)    
                                    onclick="AddItem({{$product->id}},'{{$product->name}}',{{$product->legular_price}})"
                                    @endif
                                    >
                                    {{-- <div id="op{{$product->id}}"></div> --}}
                                    <div class="d-flex sale ">
                                    
                                    
                                    </div> <img class='' src="{{ asset($product->image) }}" style="width:120px;height:85px; " />
                                    <div class="card-body text-center mx-auto">
                                        <h5 class="card-title">{{ $product->name}}</h5>
                                        <p class="card-text">฿ {{ $product->legular_price }}</p>
                                    </div>
                                    
                                    <style>
                                        #P{{$product->id}} {
                                            position: relative;
                                        
                                            -webkit-transition-duration: 0.1s; /* Safari */
                                            transition-duration: 0s;
                                            text-decoration: none;
                                            overflow: hidden;
                                            cursor: pointer;
                                            }

                                            #P{{$product->id}}:after {
                                            content: "";
                                            background: #ffc107;
                                            display: block;
                                            position: absolute;
                                            padding-top: 300%;
                                            padding-left: 350%;
                                            margin-left: -20px!important;
                                            margin-top: -120%;
                                            opacity: 0;
                                            transition: all 0.4s
                                            }

                                            #P{{$product->id}}:active:after {
                                            padding: 0;
                                            margin: 0;
                                            opacity: 1;
                                            transition: 0s
                                            }
                                    </style>
                                    @if (intval($product->qty) < 1)  
                                    <span  class="am2 rounded" >สินค้าหมด</span>
                                    @endif
                                </div>
                            @endforeach 
                        </div>
                    </div>
                    
                    <!-- /.tab-pane -->
                  </div>
                  <!-- /.tab-content -->
                </div><!-- /.card-body -->
            </div>
        </div>
        <div  class="order col-xl-3 col-lg-4 col-md-12" id="destination2" >
            <div id="source" style="background-color: #F0F0F0;    font-size: 10px; ">
                <h6 class=" text-center"  >ออร์เดอร์</h6>
                
                <div id="additem" data-offset="0" class="bg-white m-2" style="overflow: auto;  text-size:10px"  >
                                    
                </div>
                <div  style="height: 100%">

                    <div class="row m-3 ">
    
                        <div class="  col-12 " >
                            <p class="float-left">รวมทั้งหมด</p>
                            <p class="float-right" id="totol">0.00฿</p>
                        </div>
                        
                        <button id="sub" class=" btn btn-success btn-block btn-lg" disabled data-toggle="modal" data-target="#PaymentModalCenter">ชำระเงิน</button>
                    </div>
                </div>
                <style>
                    .list:active{
                        background-color: #f07929;
                    }
                </style>
            </div>
        </div>
    </div>
    <script>
        

        function MoveFunction(x) {
            if (x.matches) { // If media query matches
                var source = document.getElementById("source");
                document.getElementById("destination").appendChild(source);
            } else {
                var source = document.getElementById("source");
                document.getElementById("destination2").appendChild(source);
            }
        }

        var x = window.matchMedia("(max-width: 991px)")
        MoveFunction(x) // Call listener function at run time
        x.addListener(MoveFunction) // Attach listener function on state changes
   </script>

@endsection