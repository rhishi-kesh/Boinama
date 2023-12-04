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
    <div class="@if($isEdit)col-12 col-lg-8 align-self-start @else col-12 col-lg-8 @endif">
        <div class="card">
            <div class="card-header">
                <h5>Shipping Fee</h5>
            </div>
            <div class="card-block row">
                <div class="col-sm-12 col-lg-12 col-xl-12">
                    <div class="table-responsive px-4 pb-3">
                        <table class="table text-center mb-3">
                            <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Shipping Fee</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $item = 1;
                                @endphp
                                @forelse ($shippingFees as $key => $shippingFee)
                                <tr>
                                    <th>{{ $item++ }}</th>
                                    <td>{{ $shippingFee->fee }} ৳</td>
                                    <td>
                                        <button wire:click="changeEdit({{ $shippingFee->id }})" class="border-0 btn-success active ps-3 pe-3 mt-1 py-2 fs-6" style="cursor: pointer">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-4 align-self-start">
        @if($isEdit)
            <div class="card">
                <form class="theme-form" Wire:submit="update">
                    @csrf
                    <div class="card-header pb-0">
                        <h5>Edit Shipping Fee</h5>
                    </div>
                    <div class="card-body">

                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="fee">Fee</label>
                            <input wire:model="fee" class="form-control @error('fee') is-invalid @enderror" id="fee" type="number" placeholder="Enter Fee">
                            @if ($errors->has('fee'))
                                <div class="invalid-feedback">{{ $errors->first('fee') }}</div>
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
