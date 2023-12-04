@props(['for'])

@error($for)
    <p {{ $attributes->merge(['class' => 'text-danger']) }}>{{ $message }}</p>
@enderror
