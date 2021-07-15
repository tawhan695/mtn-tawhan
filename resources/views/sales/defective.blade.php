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
@endsection