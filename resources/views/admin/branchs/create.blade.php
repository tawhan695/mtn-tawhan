@extends('admin.layouts.app')
@section('javascript')

@endsection
@section('content')
    <section class="content">
        <div class="container pt-4">
            <div class="card">
                <div class="card-header">
                    <div class="row d-flex align-items-stretch">


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
           
        </script>


    @endsection
