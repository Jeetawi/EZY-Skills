<div x-data="notificationBell()" x-init="init()" class="relative">
    <!-- Notification Bell Button -->
    <button @click="toggleDropdown()" class="relative p-2 text-gray-600 hover:text-orange-500 hover:bg-orange-50 rounded-lg transition-colors">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
        </svg>

        <!-- Badge -->
        <span x-show="unreadCount > 0"
              x-text="unreadCount"
              x-cloak
              class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center animate-pulse">
        </span>
    </button>

    <!-- Dropdown -->
    <div x-show="isOpen"
         x-cloak
         @click.away="closeDropdown()"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="absolute right-0 mt-2 w-96 bg-white rounded-2xl shadow-2xl border-2 border-gray-200 z-50 max-h-[32rem] flex flex-col">

        <!-- Header -->
        <div class="px-6 py-4 border-b-2 border-gray-200 bg-gradient-to-r from-orange-50 to-blue-50">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-bold text-gray-900">Notifications</h3>
                <span x-show="unreadCount > 0" class="text-sm text-gray-600">
                    <span x-text="unreadCount"></span> new
                </span>
            </div>
        </div>

        <!-- Notifications List -->
        <div class="overflow-y-auto flex-1">
            <template x-if="notifications.length === 0">
                <div class="p-8 text-center">
                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <p class="text-gray-500 font-medium">No notifications yet</p>
                    <p class="text-sm text-gray-400 mt-1">You're all caught up!</p>
                </div>
            </template>

            <template x-for="notification in notifications" :key="notification.id">
                <div @click="markAsRead(notification.id, notification.data?.action_url || notification.action_url)"
                     class="px-6 py-4 border-b border-gray-100 hover:bg-orange-50 cursor-pointer transition-colors"
                     :class="!notification.read_at ? 'bg-blue-50' : ''">
                    <div class="flex items-start space-x-3">
                        <!-- Icon -->
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-gradient-to-br from-orange-400 to-orange-600 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900" x-text="notification.data?.message || notification.message"></p>
                            <p class="text-xs text-gray-500 mt-1">
                                <span x-text="notification.data?.student_name || notification.student_name || 'Student'"></span> •
                                <span x-text="formatTime(notification.created_at)"></span>
                            </p>
                            <p class="text-xs text-orange-600 font-medium mt-2">Click to review →</p>
                        </div>

                        <!-- Unread Indicator -->
                        <template x-if="!notification.read_at">
                            <div class="flex-shrink-0">
                                <span class="inline-block w-2 h-2 bg-orange-500 rounded-full"></span>
                            </div>
                        </template>
                    </div>
                </div>
            </template>
        </div>

        <!-- Footer -->
        <div class="px-6 py-3 border-t-2 border-gray-200 bg-gray-50">
            <button @click="markAllAsRead()"
                    x-show="unreadCount > 0"
                    class="text-sm text-orange-600 hover:text-orange-700 font-medium">
                Mark all as read
            </button>
        </div>
    </div>
</div>

<script>
function notificationBell() {
    return {
        isOpen: false,
        notifications: [],
        unreadCount: 0,
        isListening: false,

        toggleDropdown() {
            this.isOpen = !this.isOpen;
        },

        closeDropdown() {
            this.isOpen = false;
        },

        async init() {
            await this.fetchNotifications();
            this.listenForNotifications();
        },

        async fetchNotifications() {
            try {
                const response = await fetch('/notifications');
                if (!response.ok) {
                    return;
                }
                const data = await response.json();

                // Ensure all notifications have valid IDs
                this.notifications = data.notifications.map(n => ({
                    ...n,
                    id: n.id || `db-${Date.now()}-${Math.random().toString(36).substr(2, 9)}`
                }));

                this.unreadCount = parseInt(data.unread_count) || 0;
            } catch (error) {
                console.error('Error fetching notifications:', error);
            }
        },

        listenForNotifications() {
            if (this.isListening) {
                return;
            }

            this.isListening = true;
            const userId = {{ auth()->id() }};
            const self = this;

            // Listen to private user channel
            window.Echo.private(`App.Models.User.${userId}`)
                .notification((notification) => {
                    // Generate a unique ID if not present
                    const uniqueId = notification.id || `temp-${Date.now()}-${Math.random().toString(36).substr(2, 9)}`;

                    // Create a properly structured notification object
                    const newNotification = {
                        id: uniqueId,
                        type: notification.type || 'App\\Notifications\\EnrollmentRequestNotification',
                        data: notification,
                        read_at: null,
                        created_at: new Date().toISOString()
                    };

                    // Check for duplicates before adding
                    const isDuplicate = self.notifications.some(n => n.id === uniqueId);
                    if (isDuplicate) {
                        console.warn('Duplicate notification detected, skipping:', uniqueId);
                        return;
                    }

                    // Add to notifications array at the beginning using Alpine's reactive method
                    self.notifications = [newNotification, ...self.notifications];

                    // Increment unread count
                    const oldCount = self.unreadCount;
                    self.unreadCount = parseInt(self.unreadCount || 0) + 1;

                    // Show flasher toast
                    if (typeof flasher !== 'undefined') {
                        flasher.info(notification.message, {
                            title: 'New Enrollment Request',
                            timeout: 5000,
                            position: 'bottom-right',
                            closeButton: true,
                        });
                    }
                });
        },

        async markAsRead(notificationId, actionUrl) {
            try {
                // Find the notification to get the action URL if not provided
                const notificationIndex = this.notifications.findIndex(n => n.id === notificationId);
                if (notificationIndex === -1) {
                    return;
                }
                const notification = this.notifications[notificationIndex];
                const redirectUrl = actionUrl || notification?.data?.action_url || notification?.action_url;

                // Mark as read on server
                await fetch(`/notifications/${notificationId}/read`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                // Update local state with proper reactivity
                if (!notification.read_at) {
                    const oldCount = this.unreadCount;

                    // Create new array to trigger reactivity
                    const updatedNotifications = [...this.notifications];
                    updatedNotifications[notificationIndex] = {
                        ...notification,
                        read_at: new Date().toISOString()
                    };
                    this.notifications = updatedNotifications;
                    this.unreadCount = Math.max(0, parseInt(this.unreadCount || 0) - 1);
                } else {
                    console.log('⚠️ Notification already read, not updating count');
                }

                // Redirect to action URL
                if (redirectUrl) {
                    window.location.href = redirectUrl;
                }
            } catch (error) {
                console.error('Error marking notification as read:', error);
            }
        },

        async markAllAsRead() {
            try {
                await fetch('/notifications/mark-all-read', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                // Update local state with proper reactivity
                const now = new Date().toISOString();
                this.notifications = this.notifications.map(n => ({
                    ...n,
                    read_at: n.read_at || now
                }));
                this.unreadCount = 0;
            } catch (error) {
                console.error('Error marking all as read:', error);
            }
        },

        formatTime(datetime) {
            const date = new Date(datetime);
            const now = new Date();
            const diffMs = now - date;
            const diffMins = Math.floor(diffMs / 60000);
            const diffHours = Math.floor(diffMs / 3600000);
            const diffDays = Math.floor(diffMs / 86400000);

            if (diffMins < 1) return 'Just now';
            if (diffMins < 60) return `${diffMins}m ago`;
            if (diffHours < 24) return `${diffHours}h ago`;
            if (diffDays < 7) return `${diffDays}d ago`;
            return date.toLocaleDateString();
        },
    };
}
</script>

<style>
    [x-cloak] { display: none !important; }
</style>
