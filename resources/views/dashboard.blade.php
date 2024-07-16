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
                    {{ __("List Tabel") }}
                    <di class="flex justify-between">
                        <div class="card bg-base-100 w-96 shadow-xl">
                            <div class="card-body">
                                <h2 class="card-title">Sudah dikembalikan</h2>
                                <p>{{ $already_returned }}</p>
                            </div>
                        </div>
                        <div class="card bg-base-100 w-96 shadow-xl">
                            <div class="card-body">
                                <h2 class="card-title">Belum dikembalikan</h2>
                                <p>{{ $not_returned }}</p>
                            </div>
                        </div>
                        <div class="card bg-base-100 w-96 shadow-xl">
                            <div class="card-body">
                                <h2 class="card-title">Jumlah Buku</h2>
                                <p>{{ $books }}</p>
                            </div>
                        </div>
                        <div class="card bg-base-100 w-96 shadow-xl">
                            <div class="card-body">
                                <h2 class="card-title">Jumlah Mahasiswa</h2>
                                <p>{{ $students }}</p>
                            </div>
                        </div>
                    </di>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
