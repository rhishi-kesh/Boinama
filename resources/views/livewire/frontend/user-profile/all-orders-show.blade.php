<div class="app user_profile">
    <div class="app-content">
        <div class="bg-anti-flash-white py-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-3">
                        <ul class="list-group">
                            <a class="list-group-item" href="{{ route('dashboard') }}">
                                <i class="fas fa-tachometer-alt mr-2"></i>
                                Dashboard
                            </a>
                            <a class="list-group-item" href="{{ route('all_order') }}">
                                <i class="fas fa-list mr-2"></i>
                                All Orders
                            </a>
                            <a class="list-group-item" href="{{ route('all_pending_order') }}">
                                <i class="fas fa-spinner mr-2"></i>
                                Pending Orders
                            </a>
                            <a class="list-group-item" href="{{ route('all_delivered_order') }}">
                                <i class="far fa-thumbs-up mr-2"></i>
                                Delivered Orders
                            </a>
                            <a class="list-group-item" href="{{ route('all_cancel_order') }}">
                                <i class="fas fa-ban mr-2"></i>
                                Canceled Orders
                            </a>
                            <a class="list-group-item" href="{{ route('customer_profile') }}">
                                <i class="fas fa-edit mr-2"></i>
                                Profile Update
                            </a>
                            <a class="list-group-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-power-off mr-2"></i>
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('customerLogout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </ul>
                    </div>
                    <div class="col-12 col-lg-9 mt-0 mt-md-2 mt-lg-0">
                        <div class="row">
                            <div class="col-12 col-md-6 mt-2 mt-md-0">
                                <ul class="list-group">
                                    <li class="list-group-item active text-center">Order Information</li>
                                    <li class="list-group-item ">
                                        <b>Name: </b> {{ $orders->customer->name ?? "" }}
                                    </li>
                                    <li class="list-group-item ">
                                        <b>Phone: </b> {{ $orders->billing_phone }}
                                    </li>
                                    <li class="list-group-item ">
                                        <b>Payment By: </b> {{ $orders->payment_type }}
                                    </li>
                                    <li class="list-group-item ">
                                        <b>Order Total: </b> ৳ {{ $orders->total }}
                                    </li>
                                    <li class="list-group-item ">
                                        <b>Order Status: </b>
                                        <span class="{{ $orders->status == 'ca' ? 'bg-danger' : 'bg-success' }} text-white" style="border-radius: 20px; font-size: 13px; text-align: center; width: 70px;
                                            height: 22px; display: inline-block;">
                                        @php
                                            if($orders->status == 'p'){
                                                echo 'Padding';
                                            }elseif($orders->status == 'c'){
                                                echo "Confirm";
                                            }elseif($orders->status == 'pr'){
                                                echo "Process";
                                            }elseif($orders->status == 's'){
                                                echo "Shipping";
                                            }elseif($orders->status == 'd'){
                                                echo "Delivered";
                                            }else{
                                                echo "Canceled";
                                            }
                                        @endphp
                                        </span>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-12 col-md-6 mt-2 mt-md-0">
                                <ul class="list-group">
                                    <li class="list-group-item active text-center">Shipping Information</li>
                                    <li class="list-group-item ">
                                        <b>Order Date: </b> {{ $orders->order_date }}
                                    </li>
                                    <li class="list-group-item ">
                                        <b>Name: </b> {{ $orders->customer->name ?? "" }}
                                    </li>
                                    <li class="list-group-item ">
                                        <b>Phone: </b> {{ $orders->shipping_phone }}
                                    </li>
                                    <li class="list-group-item ">
                                        <b>Email: </b> {{ $orders->shipping_email }}
                                    </li>
                                    <li class="list-group-item ">
                                        <b>Address: </b> {{ $orders->shipping_address }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mt-2 mt-md-4">
                                <div class="card p-4">
                                    <h3>
                                        Order Details:
                                    </h3>
                                    <div class="table-responsive mt-3 text-center">
                                        <table class="table table-hover table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Image</th>
                                                    <th>Name</th>
                                                    <th>Writer Name</th>
                                                    <th>Qty</th>
                                                    <th>price</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                    @forelse ($orderDetails as $key => $item)
                                                    <tr>
                                                        <td>{{ ++$key }}</td>
                                                        <td>
                                                            <img src="{{ asset('storage/' . $item->product->image ?? "") }}" alt="" width="50">
                                                        </td>
                                                        <td>{{ $item->product->name ?? ""}}</td>
                                                        <td>{{ $item->writer_name }}</td>
                                                        <td>{{ $item->quantity }}</td>
                                                        <td>৳ {{ number_format($item->price, 2) }}</td>
                                                        <td>৳ {{ number_format($item->price * $item->quantity, 2) }}</td>
                                                    </tr>
                                                    @empty
                                                    <tr>
                                                        <td class="text-danger text-center" colspan="20">No Data Found</td>
                                                    </tr>
                                                    @endforelse

                                                <tr>
                                                    <td colspan="6" align="right" style="font-weight: bold">Sub Total</td>
                                                    <td style="font-weight: bold">৳ {{ number_format($orders->sub_total, 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6" align="right" style="font-weight: bold">Shipping Cost</td>
                                                    <td style="font-weight: bold">৳ {{ number_format($orders->shipping_cost , 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6" align="right" style="font-weight: bold">Discount</td>
                                                    <td style="font-weight: bold">৳ {{ number_format($orders->discount , 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6" align="right" style="font-weight: bold">Total</td>
                                                    <td style="font-weight: bold">৳  {{ number_format($orders->total , 2) }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('meta')
        <title>{{ empty($title) ? 'Boinama' : 'Boinama | '.$title }}</title>
        <meta property="og:image" content="{{ empty($image) ? 'https://www.boinama.com/storage/Logo/JUmWMpaNoSzroKomTiMy5j9dqknrf72gl8cz7UWo.png' : 'https://www.boinama.com/storage/'.$image }}"/>
        <meta property="og:image:width" content="200"/>
        <meta property="og:image:height" content="286"/>
        <meta property="og:title" content="{{ empty($title) ? 'Boinama' : $title }}"/>
        <meta property="og:description" content="{{ empty($discription) ? 'Boinama Best Book Seller In Bangladesh' : $discription }}"/>
        <meta property="og:url" content="{{ empty($url) ? 'https://www.boinama.com/' : $url }}">
    @endsection
</div>
