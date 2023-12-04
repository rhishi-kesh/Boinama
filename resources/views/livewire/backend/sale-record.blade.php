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
   <div class="col-12 px-4">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="col-12 col-lg-8 align-self-start">
                        <form method="POST" wire:submit="submit">
                            <div class="row">
                                <div class="col">
                                    <label for="form_date" class="mb-0">From Date</label>
                                </div>
                                <div class="col">
                                    <input class="form-control" wire:model="startDate" type="date" id="form_date" name="form_date">
                                </div>
                                <div class="col">
                                    <label for="to_date" class="mb-0">To Date</label>
                                </div>
                                <div class="col">
                                    <input class="form-control" wire:model="endDate" type="date" id="to_date" name="to_date">
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-red">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @if($isShow == true)
                    <div class="col-12">
                        <div class="table-responsive mt-3 text-center">
                            <table class="table table-hover table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Invoice</th>
                                        <th>Date</th>
                                        <th>Address</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($records as $key => $record)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $record->invoice }}</td>
                                            <td>{{ $record->order_date }}</td>
                                            <td>{{ $record->billing_address }}</td>
                                            <td>৳ {{ $record->total }}</td>
                                            {{ $total += $record->total }}
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="20" class="text-center text-danger">No data found</td>
                                        </tr>
                                    @endforelse

                                    <tr>
                                        <td colspan="4" align="right">
                                            <b>Total</b>
                                        </td>
                                        <td>
                                            <b>৳ {{ $total }}</b>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
