@extends('admin.layouts.app')
@section('javascript')

@endsection
@section('content')
    <section class="content">
        <div class="container pt-4">
            <div class="card">
                <div class="card-header">
                    <div class="row d-flex align-items-stretch">
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
                                                <p class="text-muted text-sm"><b>Email: </b> {{ $item->email }}</p>
                                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                                    <li class="small"><span class="fa-li"><i
                                                                class="fas fa-lg fa-building"></i></span> Address:.....</li>
                                                    <li class="small"><span class="fa-li"><i
                                                                class="fas fa-lg fa-phone"></i></span> Phone #: ........
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-5 text-center">
                                                <img src="{{ asset($item->image) }}" alt="" class="img-circle img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="card-footer">
                        <div class="text-right">
                        <a href="#" class="btn btn-sm bg-teal">
                            <i class="fas fa-comments"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-primary">
                            <i class="fas fa-user"></i> View Profile
                        </a>
                        </div>
                    </div> --}}
                                </div>
                            </div>
                        @endforeach


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


    @endsection
