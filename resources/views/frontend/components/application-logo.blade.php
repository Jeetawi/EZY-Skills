@props(['type' => 'default'])

<img src="{{ asset($type === 'footer' ? 'images/logo/footer-logo.svg' : 'images/logo/logo.svg') }}" alt="{{ config('app.name') }}" {{ $attributes }} />
