<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>

            <!-- Manage Product Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6">
                    <div class="flex flex-col items-center gap-4">
                        <!-- Centered Title -->
                        <h3 class="text-lg font-bold text-gray-800">
                            {{ __('CRUD APPLICATION') }}
                        </h3>

                        <!-- Buttons Section -->
                        <div class="flex flex-col md:flex-row gap-4 mt-4">
                            <!-- Product Details Button -->
                            <button
                                class="bg-green-500 text-gray font-semibold px-4 py-2 rounded hover:bg-green-600 transition duration-300"
                                onclick="window.location.href='{{ route('products.index') }}'">
                                {{ __('View Product Details') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>