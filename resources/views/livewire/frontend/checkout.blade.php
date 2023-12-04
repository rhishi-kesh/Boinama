<div id="app">
    <div class="app-content checkoutt">
        <div class="bg-anti-flash-white">
            <div class="u-s-p-t-60 u-s-p-b-10">
                <div class="section__content">
                    <div class="container">
                        <div class="checkout-f">
                            <form wire:submit="checkout" method="post">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h3 style="font-weight: bold">Billing Details</h3>
                                        <hr class="mt-2 mb-3">
                                        <div class="checkout-f__delivery bg-white p-4">
                                            <div class="u-s-m-b-30">
                                                <div class="gl-inline">
                                                    <!--====== Name ======-->
                                                    <div class="u-s-m-b-15">
                                                        <label class="gl-label" for="billing-fname">FIRST NAME <span class="text-danger">*</span></label>
                                                        <input class="input-text input-text--primary-style @error('name') is-invalid @enderror" wire:model="name" name="name" type="text" id="name" placeholder="Enter Name">
                                                        @if ($errors->has('name'))
                                                            <small class="invalid-feedback">{{ $errors->first('name') }}</small>
                                                        @endif
                                                    </div>
                                                    <!--====== Name ======-->
                                                </div>
                                                    <!--====== E-MAIL ======-->
                                                    <div class="u-s-m-b-15">
                                                        <label class="gl-label" for="billing-email">E-MAIL <span class="text-danger">*</span></label>
                                                        <input class="input-text input-text--primary-style @error('email') is-invalid @enderror" wire:model="email" name="email" type="text" id="email" placeholder="Enter E-Mail">
                                                        @if ($errors->has('email'))
                                                            <small class="invalid-feedback">{{ $errors->first('email') }}</small>
                                                        @endif
                                                    </div>
                                                    <!--====== End - E-MAIL ======-->
                                                <!--====== PHONE ======-->
                                                <div class="u-s-m-b-15">
                                                    <label class="gl-label" for="billing-phone">PHONE <span class="text-danger">*</span></label>
                                                    <input class="input-text input-text--primary-style @error('phone') is-invalid @enderror" wire:model="phone" name="phone" type="text" id="phone" placeholder="Enter Phone">
                                                    @if ($errors->has('phone'))
                                                        <small class="invalid-feedback">{{ $errors->first('phone') }}</small>
                                                    @endif
                                                </div>
                                                <!--====== End - PHONE ======-->
                                                <!--====== Address ======-->
                                                <div class="u-s-m-b-15">
                                                    <label class="gl-label" for="billing-street">ADDRESS <span class="text-danger">*</span></label>
                                                    <input class="input-text input-text--primary-style @error('address') is-invalid @enderror" wire:model="address" name="address" type="text" id="address" placeholder="Enter Address">
                                                    @if ($errors->has('address'))
                                                        <small class="invalid-feedback">{{ $errors->first('address') }}</small>
                                                    @endif
                                                </div>
                                                <!--====== Address ======-->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <h3 style="font-weight: bold">Your Order</h3>
                                        <hr class="mt-2 mb-3">
                                        <!--====== Order Summary ======-->
                                        <div class="o-summary">
                                            <div class="o-summary__section u-s-m-b-30">
                                                <div class="o-summary__item-wrap gl-scroll">
                                                    @if (session('cart'))
                                                        @forelse (session('cart') as $id => $details)
                                                        <div class="o-card">
                                                            <div class="o-card__flex">
                                                                <div class="o-card__img-wrap">
                                                                    <img class="u-img-fluid" src="{{ asset('storage/' . $details['image']) }}" alt="" style="height: 63px; object-fit: contain; background: #fff;">
                                                                </div>
                                                                <div class="o-card__info-wrap">
                                                                    <span class="o-card__name">
                                                                        <span>{{ $details['name'] }}</span>
                                                                    </span>
                                                                    <span class="o-card__quantity">x{{ $details['quantity'] }}</span>
                                                                    <span class="o-card__price">৳{{ $details['price'] }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td class="text-danger" colspan="20">No Data On Cart</td>
                                                        </tr>
                                                    @endif
                                                </div>
                                            </div>
                                            <h3 class="mb-0 payment_information_h3">Payment Information</h3>
                                            <hr class="mt-2 mb-3">
                                            <div class="o-summary__section u-s-m-b-30">
                                                <div class="o-summary__box">
                                                    <div class="u-s-m-b-10">
                                                        <table class="f-cart__table">
                                                            <tbody>
                                                                <tr>
                                                                    <td>SUB TOTAL</td>
                                                                    <td>৳ {{ $subtotal }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>SHIPPING FEE</td>
                                                                    <td>৳ {{ $shipingFee }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>DISCOUNT({{ $discountpercent }}%)</td>
                                                                    <td>৳ {{ $discount }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>TOTAL</td>
                                                                    <td>৳ {{ empty($totalWithdiscount) ? $total : $totalWithdiscount }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2">
                                                                        <hr class="p-0 m-0">
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!--====== Radio Box ======-->
                                                        <div class="radio-box my-3">
                                                            <input type="radio" id="payment_type" wire:model="payment_type" value="Cash On Delivery" name="payment_type">
                                                            <div class="radio-box__state radio-box__state--primary">
                                                                <label class="radio-box__label text-uppercase" for="payment_type">Cash on Delivery</label>
                                                            </div>
                                                            @if ($errors->has('payment_type'))
                                                                <small class="invalid-feedback">{{ $errors->first('payment_type') }}</small>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <button class="btn btn--e-brand-b-2" type="submit">PLACE ORDER</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--====== End - Order Summary ======-->
                                    </div>
                                </div>
                            </form>
                            <div class="row">
                                <div class="col-12 mt-4">
                                    <div class="f-cart__pad-box checkout_coupon mb-4 @error('phone') mt-5 @enderror @error('name') mt-5 @enderror @error('email') mt-5 @enderror @error('address') mt-1 @enderror">
                                        <form wire:submit="coupon" method="post">
                                            <p class="mb-2" style="font-weight: bold; color: #333333">Add Promo code or voucher</p>
                                            <div class="cupon">
                                                <input type="text" wire:model="coupon_code" class="form-control shadow-none" placeholder="Enter Code">
                                                <button type="submit">Apply</button>
                                            </div>
                                            @if(session()->has('not_match'))
                                                <small class="text-danger">{{ session('not_match') }}</small>
                                            @endif
                                        </form>
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
