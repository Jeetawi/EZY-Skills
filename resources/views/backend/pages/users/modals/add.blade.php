{{--
    ============================================================
    Add User Modal
    ============================================================
--}}
<x-backend::ui.modal
    x-data="{ open: false }"
    @open-add-user-modal.window="open = true"
    :isOpen="false"
    class="max-w-2xl">

    <div class="p-6 sm:p-8">
        {{-- Modal Header --}}
        <h3 class="mb-6 text-2xl font-bold text-gray-900 dark:text-white">
            Add New User
        </h3>

        {{-- Form: Create New User --}}
        <form action="{{ route('users.store') }}" method="POST" class="space-y-4">
            @csrf

            {{-- Full Name Field --}}
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Full Name
                </label>
                <input
                    type="text"
                    name="name"
                    required
                    class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                    placeholder="Enter full name" />
            </div>

            {{-- Email Address Field --}}
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Email Address
                </label>
                <input
                    type="email"
                    name="email"
                    required
                    class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                    placeholder="user@example.com" />
            </div>

            {{-- Password Field with Toggle Visibility --}}
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Password
                </label>
                {{-- Alpine.js scope for password visibility toggle --}}
                <div x-data="{ showPassword: false }" class="relative">
                    <input
                        :type="showPassword ? 'text' : 'password'"
                        name="password"
                        required
                        class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                        placeholder="Enter password" />

                    {{-- Toggle password visibility button --}}
                    <span @click="showPassword = !showPassword" class="absolute top-1/2 right-4 z-30 -translate-y-1/2 cursor-pointer">
                        {{-- Eye icon (show password) --}}
                        <svg x-show="!showPassword" class="fill-gray-500 dark:fill-gray-400" width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.0002 13.8619C7.23361 13.8619 4.86803 12.1372 3.92328 9.70241C4.86804 7.26761 7.23361 5.54297 10.0002 5.54297C12.7667 5.54297 15.1323 7.26762 16.0771 9.70243C15.1323 12.1372 12.7667 13.8619 10.0002 13.8619ZM10.0002 4.04297C6.48191 4.04297 3.49489 6.30917 2.4155 9.4593C2.3615 9.61687 2.3615 9.78794 2.41549 9.94552C3.49488 13.0957 6.48191 15.3619 10.0002 15.3619C13.5184 15.3619 16.5055 13.0957 17.5849 9.94555C17.6389 9.78797 17.6389 9.6169 17.5849 9.45932C16.5055 6.30919 13.5184 4.04297 10.0002 4.04297ZM9.99151 7.84413C8.96527 7.84413 8.13333 8.67606 8.13333 9.70231C8.13333 10.7286 8.96527 11.5605 9.99151 11.5605H10.0064C11.0326 11.5605 11.8646 10.7286 11.8646 9.70231C11.8646 8.67606 11.0326 7.84413 10.0064 7.84413H9.99151Z" />
                        </svg>
                        {{-- Eye slash icon (hide password) --}}
                        <svg x-show="showPassword" class="fill-gray-500 dark:fill-gray-400" width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.63803 3.57709C4.34513 3.2842 3.87026 3.2842 3.57737 3.57709C3.28447 3.86999 3.28447 4.34486 3.57737 4.63775L4.85323 5.91362C3.74609 6.84199 2.89363 8.06395 2.4155 9.45936C2.3615 9.61694 2.3615 9.78801 2.41549 9.94558C3.49488 13.0957 6.48191 15.3619 10.0002 15.3619C11.255 15.3619 12.4422 15.0737 13.4994 14.5598L15.3625 16.4229C15.6554 16.7158 16.1302 16.7158 16.4231 16.4229C16.716 16.13 16.716 15.6551 16.4231 15.3622L4.63803 3.57709ZM12.3608 13.4212L10.4475 11.5079C10.3061 11.5423 10.1584 11.5606 10.0064 11.5606H9.99151C8.96527 11.5606 8.13333 10.7286 8.13333 9.70237C8.13333 9.5461 8.15262 9.39434 8.18895 9.24933L5.91885 6.97923C5.03505 7.69015 4.34057 8.62704 3.92328 9.70247C4.86803 12.1373 7.23361 13.8619 10.0002 13.8619C10.8326 13.8619 11.6287 13.7058 12.3608 13.4212ZM16.0771 9.70249C15.7843 10.4569 15.3552 11.1432 14.8199 11.7311L15.8813 12.7925C16.6329 11.9813 17.2187 11.0143 17.5849 9.94561C17.6389 9.78803 17.6389 9.61696 17.5849 9.45938C16.5055 6.30925 13.5184 4.04303 10.0002 4.04303C9.13525 4.04303 8.30244 4.17999 7.52218 4.43338L8.75139 5.66259C9.1556 5.58413 9.57311 5.54303 10.0002 5.54303C12.7667 5.54303 15.1323 7.26768 16.0771 9.70249Z" />
                        </svg>
                    </span>
                </div>
            </div>

            {{-- Role Selection Field --}}
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Role
                </label>
                {{-- Alpine.js scope for select styling --}}
                <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                    <select
                        name="role"
                        required
                        class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                        :class="isOptionSelected && 'text-gray-800 dark:text-white/90'"
                        @change="isOptionSelected = true">
                        <option value="" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                            Select Role
                        </option>
                        {{-- Loop through available roles from controller --}}
                        @foreach($roles ?? [] as $role)
                            <option value="{{ $role->name }}" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                {{ ucfirst($role->name) }}
                            </option>
                        @endforeach
                    </select>
                    {{-- Dropdown arrow icon --}}
                    <span class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                        <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                </div>
            </div>

            {{-- Form Action Buttons --}}
            <div class="flex gap-3 pt-4">
                {{-- Submit Button --}}
                <button
                    type="submit"
                    class="flex-1 inline-flex justify-center items-center gap-2 px-4 py-2.5 text-sm font-medium text-white transition-colors bg-brand-500 rounded-lg hover:bg-brand-600 focus:outline-none focus:ring-4 focus:ring-brand-500/10">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Create User
                </button>
                {{-- Cancel Button - Closes modal --}}
                <button
                    type="button"
                    @click="open = false"
                    class="flex-1 inline-flex justify-center items-center gap-2 px-4 py-2.5 text-sm font-medium text-gray-700 transition-colors bg-gray-100 rounded-lg hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-500/10">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</x-backend::ui.modal>

