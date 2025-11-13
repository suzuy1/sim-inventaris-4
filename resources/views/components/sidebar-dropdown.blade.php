@props(['label', 'icon', 'active' => false])

<div x-data="{ open: {{ $active ? 'true' : 'false' }} }" class="space-y-1">
    <button @click="open = !open"
            class="group w-full flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ $active ? 'bg-indigo-600/10 text-white' : '' }}"
            :aria-expanded="open"
            :aria-label="open ? 'Tutup menu {{ $label }}' : 'Buka menu {{ $label }}'">
        <span class="sr-only" x-text="open ? 'Tutup menu {{ $label }}' : 'Buka menu {{ $label }}'"></span>
        <x-dynamic-component :component="$icon" class="w-5 h-5 flex-shrink-0 text-gray-400 group-hover:text-white"/>
        <span class="flex-1 text-left">{{ $label }}</span>
        <svg :class="{'rotate-90': open}" class="w-4 h-4 transition-transform duration-200 text-gray-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
    </button>
    
    <div x-show="open" x-transition:enter="transition ease-out duration-150"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="pl-4 py-1 space-y-1 border-l border-gray-700 ml-6"
         role="group">
        <div role="menu">
            {{ $slot }}
        </div>
    </div>
</div>
