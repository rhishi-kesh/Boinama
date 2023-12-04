<div class="app-content">
    <div class="bg-anti-flash-white">
        <div class="u-s-p-y-90">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-12">
                        <div class="shop-w-master">
                            <div class="shop-w-master__sidebar">
                                <div class="u-s-m-b-30">
                                    <div class="shop-w shop-w--style">
                                        <div class="shop-w__intro-wrap">
                                            <h1 class="shop-w__h">বিষয়</h1>
                                        </div>
                                        <div class="shop-w__wrap collapse show" id="s-category1">
                                            <ul class="shop-w__category-list gl-scroll">
                                                @forelse ($Subjects as $Subject)
                                                    <li>
                                                        <a href="{{ route('category_product', $Subject->id) }}">{{ $Subject->name }} </a>
                                                        <span class="category-list__text u-s-m-l-6">({{ App\Models\Products::where('subject_id', $Subject->id)->where('status', 0)->where('is_active', 0)->count() }})</span>
                                                    </li>
                                                @empty
                                                    <li><span class="text-danger">NOT FOUND</span></li>
                                                @endforelse

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="u-s-m-b-30">
                                    <div class="shop-w shop-w--style">
                                        <div class="shop-w__intro-wrap">
                                            <h1 class="shop-w__h">প্রকাশনী</h1>
                                        </div>
                                        <div class="shop-w__wrap collapse show" id="s-category2">
                                            <ul class="shop-w__category-list gl-scroll">
                                                @forelse ($Prakasanis as $Prakasani)
                                                    <li>
                                                        <a href="{{ route('prakasani_product', $Prakasani->id) }}">{{ $Prakasani->name }} </a>
                                                        <span class="category-list__text u-s-m-l-6">({{ App\Models\Products::where('prakasani_id', $Prakasani->id)->where('status', 0)->where('is_active', 0)->count() }})</span>
                                                    </li>
                                                @empty
                                                    <li><span class="text-danger">NOT FOUND</span></li>
                                                @endforelse

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="u-s-m-b-30">
                                    <div class="shop-w shop-w--style">
                                        <div class="shop-w__intro-wrap">
                                            <h1 class="shop-w__h">লেখক</h1>
                                        </div>
                                        <div class="shop-w__wrap collapse show" id="s-category3">
                                            <ul class="shop-w__category-list gl-scroll">
                                                @forelse ($Writers as $Writer)
                                                    <li>
                                                        <a href="{{ route('writer_product', $Writer->id) }}">{{ $Writer->name }} </a>
                                                        <span class="category-list__text u-s-m-l-6">({{ App\Models\Products::where('writer_id', $Writer->id)->where('status', 0)->where('is_active', 0)->count() }})</span>
                                                    </li>
                                                @empty
                                                    <li><span class="text-danger">NOT FOUND</span></li>
                                                @endforelse

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-12">
                        <div class="shop-p singlep">
                            <div class="shop-p__collection">
                                <div class="row is-grid-active">
                                    @if(empty($allprakasanis_image->image))

                                    @else
                                        <img src="{{ asset('storage/' . $allprakasanis_image->image) }}" class="all_product_image">
                                    @endif
                                    @forelse ($products as $product)
                                        <div class="col-lg-3 col-md-4 col-sm-6">
                                            <div class="u-s-m-b-30 shop" style="text-align: center; position: relative;">
                                                <div class="product-o product-o--hover-on">
                                                    <div class="product-o__wrap">
                                                        <span class="aspect book_image_box aspect--square u-d-block">
                                                            <img class="aspect__img" src="{{ asset('storage/' . $product->image) }}" alt="image" style="object-fit: cover">
                                                        </span>
                                                        <div class="product-o__action-wrap">
                                                            <ul class="product-o__action-list">
                                                                <li>
                                                                    <a href="{{ route('singleproduct', $product->id) }}" data-tooltip="tooltip" data-placement="top" title="" data-original-title="View">
                                                                        <i class="fas fa-eye"></i>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a wire:click="singleCart({{ $product->id }})" data-tooltip="tooltip" data-placement="top" title="" data-original-title="Add to Cart">
                                                                        <i class="fas fa-shopping-cart"></i>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <span class="product-o__category">
                                                        <a href="{{ route('writer_product', $product->writer_id) }}">{{ $product->writers_id->name ?? "N/A" }}</a>
                                                    </span>
                                                    <span class="product-o__name">
                                                        <a href="{{ route('singleproduct', $product->id) }}" class="stretched-link">{{ $product->name }}</a>
                                                    </span>
                                                    <span class="product-o__price">৳{{ $product->price }}
                                                        <span class="product-o__discount" style="color: #a0a0a0">৳{{ $product->discount }}</span>
                                                    </span>
                                                    <button wire:click="singleCart({{ $product->id }})" class="btn py-1 px-3 mt-2 d-lg-none" style="background: #FF2B01; color: #fff">Add to cart</button>
                                                </div>
                                            </div>
                                        {{ $products->links() }}
                                    </div>
                                    @empty
                                    <div class="col-12">
                                        <div class="u-s-m-b-30">
                                            <div class="shop-w shop-w--style p-3">
                                                <h1 class="text-danger h5 mb-0">No Books Found</h1>
                                            </div>
                                        </div>
                                    </div>
                                    @endforelse
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
