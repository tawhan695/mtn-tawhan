@extends('admin.layouts.app')
@section('javascript')
    <script src="https://cdn.rawgit.com/serratus/quaggaJS/0420d5e0/dist/quagga.min.js"></script>
    <style>
        /* In order to place the tracking correctly */
        canvas.drawing,
        canvas.drawingBuffer {
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
                    {{-- <h3 class="card-title">รายกรสินค้า</h3> --}}
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a id="LList" class="nav-link active" href="#list"
                                data-toggle="tab">รายกรสินค้า</a></li>
                        <li class="nav-item"><a class="nav-link" href="#add"
                                data-toggle="tab">เพิ่มรายการสินค้า</a></li>
                    </ul>


                </div>

                <div class="tab-content">
                    <div class="tab-pane active" id="list">
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" id="list">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">id</th>
                                        <th>รูป</th>
                                        <th>สินค้า</th>
                                        <th>จำนวน</th>
                                        <th>ราคาปลีก</th>
                                        <th>ราคาส่ง</th>
                                        <th>หมวดหมู่</th>
                                        <th style="width: 150px">จัดการ</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product as $item)
                                        <tr>
                                            <td style="width: 1px;">{{ $item->id }}</td>
                                            <td style="width: 1px;"><img width="100px" src="{{ asset($item->image) }}"
                                                    alt="{{ $item->name }}"></td>
                                            <td style="width: 1px">{{ $item->name }}</td>
                                            <td style="width: 1px">@if ($item->qty > 0) {{ $item->qty }}@else <span class="badge bg-danger">สินค้าหมด</span> @endif</td>
                                            <td style="width: 1px">{{ number_format($item->retail_price, 2, '.', ',') }}
                                            </td>
                                            <td style="width: 1px">
                                                {{ number_format($item->wholesale_price, 2, '.', ',') }}</td>
                                            <td style="width: 1px">
                                                @if ( $item->catagory_id != null)
                                                {{ App\Models\Catagory::where('id', $item->catagory_id)->first()->name }}
                                                @else
                                                    NULL
                                                @endif
                                            </td>
                                            <td style="width: 1px;hieght: 20px">
                                                <div class="btn-group">
                                                    {{-- <div class="col-4 "> --}}
                                                    <form action="{{ route('product.update', $item->id) }}" method="post"
                                                        id="up{{ $item->id }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="updateQTY"
                                                            id="update{{ $item->id }}" value="" />
                                                        <button class="btn btn-success" type="button"
                                                            onclick="add{{ $item->id }}()">เพิ่ม</button>
                                                    </form>
                                                    {{-- </div> --}}
                                                    {{-- <div class="col-4 "> --}}
                                                    <form action="{{ route('product.edit', $item->id) }}" method="GET">
                                                        @csrf

                                                        <button type="submit" class="btn btn-warning">แก้ไข</button>
                                                    </form>

                                                    {{-- </div> --}}
                                                    {{-- <div class="col-4 "> --}}
                                                    <form action="{{ route('product.destroy', $item->id) }}" method="post"
                                                        id="sbu{{ $item->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger" type="button"
                                                            onclick="del{{ $item->id }}()">ลบ</button>
                                                    </form>

                                                    <script>
                                                        async function add{{ $item->id }}() {
                                                            const {
                                                                value: number
                                                            } = await Swal.fire({
                                                                title: 'เพิ่มจำนวนสินค้า',
                                                                input: 'number',
                                                                inputLabel: 'กรุณาใส่ตัวเลข',
                                                                inputPlaceholder: ''
                                                            })

                                                            if (number) {

                                                                Swal.fire(`เพิ่มสำเร็จ : ${number}`)
                                                                $('#update{{ $item->id }}').val(number);
                                                                $('#up{{ $item->id }}').submit();
                                                            }
                                                        }

                                                        function del{{ $item->id }}() {
                                                            const swalWithBootstrapButtons = Swal.mixin({
                                                                customClass: {
                                                                    confirmButton: 'btn btn-success',
                                                                    cancelButton: 'btn btn-danger'
                                                                },
                                                                buttonsStyling: false
                                                            })

                                                            swalWithBootstrapButtons.fire({
                                                                title: 'ต้องการลบสินค้านี้หรือไม่ ?',
                                                                text: "{{ $item->name }} {{ number_format($item->legular_price, 2, '.', ',') }}",
                                                                icon: 'warning',
                                                                showCancelButton: true,
                                                                confirmButtonText: 'ลบ',
                                                                cancelButtonText: 'ยกเลิก',
                                                                reverseButtons: true
                                                            }).then((result) => {
                                                                if (result.isConfirmed) {
                                                                    swalWithBootstrapButtons.fire(
                                                                        'ลบสำเร็จ!',
                                                                        '!!!',
                                                                        'success'
                                                                    )
                                                                    $('#sbu{{ $item->id }}').submit();
                                                                }
                                                            })
                                                        }
                                                    </script>
                                                    {{-- </div> --}}
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
                                ทั้งหมด {{ $product->total() }} รายการ
                            </ul>
                            <ul class="pagination pagination-sm m-0 float-right">
                                {{ $product->onEachSide(5)->links('pagination::bootstrap-4') }}
                            </ul>
                        </div>
                    </div>
                    <div class="tab-pane" id="add">
                        <form action="{{ route('product.store') }}" method="post" aria-multiline="true"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="center" style=" margin: auto;  ">
                                        <div style=" width: 250px;height: 250px;">

                                            <img id="IMG" src="" alt="image product" width="100%" height="100%"
                                                accept="image/png, image/gif, image/jpeg">

                                        </div>
                                        <div class="mt-1">
                                            <input class="btn btn-info" style="width: 250px" type="file" name="image"
                                                id="exampleInputFile">
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label for="inputName3" class="col-sm-2 col-form-label">ชื่อ</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control  @error('name') is-invalid @enderror"
                                            id="inputName3" placeholder="Name" name="name" required>
                                        @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputName3" class="col-sm-2 col-form-label">SKU</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control isbn" id="isbn_input" class="isbn"
                                            placeholder="sku" name="sku" value="" required>
                                    </div>

                                    <div class="col-sm-4 row">
                                        <div class="col-sm-6">

                                            <button type="button" class="btn btn-success btn-block" disabled>สแกน</button>
                                        </div>
                                        <div class="col-sm-6">
                                            <button type="button" class="btn btn-success btn-block"
                                                id="barcode">สร้างบาร์โค้ด</button>
                                        </div>
                                    </div>
                                    {{-- <div class="col-sm-2"> --}}
                                    <script>
                                        $('#barcode').click(function() {
                                            console.log(Date.now());
                                            $('#isbn_input').val(Date.now())
                                        });
                                    </script>
                                    {{-- </div> --}}
                                </div>
                                <div class="form-group row">
                                    <label for="inputPrice3" class="col-sm-2 col-form-label">ราคาปลีก</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" id="inputPrice3" placeholder="Price"
                                            name="price" min="0" max="100000" step="0.01" value="0.00" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label>ราคาส่ง</label>
                                    </div>
                                    <div class="col-sm-5 col-12">
                                        <div class="form-group">
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control" id="inputPrice4"
                                                    placeholder="Price" name="price2" min="0" max="100000" step="0.01"
                                                    value="0.00" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-5 col-12">
                                        <div class="form-group row ">
                                            <label for="inputPrice4" class="col-sm-3 col-form-label">จำนวนค้าส่ง</label>
                                            <div class="col-sm-9">
                                                <input type="number" class="form-control" id="inputPrice4"
                                                    placeholder="Price" name="wholesaler" min="0" max="100000" step="1"
                                                    value="5" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputQty3" class="col-sm-2 col-form-label">จำนวน</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" id="inputQty3" placeholder="Qty"
                                            name="qty" min="0" max="1000" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputUnit3" class="col-sm-2 col-form-label">หน่วยนับ</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputUnit3"
                                            placeholder="ชิ้น/แผง/อัน/อื่นๆ" name="unit" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputdes" class="col-sm-2 col-form-label">รายละเอียด</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="inputdes" name="des" id="des" rows="3"
                                            required></textarea>
                                        {{-- <input type="array" class="form-control" id="inputUnit3" placeholder="ชิ้น/แผง/อัน/อื่นๆ" name="unit" required> --}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputCat3" class="col-sm-2 col-form-label">หมวดหมู่</label>
                                    <div class="col-sm-10">
                                        {{-- <input type="Unit" class="form-control" id="inputCat3" placeholder="Cat"> --}}
                                        <select class="form-control" name="catagory" id="catagory">
                                            <option value="null">เลือกหมวดหมู่</option>
                                            @foreach ($catagory as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{--  --}}
                            </div>
                            <div class="card-footer">
                                <button type="submit" id="subm" class="btn btn-info">บันทึก</button>
                                <button type="button" onclick="back()" class="btn btn-default float-right">ยกเลิก</button>
                                <script>
                                    // $('#subm').prop( "disabled", true );
                                    function back() {
                                        //console.log(55555);
                                        $("#LList").click();
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
            $('#exampleInputFile').change(function() {
                var input = this;
                var url = $(this).val();
                console.log(url);
                var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
                if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#IMG').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                } else {
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
