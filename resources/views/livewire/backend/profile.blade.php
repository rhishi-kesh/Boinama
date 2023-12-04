<div class="container-fluid">
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
            {{ session('success') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
            {{ session('error') }}
        </div>
    @endif
    <div class="container-fluid">
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
              <div class="row">
                <div class="col-lg-4">
                  <div class="card shadow-none border">
                    <div class="card-body">
                      <h5 class="mb-3">Update Image</h5>
                        <form wire:submit.prevent="imageUpdate" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="avatar-upload text-center">
                                <input type="hidden" name="id" value="{{ Auth::guard('admin')->user()->id }}">
                                <div class="avatar-edit">
                                    <input type='file' wire:model="image" name="image" class="@error('client_logo') is-invalid @enderror" id="imageUpload" accept=".png, .jpg, .jpeg" />
                                    @if ($errors->has('image'))
                                        <div class="invalid-feedback">{{ $errors->first('image') }}</div>
                                    @endif
                                    <label for="imageUpload" class="imageUpload">
                                        <i class="fa fa-camera upload-button"></i>
                                    </label>
                                </div>
                                <div class="avatar-preview">
                                    <div id="imagePreview" style="background-image: url('{{ empty($oldimage) ? url('images/profile.jpg') : asset('storage/' . Auth::guard('admin')->user()->profile_photo_path) }}');"></div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" name="img_submit" class="btn btn-primary d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-upload" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"></path>
                                        <path d="M7 9l5 -5l5 5"></path>
                                        <path d="M12 4l0 12"></path>
                                    </svg>
                                    <span class="ms-2">Upload</span>
                                </button>
                            </div>
                        </form>
                          @section('jss')
                              <script>
                                  function readURL(input) {
                                      if (input.files && input.files[0]) {
                                          var reader = new FileReader();
                                          reader.onload = function(e) {
                                              $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                                              $('#imagePreview').hide();
                                              $('#imagePreview').fadeIn(650);
                                          }
                                          reader.readAsDataURL(input.files[0]);
                                      }
                                  }
                                  $("#imageUpload").change(function() {
                                      readURL(this);
                                  });
                              </script>
                          @endsection
                      </div>
                  </div>
                </div>
                <div class="col-lg-8">
                  <div class="card shadow-none border">
                    <div class="card-body">
                      <h5 class="mb-3">Update Information</h5>
                      <form wire:submit="informationUpdate" method="POST">
                          @csrf
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-floating mb-3">
                                <input type="text" name="name"  wire:model="name" class="form-control @error('name') is-invalid @enderror" id="tb-fname" placeholder="Enter Your Name">
                                @if ($errors->has('name'))
                                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                @endif
                                <label for="tb-fname">Name</label>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-floating mb-3">
                                <input type="email" name="email" wire:model="email" class="form-control @error('email') is-invalid @enderror" id="tb-email" placeholder="Enter Your Email">
                                @if ($errors->has('email'))
                                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                @endif
                                <label for="tb-email">Email</label>
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="d-md-flex align-items-center mt-3">
                                <div class="ms-auto mt-3 mt-md-0">
                                  <button type="submit" class="btn btn-primary font-medium px-4">
                                    <div class="d-flex align-items-center">
                                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit-circle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                          <path d="M12 15l8.385 -8.415a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3z"></path>
                                          <path d="M16 5l3 3"></path>
                                          <path d="M9 7.07a7 7 0 0 0 1 13.93a7 7 0 0 0 6.929 -6"></path>
                                       </svg>
                                      <span class="ms-2">Update</span>
                                    </div>
                                  </button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>
                    </div>
                  </div>
                  <div class="card shadow-none border">
                      <div class="card-body">
                          <h5 class="mb-3">Change Password</h5>
                          <form wire:submit="changePassword" method="POST">
                              @csrf
                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="form-floating mt-3">
                                        <input name="old_Password" wire:model="old_Password" type="password" class="form-control @error('old_Password') is-invalid @enderror @if (Session::has('old')) is-invalid @endif" id="tb-cpwd" placeholder="Old Password">
                                        @if ($errors->has('old_Password'))
                                            <div class="invalid-feedback">{{ $errors->first('old_Password') }}</div>
                                        @endif
                                          @if (Session::has('old'))
                                            <div class="invalid-feedback">{{ Session::get('old') }}</div>
                                          @endif
                                        <label for="tb-cpwd">Old Password</label>
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-floating mt-3">
                                        <input name="new_password" wire:model="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" id="tb-cpwd" placeholder="New Password">
                                        @if ($errors->has('new_password'))
                                            <div class="invalid-feedback">{{ $errors->first('new_password') }}</div>
                                        @endif
                                        <label for="tb-cpwd">New Password</label>
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-floating mt-3">
                                        <input name="confirm_password" wire:model="confirm_password" type="password" class="form-control @error('C_password') is-invalid @enderror" id="tb-cpwd" placeholder="Confirm Password">
                                        @if ($errors->has('confirm_password'))
                                            <div class="invalid-feedback">{{ $errors->first('confirm_password') }}</div>
                                        @endif
                                        <label for="tb-cpwd">Confirm Password</label>
                                      </div>
                                  </div>
                                  <div class="col-12">
                                      <div class="d-md-flex align-items-center mt-3">
                                        <div class="ms-auto mt-3 mt-md-0">
                                          <button type="submit" class="btn btn-primary font-medium px-4">
                                            <div class="d-flex align-items-center">
                                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit-circle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                  <path d="M12 15l8.385 -8.415a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3z"></path>
                                                  <path d="M16 5l3 3"></path>
                                                  <path d="M9 7.07a7 7 0 0 0 1 13.93a7 7 0 0 0 6.929 -6"></path>
                                               </svg>
                                               <span class="ms-2">Update</span>
                                            </div>
                                          </button>
                                        </div>
                                      </div>
                                    </div>
                              </div>
                          </form>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
  </div>
