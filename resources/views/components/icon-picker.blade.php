@props([
    'name',
    'value' => 'phosphor-file-text',
    'icons' => [],
])

@php
$allIcons = $icons ?: [
    'phosphor-file-text'      => 'Permits',
    'phosphor-clipboard-text' => 'Reports',
    'phosphor-map-trifold'    => 'Maps',
    'phosphor-map-pin'        => 'Location',
    'phosphor-compass'        => 'Planning',
    'phosphor-ruler'          => 'Drafting',
    'phosphor-buildings'      => 'Buildings',
    'phosphor-house-line'     => 'Housing',
    'phosphor-flag'           => 'Projects',
    'phosphor-hammer'         => 'Construction',
    'phosphor-users-three'    => 'Community',
    'phosphor-users'          => 'People',
    'phosphor-handshake'      => 'Partnership',
    'phosphor-scales'         => 'Policy',
    'phosphor-pen-nib'        => 'Design',
    'phosphor-tree'           => 'Landscape',
    'phosphor-leaf'           => 'Green',
    'phosphor-gear-fine'      => 'Technical',
    'phosphor-chart-bar'      => 'Analysis',
    'phosphor-lightbulb'      => 'Ideas',
    'phosphor-shield-check'   => 'Protection',
    'phosphor-check-circle'   => 'Approved',
    'phosphor-arrows-out'     => 'Scalable',
    'phosphor-calendar'       => 'Schedule',
    'phosphor-envelope'       => 'Contact',
    'phosphor-star'           => 'Featured',
];
@endphp

<div x-data="{ selected: @js($value) }">
    <input type="hidden" name="{{ $name }}" x-bind:value="selected">

    <p class="text-xs text-gray-500 dark:text-gray-400 mb-3">Click an icon to select it</p>

    <div class="grid grid-cols-5 sm:grid-cols-8 gap-2">
        @foreach($allIcons as $icon => $label)
            <button
                type="button"
                @click="selected = '{{ $icon }}'"
                :class="selected === '{{ $icon }}'
                    ? 'ring-2 ring-orange-500 bg-orange-50 dark:bg-orange-900/20 border-transparent'
                    : 'border-gray-200 dark:border-white/10 hover:border-orange-300 hover:bg-gray-50 dark:hover:bg-white/5'"
                class="flex flex-col items-center gap-1.5 p-2.5 rounded-xl border transition-all duration-150 cursor-pointer"
                title="{{ $label }}"
            >
                <x-dynamic-component :component="$icon" width="22" height="22"
                    ::class="selected === '{{ $icon }}' ? 'text-orange-500' : 'text-gray-500 dark:text-gray-400'" />
                <span class="text-[10px] leading-tight text-center text-gray-500 dark:text-gray-400 truncate w-full"
                    :class="selected === '{{ $icon }}' ? 'text-orange-500 font-medium' : ''">
                    {{ $label }}
                </span>
            </button>
        @endforeach
    </div>

    {{-- Selected preview --}}
    <div class="mt-3 flex items-center gap-2 text-xs text-gray-400 dark:text-gray-500">
        <span>Selected:</span>
        <span class="font-mono text-gray-600 dark:text-gray-300" x-text="selected"></span>
    </div>
</div>
