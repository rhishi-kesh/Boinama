<div class="app-content">
    <div class="u-s-p-y-90">
        <div class="detail-post">
            <div class="bp-detail">
                <div class="bp-detail__thumbnail mb-0">
                    <div class="aspect aspect--bg-grey aspect--1366-768">
                        <img class="aspect__img" src="{{ asset('storage/' . $blog->image) }}" alt="">
                    </div>
                </div>
                <div class="bp-detail__info-wrap bg-white p-4 mt-0">
                    <div class="bp-mini__stat">
                        <span class="bp-mini__stat-wrap">
                            <span class="bp-mini__publish-date">
                                <small class="bp-mini__preposition"><i class="far fa-calendar"></i> {{ date ( 'd/m/Y' , strtotime($blog->created_at) ) }} </small>
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
                        <span>{{ $blog->title }}</span>
                    </span>
                    <p class="bp-mini__p">{{ $blog->subtitle }}</p>
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
