@props(['active' => false, 'mobile' => false])

@php
    if ($mobile) {
        // Mobile nav link styles
        $classes = ($active ?? false)
            ? 'block px-3 py-2 text-[#F98149] font-semibold text-base rounded-md hover:bg-orange-50 transition'
            : 'block px-3 py-2 text-gray-700 font-medium text-base rounded-md hover:bg-gray-100 hover:text-[#F98149] transition';
    } else {
        // Desktop nav link styles
        $classes = ($active ?? false)
            ? 'text-[#F98149] font-semibold transition'
            : 'text-[#8A948C] font-medium hover:text-[#F98149] transition';
    }
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
