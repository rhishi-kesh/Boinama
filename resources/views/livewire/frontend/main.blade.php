<div id="app">
    <div class="app-content">
        <div class="bg-anti-flash-white" wire:ignore>

            <!-- slider-start -->
            <div class="container">
                <div id="slider-top" class="owl-carousel owl-theme slider-top">
                    @foreach ($sliders as $slider)
                        <div class="item mt-2">
                            <a href="{{ $slider->link }}">
                                <img src="{{ asset('storage/' . $slider->image) }}" alt="image">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- slider-end -->

            {{-- letest-books --}}
            <div id="female-02" class="u-s-m-t-10">
                <div class="container">
                    <div class="row u-s-m-b-5">
                        <div class="col-12">
                            <div class="block">
                                <span class="block__title" style="font-size: 18px">Latest Products</span>
                            </div>
                            <hr class="my-1">
                        </div>
                    </div>
                    <div class="owl-carousel tab-slider owl-loaded owl-drag" data-item="5">
                        <div class="owl-stage-outer">
                            <div class="owl-stage" >
                                @foreach ($latest as $key => $item)
                                    <div class="owl-item active" style="width: 228px;">
                                        <div style="text-align: center">
                                            <div class="product-o product-o--hover-on">
                                                <div class="product-o__wrap">
                                                    <span class="aspect aspect--square u-d-block book_image_box">
                                                        <img class="aspect__img" src="{{ asset('storage/' . $item->image) }}" alt="image" style="object-fit: cover">
                                                    </span>
                                                    <div class="product-o__action-wrap">
                                                        <ul class="product-o__action-list">
                                                            <li>
                                                                <a href="{{ route('singleproduct', $item->id) }}" data-tooltip="tooltip" data-placement="top" title="" data-original-title="View">
                                                                    <i class="fas fa-eye"></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a wire:click="singleCart({{ $item->id }})" data-tooltip="tooltip" data-placement="top" title="" data-original-title="Add to Cart">
                                                                    <i class="fas fa-shopping-cart"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <span class="product-o__category">
                                                    <a href="{{ route('writer_product', $item->writer_id) }}">{{ $item->writers_id->name ?? "N/A" }}</a>
                                                </span>
                                                <span class="product-o__name">
                                                    <a href="{{ route('singleproduct', $item->id) }}" class="stretched-link">{{ $item->name }}</a>
                                                </span>
                                                <span class="product-o__price">৳{{ $item->price }}
                                                    <span class="product-o__discount" style="color: #a0a0a0">৳{{ $item->discount }}</span>
                                                </span>
                                                <button wire:click="singleCart({{ $item->id }})" class="btn py-1 px-3 mt-2 d-lg-none" style="background: #FF2B01; color: #fff">Add to cart</button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- letest-booksend --}}

            {{-- BestSell-books --}}
            <div id="female-02" class="u-s-m-t-20">
                <div class="container">
                    <div class="row u-s-m-b-10">
                        <div class="col-12">
                            <div class="block">
                                <span class="block__title" style="font-size: 18px">Best Sell</span>
                            </div>
                            <hr class="my-1">
                        </div>
                    </div>
                    <div class="owl-carousel tab-slider owl-loaded owl-drag" data-item="5">
                        <div class="owl-stage-outer">
                            <div class="owl-stage" >
                                @foreach ($topProducts as $key => $item)
                                    <div class="owl-item active" style="width: 228px;">
                                        <div class="u-s-m-b-30" style="text-align: center">
                                            <div class="product-o product-o--hover-on">
                                                <div class="product-o__wrap">
                                                    <span class="aspect aspect--square u-d-block book_image_box">
                                                        <img class="aspect__img" src="{{ asset('storage/' . $item->image) }}" alt="image" style="object-fit: cover">
                                                    </span>
                                                    <div class="product-o__action-wrap">
                                                        <ul class="product-o__action-list">
                                                            <li>
                                                                <a href="{{ route('singleproduct', $item->id) }}" data-tooltip="tooltip" data-placement="top" title="" data-original-title="View">
                                                                    <i class="fas fa-eye"></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a wire:click="singleCart({{ $item->id }})" data-tooltip="tooltip" data-placement="top" title="" data-original-title="Add to Cart">
                                                                    <i class="fas fa-shopping-cart"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <span class="product-o__category">
                                                    <a href="{{ route('writer_product', $item->writer_id) }}">{{ $item->writers_id->name ?? "N/A" }}</a>
                                                </span>
                                                <span class="product-o__name">
                                                    <a href="{{ route('singleproduct', $item->id) }}" class="stretched-link">{{ $item->name }}</a>
                                                </span>
                                                <span class="product-o__price">৳{{ $item->price }}
                                                    <span class="product-o__discount" style="color: #a0a0a0">৳{{ $item->discount }}</span>
                                                </span>
                                                <button wire:click="singleCart({{ $item->id }})" class="btn py-1 px-3 mt-2 d-lg-none" style="background: #FF2B01; color: #fff">Add to cart</button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- BestSell-booksend --}}

            <!-- small-banner -->
            <div class="small-banner p-0 pb-4">
                <div class="container">
                    <div class="row">
                        @foreach ($miniBanners as $miniBanner)
                            <div class="col-6 col-md-3 mt-2 mt-md-0">
                                <a href="{{ $miniBanner->link }}">
                                    <img src="{{ asset('storage/' . $miniBanner->image) }}" alt="Banner">
                                </a>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
            <!-- small-banner -->

            <!-- top-seller -->
            @forelse ($subjects as $subject)
                <div id="female-02">
                    <div class="container">
                        <div class="row u-s-m-b-10">
                            <div class="col-12">
                                <div class="block">
                                    <span class="block__title" style="font-size: 18px">{{ $subject->name }}</span>
                                </div>
                                <hr class="my-1">
                            </div>
                        </div>
                        <div class="owl-carousel tab-slider owl-loaded owl-drag" data-item="5">
                            <div class="owl-stage-outer">
                                <div class="owl-stage" >
                                    @forelse (App\Models\Products::where('subject_id', $subject->id)->Where('status', 0)->where('is_active', 0)->take(15)->get() as $key => $book)
                                    <div class="owl-item active" style="width: 228px;">
                                        <div class="u-s-m-b-30" style="text-align: center">
                                            <div class="product-o product-o--hover-on">
                                                <div class="product-o__wrap">
                                                    <span class="aspect aspect--square u-d-block book_image_box">
                                                        <img class="aspect__img" src="{{ asset('storage/' . $book->image) }}" alt="image" style="object-fit: cover">
                                                    </span>
                                                    <div class="product-o__action-wrap">
                                                        <ul class="product-o__action-list">
                                                            <li>
                                                                <a href="{{ route('singleproduct', $book->id) }}" data-tooltip="tooltip" data-placement="top" title="" data-original-title="View">
                                                                    <i class="fas fa-eye"></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a wire:click="singleCart({{ $book->id }})" data-tooltip="tooltip" data-placement="top" title="" data-original-title="Add to Cart">
                                                                    <i class="fas fa-shopping-cart"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <span class="product-o__category">
                                                    <a href="{{ route('writer_product', $book->writer_id) }}">{{ $book->writers_id->name ?? "N/A" }}</a>
                                                </span>
                                                <span class="product-o__name">
                                                    <a href="{{ route('singleproduct', $book->id) }}" class="stretched-link">{{ $book->name }}</a>
                                                </span>
                                                <span class="product-o__price">৳{{ $book->price }}
                                                    <span class="product-o__discount" style="color: #a0a0a0">৳{{ $book->discount }}</span>
                                                </span>
                                                <button wire:click="singleCart({{ $book->id }})" class="btn py-1 px-3 mt-2 d-lg-none" style="background: #FF2B01; color: #fff">Add to cart</button>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                        <p class="text-danger lead">No Boos Found</p>
                                    @endforelse

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="lead text-danger">No Data</p>
            @endforelse

            <!-- top-seller -->
            <!--====== Others Sections btn ======-->
            <div class="u-s-p-b-40">
                <div class="section__intro">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="block">
                                    <ul class="nav tab-list">
                                        <li class="nav-item">
                                            <a class="nav-link btn--e-white-brand-shadow active" data-toggle="tab" href="#w-l-p">LATEST PRODUCTS</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link btn--e-white-brand-shadow" data-toggle="tab" href="#w-b-s">BEST SELLING</a>
                                        </li>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--====== Others Sections btn End ======-->
                <div class="section__content">
                    <div class="container">
                        <div class="tab-content">
                            <!--====== Tab 1 ======-->
                            <div class="tab-pane fade show active" id="w-l-p">
                                <div class="owl-carousel tab-slider owl-loaded owl-drag" data-item="5">
                                    <div class="owl-stage-outer">
                                        <div class="owl-stage" >
                                            @foreach ($latest as $key => $item)
                                            <div class="owl-item active" style="width: 228px;">
                                                <div class="u-s-m-b-30" style="text-align: center">
                                                    <div class="product-o product-o--hover-on">
                                                        <div class="product-o__wrap">
                                                            <span class="aspect aspect--square u-d-block book_image_box">
                                                                <img class="aspect__img" src="{{ asset('storage/' . $item->image) }}" alt="image" style="object-fit: cover">
                                                            </span>
                                                            <div class="product-o__action-wrap">
                                                                <ul class="product-o__action-list">
                                                                    <li>
                                                                        <a href="{{ route('singleproduct', $item->id) }}" data-tooltip="tooltip" data-placement="top" title="" data-original-title="View">
                                                                            <i class="fas fa-eye"></i>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a wire:click="singleCart({{ $item->id }})" data-tooltip="tooltip" data-placement="top" title="" data-original-title="Add to Cart">
                                                                            <i class="fas fa-shopping-cart"></i>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <span class="product-o__category">
                                                            <a href="{{ route('writer_product', $item->writer_id) }}">{{ $item->writers_id->name ?? "N/A" }}</a>
                                                        </span>
                                                        <span class="product-o__name">
                                                            <a href="{{ route('singleproduct', $item->id) }}"  class="stretched-link">{{ $item->name }}</a>
                                                        </span>
                                                        <span class="product-o__price">৳{{ $item->price }}
                                                            <span class="product-o__discount" style="color: #a0a0a0">৳{{ $item->discount }}</span>
                                                        </span>
                                                        <button wire:click="singleCart({{ $item->id }})" class="btn py-1 px-3 mt-2 d-lg-none" style="background: #FF2B01; color: #fff">Add to cart</button>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--====== End - Tab 1 ======-->

                            <!--====== Tab 2 ======-->
                            <div class="tab-pane" id="w-b-s">
                                <div class="owl-carousel tab-slider owl-loaded owl-drag" data-item="5">
                                    <div class="owl-stage-outer">
                                        <div class="owl-stage" >
                                            @foreach ($topProducts as $key => $item)
                                            <div class="owl-item active" style="width: 228px;">
                                                <div class="u-s-m-b-30" style="text-align: center">
                                                    <div class="product-o product-o--hover-on">
                                                        <div class="product-o__wrap">
                                                            <span class="aspect aspect--square u-d-block book_image_box">
                                                                <img class="aspect__img" src="{{ asset('storage/' . $item->image) }}" alt="image" style="object-fit: cover">
                                                            </span>
                                                            <div class="product-o__action-wrap">
                                                                <ul class="product-o__action-list">
                                                                    <li>
                                                                        <a href="{{ route('singleproduct', $item->id) }}" data-tooltip="tooltip" data-placement="top" title="" data-original-title="View">
                                                                            <i class="fas fa-eye"></i>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a wire:click="singleCart({{ $item->id }})" data-tooltip="tooltip" data-placement="top" title="" data-original-title="Add to Cart">
                                                                            <i class="fas fa-shopping-cart"></i>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <span class="product-o__category">
                                                            <a href="{{ route('writer_product', $item->writer_id) }}">{{ $item->writers_id->name ?? "N/A" }}</a>
                                                        </span>
                                                        <span class="product-o__name">
                                                            <a href="{{ route('singleproduct', $item->id) }}"  class="stretched-link">{{ $item->name }}</a>
                                                        </span>
                                                        <span class="product-o__price">৳{{ $item->price }}
                                                            <span class="product-o__discount" style="color: #a0a0a0">৳{{ $item->discount }}</span>
                                                        </span>
                                                        <button wire:click="singleCart({{ $item->id }})" class="btn py-1 px-3 mt-2 d-lg-none" style="background: #FF2B01; color: #fff">Add to cart</button>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--====== End - Tab 2 ======-->
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
