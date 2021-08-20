@extends('sales.layouts.app')
@section('javascript')
    <script src="{{ asset('js/marketing.js') }}" defer></script>
    <script src="{{ asset('js/sale_v2.js') }}" defer></script>
    {{-- <link rel="stylesheet" href="css/sale/v2.css"> --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
        <div class="product1 col-xl-7 col-lg-7 col-md-12">
            <div class="card card-warning">
                <div class="card-header p-2 pl-3 text-white">
                    <h4>ขายปลีก</h4>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <ul class="nav nav-pills row shadow-sm mb-2">
                        <li id="" class="nav-item col-md-12 col-lg-3 order2"><a
                                class=" nav-link bg-info text-white   btn btn-block btn-default" href="#order-list"
                                data-toggle="tab">ชำระเงิน
                                <span id="mb-count" class="badge badge-warning text-white">0</span>
                            </a></li>

                        @foreach ($catagory as $item)
                            <li class="nav-item  ml-2 pb-1 mt-2"><a class=" nav-link @if ($loop->index
                                    == 0) active @endif"
                                    href="#catagory{{ $item->id }}"
                                    data-toggle="tab">{{ $item->name }}
                                </a></li>

                        @endforeach

                    </ul>
                    <div class="tab-content">

                        <div class="tab-pane  text-center" id="order-list">
                            <div id="destination">

                            </div>
                        </div>
                        @foreach ($catagory as $item)
                            <div class="tab-pane @if ($loop->index == 0) active @endif" id="catagory{{ $item->id }}">
                                <div class="row text-center">
                                    @foreach ($products as $product)
                                        @if ($product->catagory_id == $item->id)
                                            <div id="P{{ $product->id }}" class=" card m-1  p-2"
                                                style="width: 130px; height: 180px;  " @if (intval($product->qty) > 0) onclick="AddItem({{ $product->id }},'{{ $product->name }}',{{ $product->retail_price }},{{ $product->qty }},'{{ asset($product->image) }}')" @endif>

                                                <div class="d-flex sale ">


                                                </div> <img class='' src="{{ asset($product->image) }}"
                                                    style="width:120px;height:85px; " />
                                                <div class="card-body text-center mx-auto">
                                                    <h5 class="card-title" style="font-size:15px">{{ $product->name }}
                                                    </h5>
                                                    <p class="card-text" style="font-size:15px">฿
                                                        {{ $product->retail_price }}</p>
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
                        @endforeach

                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div><!-- /.card-body -->
            </div>
        </div>
        <div class="order col-xl-5 col-lg-5 col-md-12" id="destination2">
            <div id="source" class="bg-white shadow-sm  " style="font-size: 15px; padding:18px">
                <h4 class=" text-center pt-3" style="text-size: 28px;">รายการสั่งชื้อ</h4>

                <div id="additem" data-offset="0" class="bg-white " style="overflow: auto;  text-size:10px">

                </div>
                {{-- <div style=""> --}}

                <div class="row">

                    <div class="col-12">
                        <p class="float-left">รวมทั้งหมด</p>
                        <p class="float-right" id="totol">฿0.00</p>
                    </div>
                    <div id="mb-sub" class="col-12">
                    </div>
                    <script>
                        $('#sub').click(function() {

                            $('#exampleModalLong').modal().hide();
                        });
                    </script>
                </div>
                {{-- </div> --}}
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
                                $('#discount').prop("disabled", true);
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
                                        'status_sale': 'ขายปลีก',
                                        'paid_by': 'เงินสด',
                                    },
                                    beforeSend: function() {

                                        $("#ok").attr('disabled', true);
                                        $("#ok").append(
                                            '<span id="loading" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
                                        );
                                        $("#ok").text('รอสักครู่...');
                                        // $("#loading").show();
                                    },

                                    success: function(data) {
                                        console.log(data['product']);
                                        console.log("@222222");
                                        console.log(data['order_detail']);
                                        var number = parseFloat(data['Change']);

                                        number = number.toLocaleString('en');
                                        $('#PaymentModalCenter').modal('hide');
                                        Swal.fire({
                                            title: number,
                                            text: 'เงินทอน',
                                            imageUrl: '{{ asset('/images/logo/logo.jpg') }}',
                                            imageWidth: 150,
                                            imageHeight: 150,
                                            imageAlt: 'icon',
                                            confirmButtonText: 'พิมพ์ใบเสร็จ',
                                            cancelButtonText: 'ปิด',
                                            showCancelButton: true,
                                        }).then((result) => {
                                            /* Read more about isConfirmed, isDenied below */
                                            console.log(data);
                                            if (result.isConfirmed) {
                                                var resourceH = '';

                                                data['order_detail'].forEach(element => {
                                                    resourceH +=
                                                        '<tr style="padding:-10px;margin:-10px" >';
                                                    resourceH += '<th class=""><p >' + element
                                                        .name + '</p></th>';
                                                    resourceH += '<th class="text-center"><p>' +
                                                        element.qty + '</p></th>';
                                                    resourceH += '<th class="text-center"><p>' +
                                                        element.price + '</p></th>';
                                                    resourceH +=
                                                        '<th class="text-center"><p> ' + element
                                                        .totol + '</p></th>';
                                                    resourceH += '</tr>';
                                                });
                                                var head = `<div id="printText" class="receipt">
                                                    <section class="sheet padding-10mm">
                                                        <div class="image text-center" style="width:120px; height:120px; margin:auto;">
                                                            <img src="{{ asset('/images/logo/logo.jpg') }}" style="width:100%; height:100%">
                                                        </div>
                                                        <p class="centered">
                                                            {{ App\Models\Branchs::where(
                                                                'id',
                                                                auth()->user()->branch_id(),
                                                            )->first()->name }}
                                                                                                                        <br>
                                                                                                                        {{ App\Models\Branchs::where(
                                                                'id',
                                                                auth()->user()->branch_id(),
                                                            )->first()->des }}
                                                            <hr>
                                                                        <p class="centered">ใบเสร็จรับเงิน</p>
                                                            <hr>
                                                                        <p class="centered">สินค้า/บริการ</p>

                                                        <table class="table table-borderless  " style="font-size: 13px;width:100%">
                                                            <thead style="font-size: 13px;">
                                                                <tr>
                                                                    <th class=""><p class="centered">รายการ</p></th>
                                                                    <th class="text-center"><p class="centered">จำนวน</p></th>
                                                                    <th class="text-center"><p class="centered">ราคา</p></th>
                                                                    <th class="text-center"><p class="centered">รวม</p></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>`;
                                                var body = resourceH;
                                                // var dt = new Date();
                                                var footer = `
                                                                <tr>
                                                                    <th class=""><p></p></th>
                                                                    <th class="text-center"><p></p></th>
                                                                    <th class="text-center"><p class="centered">รวม</p></th>
                                                                    <th class="text-center"><p class="centered" id="o1"></p></th>
                                                                </tr>
                                                                <tr>
                                                                    <th class=""><p></p></th>
                                                                    <th class="text-center"><p></p></th>
                                                                    <th class="text-center"><p class="centered">ส่วนลด</p></th>
                                                                    <th class="text-center"><p class="centered" id="o2"></p></th>
                                                                </tr>
                                                                <tr>
                                                                    <th class=""><p></p></th>
                                                                    <th class="text-center"><p></p></th>
                                                                    <th class="text-center"><p class="centered">ยอดสุทธิ</p></th>
                                                                    <th class="text-center"><p class="centered" id="o3"></p></th>
                                                                </tr>

                                                                <tr id="hr-tb">
                                                                    <th class=""><p></p></th>
                                                                    <th class="text-center"><p></p></th>
                                                                    <th class="text-center"><p class="centered">รับเงินสด</p></th>
                                                                    <th class="text-center"><p class="centered">${cash}</p></th>
                                                                </tr>
                                                                <tr id="hr-tb">
                                                                    <th class=""><p></p></th>
                                                                    <th class="text-center"><p></p></th>
                                                                    <th class="text-center"><p class="centered">เงินทอน</p></th>
                                                                    <th class="text-center"><p class="centered">${parseInt(number).toFixed(2)}</p></th>
                                                                </tr>
                                                                </tbody>
                                                            </table>


                                                                <hr>
                                                                <p class="centered">
                                                                    พนักงานขาย :${data['sale']}
                                                                    <br>
                                                                    วันเวลา : ${data['date']}
                                                                </p>
                                                                <hr>
                                                        <p class="centered">ขอขอบพระคุณทุกท่านที่มาอุดหนุนนะคะ

                                                                ช่องทางการติดต่อ 👉🏻
                                                                FB: หจก.มัทนาไข่สดฟาร์ม
                                                                โทร.092-293-1906
                                                                หรือ@line : 092-293-1906
                                                                <br>
                                                                <hr>
                                                            <button class="btn btn-primary btn-block" id="btnPrint" onclick="printT()">ปริ๊นท์</button>
                                                            </section>
                                                    </div>`;
                                                Swal.fire({
                                                    width:'220px',
                                                    showConfirmButton: false,
                                                    showCloseButton: true,
                                                    html: head + body + footer,

                                                }).then((result) => {
                                                    if (!result.isConfirmed) {
                                                        window.location.reload();
                                                    }
                                                });
                                                $('#o1').text(''+parseFloat(data['totol']).toFixed(2));
                                                $('#o2').text(''+parseFloat( data['discount']).toFixed(2));
                                                $('#o3').text(''+parseFloat(data['net_amount']).toFixed(2));
                                            } else {
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
        function printT() {
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
        .centered,table{
            font-size: 15px;
        }
        .swal2-popup {
            padding: 20px 0 10px 0;
        }
        #hr-tb{
            border: 2px 0 0 0 solid #3333;

        }
        @media (max-width: 900px) {
            .table-borderless {
                font-size: 15px !important;
                margin-left: -20px;
                padding: -10px;
            }
        }
        .table td, .table th {
           padding: .0rem;
        }
        #overlay {
            position: fixed;
            /* Sit on top of the page content */
            display: none;
            /* Hidden by default */
            width: 100%;
            /* Full width (cover the whole page) */
            height: 100%;
            /* Full height (cover the whole page) */
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            /* Black background with opacity */
            z-index: 2;
            /* Specify a stack order in case you're using a different order for other elements */
            cursor: pointer;
            /* Add a pointer on hover */
        }

    </style>
    {{-- <div class="overlay"></div>
    <div class="spanner">
        <div class="loader"></div>
        <p>Uploading music file, please be patient.</p>
    </div> --}}
    {{-- <div id="floatingBarsG" class="overlay">

       <div class="blockG" id="rotateG_01"></div>
        <div class="blockG" id="rotateG_02"></div>
        <div class="blockG" id="rotateG_03"></div>
        <div class="blockG" id="rotateG_04"></div>
        <div class="blockG" id="rotateG_05"></div>
        <div class="blockG" id="rotateG_06"></div>
        <div class="blockG" id="rotateG_07"></div>
        <div class="blockG" id="rotateG_08"></div>
    </div> --}}

    {{-- loader --}}
    {{-- <style type="text/css">
        #floatingBarsG{
        position:absolute;
        top:50%;
        left:50%;
        transform:translate(-50%, -50%);
            width:60px;
            height:75px;
            margin:auto;
        }

        .blockG{
            position:absolute;
            background-color:rgb(255,255,255);
            width:10px;
            height:23px;
            border-radius:8px 8px 0 0;
                -o-border-radius:8px 8px 0 0;
                -ms-border-radius:8px 8px 0 0;
                -webkit-border-radius:8px 8px 0 0;
                -moz-border-radius:8px 8px 0 0;
            transform:scale(0.4);
                -o-transform:scale(0.4);
                -ms-transform:scale(0.4);
                -webkit-transform:scale(0.4);
                -moz-transform:scale(0.4);
            animation-name:fadeG;
                -o-animation-name:fadeG;
                -ms-animation-name:fadeG;
                -webkit-animation-name:fadeG;
                -moz-animation-name:fadeG;
            animation-duration:0.832s;
                -o-animation-duration:0.832s;
                -ms-animation-duration:0.832s;
                -webkit-animation-duration:0.832s;
                -moz-animation-duration:0.832s;
            animation-iteration-count:infinite;
                -o-animation-iteration-count:infinite;
                -ms-animation-iteration-count:infinite;
                -webkit-animation-iteration-count:infinite;
                -moz-animation-iteration-count:infinite;
            animation-direction:normal;
                -o-animation-direction:normal;
                -ms-animation-direction:normal;
                -webkit-animation-direction:normal;
                -moz-animation-direction:normal;
        }

        #rotateG_01{
            left:0;
            top:27px;
            animation-delay:0.3095s;
                -o-animation-delay:0.3095s;
                -ms-animation-delay:0.3095s;
                -webkit-animation-delay:0.3095s;
                -moz-animation-delay:0.3095s;
            transform:rotate(-90deg);
                -o-transform:rotate(-90deg);
                -ms-transform:rotate(-90deg);
                -webkit-transform:rotate(-90deg);
                -moz-transform:rotate(-90deg);
        }

        #rotateG_02{
            left:8px;
            top:10px;
            animation-delay:0.416s;
                -o-animation-delay:0.416s;
                -ms-animation-delay:0.416s;
                -webkit-animation-delay:0.416s;
                -moz-animation-delay:0.416s;
            transform:rotate(-45deg);
                -o-transform:rotate(-45deg);
                -ms-transform:rotate(-45deg);
                -webkit-transform:rotate(-45deg);
                -moz-transform:rotate(-45deg);
        }

        #rotateG_03{
            left:25px;
            top:3px;
            animation-delay:0.5225s;
                -o-animation-delay:0.5225s;
                -ms-animation-delay:0.5225s;
                -webkit-animation-delay:0.5225s;
                -moz-animation-delay:0.5225s;
            transform:rotate(0deg);
                -o-transform:rotate(0deg);
                -ms-transform:rotate(0deg);
                -webkit-transform:rotate(0deg);
                -moz-transform:rotate(0deg);
        }

        #rotateG_04{
            right:8px;
            top:10px;
            animation-delay:0.619s;
                -o-animation-delay:0.619s;
                -ms-animation-delay:0.619s;
                -webkit-animation-delay:0.619s;
                -moz-animation-delay:0.619s;
            transform:rotate(45deg);
                -o-transform:rotate(45deg);
                -ms-transform:rotate(45deg);
                -webkit-transform:rotate(45deg);
                -moz-transform:rotate(45deg);
        }

        #rotateG_05{
            right:0;
            top:27px;
            animation-delay:0.7255s;
                -o-animation-delay:0.7255s;
                -ms-animation-delay:0.7255s;
                -webkit-animation-delay:0.7255s;
                -moz-animation-delay:0.7255s;
            transform:rotate(90deg);
                -o-transform:rotate(90deg);
                -ms-transform:rotate(90deg);
                -webkit-transform:rotate(90deg);
                -moz-transform:rotate(90deg);
        }

        #rotateG_06{
            right:8px;
            bottom:7px;
            animation-delay:0.832s;
                -o-animation-delay:0.832s;
                -ms-animation-delay:0.832s;
                -webkit-animation-delay:0.832s;
                -moz-animation-delay:0.832s;
            transform:rotate(135deg);
                -o-transform:rotate(135deg);
                -ms-transform:rotate(135deg);
                -webkit-transform:rotate(135deg);
                -moz-transform:rotate(135deg);
        }

        #rotateG_07{
            bottom:0;
            left:25px;
            animation-delay:0.9385s;
                -o-animation-delay:0.9385s;
                -ms-animation-delay:0.9385s;
                -webkit-animation-delay:0.9385s;
                -moz-animation-delay:0.9385s;
            transform:rotate(180deg);
                -o-transform:rotate(180deg);
                -ms-transform:rotate(180deg);
                -webkit-transform:rotate(180deg);
                -moz-transform:rotate(180deg);
        }

        #rotateG_08{
            left:8px;
            bottom:7px;
            animation-delay:1.035s;
                -o-animation-delay:1.035s;
                -ms-animation-delay:1.035s;
                -webkit-animation-delay:1.035s;
                -moz-animation-delay:1.035s;
            transform:rotate(-135deg);
                -o-transform:rotate(-135deg);
                -ms-transform:rotate(-135deg);
                -webkit-transform:rotate(-135deg);
                -moz-transform:rotate(-135deg);
        }



        @keyframes fadeG{
            0%{
                background-color:rgb(0,0,0);
            }

            100%{
                background-color:rgb(255,255,255);
            }
        }

        @-o-keyframes fadeG{
            0%{
                background-color:rgb(0,0,0);
            }

            100%{
                background-color:rgb(255,255,255);
            }
        }

        @-ms-keyframes fadeG{
            0%{
                background-color:rgb(0,0,0);
            }

            100%{
                background-color:rgb(255,255,255);
            }
        }

        @-webkit-keyframes fadeG{
            0%{
                background-color:rgb(0,0,0);
            }

            100%{
                background-color:rgb(255,255,255);
            }
        }

        @-moz-keyframes fadeG{
            0%{
                background-color:rgb(0,0,0);
            }

            100%{
                background-color:rgb(255,255,255);
            }
        }
    </style> --}}

    {{-- <style>
        .wrapper{
      position: absolute;
      top: 50%;
      left: 50%;
      width: 300px;
      text-align:center;
      transform: translateX(-50%);
    }

    .spanner{
      position:absolute;
      top: 50%;
      left: 0;
      background: #2a2a2a55;
      width: 100%;
      display:block;
      text-align:center;
      height: 300px;
      color: #FFF;
      transform: translateY(-50%);
      z-index: 1000;
      visibility: hidden;
    }

    .overlay{
      position: fixed;
     width: 100%;
     height: 100%;
      background: rgba(0,0,0,0.5);
      visibility: hidden;
    }

    .loader,
    .loader:before,
    .loader:after {
      border-radius: 50%;
      width: 2.5em;
      height: 2.5em;
      -webkit-animation-fill-mode: both;
      animation-fill-mode: both;
      -webkit-animation: load7 1.8s infinite ease-in-out;
      animation: load7 1.8s infinite ease-in-out;
    }
    .loader {
      color: #ffffff;
      font-size: 10px;
      margin: 80px auto;
      position: relative;
      text-indent: -9999em;
      -webkit-transform: translateZ(0);
      -ms-transform: translateZ(0);
      transform: translateZ(0);
      -webkit-animation-delay: -0.16s;
      animation-delay: -0.16s;
    }
    .loader:before,
    .loader:after {
      content: '';
      position: absolute;
      top: 0;
    }
    .loader:before {
      left: -3.5em;
      -webkit-animation-delay: -0.32s;
      animation-delay: -0.32s;
    }
    .loader:after {
      left: 3.5em;
    }
    @-webkit-keyframes load7 {
      0%,
      80%,
      100% {
        box-shadow: 0 2.5em 0 -1.3em;
      }
      40% {
        box-shadow: 0 2.5em 0 0;
      }
    }
    @keyframes load7 {
      0%,
      80%,
      100% {
        box-shadow: 0 2.5em 0 -1.3em;
      }
      40% {
        box-shadow: 0 2.5em 0 0;
      }
    }

    .show{
      visibility: visible;
    }

    .spanner, .overlay{
     opacity: 0;
     -webkit-transition: all 0.3s;
     -moz-transition: all 0.3s;
     transition: all 0.3s;
    }

    .spanner.show, .overlay.show {
     opacity: 1
    }
        </style> --}}
@endsection
