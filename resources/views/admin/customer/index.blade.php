@extends('admin.layouts.app')
@section('javascript')

@endsection
@section('content')
    @if (auth()->user()->hasRole('admin'))

    @else
    <section class="content ">
        <section class="content ">
            <div class="container pt-4">
                <div class="card card-primary card-outline card-outline-tabs mt-6">
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link  active " id="custom-tabs--tab" data-toggle="pill"
                                    href="#custom-tabs-" role="tab"
                                    aria-controls="custom-tabs-"
                                    aria-selected="true">ข้อมูลลูกค้า</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-four-tabContent">

                            <div class=" tab-pane fade  show  active " id="custom-tabs-" role="tabpanel"
                                aria-labelledby="custom-tabs--tab">
                                <div class="row">
                                    @foreach ($customer as $item)

                                        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                                            <div class="card bg-light">
                                                <div class="card-header text-muted border-bottom-0">
                                                    {{-- {{ print_r(\App\Models\User::where('id', $item->id)->getRoleNames()) }} --}}
                                                </div>
                                                {{-- `company``name``phone``address``branch_id` --}}
                                                <div class="card-body pt-0">
                                                    <div class="row">
                                                        <div class="col-7">
                                                            <h2 class="lead"><b>{{ $item->company }}</b></h2>
                                                            <p class="text-muted text-sm"><b>ชื่อ: </b>
                                                                {{ $item->name }}</p>
                                                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                                                <li class="small"><span class="fa-li"><i
                                                                            class="fas fa-lg fa-building"></i></span>
                                                                    Address:{{ $item->address }}</li>
                                                                <li class="small"><span class="fa-li"><i
                                                                            class="fas fa-lg fa-phone"></i></span> Phone
                                                                    :
                                                                    {{ $item->phone }}
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-5 text-center">
                                                            <img src="{{ asset('images/profiles/def_face.jpg') }}" alt=""
                                                                class="img-circle img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach

                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /.card -->
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


    @endsection
