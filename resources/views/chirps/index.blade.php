<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Chirps') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('chirps.store') }}">
                        @csrf
                        <textarea 
                            name="message" 
                            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                            placeholder="{{ __('What\'s happening?') }}"
                            >{{ old('message' )}}</textarea>
                        <x-input-error :messages="$errors->get('message')" class="mt-2"/>
                        <!-- 
                            Otra forma de mostrar los errores 
                            @error('message')
                            <div class="text-red-500 mt-2">{{ $message }}</div>
                            @enderror 
                        -->
                        <x-primary-button class="mt-4">
                            {{ __('Chirp') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>

            <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                @foreach($chirps as $chirp)
                <div class="p-6 flex space-x-2">
                    <svg class="h-6 w-6 text-gray-600 dark:text-gray-400 -scale-x-100" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z"></path>
                    </svg>
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-gray-800 dark:text-gray-200">{{ $chirp->user->name }}</span>
                                <small class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ $chirp->created_at->format('j M Y, g:i a') }}</small>
                                <!--<small class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ $chirp->created_at->diffForHumans() }}</small>--><!-- Mas formatos en carbon.nesbot.com/docs -->
                                @if ($chirp->created_at != $chirp->updated_at)
                                    <small class="text-sm text-gray-600 dark:text-gray-400"> &middot; {{ __('edited')}}</small>
                                @endif
                            </div>
                        </div>
                        <p class="mt-4 text-lg text-gray-900 dark:text-gray-100">{{ $chirp->message }}</p>
                    </div>
                    @if (auth()->user()->is($chirp->user))
                    <x-dropdown>
                        <x-slot name="trigger">
                            <button>
                                <svg class="w-5 h-5 text-gray-400 dark:text-gray-200 " data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z"></path>
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('chirps.edit', $chirp)">
                                {{ __('Edit Chirp') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
