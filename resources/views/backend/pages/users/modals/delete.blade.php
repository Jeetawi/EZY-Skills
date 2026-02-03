{{--
    ============================================================
    Delete User Modal
    ============================================================
--}}
<x-backend::ui.modal
    x-data="{
        open: false,
        userId: null,
        userName: ''
    }"
    @open-delete-user-modal.window="
        open = true;
        userId = $event.detail.id;
        userName = $event.detail.name;
    "
    :isOpen="false"
    class="max-w-md">

    <div class="p-6 sm:p-8">
        {{-- Warning Icon --}}
        <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 rounded-full bg-red-100 dark:bg-red-900/30">
            <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
        </div>

        {{-- Modal Header --}}
        <h3 class="mb-2 text-xl font-bold text-center text-gray-900 dark:text-white">
            Delete User
        </h3>

        {{-- Warning Message - userName is dynamically displayed --}}
        <p class="mb-6 text-sm text-center text-gray-500 dark:text-gray-400">
            Are you sure you want to delete <strong x-text="userName"></strong>? This action cannot be undone.
        </p>

        {{-- Form: Delete User - Action URL is dynamically set based on userId --}}
        <form action="{{ url('/users') }}" method="POST" class="space-y-3" x-ref="deleteForm">
            @csrf
            @method('DELETE')
            <input type="hidden" name="user_id" x-model="userId">

            {{-- Delete Button (Danger) --}}
            <button
                type="button"
                @click="$refs.deleteForm.action = `{{ url('/users') }}/${userId}`; $refs.deleteForm.submit()"
                class="w-full inline-flex justify-center items-center gap-2 px-4 py-2.5 text-sm font-medium text-white transition-colors bg-red-600 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-500/10">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                Delete User
            </button>

            {{-- Cancel Button - Closes modal --}}
            <button
                type="button"
                @click="open = false"
                class="w-full inline-flex justify-center items-center gap-2 px-4 py-2.5 text-sm font-medium text-gray-700 transition-colors bg-gray-100 rounded-lg hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-500/10">
                Cancel
            </button>
        </form>
    </div>
</x-backend::ui.modal>
