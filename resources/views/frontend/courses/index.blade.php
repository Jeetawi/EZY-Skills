@extends('frontend.layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <!-- Page Header -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <h1 class="text-4xl font-bold text-gray-900 text-center text-blue-">
                Courses <span class="text-orange-500">List</span>
            </h1>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
            <form method="GET" action="{{ route('courses.index') }}" class="flex flex-col lg:flex-row gap-4">
                <!-- Search Box -->
                <div class="flex-1 relative">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Find Your Course here..."
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                    >
                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>

                <!-- Filter Buttons -->
                <div class="flex flex-wrap gap-3">
                    <button
                        type="submit"
                        name="level"
                        value=""
                        class="px-6 py-3 rounded-lg font-medium transition-colors duration-200 {{ !request('level') ? 'bg-orange-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        All
                    </button>
                    <button
                        type="submit"
                        name="level"
                        value="beginner"
                        class="px-6 py-3 rounded-lg font-medium transition-colors duration-200 {{ request('level') == 'beginner' ? 'bg-orange-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        Beginner
                    </button>
                    <button
                        type="submit"
                        name="level"
                        value="intermediate"
                        class="px-6 py-3 rounded-lg font-medium transition-colors duration-200 {{ request('level') == 'intermediate' ? 'bg-orange-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        Coaching Team
                    </button>
                    <button
                        type="submit"
                        name="level"
                        value="advanced"
                        class="px-6 py-3 rounded-lg font-medium transition-colors duration-200 {{ request('level') == 'advanced' ? 'bg-orange-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        Purchase
                    </button>

                    <!-- View Selector -->
                    <div class="flex border border-gray-300 rounded-lg overflow-hidden">
                        <button type="button" class="px-4 py-3 bg-orange-500 text-white hover:bg-orange-600">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M3 3h8v8H3V3zm10 0h8v8h-8V3zM3 13h8v8H3v-8zm10 0h8v8h-8v-8z"/>
                            </svg>
                        </button>
                        <button type="button" class="px-4 py-3 bg-gray-100 text-gray-700 hover:bg-gray-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M3 4h18v2H3V4zm0 7h18v2H3v-2zm0 7h18v2H3v-2z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Courses Grid -->
        @if($courses->count() > 0)
            <div class="columns-1 md:columns-2 lg:columns-4 gap-6 space-y-50 mb-8">
                @foreach($courses as $course)
                    <x-frontend::course-card :course="$course" />
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="flex justify-center items-center gap-2">
                @if($courses->onFirstPage())
                    <button disabled class="w-10 h-10 rounded-lg bg-gray-200 text-gray-400 cursor-not-allowed flex items-center justify-center">
                        &lt;
                    </button>
                @else
                    <a href="{{ $courses->previousPageUrl() }}" class="w-10 h-10 rounded-lg bg-white border border-gray-300 text-gray-700 hover:bg-orange-500 hover:text-white hover:border-orange-500 transition-colors duration-200 flex items-center justify-center">
                        &lt;
                    </a>
                @endif

                @foreach($courses->getUrlRange(1, $courses->lastPage()) as $page => $url)
                    @if($page == $courses->currentPage())
                        <button class="w-10 h-10 rounded-lg bg-orange-500 text-white font-semibold flex items-center justify-center">
                            {{ $page }}
                        </button>
                    @else
                        <a href="{{ $url }}" class="w-10 h-10 rounded-lg bg-white border border-gray-300 text-gray-700 hover:bg-orange-500 hover:text-white hover:border-orange-500 transition-colors duration-200 flex items-center justify-center">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach

                @if($courses->hasMorePages())
                    <a href="{{ $courses->nextPageUrl() }}" class="w-10 h-10 rounded-lg bg-white border border-gray-300 text-gray-700 hover:bg-orange-500 hover:text-white hover:border-orange-500 transition-colors duration-200 flex items-center justify-center">
                        &gt;
                    </a>
                @else
                    <button disabled class="w-10 h-10 rounded-lg bg-gray-200 text-gray-400 cursor-not-allowed flex items-center justify-center">
                        &gt;
                    </button>
                @endif
            </div>
        @else
            <div class="text-center py-16">
                <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="text-2xl font-semibold text-gray-700 mb-2">No Courses Found</h3>
                <p class="text-gray-500">Try adjusting your search or filter criteria</p>
            </div>
        @endif
    </div>
</div>
@endsection
