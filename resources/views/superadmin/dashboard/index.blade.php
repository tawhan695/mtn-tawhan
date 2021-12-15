{{-- @extends('admin.layouts.app') --}}
{{-- @section('javascript')

@endsection
@section('content')
     <section class="content">
        <div class="container-fluid pt-4">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <p>{{ $Order }}</p>

                            <p>ยอดขายวันนี้</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{ route('transection.index') }}" class="small-box-footer">ดูเพิ่มเติม..<i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <p>{{ number_format($ordersum, 2, '.', ',') }}</p>

                            <p>กำไรวันนี้</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">ดูเพิ่มเติม..<i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <p>{{ number_format(App\Models\Wallet::where('branch_id', Auth::user()->branch_id())->first()->balance, 2, '.', ',') }}
                            </p>

                            <p>เงินในกระเป๋า</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">ดูเพิ่มเติม..<i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <p>{{ $Defective }}</p>

                            <p>สินค้าชำรุดวันนี้</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="{{ route('defective.index') }}" class="small-box-footer">ดูเพิ่มเติม.. <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header border-transparent bg-success">
                            <h3 class="card-title">ยอดขายวันนี้</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0" id="product_table_dat">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>รูปสินค้า</th>
                                            <th>สินค้า</th>
                                            <th>ยอยขายปลีก</th>
                                            <th>ยอดเงิน (ขายปลีก)</th>
                                            <th>ยอดขายส่ง</th>
                                            <th>ยอดเงิน (ขายส่ง)</th>
                                            <th>ยอดขายรวม</th>
                                            <th>ยอดเงินขายรวม</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($product as $item)
                                            <tr>
                                                <td>{{ $loop->index++ }}</td>
                                                <td><img style="width: 60px" src="{{ asset($item->image) }}" alt="{{ $item->name }}"></td>
                                                <td>{{ $item->name }}</td>

                                                @php
                                                    $qty_1 = 0;
                                                    $price_1 = 0;
                                                    $qty_2 = 0;
                                                    $price_2 = 0;
                                                    $det = App\Models\Order_Details::where('product_id', $item->id)
                                                        ->where('created_at', 'like', '%' . date('Y-m-d') . '%')
                                                        // ->where('created_at', 'like', '%2021-11-14%')
                                                        // ->where('branch_id',auth()->user()->branch_id())
                                                        ->with(['order'])
                                                        ->get();
                                                        // print_r( date('Y-m-d'));
                                                        foreach ($det as $item2) {
                                                        // print_r( $item2->order->created_at);
                                                        $DATE =    Str::substr($item2->order->created_at, 0, 10);
                                                        // echo "$DATE";
                                                        if ($item2->order->status_sale == 'ขายปลีก' && $DATE == "".date('Y-m-d')) {
                                                            $price_1 += $item->retail_price * $item2->qty;
                                                            $qty_1 += $item2->qty;
                                                        } else if ($item2->order->status_sale == 'ขายส่ง' && $DATE == "".date('Y-m-d')) {
                                                            $price_2 += $item->wholesale_price * $item2->qty;
                                                            $qty_2 += $item2->qty;
                                                        }
                                                    }
                                                    echo '<td>' . $qty_1 . '</td>';
                                                    echo '<td>' . $price_1 . '</td>';
                                                    echo '<td>' . $qty_2 . '</td>';
                                                    echo '<td>' . $price_2 . '</td>';

                                                    //    print_r($det);

                                                @endphp
                                                <td>{{ App\Models\Order_Details::where('product_id', $item->id)->where('created_at', 'like', '%' . date('Y-m-d') . '%')->sum('qty') }}
                                                </td>
                                                <td>{{ App\Models\Order_Details::where('product_id', $item->id)->where('created_at', 'like', '%' . date('Y-m-d') . '%')->sum('totol') }}
                                                </td>


                                            </tr>
                                        @endforeach
                                        <tr class="bg-success">
                                            <td></td>
                                            <td></td>
                                            <td>รวม</td>
                                            <td id="sum_day1"></td>
                                            <td id="sum_day2"></td>
                                            <td id="sum_day3"></td>
                                            <td id="sum_day4"></td>
                                            <td id="sum_day5"></td>
                                            <td id="sum_day6"></td>
                                        </tr>
                                        <script>
                                            var table = document.getElementById("product_table_dat"),
                                            sum_dayVal_day1 = 0;
                                            sum_dayVal_day2 = 0;
                                            sum_dayVal_day3 = 0;
                                            sum_dayVal_day4 = 0;
                                            sum_dayVal_day5 = 0;
                                            sum_dayVal_day6 = 0;
                                            for (var i = 1; i < table.rows.length; i++) {
                                                // console.log(table.rows[i].cells[2].innerHTML);
                                                if (table.rows[i].cells[3].innerHTML != 0) sum_dayVal_day1 = sum_dayVal_day1 + parseFloat(table.rows[i].cells[3]
                                                    .innerHTML);
                                                if (table.rows[i].cells[4].innerHTML != 0) sum_dayVal_day2 = sum_dayVal_day2 + parseFloat(table.rows[i].cells[4]
                                                    .innerHTML);
                                                if (table.rows[i].cells[5].innerHTML != 0) sum_dayVal_day3 = sum_dayVal_day3 + parseFloat(table.rows[i].cells[5]
                                                    .innerHTML);
                                                if (table.rows[i].cells[6].innerHTML != 0) sum_dayVal_day4 = sum_dayVal_day4 + parseFloat(table.rows[i].cells[6]
                                                    .innerHTML);
                                                if (table.rows[i].cells[7].innerHTML != 0) sum_dayVal_day5 = sum_dayVal_day5 + parseFloat(table.rows[i].cells[7]
                                                    .innerHTML);
                                                if (table.rows[i].cells[8].innerHTML != 0) sum_dayVal_day6 = sum_dayVal_day6 + parseFloat(table.rows[i].cells[8]
                                                    .innerHTML);
                                            }
                                            // console.log("product_table" ,sum_dayVal_day);
                                            // console.log(subTotal);
                                            document.getElementById("sum_day1").innerHTML = "" + sum_dayVal_day1;
                                            document.getElementById("sum_day2").innerHTML = "" + sum_dayVal_day2;
                                            document.getElementById("sum_day3").innerHTML = "" + sum_dayVal_day3;
                                            document.getElementById("sum_day4").innerHTML = "" + sum_dayVal_day4;
                                            document.getElementById("sum_day5").innerHTML = "" + sum_dayVal_day5;
                                            document.getElementById("sum_day6").innerHTML = "" + sum_dayVal_day6;
                                        </script>


                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header border-transparent bg-info ">
                            <h3 class="card-title">ยอดขายประจำเดือน</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0" id="product_table_m">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>รูปสินค้า</th>
                                            <th>สินค้า</th>
                                            <th>ยอยขายปลีก</th>
                                            <th>ยอดเงิน (ขายปลีก)</th>
                                            <th>ยอดขายส่ง</th>
                                            <th>ยอดเงิน (ขายส่ง)</th>
                                            <th>ยอดขายรวม</th>
                                            <th>ยอดเงินขายรวม</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product as $item)
                                            <tr>
                                                <td>{{ $loop->index++ }}</td>
                                                <td><img style="width: 60px" src="{{ asset($item->image) }}" alt="{{ $item->name }}"></td>
                                                <td>{{ $item->name }}</td>

                                                @php
                                                    $qty_1 = 0;
                                                    $price_1 = 0;
                                                    $qty_2 = 0;
                                                    $price_2 = 0;
                                                    $det = App\Models\Order_Details::where('product_id', $item->id)
                                                    ->where('created_at', 'like', '%' . date('Y-m') . '%')
                                                    ->with(['order'])
                                                        ->get();
                                                    // print_r($det);
                                                    foreach ($det as $item2) {
                                                        if ($item2->order->status_sale == 'ขายปลีก') {
                                                            $price_1 += $item->retail_price * $item2->qty;
                                                            $qty_1 += $item2->qty;
                                                        } else {
                                                            $price_2 += $item->wholesale_price * $item2->qty;
                                                            $qty_2 += $item2->qty;
                                                        }
                                                    }
                                                    echo '<td>' . $qty_1 . '</td>';
                                                    echo '<td>' . $price_1 . '</td>';
                                                    echo '<td>' . $qty_2 . '</td>';
                                                    echo '<td>' . $price_2 . '</td>';

                                                    //    print_r($det);

                                                @endphp
                                                <td>{{ App\Models\Order_Details::where('product_id', $item->id)->where('created_at', 'like', '%' . date('Y-m') . '%')->sum('qty') }}
                                                </td>
                                                <td>{{ App\Models\Order_Details::where('product_id', $item->id)->where('created_at', 'like', '%' . date('Y-m') . '%')->sum('totol') }}
                                                </td>


                                            </tr>

                                        @endforeach
                                        <tr class="bg-info">
                                            <td></td>
                                            <td></td>
                                            <td>รวม</td>
                                            <td id="sum_m1"></td>
                                            <td id="sum_m2"></td>
                                            <td id="sum_m3"></td>
                                            <td id="sum_m4"></td>
                                            <td id="sum_m5"></td>
                                            <td id="sum_m6"></td>
                                        </tr>

                                    </tbody>
                                </table>
                                <script>
                                    var table = document.getElementById("product_table_m"),
                                        sumVal_m1 = 0;
                                    sumVal_m2 = 0;
                                    sumVal_m3 = 0;
                                    sumVal_m4 = 0;
                                    sumVal_m5 = 0;
                                    sumVal_m6 = 0;
                                    for (var i = 1; i < table.rows.length; i++) {
                                        // console.log(table.rows[i].cells[2].innerHTML);
                                        if (table.rows[i].cells[3].innerHTML != 0) sumVal_m1 = sumVal_m1 + parseFloat(table.rows[i].cells[3].innerHTML);
                                        if (table.rows[i].cells[4].innerHTML != 0) sumVal_m2 = sumVal_m2 + parseFloat(table.rows[i].cells[4].innerHTML);
                                        if (table.rows[i].cells[5].innerHTML != 0) sumVal_m3 = sumVal_m3 + parseFloat(table.rows[i].cells[5].innerHTML);
                                        if (table.rows[i].cells[6].innerHTML != 0) sumVal_m4 = sumVal_m4 + parseFloat(table.rows[i].cells[6].innerHTML);
                                        if (table.rows[i].cells[7].innerHTML != 0) sumVal_m5 = sumVal_m5 + parseFloat(table.rows[i].cells[7].innerHTML);
                                        if (table.rows[i].cells[8].innerHTML != 0) sumVal_m6 = sumVal_m6 + parseFloat(table.rows[i].cells[8].innerHTML);
                                    }
                                    // console.log("product_table" ,sumVal_m);
                                    // console.log(subTotal);
                                    document.getElementById("sum_m1").innerHTML = "" + sumVal_m1;
                                    document.getElementById("sum_m2").innerHTML = "" + sumVal_m2;
                                    document.getElementById("sum_m3").innerHTML = "" + sumVal_m3;
                                    document.getElementById("sum_m4").innerHTML = "" + sumVal_m4;
                                    document.getElementById("sum_m5").innerHTML = "" + sumVal_m5;
                                    document.getElementById("sum_m6").innerHTML = "" + sumVal_m6;
                                </script>
                            </div>
                            <!-- /.table-responsive -->
                        </div>

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header border-transparent bg-warning ">
                            <h3 class="card-title">ยอดขายทั้งหมด</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0" id="product_table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>รูปสินค้า</th>
                                            <th>สินค้า</th>
                                            <th>ยอยขายปลีก</th>
                                            <th>ยอดเงิน (ขายปลีก)</th>
                                            <th>ยอดขายส่ง</th>
                                            <th>ยอดเงิน (ขายส่ง)</th>
                                            <th>ยอดขายรวม</th>
                                            <th>ยอดเงินขายรวม</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product as $item)
                                            <tr>
                                                <td>{{ $loop->index++ }}</td>
                                                <td><img style="width: 60px" src="{{ asset($item->image) }}" alt="{{ $item->name }}"></td>
                                                <td>{{ $item->name }}</td>

                                                @php
                                                    $qty_1 = 0;
                                                    $price_1 = 0;
                                                    $qty_2 = 0;
                                                    $price_2 = 0;
                                                    $det = App\Models\Order_Details::where('product_id', $item->id)
                                                    ->where('created_at', 'like', '%' . date('Y') . '%')
                                                        ->with(['order'])
                                                        ->get();
                                                    foreach ($det as $item2) {
                                                        if ($item2->order->status_sale == 'ขายปลีก') {
                                                            $price_1 += $item->retail_price * $item2->qty;
                                                            $qty_1 += $item2->qty;
                                                        } else {
                                                            $price_2 += $item->wholesale_price * $item2->qty;
                                                            $qty_2 += $item2->qty;
                                                        }
                                                    }
                                                    echo '<td>' . $qty_1 . '</td>';
                                                    echo '<td>' . $price_1 . '</td>';
                                                    echo '<td>' . $qty_2 . '</td>';
                                                    echo '<td>' . $price_2 . '</td>';

                                                    //    print_r($det);

                                                @endphp
                                                <td>{{ App\Models\Order_Details::where('product_id', $item->id)->where('created_at', 'like', '%' . date('Y') . '%')->sum('qty') }}
                                                </td>
                                                <td>{{ App\Models\Order_Details::where('product_id', $item->id)->where('created_at', 'like', '%' . date('Y') . '%')->sum('totol') }}
                                                </td>


                                            </tr>

                                        @endforeach
                                        <tr class="bg-warning">
                                            <td></td>
                                            <td></td>
                                            <td>รวม</td>
                                            <td id="sum1"></td>
                                            <td id="sum2"></td>
                                            <td id="sum3"></td>
                                            <td id="sum4"></td>
                                            <td id="sum5"></td>
                                            <td id="sum6"></td>
                                        </tr>

                                    </tbody>
                                </table>
                                <script>
                                    var table = document.getElementById("product_table"),
                                        sumVal1 = 0;
                                    sumVal2 = 0;
                                    sumVal3 = 0;
                                    sumVal4 = 0;
                                    sumVal5 = 0;
                                    sumVal6 = 0;
                                    for (var i = 1; i < table.rows.length; i++) {
                                        // console.log(table.rows[i].cells[2].innerHTML);
                                        if (table.rows[i].cells[3].innerHTML != 0) sumVal1 = sumVal1 + parseFloat(table.rows[i].cells[3].innerHTML);
                                        if (table.rows[i].cells[4].innerHTML != 0) sumVal2 = sumVal2 + parseFloat(table.rows[i].cells[4].innerHTML);
                                        if (table.rows[i].cells[5].innerHTML != 0) sumVal3 = sumVal3 + parseFloat(table.rows[i].cells[5].innerHTML);
                                        if (table.rows[i].cells[6].innerHTML != 0) sumVal4 = sumVal4 + parseFloat(table.rows[i].cells[6].innerHTML);
                                        if (table.rows[i].cells[7].innerHTML != 0) sumVal5 = sumVal5 + parseFloat(table.rows[i].cells[7].innerHTML);
                                        if (table.rows[i].cells[8].innerHTML != 0) sumVal6 = sumVal6 + parseFloat(table.rows[i].cells[8].innerHTML);
                                    }
                                    // console.log("product_table" ,sumVal);
                                    // console.log(subTotal);
                                    document.getElementById("sum1").innerHTML = "" + sumVal1;
                                    document.getElementById("sum2").innerHTML = "" + sumVal2;
                                    document.getElementById("sum3").innerHTML = "" + sumVal3;
                                    document.getElementById("sum4").innerHTML = "" + sumVal4;
                                    document.getElementById("sum5").innerHTML = "" + sumVal5;
                                    document.getElementById("sum6").innerHTML = "" + sumVal6;
                                </script>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection --}}
