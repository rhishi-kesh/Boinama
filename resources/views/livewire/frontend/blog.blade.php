<div class="app-content">
    <div class="u-s-p-y-20">
        <div class="container">
            <div class="blog-m">
                <div class="row blog-m-init">
                    @forelse ($blogs as $blog)
                        <div class="blog-m__element" style="position: relative;">
                            <div class="bp-mini bp-mini--img">
                                <div class="bp-mini__thumbnail">
                                    <a class="aspect aspect--bg-grey aspect--1366-768 u-d-block" href="blog-detail.html">
                                        <img class="aspect__img" src="{{ asset('storage/' . $blog->image) }}" alt="">
                                    </a>
                                </div>
                                <div class="bp-mini__content">
                                    <div class="bp-mini__stat">
                                        <span class="bp-mini__stat-wrap">
                                            <span class="bp-mini__publish-date">
                                                <small class="bp-mini__preposition"><i class="far fa-calendar"></i> {{ date ( 'd/m/Y' , strtotime($blog->created_at) ) }}</small>
                                            </span>
                                        </span>
                                        <span>|</span>
                                        <span class="bp-mini__stat-wrap">
                                            <small class="bp-mini__preposition"><i class="fas fa-pencil-alt"></i></small>
                                            <small class="bp-mini__preposition">
                                                {{ $blog->writer_name }}
                                            </small>
                                        </span>
                                    </div>
                                    <span class="bp-mini__h1">
                                        <a href="{{ route('singleblog', $blog->id) }}" class="stretched-link">{{ Str::limit($blog->title, 113, '...') }}</a>
                                    </span>
                                    <p class="bp-mini__p">{{ Str::limit($blog->subtitle, 114, '...') }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-danger">No Blog Found</p>
                    @endforelse
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
