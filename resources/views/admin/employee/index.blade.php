@extends('admin.layouts.app')
@section('javascript')

@endsection
@section('content')
    <section class="content ">
        <div class="container pt-4">
            <div class="card card-primary card-outline card-outline-tabs mt-6">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                        @foreach ($branchs as $branch)
                            <li class="nav-item">
                                <a class="nav-link @if ($loop->index == 0) active @endif" id="custom-tabs-{{ $branch->id }}-tab" data-toggle="pill"
                                    href="#custom-tabs-{{ $branch->id }}" role="tab"
                                    aria-controls="custom-tabs-{{ $branch->id }}"
                                    aria-selected="true">{{ $branch->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-four-tabContent">
                        @foreach ($branchs as $branch)
                            <div class=" tab-pane fade  show @if ($loop->index == 0) active @endif" id="custom-tabs-{{ $branch->id }}" role="tabpanel"
                                aria-labelledby="custom-tabs-{{ $branch->id }}-tab">
                                <div class="row">
                                @foreach ($employee as $item)
                                    @if ($branch->id == $item->branchs_id)
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
                                                                <li class="small"><span class="fa-li"><i
                                                                            class="fas fa-lg fa-building"></i></span>
                                                                    Address:.....</li>
                                                                <li class="small"><span class="fa-li"><i
                                                                            class="fas fa-lg fa-phone"></i></span> Phone #:
                                                                    ........
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
                                    @endif
                                @endforeach
                                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                                    <div class="card bg-light">
                                        <div class="overlay">
                                            <i class="fas fa-3x fa-plus" style=""></i>

                                        </div>
                                        <div class="card-header text-muted border-bottom-0">
                                            ..
                                        </div>
                                        <div class="card-body pt-0">

                                            <div class="row">
                                                <div class="col-7">
                                                    <h2 class="lead"><b>..</b></h2>
                                                    <p class="text-muted text-sm"><b>Email: </b>
                                                        ..</p>
                                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                                        <li class="small"><span class="fa-li"><i
                                                                    class="fas fa-lg fa-building"></i></span>
                                                            Address:.....</li>
                                                        <li class="small"><span class="fa-li"><i
                                                                    class="fas fa-lg fa-phone"></i></span> Phone #:
                                                            ........
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-5 text-center">
                                                    <img src="/images/profiles/def_face.jpg" alt="img"
                                                        class="img-circle img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        @endforeach
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
