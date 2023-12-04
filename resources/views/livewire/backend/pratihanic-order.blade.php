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
    <div class="@if($isEdit)col-12 col-lg-4 @else col-12 col-lg-7 @endif align-self-start">
        <div class="card">
            <div class="card-header row">
                <div class="d-flex justify-content-between mb-4">
                    <h5>Corporate Order Content</h5>
                    <button class="btn btn-primary btn-sm" wire:click="changeEdit({{ $corporates->id }})">Edit</button>
                </div>
                <ul class="list-group">
                    <li class="list-group-item"><b>Title:</b> {{ $corporates->title }}</li>
                    <li class="list-group-item"><b>SubTitle:</b> {{ $corporates->subtitle }}</li>
                    <li class="list-group-item"><b>Phone:</b> {{ $corporates->number }}</li>
                    <li class="list-group-item"><b>Gmail:</b> {{ $corporates->gmail }}</li>
                    <li class="list-group-item"><b>Image:</b>
                        <img src="{{ asset('storage/' . $corporates->image) }}" class="ms-3" alt="image" >
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="@if($isEdit)col-12 col-lg-8 @else col-12 col-lg-5 @endif align-self-start">
        @if($isEdit)
            <div class="card">
                <form class="theme-form" Wire:submit="update">
                    @csrf
                    <div class="card-header pb-0">
                        <h5>Edit Corporate Order Content</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="title">Title</label>
                            <input wire:model="title" class="form-control @error('title') is-invalid @enderror" id="title" type="text" placeholder="Enter Title">
                            @if ($errors->has('title'))
                                <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="subtitle">SubTitle</label>
                            <textarea wire:model="subtitle" class="form-control @error('title') is-invalid @enderror" id="subtitle" type="text" placeholder="Enter SubTitle"></textarea>
                            @if ($errors->has('subtitle'))
                                <div class="invalid-feedback">{{ $errors->first('subtitle') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="number">Phone</label>
                            <input wire:model="number" class="form-control @error('number') is-invalid @enderror" id="number" type="number" placeholder="Enter Phone">
                            @if ($errors->has('number'))
                                <div class="invalid-feedback">{{ $errors->first('number') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="gmail">G-Mail</label>
                            <input wire:model="gmail" class="form-control @error('title') is-invalid @enderror" id="gmail" type="email" placeholder="Enter G-Mail">
                            @if ($errors->has('gmail'))
                                <div class="invalid-feedback">{{ $errors->first('gmail') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="SliderImage">Image</label>
                            <input wire:model="image" class="form-control @error('image') is-invalid @enderror" id="SliderImage" type="file">
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
                    </div>
                    <div class="card-footer pt-0">
                        <button class="btn btn-success active" type="submit">Update</button>
                        <a class="btn btn-secondary" wire:click="removeedit">Cancel</a>
                    </div>
                </form>
            </div>
            @endif
    </div>
</div>
