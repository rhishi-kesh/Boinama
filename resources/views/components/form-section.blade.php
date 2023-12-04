@props(['submit'])

<div {{ $attributes->merge(['class' => 'col-12 col-md-6 align-self-start']) }}>
    <div class="mt-2 md:mt-0 md:col-span-2">
        <form wire:submit="{{ $submit }}" class="profile_form">
            <div class="px-4 py-5 bg-white sm:p-6 {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
                <div class="grid grid-cols-6 gap-6">
                    {{ $form }}
                </div>
            </div>

            @if (isset($actions))
                <div class="text-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                    {{ $actions }}
                </div>
            @endif
        </form>
    </div>
</div>
