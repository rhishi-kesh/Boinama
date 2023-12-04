
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
    <div class="col-12 @if($isEdit) col-lg-8 @endif align-self-start">
        <div class="card">
            <div class="card-header">
                <h5>All Subjects</h5>
            </div>
            <div class="card-block row">
                <div class="col-sm-12 col-lg-12 col-xl-12">
                    <div class="table-responsive px-4 pb-3">
                        <table class="table text-center mb-3">
                            <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Name</th>
                                    <th scope="col" style="width: 5px">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($subjects as $key => $subject)
                                <tr>
                                    <th>{{ $subjects->firstItem()+$key }}</th>
                                    <td>{{ $subject->name }}</td>
                                    <td class="switch-sm text-center" style="width: 10px; padding: 0 15px">
                                        <label class="switch">
                                            <input type="checkbox" wire:change="status({{ $subject->id }})" @if($subject->is_nav == 0) checked @endif>
                                            <span class="switch-state"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <a wire:click="changeEdit({{ $subject->id }})" class="btn-success active ps-3 pe-2 py-2 fs-6" style="cursor: pointer">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </a>
                                        <a  wire:click="deletecategory({{ $subject->id }})" class="px-3 py-2 btn-secondary active fs-6" style="cursor: pointer">
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
                        {{  $subjects->links()  }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-4 align-self-start">
        @if($isEdit)
            <div class="card">
                <form class="theme-form" Wire:submit="update" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header pb-0">
                        <h5>Edit Subject</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="CategoryName">Subject Name</label>
                            <input wire:model="name" class="form-control @error('name') is-invalid @enderror" id="CategoryName" type="text" placeholder="Enter Name">
                            @if ($errors->has('name'))
                                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="image">Banner</label>
                            <input wire:model="image" class="form-control @error('image') is-invalid @enderror" id="image" type="file" >
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
