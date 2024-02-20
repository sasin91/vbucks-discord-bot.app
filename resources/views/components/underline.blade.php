@props([
    'tag' => 'span',
    'trigger' => 'group-hover'
])

<{{ $tag }} {{ $attributes->twMerge(['class' => "bg-gradient-to-r from-purple-500 via-violet-400 to-pink-300 bg-[length:0%_2px] bg-left-bottom bg-no-repeat text-indigo-600 transition-all duration-500 ease-out $trigger:bg-[length:100%_2px]"]) }}>
{{ $slot }}
</{{ $tag }}>
