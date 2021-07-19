@extends('sales.layouts.app')
@section('javascript')
     
@endsection
@section('content')
<div class="container">
    <div class="pt-4">
        <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">สินค้าชำรุด</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form role="form" id="submit1" action="{{route('defective.store')}}" method="POST">
                @csrf
                @method('post')
                <div class="row">
                  <div class="col-sm-6">
                    <!-- select -->
                    <div class="form-group">
                      <label>เลือกสินค้า</label>
                      <select name="id" id="product" class="custom-select  @error('id') is-invalid @enderror">
                          <option value="null">---</option>
                          @foreach ($product as $item)
                              
                            <option value="{{$item->id}}">รหัสสินค้า {{$item->id .' '.$item->name .' ฿' .$item->legular_price. ' คลัง' .$item->qty}}</option>
                          @endforeach
                      </select>
                      @error('id')
                      <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                      <label>จำนวนที่เสียหาย</label>
                      <input type="number" name="defective" minlength="0" min="0" value="0" class="form-control @error('defective') is-invalid @enderror" placeholder="Enter ...">
                      @error('defective')
                      <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-12">
                    <!-- text input -->
                    <div class="form-group">
                      <label>รายละเอียด</label>
                        <input type="text" name="status"  class="form-control @error('status') is-invalid @enderror" placeholder="{แตก,ชำรุด,เน่า,หมดอายุ,อื่นๆ..}">
                        @error('status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-info" onclick="sub()">บันทึก</button>
                <button type="button" class="btn btn-default float-right"><a href="">ยกเลิก</a></button>
            </div>
            <script>
                function sub(){
                    $('#submit1').submit();
                }
                @error('errorqty') 
                Swal.fire(
                'เกิดข้อผิดพลาด',
                '{{$message}}',
                'error'
                )
                @enderror

                @error('saved')

                Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: '{{$message}}',
                showConfirmButton: false,
                timer: 1500
                })
                @enderror

            </script>
          </div>
          
    </div> 
</div> 
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
              <th style="width: 10px">#</th>
              <th>รหัสสินค้า</th>
              <th>สินค้า</th>
              <th>จำนวน</th>
              <th>สถานะ</th>
              <th>วันเดือนปี</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($defec as $item)       
                  <tr>
                  <td style="width: 1px">{{ $loop->index}}</td>
                  <td style="width: 1px">{{ $item->product_id}}</td>
                  <td style="width: 1px">{{ App\Models\Product::where('id',$item->product_id)->first()->name}}</td>
                  <td style="width: 1px">{{ $item->qty}}</td>
                  <td style="width: 1px">{{ $item->status}}</td>
                  <td style="width: 1px">{{ $item->created_at}}</td>
                  </tr>
              @endforeach
            
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
      <div class="card-footer clearfix">
          <ul class="pagination pagination-sm m-0 float-left">
              ทั้งหมด {{ $defec->total() }} รายการ
          </ul>
          <ul class="pagination pagination-sm m-0 float-right">
              {{ $defec->onEachSide(5)->links("pagination::bootstrap-4")}}
          </ul>
        </div>
      </div>
    </div>
    <!-- /.card -->
  </div>
@endsection