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
                <h5>All Writers</h5>
            </div>
            <div class="card-block row">
                <div class="col-sm-12 col-lg-12 col-xl-12">
                    <div class="table-responsive px-4 pb-3">
                        <table class="table text-center mb-3">
                            <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($writers as $key => $writer)
                                <tr>
                                    <th>{{ $writers->firstItem()+$key }}</th>
                                    <td>{{ $writer->name }}</td>
                                    <td>
                                        <a wire:click="changeEdit({{ $writer->id }})" class="btn-success active ps-3 pe-2 py-2 fs-6" style="cursor: pointer">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </a>
                                        <a  wire:click="deletecategory({{ $writer->id }})" class="px-3 py-2 btn-secondary active fs-6" style="cursor: pointer">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-danger" colspan="20">No Data Found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{  $writers->links()  }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-4 align-self-start">
        @if($isEdit)
            <div class="card p-4 mb-2">
                <button wire:click="removeedit" class="btn btn-primary">Add Writer</button>
            </div>
            <div class="card">
                <form class="theme-form" Wire:submit="update">
                    @csrf
                    <div class="card-header pb-0">
                        <h5>Edit Writer</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="writer_image">Writer Image</label>
                            <input wire:model="writer_image" class="form-control @error('writer_image') is-invalid @enderror" id="writer_image" type="file">
                            @if ($writer_image)
                                <span class="d-block">Image Preview:</span>
                                <img width="150" class="mt-1" src="{{ $writer_image->temporaryUrl() }}">
                            @else
                                <img width="150" class="mt-1" src="{{ asset('storage/' . $old_writer_image) }}">
                            @endif
                            @if ($errors->has('writer_image'))
                                <div class="invalid-feedback">{{ $errors->first('writer_image') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="CategoryName">Writer Name</label>
                            <input wire:model="name" class="form-control @error('name') is-invalid @enderror" id="CategoryName" type="text" placeholder="Enter Name">
                            @if ($errors->has('name'))
                                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="description">Writer Description</label>
                            <textarea wire:model="description" class="form-control @error('description') is-invalid @enderror" id="description" placeholder="Enter Description"></textarea>
                            @if ($errors->has('description'))
                                <div class="invalid-feedback">{{ $errors->first('description') }}</div>
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
                    <h5>Create Writer</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="col-form-label pt-0" for="writer_image">Writer Image</label>
                        <input wire:model="writer_image" class="form-control @error('writer_image') is-invalid @enderror" id="writer_image" type="file">
                        @if ($writer_image)
                            <span class="d-block">Image Preview:</span>
                            <img width="150" class="mt-1" src="{{ $writer_image->temporaryUrl() }}">
                        @endif
                        @if ($errors->has('writer_image'))
                            <div class="invalid-feedback">{{ $errors->first('writer_image') }}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label pt-0" for="CategoryName">Writer Name</label>
                        <input wire:model="name" class="form-control @error('name') is-invalid @enderror" id="CategoryName" type="text" placeholder="Enter Name">
                        @if ($errors->has('name'))
                            <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label pt-0" for="description">Writer Description</label>
                        <textarea wire:model="description" class="form-control @error('description') is-invalid @enderror" id="description" placeholder="Enter Description"></textarea>
                        @if ($errors->has('description'))
                            <div class="invalid-feedback">{{ $errors->first('description') }}</div>
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
