@extends('sales.layouts.app')
@section('javascript')
    <script src="{{ asset('js/marketing.js') }}" defer></script>
@endsection
@section('content')
    {{-- <script> --}}
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

        .am {
            position: absolute;
            color: #ffff;
            background-color: #ffc107;
            width: 40px;
            height: 40px;
            text-align: center;
            padding-top: 5px;
            margin-left: 80px;

        }

        .am2 {
            position: absolute;
            color: #ffff;
            background-color: #c72828;
            width: 120px;
            height: 40px;
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

        .product .btn {
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

        .product .img-thumbnail {
            border: none
        }

        .product .card {
            box-shadow: 0 20px 40px rgba(0, 0, 0, .2);
            border-radius: 5px;
            padding-bottom: 10px;
            float: left;
        }

        .product .card-title {
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
    {{-- <input type="button" id="onedit"> --}}
    <div class="row m-2 pt-3">

        {{-- <div class=" col-xl-3 col-lg-4 col-md-12">
            <button class="btn btn-block btn-info mb-2" id="mb-order"
            href="#order-list" data-toggle="tab">ชำระเงิน <span id="mb-count"></span></button>
        </div> --}}
        <div class="product1 col-xl-9 col-lg-8 col-md-12">
            <div class="card" >
                <div class="card-header p-2">
                    <ul class="nav nav-pills row">
                        <li class="nav-item col-md-12 col-lg-3 "><a class=" nav-link active btn btn-block btn-default" href="#all" data-toggle="tab">รายการสินค้า</a></li>
                        <li class="nav-item order2 col-12 pb-1"><a class=" nav-link btn btn-block btn-default" href="#order-list" data-toggle="tab">ชำระเงิน <span id="mb-count" class="badge badge-warning text-white"></a></li>
                        {{-- @foreach ($catagory as $item)

                            <li class="nav-item  "><a class=" nav-link" href="#catagory{{ $item->id }}"
                                    data-toggle="tab">{{ $item->name }}</a></li>
                        @endforeach --}}

                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active text-center" id="all">
                            <div class="row text-center">
                                @foreach ($products as $product)

                                    <div id="P{{ $product->id }}" class=" card m-1  p-2"
                                        style="width: 130px; height: 180px;  " @if (intval($product->qty) > 0) onclick="AddItem({{ $product->id }},'{{ $product->name }}',{{ $product->legular_price }})" @endif>
                                        {{-- <div id="op{{$product->id}}"></div> --}}
                                        <div class="d-flex sale ">


                                        </div> <img class='' src="{{ asset($product->image) }}"
                                            style="width:120px;height:85px; " />
                                        <div class="card-body text-center mx-auto">
                                            <h5 class="card-title" style="font-size:12px">{{ $product->name }}</h5>
                                            <p class="card-text" style="font-size:15px">฿ {{ $product->legular_price }}</p>
                                        </div>

                                        <style>
                                            #P{{ $product->id }} {
                                                position: relative;

                                                -webkit-transition-duration: 0.1s;
                                                /* Safari */
                                                transition-duration: 0s;
                                                text-decoration: none;
                                                overflow: hidden;
                                                cursor: pointer;
                                            }

                                            #P{{ $product->id }}:after {
                                                content: "";
                                                background: #ffc107;
                                                display: block;
                                                position: absolute;
                                                padding-top: 300%;
                                                padding-left: 350%;
                                                margin-left: -20px !important;
                                                margin-top: -120%;
                                                opacity: 0;
                                                transition: all 0.4s
                                            }

                                            #P{{ $product->id }}:active:after {
                                                padding: 0;
                                                margin: 0;
                                                opacity: 1;
                                                transition: 0s
                                            }

                                        </style>
                                        @if (intval($product->qty) < 1)
                                            <span class="am2 rounded">สินค้าหมด</span>
                                        @endif
                                    </div>

                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane  text-center" id="order-list">
                            <div id="destination" >

                            </div>
                        </div>
                        {{-- @foreach ($catagory as $item)
                            <div class="tab-pane" id="catagory{{ $item->id }}">
                                <div class="row text-center">
                                @foreach ($products as $product)
                                    @if ($product->catagory_id == $item->id )
                                        <div id="P{{ $product->id }}" class=" card m-1  p-2"
                                            style="width: 140px; height: 200px;  " @if (intval($product->qty) > 0) onclick="AddItem({{ $product->id }},'{{ $product->name }}',{{ $product->legular_price }})" @endif>

                                            <div class="d-flex sale ">


                                            </div> <img class='' src="{{ asset($product->image) }}"
                                                style="width:120px;height:85px; " />
                                            <div class="card-body text-center mx-auto">
                                                <h5 class="card-title" style="font-size:15px">{{ $product->name }}</h5>
                                                <p class="card-text">฿ {{ $product->legular_price }}</p>
                                            </div>

                                            <style>
                                                #P{{ $product->id }} {
                                                    position: relative;

                                                    -webkit-transition-duration: 0.1s;
                                                    /* Safari */
                                                    transition-duration: 0s;
                                                    text-decoration: none;
                                                    overflow: hidden;
                                                    cursor: pointer;
                                                }

                                                #P{{ $product->id }}:after {
                                                    content: "";
                                                    background: #ffc107;
                                                    display: block;
                                                    position: absolute;
                                                    padding-top: 300%;
                                                    padding-left: 350%;
                                                    margin-left: -20px !important;
                                                    margin-top: -120%;
                                                    opacity: 0;
                                                    transition: all 0.4s
                                                }

                                                #P{{ $product->id }}:active:after {
                                                    padding: 0;
                                                    margin: 0;
                                                    opacity: 1;
                                                    transition: 0s
                                                }

                                            </style>
                                            @if (intval($product->qty) < 1)
                                                <span class="am2 rounded">สินค้าหมด</span>
                                            @endif
                                        </div>
                                    @endif
                                @endforeach
                                    </div>
                            </div>
                        @endforeach --}}

                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div><!-- /.card-body -->
            </div>
        </div>
        <div class="order col-xl-3 col-lg-4 col-md-12" id="destination2">
            <div id="source" class="bg-white shadow-sm" style="font-size: 15px;">
                <h4 class=" text-center pt-3"style="text-size: 28px;">รายการสั่งชื้อ</h4>

                <div id="additem" data-offset="0" class="bg-white m-2" style="overflow: auto;  text-size:10px">

                </div>
                <div style="height: 100%">

                    <div class="row m-3 " style="background:#f7f7f7;">

                        <div class="  col-12 ">
                            <p class="float-left">รวมทั้งหมด</p>
                            <p class="float-right" id="totol">0.00฿</p>
                        </div>
                        {{-- <p class="bg-danger">อย่าลืม นะครับอย่าลืม อก้ตรงนี้ด้วย มันยังไม่เสร็จ</p> --}}
                        <div id="mb-sub" class="row w-100">

                        </div>


                        <script>
                            $('#sub').click(function() {

                                $('#exampleModalLong').modal().hide();
                            });
                        </script>
                    </div>
                </div>
                <style>
                    .list:active {
                        background-color: #f07929;
                    }

                </style>
            </div>
        </div>
    </div>
    <!-- Modal -->
    {{-- <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="destination">

                </div>

            </div>
        </div>
    </div> --}}
    <!-- Modal -->
    <div class="modal fade" id="PaymentModalCenter" tabindex="-1" role="dialog" aria-labelledby="PaymentModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    {{-- <h5 class="modal-title" id="PaymentModalLongTitle">Modal title</h5> --}}
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row" id="">
                    <div class="col-12 row text-center">
                        <h2 class="col-12" id="Amout" style="margin-bottom:-10px">0.00</h2>
                        <p class="col-12 text-secondary ">จำนวนเงินที่ต้องชำระ</p>
                    </div>
                    <div class="col-12" style="">
                        <div class="input-group">
                            <input id="cash" disabled value="0.00" style="height: 70px ;text-align:right; font-size:40px"
                                type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                            <div class="input-group-append">
                                <span class="input-group-text">฿</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 shadow-sm p-3  bg-white rounded">
                        {{--  --}}
                        <div class="row">
                            <div onclick="Keyinput('7')" class="col-3 btn text-center shadow-sm">7</div>
                            <div onclick="Keyinput('8')" class="col-3 btn text-center shadow-sm">8</div>
                            <div onclick="Keyinput('9')" class="col-3 btn text-center shadow-sm">9</div>
                            <div onclick="Keyinput('1000')" class="col-3 btn text-center shadow-sm">1000฿</div>
                        </div>
                        <div class="row">
                            <div onclick="Keyinput('4')" class="col-3 btn text-center shadow-sm">4</div>
                            <div onclick="Keyinput('5')" class="col-3 btn text-center shadow-sm">5</div>
                            <div onclick="Keyinput('6')" class="col-3 btn text-center shadow-sm">6</div>
                            <div onclick="Keyinput('500')" class="col-3 btn text-center shadow-sm">500฿</div>
                        </div>
                        <div class="row">
                            <div onclick="Keyinput('1')" class="col-3 btn text-center shadow-sm">1</div>
                            <div onclick="Keyinput('2')" class="col-3 btn text-center shadow-sm">2</div>
                            <div onclick="Keyinput('3')" class="col-3 btn text-center shadow-sm">3</div>
                            <div onclick="Keyinput('100')" class="col-3 btn text-center shadow-sm">100฿</div>
                        </div>
                        <div class="row">
                            <div onclick="Keyinput('.')" class="col-3 btn text-center shadow-sm">.</div>
                            <div onclick="Keyinput('0')" class="col-3 btn text-center shadow-sm">0</div>
                            <div onclick="Keyinput('del')" class="col-3 btn text-center shadow-sm">ลบ</div>
                            <div onclick="Keyinput('full')" class="col-3 btn text-center shadow-sm">เต็ม</div>
                        </div>
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
                                case '1000':
                                case '500':
                                case '100':
                                    pushKey = parseFloat(pushKey) + parseFloat(key);

                                    break;
                                case '.':
                                    pushKey = pushKey + key;
                                    break;
                                case 'full':
                                    pushKey = (parseFloat(document.getElementById('Amout').innerText).toFixed(2));
                                    f = true
                                    break;
                                case 'del':
                                    if (pushKey.length > 0) {
                                        pushKey = 0;
                                    } else {
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
                            if (parseFloat(pushKey) >= parseFloat(document.getElementById('Amout').innerText) && parseFloat(document
                                    .getElementById('Amout').innerText) > 0) {
                                document.getElementById('ok').disabled = false;
                            } else {
                                document.getElementById('ok').disabled = true;
                            }
                            //console.log('cash '+ cash);

                        }
                    </script>
                    <script>
                        $(document).ready(function() {
                            $(document).on('click', '#ok', function() {
                                $('#discount').prop( "disabled", true );
                                var discount = document.getElementById('discount').value;
                                //console.log('dis '+ discount);
                                $.ajax({
                                    type: 'POST',
                                    url: '{{ url('sale') }}',
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    data: {
                                        "_token": "{{ csrf_token() }}",
                                        'product': list,
                                        'cash': cash,
                                        'discount': discount,
                                        'status': 'สำเร็จ',
                                        'paid_by': 'เงินสด',
                                    },
                                    success: function(data) {
                                        console.log(data['product']);
                                        console.log("@222222");
                                        console.log(data['order_detail']);
                                        var number = parseFloat(data['Change']);

                                        number = number.toLocaleString('en');
                                        $('#PaymentModalCenter').modal('hide');
                                        Swal.fire({
                                            title: 'เงินทอน',
                                            text: number,
                                            imageUrl: '{{ asset('/images/logo/logo.jpg') }}',
                                            imageWidth: 200,
                                            imageHeight: 200,
                                            imageAlt: 'icon',
                                            confirmButtonText: 'พิมพ์ใบเสร็จ',
                                            cancelButtonText: 'ปิด',
                                            showCancelButton: true,
                                        }).then((result) => {
                                            /* Read more about isConfirmed, isDenied below */
                                            if (result.isConfirmed) {
                                                var resourceH = '';

                                                data['order_detail'].forEach(element => {
                                                        resourceH +='<tr style="padding:-10px;margin:-10px" >';
                                                        resourceH += '<th class=""><p >'+element.name+'</p></th>';
                                                        resourceH += '<th class="text-center"><p>'+element.qty+'</p></th>';
                                                        resourceH += '<th class="text-center"><p>'+element.price+'</p></th>';
                                                        resourceH += '<th class="text-center"><p> '+element.totol+'</p></th>';
                                                        resourceH +='</tr>';
                                                    });
                                                var head =  `<div id="printText">
                                                        <div class="image text-center" style="width:200px; height:200px; margin:auto;">
                                                            <img src="{{ asset('/images/logo/logo.jpg') }}" style="width:100%; height:100%">
                                                        </div>
                                                        <p class="centered">
                                                            {{ App\Models\Branchs::where('id',auth()->user()->branch_id())->first()->name }}
                                                            <br>
                                                            {{ App\Models\Branchs::where('id',auth()->user()->branch_id())->first()->des }}
                                                            <br>------------------------------
                                                            <br>        ใบเสร็จรับเงิน
                                                            <br>------------------------------
                                                            <br>        สินค้า/บริการ
                                                            <hr>
                                                        <table class="table table-borderless  " style="text-size:8px;width:100%">
                                                            <thead style="text-size:8px;">
                                                                <tr>
                                                                    <th class=""><p>รายการ</p></th>
                                                                    <th class="text-center"><p>จำนวน</p></th>
                                                                    <th class="text-center"><p>ราคา</p></th>
                                                                    <th class="text-center"><p>รวม</p></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>`;
                                                var body =resourceH;
                                                var footer = `
                                                                <tr>
                                                                    <th class=""><p></p></th>
                                                                    <th class="text-center"><p></p></th>
                                                                    <th class="text-center"><p>รวม</p></th>
                                                                    <th class="text-center"><p id="o1"></p></th>
                                                                </tr>
                                                                <tr>
                                                                    <th class=""><p></p></th>
                                                                    <th class="text-center"><p></p></th>
                                                                    <th class="text-center"><p>ส่วนลด</p></th>
                                                                    <th class="text-center"><p id="o2"></p></th>
                                                                </tr>
                                                                <tr>
                                                                    <th class=""><p></p></th>
                                                                    <th class="text-center"><p></p></th>
                                                                    <th class="text-center"><p>ยอดสุทธิ</p></th>
                                                                    <th class="text-center"><p id="o3"></p></th>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                                <hr>
                                                        <p class="centered">ขอบคุณที่ใช้บริการ

                                                            <button class="btn btn-primary btn-block" id="btnPrint" onclick="printT()">ปริ๊นท์</button>

                                                    </div>`;
                                                Swal.fire({
                                                    showConfirmButton: false,
                                                    showCloseButton: true,
                                                    html:head+body+footer,
                                                }).then((result) => {
                                                    if (!result.isConfirmed) {
                                                        window.location.reload();
                                                    }});
                                                $('#o1').text(data['totol']);
                                                $('#o2').text(data['discount']);
                                                $('#o3').text(data['net_amount']);
                                            } else  {
                                                Swal.fire('Saved!', '', 'success')
                                                location.reload();
                                            }
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

                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary"style="height: 77px ;width: 220px; font-size:40px" data-dismiss="modal">ยกเลิก</button> --}}
                    <button id="ok" type="button" disabled class="btn btn-primary">ตกลง</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        function MoveFunction(x) {
            if (x.matches) { // If media query matches
                var source = document.getElementById("source");
                document.getElementById("destination").appendChild(source);
                $("#sub").remove();
                $('#mb-sub').append(`
                <button id="sub" class=" btn btn-success btn-block btn-lg" disabled type="button" data-toggle="modal"
                data-target="#PaymentModalCenter"
                            >ชำระเงิน</button>
                `);
            } else {
                var source = document.getElementById("source");
                document.getElementById("destination2").appendChild(source);
                $("#sub").remove();
                $('#mb-sub').append(`
                <button id="sub" class=" btn btn-success btn-block btn-lg" disabled data-toggle="modal" type="button"
                            data-target="#PaymentModalCenter"
                            >ชำระเงิน</button>
                `);
            }
        }

        var x = window.matchMedia("(max-width: 991px)")
        MoveFunction(x) // Call listener function at run time
        x.addListener(MoveFunction) // Attach listener function on state changes


        //pop up
        // $('#mb-order').click(function() {
        //     Swal.fire({
        //         title: '<strong>HTML <u>example</u></strong>',
        //         htm;: document.getElementById("source").appendChild(source);
        //     })
        // })

        // const $btnPrint = document.querySelector("#btnPrint");
        //                         $btnPrint.addEventListener("click", () => {
        //                             window.print();
        //                         });
         function printT (){
            console.log("print");
            // p = document.querySelector("#printText")
            $('#btnPrint').remove();
            // $('.swal2-confirm').remove();
            window.print();
        }

        // $('#mb-order').click(function (){
        //     Swal.fire({
        //         target: document.getElementById("source")
        //     })
        // })
    </script>
    <style>
        @media (max-width: 900px) {
    .table-borderless {
        font-size:15px !important;
        margin-left: -20px;
        padding: -10px;
    }
}
    </style>
@endsection
