<div class="row justify-content-center">
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
    <div class="col-6">
        <div class="card">
            <form class="theme-form" Wire:submit="submit">
                @csrf
                <div class="card-header pb-0">
                    <h5 class="text-success">Add User</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="col-form-label pt-0" for="name">User Name</label>
                        <input wire:model="name" class="form-control @error('name') is-invalid @enderror" id="name" type="text" placeholder="Enter Name">
                        @if ($errors->has('name'))
                            <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label pt-0" for="email">User Email</label>
                        <input wire:model="email" class="form-control @error('email') is-invalid @enderror" id="email" type="email" placeholder="Enter Email">
                        @if ($errors->has('email'))
                            <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label pt-0" for="role">Role</label>
                        <select wire:model="role" class="form-select @error('role') is-invalid @enderror" name="role" id="role">
                            <option value="">Select User Role</option>
                            <option value="0">Admin</option>
                            <option value="1">Vendor</option>
                            <option value="2">User</option>
                        </select>
                        @if ($errors->has('role'))
                            <div class="invalid-feedback">{{ $errors->first('role') }}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label pt-0" for="password">User Password</label>
                        <input wire:model="password" class="form-control @error('password') is-invalid @enderror" id="password" type="password" placeholder="Enter Password">
                        @if ($errors->has('password'))
                            <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label pt-0" for="confirm_password">Confirm Password</label>
                        <input wire:model="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror" id="confirm_password" type="password" placeholder="Enter Confirm Password">
                        @if ($errors->has('confirm_password'))
                            <div class="invalid-feedback">{{ $errors->first('confirm_password') }}</div>
                        @endif
                    </div>
                </div>
                <div class="card-footer pt-0">
                    <button class="btn btn-primary" type="submit">Submit</button>
                    <button class="btn btn-secondary" type="reset">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>
