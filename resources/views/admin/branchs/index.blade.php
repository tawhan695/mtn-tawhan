@extends('admin.layouts.app')
@section('javascript')

@endsection
@section('content')
    @if (auth()->user()->hasRole('admin'))
        <section class="content">
            <div class="container pt-4">
                <div class="card">
                    <div class="card-header">
                        <div class="row d-flex align-items-stretch">
                            @foreach ($branchs as $item)
                                <div class="col-md-4">
                                    <!-- Widget: user widget style 1 -->
                                    <div class="card card-widget widget-user">
                                        <!-- Add the bg color to the header using any of the bg-* classes -->
                                        <div class="widget-user-header bg-warning">
                                            <h3 class="widget-user-username">มัทนาไข่สด ฟาร์ม</h3>
                                            <h5 class="widget-user-desc">{{ $item->name }}</h5>
                                        </div>
                                        <div class="row">
                                            <div class="widget-user-image col-12">
                                                <img class="img-circle elevation-2"
                                                    src="{{ asset('images/logo/logo.jpg') }}" alt="User Avatar">
                                            </div>
                                        </div>
                                        <div class="card-footer ">
                                            <div class="col-12">
                                                {{ $item->des }}
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4 border-right">
                                                    <div class="description-block">
                                                        <h5 class="description-header">
                                                            {{ \App\Models\Order::where('branch_id', $item->id)->count() }}
                                                        </h5>
                                                        <span class="description-text">ออเดอร์</span>
                                                    </div>
                                                    <!-- /.description-block -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col-sm-4 border-right">
                                                    <div class="description-block">
                                                        <h5 class="description-header">
                                                            {{ \App\Models\Order::where('branch_id', $item->id)->sum('net_amount') }}
                                                        </h5>
                                                        <span class="description-text">ยอดขาย</span>
                                                    </div>
                                                    <!-- /.description-block -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col-sm-4">
                                                    <div class="description-block">
                                                        <h5 class="description-header">
                                                            {{ \App\Models\Product::where('branch_id', $item->id)->count() }}
                                                        </h5>
                                                        <span class="description-text">สินค้า</span>
                                                    </div>
                                                    <!-- /.description-block -->
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- /.row -->
                                        </div>
                                    </div>
                                    <!-- /.widget-user -->
                                </div>
                            @endforeach
                            <div class="col-md-4">

                                <!-- Widget: user widget style 1 -->
                                <div class="card card-widget widget-user" id="addBranch">
                                    <!-- Add the bg color to the header using any of the bg-* classes -->
                                    <div class="overlay">
                                        <i class="fas fa-3x fa-plus" style=""></i>

                                    </div>
                                    <div class="widget-user-header bg-warning">
                                        <h3 class="widget-user-username">มัทนาไข่สด ฟาร์ม</h3>
                                        <h5 class="widget-user-desc"></h5>
                                    </div>
                                    <div class="row">
                                        <div class="widget-user-image col-12">
                                            <img class="img-circle elevation-2" src="{{ asset('images/logo/logo.jpg') }}"
                                                alt="User Avatar">
                                        </div>
                                    </div>
                                    <div class="card-footer ">
                                        <div class="col-12">

                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4 border-right">
                                                <div class="description-block">
                                                    <h5 class="description-header">0</h5>
                                                    <span class="description-text">ออเดอร์</span>
                                                </div>
                                                <!-- /.description-block -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-4 border-right">
                                                <div class="description-block">
                                                    <h5 class="description-header">0</h5>
                                                    <span class="description-text">ยอดขาย</span>
                                                </div>
                                                <!-- /.description-block -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-4">
                                                <div class="description-block">
                                                    <h5 class="description-header">0</h5>
                                                    <span class="description-text">สินค้า</span>
                                                </div>
                                                <!-- /.description-block -->
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                </div>
                                <!-- /.widget-user -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
    <section class="content">
        <div class="container pt-4">
            <div class="card">
                <div class="card-header">
                    <div class="row d-flex align-items-stretch">
                        @foreach ($branchs_manager as $item)
                            <div class="col-md-12">
                                <!-- Widget: user widget style 1 -->
                                <div class="card card-widget widget-user">
                                    <!-- Add the bg color to the header using any of the bg-* classes -->
                                    <div class="widget-user-header bg-warning">

                                        <h3 class="widget-user-username">{{ $item->name }}</h3>
                                        {{-- <h5 class="widget-user-desc"></h5> --}}
                                    </div>
                                    <div class="row">
                                        <div class="widget-user-image col-12">
                                            <img class="img-circle elevation-2" src="{{ asset('images/logo/logo.jpg') }}"
                                                alt="User Avatar">
                                        </div>
                                    </div>
                                    <div class="card-footer ">
                                        <div class="col-12">
                                            {{ $item->des }}
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <button class="btn btn-primary"data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">
                                                แก้ไขข้อมูลสาขา
                                            </button>
                                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูลสาขา</h5>
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                      </button>
                                                    </div>
                                                    <div class="modal-body">
                                                      <form id="branchsUpdate" method="post" action="{{ route('branchs.update',$item->id) }}">
                                                          @csrf
                                                          @method('PUT')
                                                        <div class="form-group">
                                                          <label for="recipient-name" class="col-form-label">ชื่อสาขา:</label>
                                                          <input type="text" class="form-control" id="recipient-name" name="name" value="{{ $item->name }}">
                                                        </div>
                                                        <div class="form-group">
                                                          <label for="message-text" class="col-form-label">รายละเอียด:</label>
                                                          <textarea class="form-control" id="message-text" name="des" >{{ $item->des }}</textarea>
                                                        </div>
                                                        <button id="#subd" type="submit" class="btn btn-primary">บันทึก</button>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>


                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                </div>
                                <!-- /.widget-user -->
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    @endif
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
    <script>
        $('#addBranch').click(function() {
            console.log('addBranch');
            window.location.assign('{{ route('branchs.create') }}');
        })
    </script>


@endsection
