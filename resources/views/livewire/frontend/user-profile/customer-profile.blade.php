<div class="app user_profile">
    <div class="app-content">
        <div class="bg-anti-flash-white py-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-3">
                        <ul class="list-group">
                            <a class="list-group-item" href="{{ route('dashboard') }}">
                                <i class="fas fa-tachometer-alt mr-2"></i>
                                Dashboard
                            </a>
                            <a class="list-group-item" href="{{ route('all_order') }}">
                                <i class="fas fa-list mr-2"></i>
                                All Orders
                            </a>
                            <a class="list-group-item" href="{{ route('all_pending_order') }}">
                                <i class="fas fa-spinner mr-2"></i>
                                Pending Orders
                            </a>
                            <a class="list-group-item" href="{{ route('all_delivered_order') }}">
                                <i class="far fa-thumbs-up mr-2"></i>
                                Delivered Orders
                            </a>
                            <a class="list-group-item" href="{{ route('all_cancel_order') }}">
                                <i class="fas fa-ban mr-2"></i>
                                Canceled Orders
                            </a>
                            <a class="list-group-item active" href="{{ route('customer_profile') }}">
                                <i class="fas fa-edit mr-2"></i>
                                Profile Update
                            </a>
                            <a class="list-group-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-power-off mr-2"></i>
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('customerLogout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </ul>
                    </div>
                    <div class="col-12 col-lg-9">
                        <div class="card shadow-none border">
                          <div class="card-body">
                            <h5 class="mb-3 h5">Update Information</h5>
                            <form wire:submit="informationUpdate" method="POST">
                                @csrf
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                      <input type="text" name="name"  wire:model="name" class="shadow-none form-control @error('name') is-invalid @enderror" id="tb-fname" placeholder="Enter Your Name">
                                      <label for="name">Name</label>
                                      @if ($errors->has('name'))
                                          <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                      @endif
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                      <input type="email" name="email" wire:model="email" class="shadow-none form-control @error('email') is-invalid @enderror" id="tb-email" placeholder="Enter Your Email">
                                      <label for="email">Email</label>
                                      @if ($errors->has('email'))
                                          <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                      @endif
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                      <input type="number" name="number" wire:model="number" class="shadow-none form-control @error('number') is-invalid @enderror" id="tb-number" placeholder="Enter Your Number">
                                      <label for="number">Number</label>
                                      @if ($errors->has('number'))
                                          <div class="invalid-feedback">{{ $errors->first('number') }}</div>
                                      @endif
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                      <input type="text" name="address" wire:model="address" class="shadow-none form-control @error('address') is-invalid @enderror" id="tb-address" placeholder="Enter Your Address">
                                      <label for="address">Address</label>
                                      @if ($errors->has('address'))
                                          <div class="invalid-feedback">{{ $errors->first('address') }}</div>
                                      @endif
                                    </div>
                                  </div>
                                  <div class="col-12">
                                    <div class="d-md-flex align-items-center mt-3">
                                      <div class="ms-auto mt-3 mt-md-0">
                                        <button type="submit" class="shadow-none btn btn-orange font-medium px-4">
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
                        <div class="card shadow-none border mt-5">
                            <div class="card-body">
                                <h5 class="mb-3 h5">Change Password</h5>
                                <form wire:submit="changePassword" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floating mt-3">
                                              <input name="old_Password" wire:model="old_Password" type="password" class="shadow-none form-control @error('old_Password') is-invalid @enderror @if (Session::has('old')) is-invalid @endif" id="tb-cpwd" placeholder="Old Password">
                                                <label for="old_Password">Old Password</label>
                                              @if ($errors->has('old_Password'))
                                                  <div class="invalid-feedback">{{ $errors->first('old_Password') }}</div>
                                              @endif
                                                @if (Session::has('old'))
                                                  <div class="invalid-feedback">{{ Session::get('old') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mt-3">
                                              <input name="new_password" wire:model="new_password" type="password" class="shadow-none form-control @error('new_password') is-invalid @enderror" id="tb-cpwd" placeholder="New Password">
                                                <label for="new_password">New Password</label>
                                              @if ($errors->has('new_password'))
                                                  <div class="invalid-feedback">{{ $errors->first('new_password') }}</div>
                                              @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mt-3">
                                              <input name="confirm_password" wire:model="confirm_password" type="password" class="shadow-none form-control @error('C_password') is-invalid @enderror" id="tb-cpwd" placeholder="Confirm Password">
                                              <label for="confirm_password">Confirm Password</label>
                                              @if ($errors->has('confirm_password'))
                                                  <div class="invalid-feedback">{{ $errors->first('confirm_password') }}</div>
                                              @endif
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-md-flex align-items-center mt-3">
                                              <div class="ms-auto mt-3 mt-md-0">
                                                <button type="submit" class="btn btn-orange font-medium px-4">
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
    @section('meta')
        <title>{{ empty($title) ? 'Boinama' : 'Boinama | '.$title }}</title>
        <meta property="og:image" content="{{ empty($image) ? 'https://www.boinama.com/storage/Logo/JUmWMpaNoSzroKomTiMy5j9dqknrf72gl8cz7UWo.png' : 'https://www.boinama.com/storage/'.$image }}"/>
        <meta property="og:image:width" content="200"/>
        <meta property="og:image:height" content="286"/>
        <meta property="og:title" content="{{ empty($title) ? 'Boinama' : $title }}"/>
        <meta property="og:description" content="{{ empty($discription) ? 'Boinama Best Book Seller In Bangladesh' : $discription }}"/>
        <meta property="og:url" content="{{ empty($url) ? 'https://www.boinama.com/' : $url }}">
    @endsection
</div>
