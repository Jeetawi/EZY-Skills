
@props([
    'src' => '',
    'user' => null,
    'name' => null,
    'image' => null,
    'alt' => 'User Avatar',
    'size' => 'medium',
    'status' => 'none',
])

@php
    $sizeClasses = [
        'xsmall' => 'h-6 w-6 max-w-6',
        'small' => 'h-8 w-8 max-w-8',
        'medium' => 'h-10 w-10 max-w-10',
        'large' => 'h-12 w-12 max-w-12',
        'xlarge' => 'h-14 w-14 max-w-14',
        'xxlarge' => 'h-16 w-16 max-w-16',
    ];

    $textSizeClasses = [
        'xsmall' => 'text-[8px]',
        'small' => 'text-[10px]',
        'medium' => 'text-xs',
        'large' => 'text-sm',
        'xlarge' => 'text-base',
        'xxlarge' => 'text-lg',
    ];

    $statusSizeClasses = [
        'xsmall' => 'h-1.5 w-1.5 max-w-1.5',
        'small' => 'h-2 w-2 max-w-2',
        'medium' => 'h-2.5 w-2.5 max-w-2.5',
        'large' => 'h-3 w-3 max-w-3',
        'xlarge' => 'h-3.5 w-3.5 max-w-3.5',
        'xxlarge' => 'h-4 w-4 max-w-4',
    ];

    $statusColorClasses = [
        'online' => 'bg-success-500',
        'offline' => 'bg-error-500',
        'busy' => 'bg-yellow-500',
    ];

    $sizeClass = $sizeClasses[$size] ?? $sizeClasses['medium'];
    $textSizeClass = $textSizeClasses[$size] ?? $textSizeClasses['medium'];
    $statusSizeClass = $statusSizeClasses[$size] ?? $statusSizeClasses['medium'];
    $statusColorClass = $statusColorClasses[$status] ?? '';

    // Determine the image source and user name
    $userName = $name ?? ($user->name ?? 'Guest User');
    $userImage = $image ?? ($user->profile_photo_path ?? $src);
    $imageExists = $userImage && file_exists(public_path($userImage));

    // Get initials (first letter of first name + first letter of last name)
    $nameParts = explode(' ', trim($userName));
    $initials = '';
    if (count($nameParts) >= 2) {
        $initials = strtoupper(substr($nameParts[0], 0, 1) . substr($nameParts[count($nameParts) - 1], 0, 1));
    } elseif (count($nameParts) === 1) {
        $initials = strtoupper(substr($nameParts[0], 0, 2));
    }
@endphp

<div {{ $attributes->merge(['class' => "relative rounded-full $sizeClass"]) }}>
    @if($imageExists)
        <img
            src="{{ asset($userImage) }}"
            alt="{{ $alt }}"
            class="h-full w-full object-cover rounded-full"
        />
    @else
        <span class="flex h-full w-full items-center justify-center bg-gradient-to-br from-blue-500 to-purple-600 text-white font-bold {{ $textSizeClass }} select-none rounded-full">
            {{ $initials }}
        </span>
    @endif

    @if($status !== 'none')
        <span class="absolute bottom-0 right-0 rounded-full border-[1.5px] border-white dark:border-gray-900 {{ $statusSizeClass }} {{ $statusColorClass }}"></span>
    @endif
</div>
