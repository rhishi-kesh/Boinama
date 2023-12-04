<div class="col-sm-12 table-dta">
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
    @if($isview)
        <div class="col-sm-12 col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h5>Single Product</h5>
                        <div>
                            <a class="btn btn-danger" wire:click="showtable">Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <ul class="list-group">
                                <li class="list-group-item"><b>Product Image:</b>
                                    <img src="{{ asset('storage/' . $previewimage) }}" class="ms-3" alt="image"
                                        style="width: 60px; height: 90px; object-fit: cover;">
                                </li>
                                <li class="list-group-item"><b>Product Preview:</b>
                                    <a href="{{ asset('storage/' . $preview) }}" target="_blank">Click & View Preview</a>
                                </li>
                                <li class="list-group-item"><b>Product Name:</b> {{ $name }}</li>
                                <li class="list-group-item"><b>Product Price:</b> {{ $price }}</li>
                                <li class="list-group-item"><b>Product Quantity:</b> {{ $quantity }}</li>
                                <li class="list-group-item"><b>Product Original Price:</b> {{ $discount }}</li>
                                <li class="list-group-item"><b>Product Writer:</b> {{ $writer_id }}</li>
                                <li class="list-group-item"><b>Product Subject:</b> {{ $subject_id }}</li>
                                <li class="list-group-item"><b>Product Prokashoni:</b> {{ $prakasani_id }}</li>
                                <li class="list-group-item"><b>Product Description:</b> {{ $description }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @elseif($isedit)
        <div class="col-12">
            <div class="card">
                <form class="theme-form" wire:submit="update">
                    @csrf
                    <div class="card-header pb-0">
                        <h5>Edit Product</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="mt-3 col-6">
                                <label for="name" class="form-label">Product Name <span
                                    class="text-danger">*</span></label>
                                <input type="text" wire:model="name"
                                    class="form-control @error('name') is-invalid @enderror" id="name"
                                    name="name" class="form-control" placeholder="Enter Name">
                                @if ($errors->has('name'))
                                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                            <div class="mt-3 col-6">
                                <label for="price" class="form-label">Product Price <span
                                    class="text-danger">*</span></label>
                                <input type="text" wire:model="price"
                                    class="form-control @error('price') is-invalid @enderror" id="price"
                                    name="price" class="form-control" placeholder="Enter Price">
                                @if ($errors->has('price'))
                                    <div class="invalid-feedback">{{ $errors->first('price') }}</div>
                                @endif
                            </div>
                            <div class="mt-3 col-6">
                                <label for="quantity" class="form-label">Product Quantity <span
                                    class="text-danger">*</span></label>
                                <input type="text" wire:model="quantity"
                                    class="form-control @error('quantity') is-invalid @enderror" id="quantity"
                                    name="quantity" class="form-control" placeholder="Enter Quantity">
                                @if ($errors->has('quantity'))
                                    <div class="invalid-feedback">{{ $errors->first('quantity') }}</div>
                                @endif
                            </div>
                            <div class="mt-3 col-6">
                                <label for="discount" class="form-label">Product Original Price</label>
                                <input type="text" wire:model="discount"
                                    class="form-control @error('discount') is-invalid @enderror" id="discount"
                                    name="discount" class="form-control" placeholder="Enter Discount">
                                @if ($errors->has('discount'))
                                    <div class="invalid-feedback">{{ $errors->first('discount') }}</div>
                                @endif
                            </div>
                            <div class="mt-3 col-6">
                                <label for="image" class="form-label">Product Image <span
                                    class="text-danger">*</span></label>
                                <input type="file" wire:model="image" class="form-control @error('image') is-invalid @enderror" id="image" name="image" class="form-control">
                                @if ($image)
                                    <span class="d-block">Image Preview:</span>
                                    <img style="width: 60px; height: 90px;" class="mt-1" src="{{ $image->temporaryUrl() }}">
                                @else
                                    <img style="width: 60px; height: 90px;" class="mt-1" src="{{ asset('storage/' . $oldimageproduct) }}">
                                @endif
                                @if ($errors->has('image'))
                                    <div class="invalid-feedback">{{ $errors->first('image') }}</div>
                                @endif
                            </div>
                            <div class="mt-3 col-6 align-self-start">
                                <label for="preview" class="form-label">Product Preview</label>
                                <input type="file" wire:model="preview" class="form-control @error('preview') is-invalid @enderror" id="preview" name="preview" class="form-control">
                                <a href="{{ asset('storage/' . $oldimagepreview) }}" target="_blank" class="mt-2">Click & View Preview</a>
                                @if ($errors->has('preview'))
                                    <div class="invalid-feedback">{{ $errors->first('preview') }}</div>
                                @endif
                            </div>
                            <div class="mt-3 col-6">
                                <label class="form-label pt-0" for="writer_id">Select Writers <span
                                        class="text-danger">*</span></label>
                                <select wire:model="writer_id" name="writer_id" id="writer_id"
                                    class="form-select @error('writer_id') is-invalid @enderror">
                                    <option value="">Select writer</option>
                                    @foreach ($writers as $writer)
                                        <option value="{{ $writer->id }}">{{ $writer->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('writer_id'))
                                    <div class="invalid-feedback">{{ $errors->first('writer_id') }}</div>
                                @endif
                            </div>
                            <div class="mt-3 col-6">
                                <label class="form-label pt-0" for="subject_id">Select Subject <span
                                        class="text-danger">*</span></label>
                                <select wire:model="subject_id" name="subject_id" id="subject_id"
                                    class="form-select @error('subject_id') is-invalid @enderror">
                                    <option value="">Select subject</option>
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('subject_id'))
                                    <div class="invalid-feedback">{{ $errors->first('subject_id') }}</div>
                                @endif
                            </div>
                            <div class="mt-3 col-6 align-self-start">
                                <label class="form-label pt-0" for="prakasani_id">Select Prokashoni <span
                                        class="text-danger">*</span></label>
                                <select wire:model="prakasani_id" name="prakasani_id" id="prakasani_id"
                                    class="form-select @error('prakasani_id') is-invalid @enderror">
                                    <option value="">Select prakasani</option>
                                    @foreach ($prakasanis as $prakasani)
                                        <option value="{{ $prakasani->id }}">{{ $prakasani->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('prakasani_id'))
                                    <div class="invalid-feedback">{{ $errors->first('prakasani_id') }}</div>
                                @endif
                            </div>
                            <div class="mt-3 col-6">
                                <label class="form-label pt-0" for="description">Description</label>
                                    <textarea wire:model="description" class="form-control @error('description') is-invalid @enderror" id="description"
                                        name="description" class="form-control" placeholder="Enter Product Description"></textarea>
                                @if ($errors->has('description'))
                                    <div class="invalid-feedback">{{ $errors->first('description') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-footer pt-0">
                        <button class="btn btn-primary" type="submit">Update</button>
                        <a class="btn btn-danger" wire:click="showtable">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    @else
        <div class="card">
            <div class="card-header pb-0">
                <h5>All Padding Products</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="basic-3_wrapper" class="dataTables_wrapper">
                        <div class="d-flex justify-content-between">
                            <div class="dataTables_length" id="basic-3_length">
                                <label>Show
                                    <select name="basic-3_length" wire:model.live="perPage" class="form-select"
                                        style="width: 70px; display: inline-block; height: 35px; margin: 2px">
                                        <option value="15">15</option>
                                        <option value="30">30</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select> entries
                                </label>
                            </div>
                            <div id="basic-3_filter" class="dataTables_filter">
                                <label>Search:
                                    <input wire:model.live.debounce.300ms = "search" type="search"
                                        placeholder="Product Name" aria-controls="basic-3">
                                </label>
                            </div>
                        </div>
                        <table class="display dataTable mb-2" id="basic-3" role="grid" aria-describedby="basic-3_info">
                            <thead>
                                <tr role="row">
                                    <th scope="col">SL</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col" style="font-size: 13px">Original Price</th>
                                    <th scope="col">Subjects</th>
                                    <th scope="col">Prokashoni</th>
                                    <th scope="col">Writers</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($Products as $key => $Product)
                                    <tr role="row" class="odd">
                                        <td>{{ $Products->firstItem() + $key }}</td>
                                        <td>{{ $Product->name }}</td>
                                        <td>
                                            <img src="{{ asset('storage/' . $Product->image) }}" alt="image"
                                                style="width: 60px; height: 90px; object-fit: cover;">
                                        </td>
                                        <td>৳ {{ $Product->price }}</td>
                                        <td>{{ $Product->quantity }}</td>
                                        <td>{{ $Product->discount }}</td>
                                        <td>{{ $Product->subjects_id->name }}</td>
                                        <td>{{ $Product->prakasanis_id->name }}</td>
                                        <td>{{ $Product->writers_id->name }}</td>
                                        <td style="width: 10px; text-align: center;">
                                            <div class="d-flex">
                                                <button wire:click="view({{ $Product->id }})" class="px-2 py-1 btn-primary active text-center" style="font-size: 12px">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </button>
                                                <button wire:click="status({{ $Product->id }})" class="px-2 py-1 btn-success active text-center ms-1">
                                                    <i class="fa-solid fa-check"></i>
                                                </button>
                                            </div>
                                            <div class="d-flex mt-1">
                                                <button wire:click="showEdit({{ $Product->id }})" class="d-block px-2 py-1 btn-info active text-center" style="font-size: 12px">
                                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                                </button>
                                                <button  wire:click="delete({{ $Product->id}})" class="d-block px-2 py-1 btn-danger active text-center ms-1">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="40" class="text-center text-danger">No Data Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p>Showing {{ $Products->firstItem() }} to {{ $Products->lastItem() }} of
                                    {{ $Products->total() }} entries</p>
                            </div>
                            <div>
                                {{ $Products->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
