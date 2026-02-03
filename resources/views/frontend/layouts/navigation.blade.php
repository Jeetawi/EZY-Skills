<nav x-data="{ open: false }" x-init="$watch('open', value => { document.body.style.overflow = value ? 'hidden' : '' })" class="pt-10">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <!-- Logo -->
            <div class="shrink-0 flex items-center">
                <a href="/" class="flex items-center">
                    <x-frontend::application-logo class="block py-4 h-30 w-auto" />
                </a>
            </div>

            <!-- Navigation Links (Desktop) -->
            <div class="hidden xl:flex items-center space-x-12">
                <x-frontend::nav-link href="/" :active="request()->is('/')">
                    Home
                </x-frontend::nav-link>
                <x-frontend::nav-link href="/course-selector" :active="request()->is('course-selector')">
                    Course Selector
                </x-frontend::nav-link>
                <x-frontend::nav-link href="/courses" :active="request()->is('courses')">
                    Courses
                </x-frontend::nav-link>
                <x-frontend::nav-link href="/pricing" :active="request()->is('pricing')">
                    Pricing
                </x-frontend::nav-link>
                <x-frontend::nav-link href="/faq" :active="request()->is('faq')">
                    FAQ
                </x-frontend::nav-link>
                <x-frontend::nav-link href="/contact" :active="request()->is('contact')">
                    Contact US
                </x-frontend::nav-link>
            </div>

            <!-- Auth Buttons (Desktop) -->
            <div class="hidden xl:flex items-center space-x-10">
                @guest
                    <x-frontend::button
                        variant="primary"
                        :outline="true"
                        href="{{ route('login') }}"
                        size="lg">
                        Log In
                    </x-frontend::button>
                    <x-frontend::button
                        variant="primary"
                        :outline="false"
                        href="{{ route('register') }}"
                        size="lg">
                        Create Account
                    </x-frontend::button>
                @endguest

                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none transition">
                                <div>{{ Auth::user()->name }}</div>
                                <svg class="ml-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth
            </div>

            <!-- Hamburger (Mobile) -->
            <div class="flex items-center xl:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-orange-500 hover:bg-gray-100 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Mobile) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden xl:hidden fixed inset-0 top-[160px] bg-white z-50">
        <div class="pt-2 pb-3 space-y-1 px-4 sm:px-12">
            <x-frontend::nav-link href="/" :active="request()->is('/')" :mobile="true">
                Home
            </x-frontend::nav-link>
            <x-frontend::nav-link href="/course-selector" :active="request()->is('course-selector')" :mobile="true">
                Course Selector
            </x-frontend::nav-link>
            <x-frontend::nav-link href="/courses" :active="request()->is('courses')" :mobile="true">
                Courses
            </x-frontend::nav-link>
            <x-frontend::nav-link href="/pricing" :active="request()->is('pricing')" :mobile="true">
                Pricing
            </x-frontend::nav-link>
            <x-frontend::nav-link href="/faq" :active="request()->is('faq')" :mobile="true">
                FAQ
            </x-frontend::nav-link>
            <x-frontend::nav-link href="/contact" :active="request()->is('contact')" :mobile="true">
                Contact US
            </x-frontend::nav-link>
        </div>

        <!-- Responsive Auth Buttons -->
        @guest
            <div class="pt-4 pb-3 border-t border-gray-200 px-4 sm:px-14 flex gap-3">
                <x-frontend::button
                    variant="primary"
                    :outline="true"
                    href="{{ route('login') }}"
                    size="sm">
                    Log In
                </x-frontend::button>
                <x-frontend::button
                    variant="primary"
                    :outline="false"
                    href="{{ route('register') }}"
                    size="sm">
                    Create Account
                </x-frontend::button>
            </div>
        @endguest

        @auth
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                        Profile
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</nav>
