@extends('admin.layouts.app')
@section('javascript')
     
@endsection
@section('content')
<section class="content">
    <div class="container pt-4">
      <div class="card">
        <div class="card-header">
          {{-- <h3 class="card-title">รายกรสินค้า</h3> --}}
          <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link active" href="#list" id="LList" data-toggle="tab">รายกรประเภทสินค้า</a></li>
            <li class="nav-item"><a class="nav-link" href="#add" data-toggle="tab">เพิ่มประเภทสินค้า</a></li>
          </ul>

          
        </div>
        <div class="tab-content">
          <div class="tab-pane active" id="list">
            <!-- /.card-header -->
              <div class="card-body table-responsive p-0" id="list">
                <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>ชื่อประเภท</th>
                    {{-- <th>สินค้า</th>
                    <th>จำนวน</th>
                    <th>ราคา</th>
                    <th>หมวดหมู่</th> --}}
                    <th style="width: 150px">จัดการ</th>
                    
                  </tr>
                </thead>
                <tbody>
                    @foreach ($catagory as $item)       
                        <tr>
                        <td>{{ ($loop->index)+1}}</td>
                        {{-- <td style="width: 80px"><img width="100%" src="{{ $item->image}}" alt="{{$item->name}}"></td> --}}
                        <td style="width: 1px">{{ $item->name}}</td>
                        {{-- <td style="width: 1px">@if ($item->qty > 0) {{$item->qty}}@else <span class="badge bg-danger">สินค้าหมด</span> @endif</td> --}}
                        {{-- <td style="width: 1px">{{  number_format( $item->legular_price, 2, '.', ',') }}</td> --}}
                        {{-- <td style="width: 1px">{{ App\Models\Catagory::where('id',$item->catagory_id)->first()->name}}</td> --}}
                        <td style="width: 1px;hieght: 20px">
                          <div class="row">
                            <button class="btn btn-success mr-1">แก้ไข</button>
                            <form action="{{route('catagory.destroy',$item->id)}}" method="post">
                              {{ csrf_field() }}
                              {{ method_field('DELETE') }}
                              <button type="submit" class="btn btn-danger">ลบ</button>
                            </form>
                          </div>
                        </td>
                        </tr>
                    @endforeach
                  
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-left">
                    ทั้งหมด {{ $catagory->total() }} รายการ
                </ul>
                <ul class="pagination pagination-sm m-0 float-right">
                    {{ $catagory->onEachSide(5)->links("pagination::bootstrap-4")}}
                </ul>
            </div>
          </div>
          <div class="tab-pane" id="add">
            <div class="card card-info m-2">
             
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="{{ route('catagory.store')}}" method="POST">
                @csrf
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputcatagory" class="col-sm-2 col-form-label">ชื่อประเภทสินค้า</label>
                    <div class="col-sm-10">
                      <input type="catagory" name="catagory" class="form-control" id="inputcatagory" placeholder="ชื่อประเภทสินค้า" oninput="enbtn()" required>
                    </div>
                  </div>
                 
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit"  id="subm" class="btn btn-info">บันทึก</button>
                  <button type="button" onclick="back()"  class="btn btn-default float-right" >ยกเลิก</button>
                  <script>
                    $('#subm').prop( "disabled", true );
                      function back() {
                        //console.log(55555);
                        $( "#LList" ).click();
                      }
                      function enbtn(){
                        $('#subm').prop( "disabled", false );
                      }
                  </script>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
          </div>

        </div>
      </div>
      
    </div>
    
</div>
@if (session()->has('success'))
<script>
  const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
  Toast.fire({
  icon: 'success',
  title: '{{ session()->get('success')}} '
  })
</script>
@endif

@error('del')
  <script>
    Swal.fire({
  icon: 'error',
  title: 'เกิดข้อผิดพลาด',
  text: '{{ $message }}',
  })
  </script>
    
@enderror


@endsection