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
            <div class="card-body">
                <ul class="nav nav-tabs search-list justify-content-start" id="top-tab" role="tablist" style="border-radius: 0px">
                    <li class="nav-item" style="border-right: 4px solid #fff"><a class="nav-link px-2 active" id="all-link" data-bs-toggle="tab" href="#padding"
                            role="tab" aria-selected="true"><i class="fas fa-spinner mr-2"></i>Padding Orders</a>
                        <div class="material-border"></div>
                    </li>
                    <li class="nav-item" style="border-right: 4px solid #fff"><a class="nav-link px-2" id="image-link" data-bs-toggle="tab" href="#confirm"
                            role="tab" aria-selected="false"><i class="fa-solid fa-check"></i>Confirm Orders</a>
                        <div class="material-border"></div>
                    </li>
                    <li class="nav-item" style="border-right: 4px solid #fff"><a class="nav-link px-2" id="video-link" data-bs-toggle="tab" href="#process"
                            role="tab" aria-selected="false"><i class="fa-solid fa-person-running"></i>Process Orders</a>
                        <div class="material-border"></div>
                    </li>
                    <li class="nav-item" style="border-right: 4px solid #fff;"><a class="nav-link px-2" id="map-link" data-bs-toggle="tab" href="#shipping"
                            role="tab" aria-selected="false"><i class="fa-solid fa-truck"></i>Shipping Orders</a>
                        <div class="material-border"></div>
                    </li>
                    <li class="nav-item" style="border-right: 4px solid #fff"><a class="nav-link px-2" id="setting-link" data-bs-toggle="tab" href="#delivered"
                            role="tab" aria-selected="false"><i class="far fa-thumbs-up mr-2"></i>Delivered Orders</a>
                        <div class="material-border"></div>
                    </li>
                    <li class="nav-item" style="border-right: 4px solid #fff"><a class="nav-link px-2" id="setting-link" data-bs-toggle="tab" href="#cancel"
                            role="tab" aria-selected="false"><i class="fas fa-ban mr-2"></i>Cancel Orders</a>
                        <div class="material-border"></div>
                    </li>
                </ul>
                <div class="tab-content" id="top-tabContent">
                    <div class="tab-pane show active" id="padding" role="tabpanel" aria-labelledby="all-link">
                        <div class="table-responsive mt-3 text-center">
                            <table class="table table-hover table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Date</th>
                                        <th>Customer</th>
                                        <th>Address</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pendingOrders as $key => $item)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $item->order_date }}</td>
                                            <td>{{ $item->customer->name ?? "N/A" }}</td>
                                            <td>{{ $item->billing_address }}</td>
                                            <td>৳ {{ $item->total }}</td>
                                            <td>
                                                <span class="bg-success text-white py-1 px-2" style="border-radius: 20px; font-size: 13px">Pending</span>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-start">
                                                    <a href="{{ route('invoice', $item->id) }}" class="px-2 pt-1 pb-0 btn-primary active text-center" style="cursor: pointer" >
                                                        <i class="fa-solid fa-file-invoice"></i>
                                                    </a>
                                                    <a wire:click="confirmOrder({{ $item->id }})" class="px-2 pt-1 pb-0 btn-success active text-center" style="cursor: pointer">
                                                        <i class="fa-solid fa-check"></i>
                                                    </a>
                                                    <a wire:click="cancelOrder({{ $item->id }})" class="px-2 pt-1 pb-0 btn-danger active text-center" style="font-size: 12px; cursor: pointer">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-danger" colspan="40">No data found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="confirm" role="tabpanel" aria-labelledby="image-link">
                        <div class="table-responsive mt-3 text-center">
                            <table class="table table-hover table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Date</th>
                                        <th>Customer</th>
                                        <th>Address</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($confirmOrders as $key => $item)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $item->order_date }}</td>
                                            <td>{{ $item->customer->name ?? "N/A" }}</td>
                                            <td>{{ $item->billing_address }}</td>
                                            <td>৳ {{ $item->total }}</td>
                                            <td>
                                                <span class="bg-success text-white py-1 px-2" style="border-radius: 20px; font-size: 13px">Confirm</span>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-start">
                                                    <a href="{{ route('invoice', $item->id) }}" class="px-2 pt-1 pb-0 btn-primary active text-center" style="cursor: pointer" >
                                                        <i class="fa-solid fa-file-invoice"></i>
                                                    </a>
                                                    <a wire:click="processOrder({{ $item->id }})" class="px-2 pt-1 pb-0 btn-success active text-center" style="cursor: pointer">
                                                        <i class="fa-solid fa-check"></i>
                                                    </a>
                                                    <a wire:click="cancelOrder({{ $item->id }})" class="px-2 pt-1 pb-0 btn-danger active text-center" style="font-size: 12px; cursor: pointer">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-danger" colspan="40">No data found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="process" role="tabpanel" aria-labelledby="video-link">
                        <div class="table-responsive mt-3 text-center">
                            <table class="table table-hover table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Date</th>
                                        <th>Customer</th>
                                        <th>Address</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($processOrders as $key => $item)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $item->order_date }}</td>
                                            <td>{{ $item->customer->name ?? "N/A" }}</td>
                                            <td>{{ $item->billing_address }}</td>
                                            <td>৳ {{ $item->total }}</td>
                                            <td>
                                                <span class="bg-success text-white py-1 px-2" style="border-radius: 20px; font-size: 13px">Process</span>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-start">
                                                    <a href="{{ route('invoice', $item->id) }}" class="px-2 pt-1 pb-0 btn-primary active text-center" style="cursor: pointer" >
                                                        <i class="fa-solid fa-file-invoice"></i>
                                                    </a>
                                                    <a wire:click="shippingOrder({{ $item->id }})" class="px-2 pt-1 pb-0 btn-success active text-center" style="cursor: pointer">
                                                        <i class="fa-solid fa-check"></i>
                                                    </a>
                                                    <a wire:click="cancelOrder({{ $item->id }})" class="px-2 pt-1 pb-0 btn-danger active text-center" style="font-size: 12px; cursor: pointer">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-danger" colspan="40">No data found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="shipping" role="tabpanel" aria-labelledby="video-link">
                        <div class="table-responsive mt-3 text-center">
                            <table class="table table-hover table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Date</th>
                                        <th>Customer</th>
                                        <th>Address</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($shippingOrders as $key => $item)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $item->order_date }}</td>
                                            <td>{{ $item->customer->name ?? "N/A" }}</td>
                                            <td>{{ $item->billing_address }}</td>
                                            <td>৳ {{ $item->total }}</td>
                                            <td>
                                                <span class="bg-success text-white py-1 px-2" style="border-radius: 20px; font-size: 13px">shipping</span>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-start">
                                                    <a href="{{ route('invoice', $item->id) }}" class="px-2 pt-1 pb-0 btn-primary active text-center" style="cursor: pointer" >
                                                        <i class="fa-solid fa-file-invoice"></i>
                                                    </a>
                                                    <a wire:click="deliveredOrder({{ $item->id }})" class="px-2 pt-1 pb-0 btn-success active text-center" style="cursor: pointer">
                                                        <i class="fa-solid fa-truck"></i>
                                                    </a>
                                                    <a wire:click="cancelOrder({{ $item->id }})" class="px-2 pt-1 pb-0 btn-danger active text-center" style="font-size: 12px; cursor: pointer">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-danger" colspan="40">No data found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane " id="delivered" role="tabpanel" aria-labelledby="video-link">
                        <div class="table-responsive mt-3 text-center">
                            <table class="table table-hover table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Date</th>
                                        <th>Customer</th>
                                        <th>Address</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($deliveredOrders as $key => $item)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $item->order_date }}</td>
                                            <td>{{ $item->customer->name ?? "N/A" }}</td>
                                            <td>{{ $item->billing_address }}</td>
                                            <td>৳ {{ $item->total }}</td>
                                            <td>
                                                <span class="bg-success text-white py-1 px-2" style="border-radius: 20px; font-size: 13px">Delivered</span>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ route('invoice', $item->id) }}" class="px-2 pt-1 pb-0 btn-success active text-center" style="cursor: pointer" >
                                                        <i class="fa-solid fa-file-invoice"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-danger" colspan="40">No data found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="cancel" role="tabpanel" aria-labelledby="video-link">
                        <div class="table-responsive mt-3 text-center">
                            <table class="table table-hover table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Date</th>
                                        <th>Customer</th>
                                        <th>Address</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($cancelOrders as $key => $item)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $item->order_date }}</td>
                                            <td>{{ $item->customer->name ?? "N/A" }}</td>
                                            <td>{{ $item->billing_address }}</td>
                                            <td>৳ {{ $item->total }}</td>
                                            <td>
                                                <span class="bg-danger text-white py-1 px-2" style="border-radius: 20px; font-size: 13px">Canceled</span>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ route('invoice', $item->id) }}" class="px-2 pt-1 pb-0 btn-success active text-center" style="cursor: pointer" >
                                                        <i class="fa-solid fa-file-invoice"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-danger" colspan="40">No data found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
