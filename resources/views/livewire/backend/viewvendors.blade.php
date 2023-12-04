
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
            <div class="card-header">
                <h5>All Vendors</h5>
            </div>
            <div class="card-block row">
                <div class="col-sm-12 col-lg-12 col-xl-12">
                    <div class="table-responsive px-4 pb-3">
                        <table class="table text-center mb-3">
                            <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($vendors as $key => $vendor)
                                <tr>
                                    <th>{{ $vendors->firstItem()+$key }}</th>
                                    <td>{{ $vendor->name }}</td>
                                    <td>
                                        <img src="{{ asset('storage/' . $vendor->profile_photo_path) }}" alt="" class="rounded-circle object-fit-cover" style="width: 35px; height: 35px; object-fit: cover;">
                                    </td>
                                    <td>{{ $vendor->email }}</td>
                                    <td>
                                        @if ($vendor->role == 0)
                                            Admin
                                        @else
                                            Vendor
                                        @endif
                                    </td>
                                    <td class="switch-sm">
                                        <label class="switch">
                                            <input type="checkbox" wire:change="status({{ $vendor->id }})" @if($vendor->status == 0) checked @endif>
                                            <span class="switch-state"></span>
                                        </label>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-danger" colspan="20">No Data Found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{  $vendors->links()  }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
