@props([
    'variant' => 'primary',
    'outline' => false,
    'href' => null,
    'type' => 'button',
    'size' => 'md',
])

@php
    $baseClasses = 'inline-flex items-center justify-center font-medium rounded-lg transition-all duration-200 focus:outline-none disabled:opacity-50 disabled:cursor-not-allowed';

    // Size classes
    $sizeClasses = [
        'sm' => 'px-4 py-1.5 text-sm',
        'md' => 'px-6 py-2 text-sm',
        'lg' => 'px-8 py-3 text-base',
    ];

    // Variant classes
    if ($outline) {
        $variantClasses = [
            'primary' => 'border-2 border-[#F98149] text-[#F98149] hover:text-[#FDFDFD] hover:bg-[#E9713A] hover:border-[#E9713A] hover:shadow-lg hover:shadow-[#F98149]/30',
            'secondary' => 'border-2 border-gray-500 text-gray-700 hover:bg-gray-600 hover:border-gray-600 hover:text-white hover:shadow-lg hover:shadow-gray-500/30',
            'success' => 'border-2 border-green-500 text-green-600 hover:bg-green-600 hover:border-green-600 hover:text-white hover:shadow-lg hover:shadow-green-500/30',
            'danger' => 'border-2 border-red-500 text-red-600 hover:bg-red-600 hover:border-red-600 hover:text-white hover:shadow-lg hover:shadow-red-500/30',
            'dark' => 'border-2 border-gray-800 text-gray-800 hover:bg-gray-900 hover:border-gray-900 hover:text-white hover:shadow-lg hover:shadow-gray-800/30',
        ];
    } else {
        $variantClasses = [
            'primary' => 'bg-[#F98149] text-[#FDFDFD] hover:bg-[#E9713A] hover:shadow-lg hover:shadow-[#F98149]/30',
            'secondary' => 'bg-gray-500 text-white hover:bg-gray-700 hover:shadow-lg hover:shadow-gray-500/30',
            'success' => 'bg-green-500 text-white hover:bg-green-700 hover:shadow-lg hover:shadow-green-500/30',
            'danger' => 'bg-red-500 text-white hover:bg-red-700 hover:shadow-lg hover:shadow-red-500/30',
            'dark' => 'bg-gray-800 text-white hover:bg-black hover:shadow-lg hover:shadow-gray-800/30',
        ];
    }

    $classes = $baseClasses . ' ' . $sizeClasses[$size] . ' ' . $variantClasses[$variant];
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
