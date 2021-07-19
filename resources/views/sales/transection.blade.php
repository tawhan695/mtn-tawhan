@extends('sales.layouts.app')
@section('javascript')
    <script src="{{ asset('js/transection.js') }}" defer></script>    
@endsection
@section('content')

<style>
    @media  screen and (min-width: 600px) {
        .swal2-content {
    text-align: left;
  }
}
</style>

<div class="container">
    <div class="pt-4">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">ประวัติการขาย</h3>

          <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

              <div class="input-group-append">
                <button type="submit" class="btn btn-default">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
        
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th style="width: 10px">เลขที่คำสั่งชื้อ</th>
                <th>รายการ</th>
                <th>วันที่</th>
                <th>ส่วนลด</th>
                <th>รวมทั้งสิ้น</th>
                <th>ชำระโดย</th>
                <th>สถานะ</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($order as $item)       
                    <tr onclick="showdetails{{$item->id}}()">
                    {{-- <td>{{ $item->id}}</td>
                    <td>{{ $item->id}}</td> --}}
                    <td style="width: 1px">{{ $item->id}}</td>
                    <td style="width: 1px">{{ App\Models\Order_Details::where('order_id',$item->id)->count()}} รายการ</td>
                    <td style="width: 1px">{{ $item->created_at}}</td>
                    <td style="width: 1px">{{ $item->discount}}</td>
                    {{-- <td>{{ money_format('฿%i', $item->cash_totol)}}</td> --}}
                    <td style="width: 1px">{{  number_format( $item->net_amount, 2, '.', ',') }}</td>
                    <td style="width: 1px">{{ $item->paid_by}}</td>
                    <td style="width: 1px">{{ $item->status}}</td>
                    </tr>

                    <script>
                        var re{{$item->id}} = 
                        `
                        <div class="row float-left">
                        <div class="col-sm-3 col-12">
                            <div class="row">
                                <div class="col-12">เลขที่ใบสั่งชื้อ : {{ $item->id}}</div>
                                <div class="col-12">วันที่ : {{ $item->created_at}} </div>
                            </div>
                        </div>
                        <div class="col-sm-3 col-12">
                            <div class="row">
                                <div class="col-12">ชำระโดย</div>
                                <div class="col-12">{{ $item->paid_by}}</div>
                            </div>
                        </div>
                        <div class="col-sm-3 col-12">
                            <div class="row">
                                <div class="col-12">พนักงาน</div>
                                <div class="col-12">{{ App\Models\User::where('id',$item->user_id)->first()->name}}</div>
                            </div>
                        </div>
                        <div class="col-sm-3 col-12">
                            <div class="row">
                                <div class="col-12">ลูกค้า</div>
                                <div class="col-12"> ทั่วไป </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                        <th style="width: 10px">รหัสสินค้า</th>
                        <th>ชื่อสินค้า</th>
                        <th>ราคา</th>
                        <th>จำนวน/หน่วย</th>
                        <th>ราคารวม</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $order_details = App\Models\Order_Details::join('products','products.id','=','order__details.product_id')->where('order_id',$item->id)->select('products.unit', 'order__details.*')->get();
                           
                            @endphp
                        @foreach ($order_details as $i)       
                            <tr>
                                <td style="width: 1px">{{ $i->id}}</td>
                                <td style="width: 1px">{{ $i->name}}</td>
                                <td style="width: 1px">฿ {{ number_format( $i->price, 2, '.', ',')}}</td>
                                <td style="width: 1px">{{ $i->qty .'/'.$i->unit }}</td>
                                <td style="width: 1px">฿ {{ number_format( $i->totol, 2, '.', ',')}}</td>
                            </tr>
                            
                            @endforeach
                            <style>
                                tr.noBorder td {
                                    border: 0;
                                }
                            </style>
                            <tr class="">
                                <td style="width: 1px"></td>
                                <td style="width: 1px"></td>
                                <td style="width: 1px"></td>
                                <td style="width: 1px">รวม</td>
                                <td style="width: 1px">฿ {{number_format( $item->cash_totol , 2, '.', ',')}}</td>  
                            </tr>
                            <tr class="noBorder">
                                <td style="width: 1px"></td>
                                <td style="width: 1px"></td>
                                <td style="width: 1px"></td>
                                <td style="width: 1px">ส่วนลด</td>
                                <td style="width: 1px">฿ {{number_format( $item->discount, 2, '.', ',')}}</td>  
                            </tr>
                            <tr class="noBorder">
                                <td style="width: 1px"></td>
                                <td style="width: 1px"></td>
                                <td style="width: 1px"></td>
                                <td style="width: 1px">ยอดสุทธิ</td>
                                <td style="width: 1px">฿ {{number_format($item->net_amount , 2, '.', ',')}}</td> 
                            </tr>
                        
                    </tbody>
                    </table>
                    </div>
                        
                        `;
                        
                        function showdetails{{$item->id}}() {
                            Swal.fire({
                                title: '',
                                // icon: 'info',
                                width:1000,
                                html:re{{$item->id}},
                                showCloseButton: true,
                                focusConfirm: false,
                                showConfirmButton: false,
                            })
                        }
                    </script>
                @endforeach
              
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-left">
                ทั้งหมด {{ $order->total() }} รายการ
            </ul>
            <ul class="pagination pagination-sm m-0 float-right">
                {{ $order->onEachSide(5)->links("pagination::bootstrap-4")}}
            </ul>
          </div>
        </div>
      </div>
      <!-- /.card -->
    </div>
    




@endsection