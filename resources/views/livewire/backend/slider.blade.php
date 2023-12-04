
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
    <div class="col-12 col-lg-8 align-self-start">
        <div class="card">
            <div class="card-header">
                <h5>All Sliders</h5>
            </div>
            <div class="card-block row">
                <div class="col-sm-12 col-lg-12 col-xl-12">
                    <div class="table-responsive px-4 pb-3">
                        <table class="table text-center mb-3">
                            <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Link</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($Sliders as $key => $Slider)
                                <tr>
                                    <th>{{ $Sliders->firstItem()+$key }}</th>
                                    <td>
                                        <img src="{{ asset('storage/' . $Slider->image) }}" alt="img" width="150">
                                    </td>
                                    <td>{{ $Slider->link }}</td>
                                    <td class="switch-sm">
                                        <label class="switch">
                                            <input type="checkbox" wire:change="status({{ $Slider->id }})" @if($Slider->status == 0) checked @endif>
                                            <span class="switch-state"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <button wire:click="changeEdit({{ $Slider->id }})" class="border-0 btn-success active ps-3 pe-3 mt-1 py-2 fs-6" style="cursor: pointer">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </button>
                                        <button  wire:click="deletecategory({{ $Slider->id }})" class="border-0 px-3 py-2 btn-secondary mt-1 active fs-6" style="cursor: pointer">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-danger" colspan="20">No Data Found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{  $Sliders->links()  }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-4 align-self-start">
        @if($isEdit)
            <div class="card p-4 mb-2">
                <button wire:click="removeedit" class="btn btn-primary">Add Category</button>
            </div>
            <div class="card">
                <form class="theme-form" Wire:submit="update">
                    @csrf
                    <div class="card-header pb-0">
                        <h5>Edit Slider</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="SliderImage">Slider Image</label>
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
                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="SliderLink">Slider Link</label>
                            <input wire:model="link" class="form-control @error('link') is-invalid @enderror" id="SliderLink" type="url" placeholder="Enter Your URL">
                            @if ($errors->has('link'))
                                <div class="invalid-feedback">{{ $errors->first('link') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer pt-0">
                        <button class="btn btn-success active" type="submit">Update</button>
                        <a class="btn btn-secondary" wire:click="removeedit">Cancel</a>
                    </div>
                </form>
            </div>
        @else
        <div class="card">
            <form class="theme-form" Wire:submit="submit" enctype="multipart/form-data">
                @csrf
                <div class="card-header pb-0">
                    <h5>Create Slider</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="col-form-label pt-0" for="SliderImage">Slider Image</label>
                        <input wire:model="image" class="form-control @error('image') is-invalid @enderror" id="SliderImage" type="file">
                        @if ($image)
                            <span class="d-block">Image Preview:</span>
                            <img width="150" src="{{ $image->temporaryUrl() }}">
                        @endif
                        @if ($errors->has('image'))
                            <div class="invalid-feedback">{{ $errors->first('image') }}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label pt-0" for="SliderLink">Slider Link</label>
                        <input wire:model="link" class="form-control @error('link') is-invalid @enderror" id="SliderLink" type="url" placeholder="Enter Your URL">
                        @if ($errors->has('link'))
                            <div class="invalid-feedback">{{ $errors->first('link') }}</div>
                        @endif
                    </div>
                </div>
                <div class="card-footer pt-0">
                    <button class="btn btn-primary" type="submit">Submit</button>
                    <button class="btn btn-secondary" type="reset">Reset</button>
                </div>
            </form>
        </div>
        @endif
    </div>
</div>
