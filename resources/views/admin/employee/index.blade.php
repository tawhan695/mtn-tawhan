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
                            <a class="nav-link  " id="custom-tabs-ty-tab" data-toggle="pill" href="#custom-tabs-ty"
                                role="tab" aria-controls="custom-tabs-ty" aria-selected="true">เพิ่มพนักงาน</a>
                        </li>
                        {{-- @foreach ($branchs as $branch)
                        @endforeach --}}
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-four-tabContent">

                        <div class=" tab-pane fade  show  active " id="custom-tabs-{{ $branchs->id }}" role="tabpanel"
                            aria-labelledby="custom-tabs-{{ $branchs->id }}-tab">
                            <div class="row">
                                @foreach ($employee as $item)

                                    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                                        <div class="card bg-light">
                                            <div class="card-header text-muted border-bottom-0">
                                                {{-- {{ print_r(\App\Models\User::where('id', $item->id)->getRoleNames()) }} --}}
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
                                                                Address:{{ $item->address }}</li>
                                                            <li class="small"><span class="fa-li"><i
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
                            <form action="{{ route('employee.store') }}" method="post" enctype="multipart/form-data"
                                class="needs-validation" novalidate>
                                @csrf
                                @method('post')
                                <div class="form-group">
                                    <label for="username">ชื่อผู้ใช้:</label>
                                    <input type="text" class="form-control" id="username" placeholder="Enter username"
                                        name="username" required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                                <div class="form-group">
                                    <label for="uname">name:</label>
                                    <input type="text" class="form-control" id="name" placeholder="Enter name" name="name"
                                        required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                                <div class="form-group">
                                    <label for="uname">อีเมล์:</label>
                                    <input type="text" class="form-control" id="email" placeholder="Enter Mail"
                                        name="email" required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <div class="input-group" id="show_hide_password">
                                        <input class="form-control" type="password" name="password" placeholder="Enter">
                                        <div class="input-group-addon">
                                            <a href=""><i class="fa fa-eye-slash" aria-hidden="true" style="hover{
                                                            color:#333
                                                          }"></i></a>
                                        </div>
                                    </div>
                                    <script>
                                        $(document).ready(function() {
                                            $("#show_hide_password a").on('click', function(event) {
                                                event.preventDefault();
                                                if ($('#show_hide_password input').attr("type") == "text") {
                                                    $('#show_hide_password input').attr('type', 'password');
                                                    $('#show_hide_password i').addClass("fa-eye-slash");
                                                    $('#show_hide_password i').removeClass("fa-eye");
                                                } else if ($('#show_hide_password input').attr("type") == "password") {
                                                    $('#show_hide_password input').attr('type', 'text');
                                                    $('#show_hide_password i').removeClass("fa-eye-slash");
                                                    $('#show_hide_password i').addClass("fa-eye");
                                                }
                                            });
                                        });
                                    </script>
                                </div>


                                <div class="form-group">
                                    <label for="uname">เบอร์โทรศัพท์:</label>
                                    <input type="text" class="form-control" id="tel" placeholder="Enter phone" name="tel"
                                        required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                                <div class="form-group">
                                    <label for="comment">ที่อยู่:</label>
                                    <textarea class="form-control" rows="3" id="address" name="address"
                                        placeholder="ที่อยู่"></textarea>
                                </div>
                                <div class="form-group">
                                    <input class="float-right btn btn-primary btn-block" type="submit" value="บันทึกข้อมูล">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>
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
