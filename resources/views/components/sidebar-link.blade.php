@props(['route', 'label', 'icon' => null, 'params' => [], 'active' => false])

@php
    $isActive = $active ?? request()->routeIs($route . '*');
    $href = $params ? route($route, array_filter($params)) : route($route);
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => 'group flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 ' . ($isActive 
    ? 'bg-indigo-600/20 text-indigo-400 border-l-4 border-indigo-500' 
    : 'text-gray-300 hover:text-white hover:bg-gray-800')]) }}
   class="" role="menuitem">
    
    @if($icon)
        <x-dynamic-component :component="$icon" class="w-5 h-5 flex-shrink-0 {{ $isActive ? 'text-indigo-400' : 'text-gray-400 group-hover:text-white' }}"/>
    @endif
    
    <span>{{ $label }}</span>
</a>
