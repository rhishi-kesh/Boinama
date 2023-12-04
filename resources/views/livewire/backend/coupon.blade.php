
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
                <h5>All Coupons</h5>
            </div>
            <div class="card-block row">
                <div class="col-sm-12 col-lg-12 col-xl-12">
                    <div class="table-responsive px-4 pb-3">
                        <table class="table text-center mb-3">
                            <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Code</th>
                                    <th scope="col">Amount(%)</th>
                                    <th scope="col">Expire Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($coupons as $key => $coupon)
                                <tr>
                                    <th>{{ $coupons->firstItem()+$key }}</th>
                                    <td>{{ $coupon->code }}</td>
                                    <td>{{ $coupon->amount }}%</td>
                                    <td>{{ $coupon->expire_date }}</td>
                                    <td class="switch-sm">
                                        <label class="switch">
                                            <input type="checkbox" wire:change="status({{ $coupon->id }})" @if($coupon->status == 0) checked @endif>
                                            <span class="switch-state"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <a wire:click="changeEdit({{ $coupon->id }})" class="btn-success active ps-3 pe-2 py-2 fs-6" style="cursor: pointer">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </a>
                                        <a  wire:click="delete({{ $coupon->id }})" class="px-3 py-2 btn-secondary active fs-6" style="cursor: pointer">
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
                        {{  $coupons->links()  }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-4 align-self-start">
        @if($isEdit)
            <div class="card p-4 mb-2">
                <button wire:click="removeedit" class="btn btn-primary">Add Coupon</button>
            </div>
            <div class="card">
                <form class="theme-form" Wire:submit="update">
                    @csrf
                    <div class="card-header pb-0">
                        <h5>Edit Coupon</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="code">Code</label>
                            <input wire:model="code" class="form-control @error('code') is-invalid @enderror" id="code" type="text" placeholder="Enter Code">
                            @if ($errors->has('code'))
                                <div class="invalid-feedback">{{ $errors->first('code') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="amount">Amount(%)</label>
                            <input wire:model="amount" class="form-control @error('amount') is-invalid @enderror" id="amount" type="number" placeholder="Enter Amount" min="1" max="100">
                            @if ($errors->has('amount'))
                                <div class="invalid-feedback">{{ $errors->first('amount') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="expire">Expire Date</label>
                            <input wire:model="expire" class="form-control @error('expire') is-invalid @enderror" id="expire" type="date">
                            @if ($errors->has('expire'))
                                <div class="invalid-feedback">{{ $errors->first('expire') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer pt-0">
                        <button class="btn btn-primary" type="submit">Update</button>
                        <button class="btn btn-secondary" type="reset">Reset</button>
                    </div>
                </form>
            </div>
        @else
        <div class="card">
            <form class="theme-form" Wire:submit="submit">
                @csrf
                <div class="card-header pb-0">
                    <h5>Create Coupon</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="col-form-label pt-0" for="code">Code</label>
                        <input wire:model="code" class="form-control @error('code') is-invalid @enderror" id="code" type="text" placeholder="Enter Code">
                        @if ($errors->has('code'))
                            <div class="invalid-feedback">{{ $errors->first('code') }}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label pt-0" for="amount">Amount(%)</label>
                        <input wire:model="amount" class="form-control @error('amount') is-invalid @enderror" id="amount" type="number" placeholder="Enter Amount">
                        @if ($errors->has('amount'))
                            <div class="invalid-feedback">{{ $errors->first('amount') }}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label pt-0" for="expire">Expire Date</label>
                        <input wire:model="expire" class="form-control @error('expire') is-invalid @enderror" id="expire" type="date">
                        @if ($errors->has('expire'))
                            <div class="invalid-feedback">{{ $errors->first('expire') }}</div>
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
