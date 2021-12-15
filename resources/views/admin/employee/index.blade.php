@extends('admin.layouts.app')
@section('javascript')

@endsection
@section('content')
    <section class="content ">
        <div class="container pt-4">
            <div class="card card-primary card-outline card-outline-tabs mt-6">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link  active " id="custom-tabs-{{ $branchs->id }}-tab" data-toggle="pill"
                                href="#custom-tabs-{{ $branchs->id }}" role="tab"
                                aria-controls="custom-tabs-{{ $branchs->id }}"
                                aria-selected="true">{{ $branchs->name }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  " id="custom-tabs-ty-tab" data-toggle="pill"
                                href="#custom-tabs-ty" role="tab" aria-controls="custom-tabs-ty"
                                aria-selected="true">เพิ่มพนักงาน</a>
                        </li>
                        {{-- @foreach ($branchs as $branch)
                        @endforeach --}}
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-four-tabContent">

                            <div class=" tab-pane fade  show  active " id="custom-tabs-{{ $branchs->id }}"
                                role="tabpanel" aria-labelledby="custom-tabs-{{ $branchs->id }}-tab">
                                <div class="row">
                                    @foreach ($employee as $item)

                                            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                                                <div class="card bg-light">
                                                    <div class="card-header text-muted border-bottom-0">
                                                        {{ \App\Models\User::where('id', $item->id)->first()->getRoleNames()[0] }}
                                                    </div>
                                                    <div class="card-body pt-0">
                                                        <div class="row">
                                                            <div class="col-7">
                                                                <h2 class="lead"><b>{{ $item->name }}</b></h2>
                                                                <p class="text-muted text-sm"><b>Email: </b>
                                                                    {{ $item->email }}</p>
                                                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                                                    <li class="small"><span
                                                                            class="fa-li"><i
                                                                                class="fas fa-lg fa-building"></i></span>
                                                                        Address:{{ $item->address }}</li>
                                                                    <li class="small"><span
                                                                            class="fa-li"><i
                                                                                class="fas fa-lg fa-phone"></i></span> Phone
                                                                        #:
                                                                        {{ $item->tel }}
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-5 text-center">
                                                                <img src="{{ asset($item->image) }}" alt=""
                                                                    class="img-circle img-fluid">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                    @endforeach

                                </div>
                            </div>

                        <div class=" tab-pane fade  show  " id="custom-tabs-ty" role="tabpanel"
                            aria-labelledby="custom-tabs-ty-tab">
                          <h5>
                            รออัพเดท
                          </h5>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
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
