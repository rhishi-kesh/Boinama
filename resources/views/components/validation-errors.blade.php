@if ($errors->any())
    <div {{ $attributes }}>
        <div class="font-medium text-danger mt-3">{{ __('Whoops! Something went wrong.') }}</div>

        <ul class="mt-2 text-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
