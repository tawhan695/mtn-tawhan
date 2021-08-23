@extends('admin.layouts.app')
@section('javascript')

@endsection
@section('content')
    <section class="content ">
        <div class="container pt-4">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">ประวัติการเพิ่มสินค้า</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    {{-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button> --}}
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <ul class="products-list product-list-in-card pl-2 pr-2">
                    @foreach ($His as $item)
                    <li class="item">
                        <div class="product-img">
                          <img src="{{ asset($item->image) }}" alt="Product Image" class="img-size-50">
                        </div>
                        <div class="product-info">
                          <a href="javascript:void(0)" class="product-title">{{ $item->pname }}
                            <span class="badge badge-warning float-right">{{ $item->qty .'/'.$item->unit}}</span></a>
                          <span class="product-description">
                            เพิมโดย {{ $item->name . ' เมื่อ ' . $item->created_at}}
                          </span>
                        </div>
                      </li>
                    @endforeach
                    <!-- /.item -->
                  </ul>
                </div>
                <!-- /.card-body -->
                <div class="card-footer text-center">
                    <ul class="pagination pagination-sm m-0 float-right">
                        {{ $His->onEachSide(5)->links("pagination::bootstrap-4")}}
                    </ul>
                </div>
                <!-- /.card-footer -->
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
                    title: '{{ session()->get('success') }} '
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
