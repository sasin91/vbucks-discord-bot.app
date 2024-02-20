@props(['tag' => 'h2'])

<{{ $tag }}
    {{ $attributes->twMerge(['class' => 'text-transparent bg-clip-text bg-gradient-to-r from-purple-500 to-pink-300']) }}>
    {{ $slot }}
</{{ $tag }}>
