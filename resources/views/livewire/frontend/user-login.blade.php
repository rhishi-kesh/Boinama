<div class="app">
    <div class="app-content">
        <div class="bg-anti-flash-white">
            <div class="section__content">
                <div class="container">
                    <div class="row row--center">
                        <div class="col-lg-6 col-md-8 u-s-m-b-30">
                            <div class="l-f-o">
                                <div class="l-f-o__pad-box">
                                    @if ($errors->any())
                                        <div {{ $attributes }}>
                                            <div class="font-medium text-danger mt-3">{{ __('Whoops! Something went wrong.') }}</div>

                                            <ul class="mt-2 text-danger">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form method="POST" action="{{ route('customerloginpost') }}">
                                        <h3 class="text-center text-uppercase text-dark h3">login</h3>
                                        @csrf
                                        @if (session()->has('invalid'))
                                            <div class="alert alert-danger alert-dismissible">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <p>{{ session('invalid') }}</p>
                                            </div>
                                        @endif
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
                                            <button class="btn shadow-none btn-orange">Log In</button>
                                        </div>
                                        <p class="text-center mt-2">Don't have an account? <a class="color-orange" href="{{ route('customerregistation') }}" >Register</a></p>
                                    </form>
                                </div>
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
