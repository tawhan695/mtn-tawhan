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
                <p>เลขที่ใบสั่งชื้อ</p>
                <div class="input-group mb-3">
                    <!-- /btn-group -->
                    <input type="text" id="mInput" onkeyup="mySearch()" class="form-control" placeholder="กรุณาใส่เลขที่ใบสั่งชื้อ">
                    <span class="input-group-prepend">
                        {{-- <button type="button" class="btn btn-danger btn-flaot ">ค้นหา</button> --}}
                    </span>
                </div>
                <div>
                    <div class="card">
                        {{-- <div class="card-header">
                          <h3 class="card-title"></h3>
                        </div> --}}
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th style="width: 10px">#</th>
                                <th>เลขที่ใบสั่งชื้อ</th>
                                <th>วันเดือนปี เวลา</th>
                                <th style="width: 40px">สถานะ</th>
                              </tr>
                            </thead>
                            <tbody id="list">
                            </tbody>
                          </table>
                        </div>
                        <!-- /.card-body -->
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function edit(id){
        console.log('post: id {{url('return')}}/',id);
        window.location.href ='{{url('return')}}/'+id+'/edit?id='+id;
    }
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
                        `<tr onclick="edit(`+e.id+`)"><td>`+(index+=1)+`</td>
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