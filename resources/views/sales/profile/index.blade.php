@extends('sales.layouts.app')
@section('javascript')
     
@endsection
@section('content')

<div class="container">
    <div class="pt-4">
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-3">
  
              <!-- Profile Image -->
              <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                  <div class="text-center">
                    <img id="img" class="profile-user-img img-fluid img-circle" src="{{ asset(Auth::user()->image) }}" alt="User profile picture" style="border: 3px solid #adb ; width: 100px; height: 100px;">
                  </div>
  
                  <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>
  
                  <p class="text-muted text-center">{{ App\Models\Branchs::where('id',App\Models\Has_Branchs::where('user_id',auth()->user()->id)->first()->id)->first()->name}}</p>
                  
                  
                  {{-- <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                      <b>Followers</b> <a class="float-right">1,322</a>
                    </li>
                    <li class="list-group-item">
                      <b>Following</b> <a class="float-right">543</a>
                    </li>
                    <li class="list-group-item">
                      <b>Friends</b> <a class="float-right">13,287</a>
                    </li>
                  </ul> --}}
  
                  {{-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
  
              <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
              <div class="card">
                <div class="card-header p-2">
                  <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#profile" data-toggle="tab">ข้อมูลส่วนตัว</a></li>
                    {{-- <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li> --}}
                    <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">ตั้งค่าข้อมูลส่วนตัว</a></li>
                  </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content">

                    <div class="active tab-pane" id="profile">
                      {{-- {{Auth::user()}} --}}
                      <div class="card-body">
                        <strong><i class="fas fa-book mr-1"></i> </strong>
        
                        <hr>
                        <p class="text-muted">
                          name:{{auth()->user()->name}}
                        </p>
                        <hr>
                        <p class="text-muted">
                          username:{{auth()->user()->username}}
                        </p>
                        <hr>
                        <p class="text-muted">
                          email:{{auth()->user()->email}}
                        </p>
                        <hr>
                        <p class="text-muted">
                          สร้างเมื่อ:{{auth()->user()->created_at}}
                        </p>
        
                        <hr>
        
                        {{-- <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
        
                        <p class="text-muted">Malibu, California</p>
        
                        <hr>
        
                        <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>
        
                        <p class="text-muted">
                          <span class="tag tag-danger">UI Design</span>
                          <span class="tag tag-success">Coding</span>
                          <span class="tag tag-info">Javascript</span>
                          <span class="tag tag-warning">PHP</span>
                          <span class="tag tag-primary">Node.js</span>
                        </p>
        
                        <hr>
        
                        <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
        
                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p> --}}
                      </div>             
                    </div>

                    <!-- /.tab-pane -->
  
                    <div class="tab-pane" id="settings">
                      <form class="form-horizontal" action="{{route('user2.update',auth()->user()->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="form-group row">
                          <label for="exampleInputFile" class="col-sm-2 col-form-label">File input</label>
                          <div class="col-sm-10">
                            <div class="custom-file">
                              <input type="file" name="image" class="form-control" id="exampleInputFile" accept="image/png, image/gif, image/jpeg">
                              <label class="custom-file-label" for="exampleInputFile" >Choose file</label>
                            </div>
                            <script>
                              $('#exampleInputFile').change(function(){
                                var input = this;
                                var url = $(this).val();
                                var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
                                if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) 
                                {
                                    var reader = new FileReader();

                                    reader.onload = function (e) {
                                      $('#img').attr('src', e.target.result);
                                    }
                                  reader.readAsDataURL(input.files[0]);
                                }
                                else
                                {
                                  $('#img').attr('src', '/assets/no_preview.png');
                                }
                              });
                            </script>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="inputusername" class="col-sm-2 col-form-label">Username</label>
                          <div class="col-sm-10">
                            <input type="text" disabled class="form-control" id="inputusername" placeholder="username" name="username" value="{{auth()->user()->username}}">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                          <div class="col-sm-10">
                            <input type="email"  disabled class="form-control" id="inputEmail" placeholder="Email" name="email" value="{{auth()->user()->email}}">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputName2" placeholder="Name" name="name" value="{{auth()->user()->name}}">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputExperience" class="col-sm-2 col-form-label">ตำแหน่ง</label>
                          <div class="col-sm-10">
                            <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputSkills" class="col-sm-2 col-form-label">ประจำสาขา</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                          </div>
                        </div>
                        {{-- <div class="form-group row">
                          <div class="offset-sm-2 col-sm-10">
                            <div class="checkbox">
                              <label>
                                <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                              </label>
                            </div>
                          </div>
                        </div> --}}
                        <div class="form-group row">
                          <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn btn-danger">บันทึก</button>
                          </div>
                        </div>
                      </form>
                    </div>
                    <!-- /.tab-pane -->
                  </div>
                  <!-- /.tab-content -->
                </div><!-- /.card-body -->
              </div>
              <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
    </div>
</div>



@endsection