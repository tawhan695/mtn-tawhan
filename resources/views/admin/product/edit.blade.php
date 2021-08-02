@extends('admin.layouts.app')
@section('javascript')
<script src="https://cdn.rawgit.com/serratus/quaggaJS/0420d5e0/dist/quagga.min.js"></script>
<style>
    /* In order to place the tracking correctly */
    canvas.drawing, canvas.drawingBuffer {
        position: absolute;
        left: 0;
        top: 0;
    }
</style>
@endsection
@section('content')
<section class="content">
    <div class="container pt-4">
      <div class="card">
        <div class="card-header">
          แก้ไขสินค้า
        </div>
        
        <div class="tab-content">
          <div class="tab-pane active" id="add">
            <form action="{{ route('product.update',$product->id)}}" method="post" aria-multiline="true" enctype="multipart/form-data">
              @csrf
              @method('put')

              <div class="card-body">
                <div class="form-group row">
                  <div class="center" style=" margin: auto;  ">
                    <div style=" width: 250px;height: 250px;">
                      
                      <img id="IMG" src="" alt="image product" width="100%" height="100%" accept="image/png, image/gif, image/jpeg">
                      
                    </div>
                    <div class="mt-1">
                      <input class="btn btn-info" style="width: 250px" type="file" name="image" id="exampleInputFile">
                    </div>
                  </div>
                  
                </div>
                <div class="form-group row">
                  <label for="inputName3" class="col-sm-2 col-form-label">ชื่อ</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control  @error('name') is-invalid @enderror" 
                            id="inputName3" placeholder="Name" name="name" required value="{{ $product->name}}">
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputName3" class="col-sm-2 col-form-label">SKU</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control isbn" id="isbn_input" class="isbn"
                     placeholder="sku" name="sku"  required value="{{ $product->sku}}">
                  </div>
                  
                  <div class="col-sm-4 row">
                     <div class="col-sm-6">
                      
                       <button type="button" class="btn btn-success btn-block" disabled >สแกน</button>
                     </div>
                     <div class="col-sm-6">
                       <button type="button" class="btn btn-success btn-block" id="barcode">สร้างบาร์โค้ด</button>
                     </div>
                  </div>
                  {{-- <div class="col-sm-2"> --}}
                     <script>
                        $('#barcode').click(function(){
                          console.log(Date.now());
                          $('#isbn_input').val(Date.now())
                        });
                     </script>
                  {{-- </div> --}}
                </div>
                <div class="form-group row">
                  <label for="inputPrice3" class="col-sm-2 col-form-label">ราคา</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="inputPrice3" placeholder="Price"
                     name="price" min="0" max="100000" step="0.01"  required value="{{ $product->legular_price}}">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputQty3" class="col-sm-2 col-form-label">จำนวน</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="inputQty3" value="{{ $product->qty}}"
                    placeholder="Qty" name="qty" min="0" max="1000" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputUnit3" class="col-sm-2 col-form-label">หน่วยนับ</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputUnit3" value="{{ $product->unit}}"
                    placeholder="ชิ้น/แผง/อัน/อื่นๆ" name="unit" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputdes" class="col-sm-2 col-form-label">รายละเอียด</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" id="inputdes"
                     name="des" id="des"  rows="3" required>{{ $product->des}}</textarea>
                    {{-- <input type="array" class="form-control" id="inputUnit3" placeholder="ชิ้น/แผง/อัน/อื่นๆ" name="unit" required> --}}
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputCat3" class="col-sm-2 col-form-label">หมวดหมู่</label>
                  <div class="col-sm-10">
                    
                    {{-- <input type="Unit" class="form-control" id="inputCat3" placeholder="Cat"> --}}
                    <select class="form-control" name="catagory" id="catagory">
                      <option>เลือกหมวดหมู่</option>
                      @foreach ($catagory as $item)
                          @if ($product->catagory_id == $item->id)
                              
                            <option value="{{ $item->id}}" selected >{{ $item->name}}</option>
                          @else
                              
                            <option value="{{ $item->id}}">{{ $item->name}}</option>
                          @endif
                      @endforeach
                    </select>
                  </div>
                </div>
  
                {{--  --}}
              </div>
              <div class="card-footer">
                <button type="submit"  id="subm" class="btn btn-info">บันทึก</button>
                <button type="button" onclick="back()"  class="btn btn-default float-right" >ยกเลิก</button>
                <script>
                  // $('#subm').prop( "disabled", true );
                    function back() {
                      //console.log(55555);
                      $( "#LList" ).click();
                    }
                   
                </script>
              </div>
            </form>
          </div>

        </div>
      </div>
      
    </div>
    
</div>
<script>
  $('#IMG').attr('src', '/images/products/default.png');
  $('#exampleInputFile').change(function(){
          var input = this;
          var url = $(this).val();
          console.log(url);
          var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
          if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) 
          {
              var reader = new FileReader();

              reader.onload = function (e) {
                $('#IMG').attr('src', e.target.result);
              }
            reader.readAsDataURL(input.files[0]);
          }
          else
          {
            $('#IMG').attr('src', '/assets/no_preview.png');
          }
        });

        @error('sucess')
        
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
          });
        Toast.fire({
        icon: 'success',
        title: '{{ $message }} '
        })
    
        @enderror
    
</script>
{{-- https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js --}}
{{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.js"></script> --}}


@endsection