<div class="app-content" wire:ignore>
    <div class="bg-anti-flash-white">
        <!--====== Section 1 ======-->
        <div class="u-s-p-t-90 singleproduct">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-12 col-lg-9">
                        <div class="row">
                            <div class="col-12 col-sm-4 p_img">
                                <img class="aspect__img top_single" src="{{ asset('storage/' . $product->image) }}" alt="image" style="object-fit: cover">
                            </div>
                            <div class="col-12 col-sm-8">
                                <!--====== Product Right Side Details ======-->
                                <div class="pd-detail">
                                    <div class="u-s-m-b-15">
                                        <span class="pd-detail__name u-s-m-b-15">{{ $product->name }}</span>
                                        <span>By : <a href="{{ route('writer_product', $product->writers_id) }}" class="Category">{{ $product->writers_id->name ?? "N/A" }}</a></span>
                                        <br>
                                        <span>Category : <a href="{{ route('category_product', $product->subject_id) }}" class="Category">{{ $product->subjects_id->name ?? "N/A" }}</a></span>
                                    </div>
                                    <div class="u-s-m-b-15">
                                        <div class="pd-detail__inline">
                                            <span class="pd-detail__price">৳{{ $product->price }}</span>
                                            <del class="pd-detail__del" style="margin-top: 20px;">৳{{ $product->discount }}</del>
                                        </div>
                                    </div>
                                    <div class="u-s-m-b-15">
                                        <div class="pd-detail__inline" >
                                            <span class="pd-detail__stock" style="background-color: rgba(0, 148, 68, 0.14); color: #009444; @if($product->quantity <= 0)text-center; background-color: rgba(148, 0, 0, 0.14); color: #b50000; @endif">{{ $product->quantity }} in stock</span>
                                            <a href="{{ asset('storage/' . $product->preview) }}" target="_blank" class="read_more">
                                                একটু পড়ে দেখুন
                                            </a>
                                        </div>
                                    </div>
                                    <div class="u-s-m-b-15">
                                        {!! $shareComponent !!}
                                    </div>
                                    <div class="u-s-m-b-15">
                                        <form class="pd-detail__form" wire:submit="singlepagecart({{ $product->id }})">
                                            <div class="pd-detail-inline-2">
                                                <div class="u-s-m-b-15">
                                                    <!--====== Input Counter ======-->
                                                    <div class="input-counter">
                                                        <span class="input-counter__minus fas fa-minus" wire:click="decrementCart"></span>
                                                        <input class="input-counter__text input-counter--text-primary-style" readonly wire:model="quentity" type="text" value="{{ $this->quentity }}" data-min="1" data-max="10">
                                                        <span class="input-counter__plus fas fa-plus" wire:click="incrementCart"></span>
                                                    </div>
                                                    <!--====== End - Input Counter ======-->
                                                </div>
                                                <div class="u-s-m-b-15 cart_btn">
                                                    <button class="btn btn--e-brand-b-2" type="submit">Add to Cart</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                <!--====== End - Product Right Side Details ======-->
                            </div>
                        </div>
                        <div class="col-12 p-4 ps-3">
                            <p class="d-block fs-5 text-uppercase " style="color: #000">Summary: </p>
                            <p class="">{{ $product->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Related Product start -->
        <div class="u-s-p-b-40 u-s-m-t-80" id="female-02">
            <div class="container">
                <div class="row u-s-m-b-5">
                    <div class="col-12">
                        <div class="block">
                            <span class="block__title" style="font-size: 18px">Related Products</span>
                        </div>
                    </div>
                </div>
                <hr class="m-0 mb-1">
                <div class="owl-carousel tab-slider owl-loaded owl-drag" data-item="5">
                    <div class="owl-stage-outer">
                        <div class="owl-stage" >
                            @foreach ($releteds as $key => $releted)
                            <div class="owl-item active" style="width: 228px;">
                                <div class="u-s-m-b-30" style="text-align: center">
                                    <div class="product-o product-o--hover-on">
                                        <div class="product-o__wrap">
                                            <span class="aspect aspect--square u-d-block book_image_box">
                                                <img class="aspect__img" src="{{ asset('storage/' . $releted->image) }}" alt="image" style="object-fit: cover">
                                            </span>
                                            <div class="product-o__action-wrap">
                                                <ul class="product-o__action-list">
                                                    <li>
                                                        <a href="{{ route('singleproduct', $releted->id) }}" data-tooltip="tooltip" data-placement="top" title="" data-original-title="View">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a wire:click="singleCart({{ $releted->id }})" data-tooltip="tooltip" data-placement="top" title="" data-original-title="Add to Cart">
                                                            <i class="fas fa-shopping-cart"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <span class="product-o__category">
                                            <a href="{{ route('writer_product', $releted->writer_id) }}">{{ $releted->writers_id->name ?? "N/A" }}</a>
                                        </span>
                                        <span class="product-o__name">
                                            <a href="{{ route('singleproduct', $releted->id) }}" class="stretched-link">{{ $releted->name }}</a>
                                        </span>
                                        <span class="product-o__price">৳{{ $releted->price }}
                                            <span class="product-o__discount" style="color: #a0a0a0">৳{{ $releted->discount }}</span>
                                        </span>
                                        <button wire:click="singleCart({{ $releted->id }})" class="btn py-1 px-3 mt-2 d-lg-none" style="background: #FF2B01; color: #fff">Add to cart</button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
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
