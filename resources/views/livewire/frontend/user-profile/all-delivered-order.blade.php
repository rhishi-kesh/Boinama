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
                            <a class="list-group-item active" href="{{ route('all_delivered_order') }}">
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
                    <div class="col-12 col-lg-9">
                        <div class="card p-4">
                            <h3>
                                <i class="fas fa-list mr-2"></i>
                                All Delivered Orders
                            </h3>
                            <div class="table-responsive mt-3 text-center">
                                <table class="table table-hover table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Date</th>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($orders as $key => $item)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $item->order_date }}</td>
                                                <td>{{ $item->customer->name }}</td>
                                                <td>{{ $item->billing_phone }}</td>
                                                <td>৳ {{ $item->total }}</td>
                                                <td>
                                                    <span class="{{ $item->status == 'ca' ? 'bg-danger' : 'bg-success' }} text-white" style="border-radius: 20px; font-size: 13px; width: 65px;
                                                        height: 22px; display: inline-block;">
                                                    @php
                                                        if($item->status == 'p'){
                                                            echo 'Padding';
                                                        }elseif($item->status == 'c'){
                                                            echo "Confirm";
                                                        }elseif($item->status == 'pr'){
                                                            echo "Process";
                                                        }elseif($item->status == 's'){
                                                            echo "Shipping";
                                                        }elseif($item->status == 'd'){
                                                            echo "Delivered";
                                                        }else{
                                                            echo "Canceled";
                                                        }
                                                    @endphp
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('all_order_show', $item->id) }}" class="text-white py-1 px-2" style="border-radius: 20px; font-size: 13px; background: #FF2A00">
                                                        View
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-center text-danger" colspan="30">No Data Found</td>
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
