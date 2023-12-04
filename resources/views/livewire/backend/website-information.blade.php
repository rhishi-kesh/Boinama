<div class="row">
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
    <div class="col-12 align-self-start">
        <div class="card">
            <form class="theme-form" Wire:submit="update">
                @csrf
                <div class="card-header pb-0">
                    <h5>Edit Website Informations</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3 col-12 col-md-6 align-self-start">
                            <label class="col-form-label pt-0" for="logo">Website Logo</label>
                            <input wire:model="image" class="form-control @error('image') is-invalid @enderror" id="logo" type="file">
                            @if ($image)
                                <span class="d-block">Image Preview:</span>
                                <img width="150" class="mt-1" src="{{ $image->temporaryUrl() }}">
                            @else
                            <img width="150" class="mt-1" src="{{ asset('storage/' . $oldimage) }}">
                            @endif
                            @if ($errors->has('image'))
                                <div class="invalid-feedback">{{ $errors->first('image') }}</div>
                            @endif
                        </div>

                        <div class="mb-3 col-12 col-md-6 align-self-start">
                            <label class="col-form-label pt-0" for="footerabout">Footer About</label>
                            <textarea wire:model="fabout" rows="7" class="form-control @error('fabout') is-invalid @enderror" id="footerabout" placeholder="Footer About Text"></textarea>
                            @if ($errors->has('fabout'))
                                <div class="invalid-feedback">{{ $errors->first('fabout') }}</div>
                            @endif
                        </div>

                        <div class="mb-3 col-12 col-md-6">
                            <label class="col-form-label pt-0" for="address">Address</label>
                            <input wire:model="address" class="form-control @error('address') is-invalid @enderror" id="address" type="text" placeholder="Address">
                            @if ($errors->has('address'))
                                <div class="invalid-feedback">{{ $errors->first('address') }}</div>
                            @endif
                        </div>

                        <div class="mb-3 col-12 col-md-6">
                            <label class="col-form-label pt-0" for="number">Number</label>
                            <input wire:model="number" class="form-control @error('number') is-invalid @enderror" id="number" type="number" placeholder="Number">
                            @if ($errors->has('number'))
                                <div class="invalid-feedback">{{ $errors->first('number') }}</div>
                            @endif
                        </div>

                        <div class="mb-3 col-12 col-md-6">
                            <label class="col-form-label pt-0" for="gmail">Gmail</label>
                            <input wire:model="gmail" class="form-control @error('gmail') is-invalid @enderror" id="gmail" type="gmail" placeholder="Gmail">
                            @if ($errors->has('gmail'))
                                <div class="invalid-feedback">{{ $errors->first('gmail') }}</div>
                            @endif
                        </div>

                        <div class="mb-3 col-12 col-md-6">
                            <label class="col-form-label pt-0" for="facebook">Facebook</label>
                            <input wire:model="facebook" class="form-control @error('facebook') is-invalid @enderror" id="facebook" type="url" placeholder="Facebook">
                            @if ($errors->has('facebook'))
                                <div class="invalid-feedback">{{ $errors->first('facebook') }}</div>
                            @endif
                        </div>

                        <div class="mb-3 col-12 col-md-6">
                            <label class="col-form-label pt-0" for="linkedin">Linkedin</label>
                            <input wire:model="linkedin" class="form-control @error('linkedin') is-invalid @enderror" id="linkedin" type="url" placeholder="Linkedin">
                            @if ($errors->has('linkedin'))
                                <div class="invalid-feedback">{{ $errors->first('linkedin') }}</div>
                            @endif
                        </div>

                        <div class="mb-3 col-12 col-md-6">
                            <label class="col-form-label pt-0" for="youtube">YouTube</label>
                            <input wire:model="youtube" class="form-control @error('youtube') is-invalid @enderror" id="youtube" type="url" placeholder="YouTube">
                            @if ($errors->has('youtube'))
                                <div class="invalid-feedback">{{ $errors->first('youtube') }}</div>
                            @endif
                        </div>

                        <div class="mb-3 col-12 col-md-6">
                            <label class="col-form-label pt-0" for="twitter">Twitter</label>
                            <input wire:model="twitter" class="form-control @error('twitter') is-invalid @enderror" id="twitter" type="url" placeholder="Twitter">
                            @if ($errors->has('twitter'))
                                <div class="invalid-feedback">{{ $errors->first('twitter') }}</div>
                            @endif
                        </div>

                        <div class="mb-3 col-12 col-md-6">
                            <label class="col-form-label pt-0" for="instragram">Instragram</label>
                            <input wire:model="instragram" class="form-control @error('instragram') is-invalid @enderror" id="instragram" type="url" placeholder="Instragram">
                            @if ($errors->has('instragram'))
                                <div class="invalid-feedback">{{ $errors->first('instragram') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer pt-0">
                    <button class="btn btn-success active" type="submit">Update</button>
                    <button class="btn btn-secondary" type="reset">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>
