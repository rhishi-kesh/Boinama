<div class="app cart-boinama">
    <div class="app-content">
        <div class="bg-anti-flash-white">
            <div class="u-s-p-b-60">
                <div class="section__intro" style="padding: 60px 0;">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section__text-wrap">
                                    <h1 class="section__heading u-c-secondary">SHOPPING CART</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section__content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-9 col-md-12 col-sm-12 u-s-m-b-30">
                                <div class="table-responsive">
                                    <table class="table-p">
                                        <tbody>
                                            @if (session('cart'))
                                                @forelse (session('cart') as $id => $details)
                                                <tr>
                                                    <td>
                                                        <div class="table-p__box">
                                                            <div class="table-p__img-wrap">
                                                                <img class="u-img-fluid" src="{{ asset('storage/' . $details['image']) }}" alt="">
                                                            </div>
                                                            <div class="table-p__info">
                                                                <span class="table-p__name">
                                                                    <a href="{{ route('singleproduct', $id) }}">{{ $details['name'] }}</a>
                                                                </span>
                                                                <span class="table-p__category">
                                                                    <a href="{{ route('writer_product', $details['writer_id']) }}">{{ $details['writer'] }}</a>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="table-p__price">৳{{ $details['price'] }}</span></td>
                                                    <td>
                                                        <div class="table-p__input-counter-wrap">

                                                            <!--====== Input Counter ======-->
                                                            <div class="input-counter">

                                                                <button wire:click="decrement({{ $id }})" class="input-counter__minus fas fa-minus"></button>

                                                                <input class="input-counter__text input-counter--text-primary-style" readonly type="text" value="{{ $details['quantity'] }}" data-min="1" data-max="1000">

                                                                <button wire:click="increment({{ $id }})" class="input-counter__plus fas fa-plus"></button>
                                                            </div>
                                                            <!--====== End - Input Counter ======-->
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="table-p__price">৳{{ $details['price'] * $details['quantity'] }}</span>
                                                    </td>
                                                    <td>
                                                        <div class="table-p__del-wrap">
                                                            <a class="far fa-trash-alt table-p__delete-link" wire:click="singleCartDelete({{ $id }})"></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @empty
                                                    <tr>
                                                        <td class="text-danger" colspan="20">No Data</td>
                                                    </tr>
                                                @endforelse
                                            @else
                                            <tr>
                                                <td class="text-danger" colspan="20">No Data On Cart</td>
                                            </tr>
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12 col-sm-12 align-self-start">
                                <form class="f-cart" method="POST" wire:submit="checkout">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="f-cart__pad-box">
                                                <div class="u-s-m-b-30">
                                                    <table class="f-cart__table">
                                                        <tbody>
                                                            <tr>
                                                                <td>SUB TOTAL</td>
                                                                <td>৳{{ $subtotal }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>SHIPPING FEE</td>
                                                                <td>৳{{ $shipingFee }}</td>
                                                            </tr>
                                                            {{-- <tr>
                                                                <td>DISCOUNT</td>
                                                                <td>0</td>
                                                            </tr> --}}
                                                            <tr>
                                                                <td>TOTAL</td>
                                                                <td>৳{{ $total }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2">
                                                                    <hr class="p-0 m-0">
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div>
                                                    <button class="btn btn--e-brand-b-2 shadow-none" type="submit"> PROCEED TO CHECKOUT</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-12 my-4">
                                <div class="route-box">
                                    <div class="route-box__g1">
                                        <a class="route-box__link" href="{{ route('main') }}">
                                            <i class="fas fa-long-arrow-alt-left"></i>
                                            <span>CONTINUE SHOPPING</span>
                                        </a>
                                    </div>
                                    <div class="route-box__g2">
                                        <a class="route-box__link" wire:click="deleteAllCart">
                                            <i class="fas fa-trash"></i>
                                            <span>CLEAR CART</span>
                                        </a>
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
