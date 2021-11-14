@extends('admin.layouts.app')
@section('javascript')

@endsection
@section('content')
    <section class="content ">
        <div class="container pt-4">
            <div class="card ">
                <div class="card-body">

                    <div class="row">
                        <h5 class="card-title col-12">ยอดเงินในกระเป่า</h5>
                        <div class="col-sm-6 col-12  ">
                            <div class="m-1 shadow-sm card-primary card-outline p-2 text-center"
                                style="height:150px;border-radius: 20px">
                                ยอดเงิน
                                <br>
                                <h2>
                                    {{ App\Models\Wallet::where(
                                            'branch_id',
                                            auth()->user()->branch_id(),
                                        )->first()->balance }}
                                </h2>

                                <button type="button" class="btn btn-primary" onclick="withdraw()">ถอน</button>
                                <form action="{{ url('admin/finance/withdraw') }}" id="withdraw" method="post">
                                    @csrf
                                    @method("POST")

                                </form>
                                <script>
                                    async function withdraw() {
                                        const {
                                            value: amount
                                        } = await Swal.fire({
                                            title: 'ถอนเงินในกระเป๋า',
                                            input: 'number',
                                            inputLabel: 'ระบุจำนวนเงินที่ต้องการถอน',
                                            inputPlaceholder: 'จำนวนเงิน'
                                        })

                                        if (amount) {
                                            $('#withdraw').append(`<input type="hidden" name="balance"  value="${amount}">`)
                                            Swal.fire(`จำนวนเงิน: ${amount}`)
                                            $('#withdraw').submit();

                                        }
                                    }
                                </script>

                            </div>
                        </div>
                        <div class="col-sm-6 col-12 ">
                            <div class="m-1 p-2  shadow-sm card-primary card-outline text-center"
                                style="height:150px;border-radius: 20px">
                                เพิ่มเงินเป๋า
                                <br>
                                <button type="button" onclick="deposit()" class="btn btn-primary">เพิ่ม</button>
                            </div>
                            <form action="{{ url('admin/finance/deposit') }}" id="deposit" method="post">
                                @csrf
                                @method("POST")

                            </form>
                            <script>
                                async function deposit() {
                                    const {
                                        value: amount
                                    } = await Swal.fire({
                                        title: 'เพื่มเงินในกระเป๋า',
                                        input: 'number',
                                        inputLabel: 'ระบุจำนวนเงินที่ต้องการเพิ่ม',
                                        inputPlaceholder: 'จำนวนเงิน'
                                    })

                                    if (amount) {
                                        $('#deposit').append(`<input type="hidden" name="balance"  value="${amount}">`)
                                        Swal.fire(`จำนวนเงิน: ${amount}`)
                                        $('#deposit').submit();
                                    }
                                }
                            </script>
                        </div>
                    </div>
                    {{-- <a href="#" class="card-link">Card link</a>
                  <a href="#" class="card-link">Another link</a> --}}
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">ประวัติการการเงิน</h3>
                </div>

                <!-- /.card-header -->
                <div class="card-body table-responsive p-2">
                    <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>จำนวนเงิน</th>
                        <th>รายละเอียด</th>
                        <th>date</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($payment as $item)
                            <tr onclick="">
                            <td style="width: 1px">{{$loop->index+1}}</td>
                            <td style="width: 1px">{{ $item->amount }}</td>
                            <td style="width: 1px">{{ $item->des}}</td>
                            <td style="width: 1px">{{ $item->created_at}}</td>
                            </tr>
                        @endforeach

                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-left">
                        ทั้งหมด {{ $payment->total() }} รายการ
                    </ul>
                    <ul class="pagination pagination-sm m-0 float-right">
                        {{ $payment->onEachSide(5)->links("pagination::bootstrap-4")}}
                    </ul>
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
