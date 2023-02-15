<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update user') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form method="POST" action="{{ route('users.update', $user) }}">
                        @method('PUT')
                        @csrf
                        <!-- Name -->
                        <div>
                            <x-label for="first_name" :value="__('Name')" />

                            <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" value="{{ $user->first_name }}" required autofocus />
                        </div>

                        <!-- Surname -->
                        <div class="mt-4">
                            <x-label for="surname" :value="__('Surname')" />

                            <x-input id="surname" class="block mt-1 w-full" type="text" name="surname" value="{{ $user->surname }}" required autofocus />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-label for="email" :value="__('Email')" />

                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ $user->email }}" required />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-label for="password" :value="__('New password')" />

                            <x-input id="password" class="block mt-1 w-full" type="password" name="password" autocomplete="new-password" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-label for="password_confirmation" :value="__('Confirm new password')" />

                            <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" />
                        </div>

                        <!-- Admin -->
                        @can('setAdmin', $user)
                        <div class="mt-4">

                            <input id="admin" type="checkbox" {{ $user->admin == 1 ? 'checked' : null }} value="{{ $user->admin }}" name="admin" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">

                            <label for="admin" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Admin</label>

                        </div>
                        @endcan

                        <div class="mt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-200 border">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>