@extends('backend.layouts.app')

@section('content')
    <x-backend::common.page-breadcrumb pageTitle="Permissions" />

    @php
        $columns = [
            ['label' => 'Permission Name', 'key' => 'name'],
            ['label' => 'Assigned Roles', 'key' => 'roles'],
            ['label' => 'Created', 'key' => 'created_at'],
            ['label' => 'Actions', 'key' => 'actions'],
        ];
    @endphp

    <button @click="$dispatch('open-add-permission-modal')" type="button" class="flex ms-auto items-center mb-3 px-4 py-2.5 text-sm font-bold text-white transition-colors bg-brand-500 rounded-lg hover:bg-brand-600 focus:outline-none focus:ring-4 focus:ring-brand-500/10">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
        </svg>
        Add Permission
    </button>

    <x-backend::tables.data-table
        title="Permissions Management"
        description="Manage system permissions and access controls"
        :columns="$columns"
        :data="$permissions"
    >
        <td class="py-4 whitespace-nowrap">
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
                <div class="text-sm font-medium text-gray-900 dark:text-white" x-text="item.name"></div>
            </div>
        </td>
        <td class="px-4 py-4">
            <div class="flex flex-wrap gap-1">
                <template x-if="item.roles.length > 0">
                    <template x-for="role in item.roles" :key="role.name">
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium capitalize" :class="{
                            'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300': role.name === 'admin',
                            'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300': role.name === 'teacher',
                            'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300': role.name === 'student'
                        }" x-text="role.name"></span>
                    </template>
                </template>
                <template x-if="item.roles.length === 0">
                    <span class="text-sm text-gray-400 dark:text-gray-500">No roles assigned</span>
                </template>
            </div>
        </td>
        <td class="px-4 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-500 dark:text-gray-400" x-text="item.created_at"></div>
        </td>
        <td class="px-4 py-4 text-sm font-medium text-right whitespace-nowrap">
            <div class="flex justify-start">
                <x-backend::common.table-dropdown>
                    <x-slot name="button">
                        <button type="button" class="text-gray-500 dark:text-gray-400">
                            <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M5.99902 10.245C6.96552 10.245 7.74902 11.0285 7.74902 11.995V12.005C7.74902 12.9715 6.96552 13.755 5.99902 13.755C5.03253 13.755 4.24902 12.9715 4.24902 12.005V11.995C4.24902 11.0285 5.03253 10.245 5.99902 10.245ZM17.999 10.245C18.9655 10.245 19.749 11.0285 19.749 11.995V12.005C19.749 12.9715 18.9655 13.755 17.999 13.755C17.0325 13.755 16.249 12.9715 16.249 12.005V11.995C16.249 11.0285 17.0325 10.245 17.999 10.245ZM13.749 11.995C13.749 11.0285 12.9655 10.245 11.999 10.245C11.0325 10.245 10.249 11.0285 10.249 11.995V12.005C10.249 12.9715 11.0325 13.755 11.999 13.755C12.9655 13.755 13.749 12.9715 13.749 12.005V11.995Z" fill="currentColor"/>
                            </svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        @can('manage permissions')
                            <a href="#" class="flex w-full px-3 py-2 font-medium text-left text-gray-500 rounded-lg text-theme-xs hover:bg-gray-100 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-white/5 dark:hover:text-gray-300">Edit</a>
                        @endcan
                        @can('manage permissions')
                            <a href="#" class="flex w-full px-3 py-2 font-medium text-left text-red-500 rounded-lg text-theme-xs hover:bg-red-50 dark:hover:bg-red-500/10">Delete</a>
                        @endcan
                    </x-slot>
                </x-backend::common.table-dropdown>
            </div>
        </td>
    </x-backend::tables.data-table>
@endsection
