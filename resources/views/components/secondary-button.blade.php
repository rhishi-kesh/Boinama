<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn btn-dark']) }}>
    {{ $slot }}
</button>
