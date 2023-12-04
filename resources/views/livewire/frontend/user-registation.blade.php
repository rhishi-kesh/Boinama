<div class="app">
    <div class="app-content">
        <div class="bg-anti-flash-white">
            <div class="section__content">
                <div class="container">
                    <div class="row row--center">
                        <div class="col-lg-6 col-md-8 u-s-m-b-30">
                            <div class="l-f-o">
                                <div class="l-f-o__pad-box">
                                    <form method="POST" wire:submit="submit">
                                        <h3 class="text-center text-uppercase text-dark h3">Register</h3>
                                        @csrf
                                        <div>
                                            <x-label for="name" value="{{ __('Name') }}" class="form-label" />
                                            <x-input id="name" wire:model="name" class="form-control" type="text" name="name" :value="old('name')" autofocus autocomplete="username" />
                                            @error('name') <span class="text-danger" style="font-size: 12px">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="mt-4">
                                            <x-label for="email" value="{{ __('Email') }}" class="form-label" />
                                            <x-input id="email" wire:model="email" class="form-control" type="email" name="email" :value="old('email')" autofocus autocomplete="username" />
                                            @error('email') <span class="text-danger" style="font-size: 12px">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="mt-4">
                                            <x-label for="password" value="{{ __('Password') }}" class="form-label" />
                                            <x-input id="password" wire:model="password" class="form-control" type="password" name="password" autocomplete="current-password" />
                                            @error('password') <span class="text-danger" style="font-size: 12px">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="mt-4">
                                            <x-label for="confirm_password" value="{{ __('Confirm Password') }}" class="form-label" />
                                            <x-input id="confirm_password" wire:model="confirm_password" class="form-control" type="password" name="confirm_password" autocomplete="current-password"/>
                                            @error('confirm_password') <span class="text-danger" style="font-size: 12px">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="d-flex justify-content-end mt-4">
                                            <button class="btn shadow-none btn-orange">REGISTER</button>
                                        </div>
                                        <p class="text-center mt-2">Already have an account? <a class="color-orange" href="{{ route('customerlogin') }}" >Login</a></p>
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
