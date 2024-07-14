<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Students') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                    <div x-data="{ showModal = false }">
                        <button @click="showModal = true">Buka Modal</button>

                        <div x-show="showModal" class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75 z-10">
                            <div x-show="showModal" @click.away="showModal = false" class="bg-white p-4 rounded-lg">
                                <h2>Judul Modal</h2>
                                <p>Konten modal di sini...</p>
                                <button @click="showModal = false">Tutup Modal</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
