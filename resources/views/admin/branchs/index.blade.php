@extends('admin.layouts.app')
@section('javascript')

@endsection
@section('content')
    <section class="content">
        <div class="container pt-4">
            <div class="card">
                <div class="card-header">
                    <div class="row d-flex align-items-stretch">
                        @foreach ($branchs as $item)
                            <div class="col-md-4">
                                <!-- Widget: user widget style 1 -->
                                <div class="card card-widget widget-user" >
                                    <!-- Add the bg color to the header using any of the bg-* classes -->
                                    <div class="widget-user-header bg-warning">
                                        <h3 class="widget-user-username">มัทนาไข่สด ฟาร์ม</h3>
                                        <h5 class="widget-user-desc">{{ $item->name }}</h5>
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
                                        <div class="row">
                                            <div class="col-sm-4 border-right">
                                                <div class="description-block">
                                                    <h5 class="description-header">{{ \App\Models\Order::where('branch_id',$item->id)->count() }}</h5>
                                                    <span class="description-text">ออเดอร์</span>
                                                </div>
                                                <!-- /.description-block -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-4 border-right">
                                                <div class="description-block">
                                                    <h5 class="description-header">{{ \App\Models\Order::where('branch_id',$item->id)->sum('net_amount') }}</h5>
                                                    <span class="description-text">ยอดขาย</span>
                                                </div>
                                                <!-- /.description-block -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-4">
                                                <div class="description-block">
                                                    <h5 class="description-header">{{ \App\Models\Product::where('branch_id',$item->id)->count() }}</h5>
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
            $('#addBranch').click(function(){
                console.log('addBranch');
                window.location.assign('{{ route('branchs.create') }}');
            })
        </script>


    @endsection
