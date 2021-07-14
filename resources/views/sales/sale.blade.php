@extends('sales.layouts.app')
@section('javascript')
    <script src="{{ asset('js/marketing.js') }}" defer></script>    
@endsection
@section('content')

<div class="">
    <div class="row p-1">
        <div class="col-lg-9 product">
            {{-- <h3 class="ml-4 mt-3 mb-1">รายการสินค้า</h3> --}}
            <div class=" p-3">
                <style> 
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
                @foreach ($products as $product)
                    <div id="P{{$product->id}}" class=" card m-1  p-2" style="width: 140px; " 
                        @if (intval($product->qty) > 0)    
                        onclick="AddItem({{$product->id}},'{{$product->name}}',{{$product->legular_price}})"
                        @endif
                        >
                        {{-- <div id="op{{$product->id}}"></div> --}}
                        <div class="d-flex sale ">
                          
                          
                        </div> <img class='mx-auto img-thumbnail' src="{{ asset($product->image) }}" width="auto" height="auto" />
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
        <div class="col-lg-3 ">
            <div class="mt-3 " style="background-color: #F0F0F0;    font-size: 10px; ">
                <h6 class=" text-center"  >ออร์เดอร์</h6>
                
                <div id="additem" data-offset="0" class="bg-white m-2" style="overflow: auto; height:410px; text-size:10px"  >
                                    
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
</div>

<!-- Modal  ชำระเงิน-->
<div class="modal fade" id="PaymentModalCenter" tabindex="-1" role="dialog" aria-labelledby="PaymentModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="">
      <div class="modal-content" style=" height: 100%; font-size:50%">
        <div class="modal-header">
          <h5 class="modal-title" id="PaymentModalLongTitle">ชำระเงิน</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="margin-bottom:-30px ;">
            <div class="row text-center">
                <h2 class="col-12" id="Amout" style="margin-bottom:-10px">0.00</h2>
                <p class="col-12 text-secondary ">จำนวนเงินที่ต้องชำระ</p>
            </div>
            <div class="container">
                {{-- <div class="row">
                    <div class="col-12 text-center">
                        <i class="far fa-money-bill-alt fa-3x"></i>
                        <p>เงินสด</p>
                    </div>
                </div> --}}
                <div class="row" style="">
                    <div class="col-12" style="padding-left: 52px;padding-right: 52px;">
                        <div class="input-group">
                            <input id="cash" disabled value="0.00" style="height: 70px ;text-align:right; font-size:40px" type="text"  class="form-control" aria-label="Amount (to the nearest dollar)">
                            <div class="input-group-append">
                              <span class="input-group-text">฿</span>
                
                            </div>
                          </div>
                    </div>
                    <div class="col-12 pl-5 pr-5" >
                        {{-- <div class="row" style="padding-right:0px;padding-left:0px;"> --}}
                            <div class="row">
                                <div onclick="Keyinput('7')" class="col-3 number btn-num text-center border">7</div>
                                <div onclick="Keyinput('8')" class="col-3 number btn-num text-center border">8</div>
                                <div onclick="Keyinput('9')" class="col-3 number btn-num text-center border">9</div>
                                <div onclick="Keyinput('1000')" class="col-3 number btn-num text-center border">1000฿</div>
                            </div>
                            <div class="row">
                                <div onclick="Keyinput('4')" class="col-3 number btn-num text-center border">4</div>
                                <div onclick="Keyinput('5')" class="col-3 number btn-num text-center border">5</div>
                                <div onclick="Keyinput('6')" class="col-3 number btn-num text-center border">6</div>
                                <div onclick="Keyinput('500')" class="col-3 number btn-num text-center border">500฿</div>
                            </div>
                            <div class="row">
                                <div onclick="Keyinput('1')" class="col-3 number btn-num text-center border">1</div>
                                <div onclick="Keyinput('2')" class="col-3 number btn-num text-center border">2</div>
                                <div onclick="Keyinput('3')" class="col-3 number btn-num text-center border">3</div>
                                <div onclick="Keyinput('100')" class="col-3 number btn-num text-center border">100฿</div>
                            </div>
                            <div class="row">
                                <div onclick="Keyinput('.')" class="col-3 number btn-num text-center border">.</div>
                                <div onclick="Keyinput('0')" class="col-3 number btn-num text-center border">0</div>
                                <div onclick="Keyinput('del')" class="col-3 number btn-num text-center border">ลบ</div>
                                <div onclick="Keyinput('full')" class="col-3 number btn-num text-center border">เต็ม</div>
                            </div>
                            <div class="input-group mb-3 mt-2">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">ส่วนลด</span>
                                </div>
                                <input id="discount" type="number" class="form-control " placeholder="0" tabindex="4" value="0">
                              </div>
                                <script>
                                    var cash = 0;
                                    var pushKey = '0';
                                    
                                    var f = false;
                                    function Keyinput(key) {

                                        switch (key) {
                                            case '1000' : case '500' : case '100':
                                                pushKey = parseFloat(pushKey) + parseFloat(key);
                                                
                                                break;
                                            case '.':
                                                pushKey = pushKey + key;
                                                break;
                                            case 'full':
                                                pushKey = (parseFloat(document.getElementById('Amout').innerText).toFixed(2));
                                                f=true
                                                break;
                                            case 'del':
                                                if(pushKey.length > 0){
                                                    pushKey = 0;
                                                }else{
                                                    pushKey = 0;
                                                }
                                                break;
                                        
                                            default:
                                                // var IN = 
                                                if (f != true) {
                                                    if (pushKey.toString().indexOf(".") == -1) {
                                                    
                                                        pushKey = pushKey + key;
                                                    } else {
                                                        // pushKey = pushKey + key;
                                                        
                                                        pushKey = pushKey + key;
                                                    }
                                                } else {
                                                    pushKey = key;
                                                    // //console.log('fff');
                                                    // //console.log(f);
                                                    f = false;
                                              
                                                
                                                    // pushKey = parseFloat(pushKey) + parseFloat(0 + parseFloat(key).toFixed(2));
                                                    
                                                }

                                                break;
                                        }
                                        // //console.log(pushKey);
                                        cash = document.getElementById('cash').value = parseFloat(pushKey).toFixed(2);
                                        if (parseFloat(pushKey) >= parseFloat(document.getElementById('Amout').innerText) && parseFloat(document.getElementById('Amout').innerText) > 0 ) {
                                            document.getElementById('ok').disabled = false;
                                        } else {
                                            document.getElementById('ok').disabled = true;
                                        }
                                        //console.log('cash '+ cash);
                                        
                                    }

                                    
                                   
                                </script>
                                <script>
                                    $(document).ready(function() {
                                       $(document).on('click', '#ok', function () {
                                        var discount = document.getElementById('discount').value;
                                        //console.log('dis '+ discount);
                                         $.ajax({
                                            type:'POST',
                                            url:'{{ url('sale')}}',
                                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                            data:{
                                                "_token": "{{ csrf_token() }}",
                                                'product': list,
                                                'cash':cash,
                                                'discount': discount,
                                                'status': 'สำเร็จ',
                                                'paid_by': 'เงินสด',
                                            },
                                            success:function(data){
                                                //console.log(data);
                                                var number = parseFloat(data['Change']);
                                                number=number.toLocaleString('en');
                                                $('#PaymentModalCenter').modal('hide');
                                                Swal.fire({
                                                    title: 'เงินทอน',
                                                    text: number,
                                                    imageUrl: '{{asset("/images/logo/logo.jpg")}}',
                                                    imageWidth: 300,
                                                    imageHeight: 300,
                                                    imageAlt: 'icon',
                                                    confirmButtonText: 'พิมพ์ใบเสร็จ',
                                                    cancelButtonText: 'ปิด',
                                                    showCancelButton: true,
                                                    })
                                                    $('.swal2-confirm').click(function() {
                                                        // var w = window.open();
                                                        //     var html = "<!DOCTYPE HTML>";
                                                        //     html += '<html lang="en-us">';
                                                        //     html += '<head><style></style></head>';
                                                        //     html += "<body>";

                                                        //     //check to see if they are null so "undefined" doesnt print on the page. <br>s optional, just to give space
                                                        //     html +=  "<div/>456<div/>";
                                                        //     html += "<div/>123<div/>";
                                                        //     html += "<div/>46545656<div/>";

                                                        //     html += "</body>";
                                                        //     w.document.write($('#additem'));
                                                        //     w.window.print();
                                                        //     w.document.close();
                                                         
                                                        });
                                            }
                                         });
                                       });
                                   });
                                   </script>
                                <style>
                                    .number{
                                        padding: 25px;
                                        font-size: 30px;
                                        /* padding-top: 20px;
                                        padding-bottom: 20px; */
                                        /* width: 100px; */
                                        height: 100px;
                                    }
                                    .btn-num:active{
                                        background: #f0c929;
                                    }
                                </style>
                        {{-- </div> --}}
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer mr-5" style="margin-top: 5px">
          {{-- <button type="button" class="btn btn-secondary"style="height: 77px ;width: 220px; font-size:40px" data-dismiss="modal">ยกเลิก</button> --}}
          <button id="ok" type="button" disabled class="btn btn-primary" style="height: 77px ;width: 220px; font-size:40px">ตกลง</button>
        </div>
      </div>
    </div>
    <style>
        #PaymentModalCenter .modal-dialog {
            max-width: 60%;
            max-height: 100%;
            
        }
        #PaymentModalCenter .modal-dialog-centered{
            height: 80%;
        }
    </style>
  </div>

  <!-- Modal แก้ไขรายการสินค้า-->

  <div class="modal fade" id="pdModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="pdModalLongTitle">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h1 id="edit1"></h1>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">ลบ</button>
          <button type="button" class="btn btn-primary">ตกลง</button>
        </div>
      </div>
    </div>
  </div>
@endsection