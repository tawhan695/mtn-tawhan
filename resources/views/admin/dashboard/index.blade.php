@extends('admin.layouts.app')
@section('javascript')

@endsection
@section('content')
<section class="content">
    <div class="container-fluid pt-4">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <p>{{ $Order}}</p>

              <p>ยอดขายวันนี้</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">ดูเพิ่มเติม..<i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <p>{{ number_format($ordersum, 2, '.', ',')}}</p>

              <p>กำไรวันนี้</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">ดูเพิ่มเติม..<i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <p>{{number_format( App\Models\Wallet::where('branch_id',App\Models\Has_Branchs::where('user_id',Auth::user()->id)->first()->id)->first()->balance, 2, '.', ',')  }}</p>

              <p>เงินในกระเป๋า</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">ดูเพิ่มเติม..<i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <p>{{$Defective}}</p>

              <p>สินค้าชำรุดวันนี้</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">ดูเพิ่มเติม.. <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
    </div>

</div>

@endsection
