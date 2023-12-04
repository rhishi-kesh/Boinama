
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
                <h5>All Admins</h5>
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
                                @forelse ($admins as $key => $admin)
                                <tr>
                                    <th>{{ $admins->firstItem()+$key }}</th>
                                    <td>{{ $admin->name }}</td>
                                    <td>
                                        <img src="{{ asset('storage/' . $admin->profile_photo_path) }}" alt="" class="rounded-circle object-fit-cover" style="width: 35px; height: 35px; object-fit: cover;">
                                    </td>
                                    <td>{{ $admin->email }}</td>
                                    <td>
                                        @if ($admin->role == 0)
                                            Admin
                                        @else
                                            Writer
                                        @endif
                                    </td>
                                    <td class="switch-sm">
                                        <label class="switch">
                                            <input type="checkbox" wire:change="status({{ $admin->id }})" @if($admin->status == 0) checked @endif>
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
                        {{  $admins->links()  }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 align-self-start">
        <div class="card">
            <div class="card-header">
                <h5>All Users</h5>
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
                                @forelse ($users as $key => $user)
                                <tr>
                                    <th>{{ $users->firstItem()+$key }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>
                                        <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="" class="rounded-circle object-fit-cover" style="width: 35px; height: 35px; object-fit: cover;">
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->role == 0)
                                            Admin
                                        @else
                                            User
                                        @endif
                                    </td>
                                    <td class="switch-sm">
                                        <label class="switch">
                                            <input type="checkbox" wire:change="status({{ $user->id }})" @if($user->status == 0) checked @endif>
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
                        {{  $users->links()  }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
