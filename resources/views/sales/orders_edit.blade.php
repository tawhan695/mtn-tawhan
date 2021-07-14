@extends('sales.layouts.app')
@section('javascript')
     
@endsection
@section('content')

<div class="container">
    <div class="pt-4">
        <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">คืนสินค้า</h3>
            </div>
            <div class="card-body">
                
                <div  style="display: block;"><div class="row float-left">
                    <div class="col-sm-3 col-12">
                        <div class="row">
                            <div class="col-12">เลขที่ใบสั่งชื้อ : {{ $order->id}}</div>
                            <div class="col-12">วันที่ : {{ $order->created_at}} </div>
                        </div>
                    </div>
                    <div class="col-sm-3 col-12">
                        <div class="row">
                            <div class="col-12">ชำระโดย</div>
                            <div class="col-12">{{ $order->paid_by}}</div>
                        </div>
                    </div>
                    <div class="col-sm-3 col-12">
                        <div class="row">
                            <div class="col-12">พนักงาน</div>
                            <div class="col-12">{{auth()->user()->find($order->user_id)->name}}</div>
                        </div>
                    </div>
                    <div class="col-sm-3 col-12">
                        <div class="row">
                            <div class="col-12">ลูกค้า</div>
                            <div class="col-12">ทั่วไป</div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                    <th style="width: 10px">#</th>
                    <th>ชื่อสินค้า</th>
                    <th>ราคา</th>
                    <th>จำนวน/หน่วย</th>
                    <th>ราคารวม</th>
                    <th>ตัวเลือก</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach ($details as $item)
                        <tr>
                            <td style="width: 1px">{{ $loop->index+1}}</td>
                            <td style="width: 1px">{{ $item->name}}</td>
                            <td style="width: 1px">{{  number_format( $item->price, 2, '.', ',') }}</td>
                            <td style="width: 1px">{{$item->qty}}</td>
                            <td style="width: 1px">{{  number_format( (floatval($item->price) * intval($item->qty)), 2, '.', ',') }}</td>
                            <td style="width: 1px">
                                <button type="button" class="btn btn-outline-primary" onclick="al2{{$item->id}}()">แก้ไข</button>
                                <button type="button" class="btn btn-outline-danger" onclick="del{{$item->id}}()">ลบ</button>
                            </td>
                            <script>
                                function del{{$item->id}}() {
                                                $('#form-update').append('<input type="hidden" name="idd"  value="{{$item->id}}">');
                                                $('#form-update').append('<input type="hidden" name="qty"  value="0">');
                                                $('#form-update').submit();
                                }
                                function al2{{$item->id}}(){
                                    Swal.fire({
                                        title: 'แก้ไขจำนวนสินค้า',
                                        input: 'number',
                                        inputLabel: 'จำนวน',
                                        inputValue:{{$item->qty}},
                                        inputAttributes: {
                                            min: 0,
                                            max: {{$item->qty}},
                                            step: 1,
                                            pattern: "[0-9]{10}"
                                        },
                                        inputValidator: (value) => {
                                            if (value > {{$item->qty}}) {
                                                return 'จำนวนสินค้าเกินจำนวนที่มีอยู่'
                                            }
                                            else if(value < 0) {
                                                return 'ไม่สามารถใส่ค่าติดลบได้'
                                            }
                                            else if(value == {{$item->qty}}) {
                                                return 'ค่าเท่าเดิมไม่สามารถเปลี่ยนแปลงได้'
                                            }
                                            else{
                                                $('#form-update').append('<input type="hidden" name="idd"  value="{{$item->id}}">');
                                                $('#form-update').append('<input type="hidden" name="qty"  value="'+value+'">');
                                                $('#form-update').submit();
                                            }
                                           
                                        },
                                        inputPlaceholder: '{{$item->qty}}'
                                    })

                                }
                               
                            </script>
                        </tr>
                        @endforeach 
                        <style> tr.noBorder td {border: 0;}
                        </style>
                        <tr class="">
                            
                            <td style="width: 1px"></td>
                            <td style="width: 1px"></td>
                            <td style="width: 1px"></td>
                            <td style="width: 1px">รวม</td>
                            <td style="width: 1px">{{  number_format( $order->cash_totol, 2, '.', ',') }}</td>  
                            <td style="width: 1px"></td>
                        </tr>
                        <tr class="noBorder">
                            <td style="width: 1px"></td>
                            <td style="width: 1px"></td>
                            <td style="width: 1px"></td>
                            <td style="width: 1px">ส่วนลด</td>
                            <td style="width: 1px">{{  number_format( $order->discount, 2, '.', ',') }}</td>  
                            <td style="width: 1px"></td>
                        </tr>
                        <tr class="noBorder">
                            <td style="width: 1px"></td>
                            <td style="width: 1px"></td>
                            <td style="width: 1px"></td>
                            <td style="width: 1px">ยอดสุทธิ</td>
                            <td style="width: 1px">{{  number_format( $order->net_amount, 2, '.', ',') }}</td> 
                            <td style="width: 1px"></td>
                        </tr>                          
                </tbody>
                </table>
                </div>
                    
                </div>
                <form id="form-update" action="{{Route('return.update',0)}}" method="post">
                    @csrf
                    @method('put')
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function mySearch(){
        var input = $('#mInput').val();
        $('#list').empty();
        // console.log(input.length);
        if (input.length > 0) {
            $.ajax({
            type:'POST',
            url:'{{ url('sale/transection')}}',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{
                "_token": "{{ csrf_token() }}",
                'id': input,
            },
            success:function(data){
                // console.log(data);
                $('#list').empty();
                data['data'].forEach((e,index) => {
                    // console.log(index+1);
                    todate= new Date(e.created_at)
                    let dd = todate.getDate();
                    let mm = todate.getMonth(); 
                    const yyyy = todate.getFullYear();
                    var date = yyyy+'/'+mm+'/'+dd+ '  '+todate.getHours()+':'+todate.getMinutes();
                    $('#list').append(
                        `<tr><td>`+(index+=1)+`</td>
                        <td>`+e.id+`</td>
                        <td>`+date +`</td>
                        <td>`+e.status +`</td>
                              </tr>
                    `);
                });
                }
            });
        }else{
            $('#list').empty();
        } 
    }    
</script>  


    




@endsection