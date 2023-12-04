<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BoiNama Login</title>
    <link rel="stylesheet" type="text/css" href="{{ url('backend/') }}/{{ 'assets/css/vendors/bootstrap.css' }}">

</head>
<body>
    <section class="mt-5 pt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-7 col-lg-5">
                    <div class="card p-4 shadow">
                        <img src="{{ url('/logo.png') }}" alt="Logo" style="margin: auto; width: 100px; object-fit: cover; margin-bottom: 10px" >

                        @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
                            {{ session('error') }}
                        </div>
                        @endif

                        <form method="POST" action="{{ route('adminloginsPOST') }}">
                            @csrf

                            <div>
                                <x-label for="email" value="{{ __('Email') }}" class="form-label" />
                                <x-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                            </div>

                            <div class="mt-4">
                                <x-label for="password" value="{{ __('Password') }}" class="form-label" />
                                <x-input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
                            </div>

                            <div class="block mt-4">
                                <label for="remember_me" class="flex items-center">
                                    <x-checkbox id="remember_me" name="remember" />
                                    <span class="ml-2 text-sm text-gray-600">Remember Me</span>
                                </label>
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <button class="btn btn-dark">Log In</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- latest jquery-->
    <script src="{{ url('backend') }}/{{ "assets/js/jquery-3.5.1.min.js" }}"></script>
    <!-- Bootstrap js-->
    <script src="{{ url('backend') }}/{{ "assets/js/bootstrap/popper.min.js" }}"></script>
    <script src="{{ url('backend') }}/{{ "assets/js/bootstrap/bootstrap.min.js" }}"></script>
</body>
</html>
