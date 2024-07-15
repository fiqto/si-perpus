<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Peminjaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="py-3 flex justify-between items-center">
                <h3 class="font-bold text-2xl">Tabel</h3>
                <button class="btn" onclick="my_modal_1.showModal()">Tambah</button>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto text-gray-900">
                        <table class="table">
                            <!-- head -->
                            <thead>
                            <tr>
                                <th></th>
                                <th>Buku</th>
                                <th>Mahasiswa</th>
                                <th>Tanggal Peminjaman</th>
                                <th>Tanggal Batas Pengembalian</th>
                                <th>Tanggal Pengembalian</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- row 1 -->
                            @forelse($rentals as $rental)
                                <tr>
                                    <th>{{ $loop->index + 1 }}</th>
                                    <td>{{ $rental->title }}</td>
                                    <td>{{ $rental->name }}</td>
                                    <td>
                                        <button class="btn" onclick="my_modal_2.showModal({{ $rental->id }})">Ubah</button>
                                        <button class="btn" onclick="my_modal_3.showModal({{ $rental->id }})">Hapus</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center text-mute" colspan="7">Data peminjaman tidak tersedia</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $rentals->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    <dialog id="my_modal_1" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box">
            <h3 class="text-lg font-bold">Tambah</h3>
            <div class="modal-action">
                <form action="{{ route('rentals.store') }}" method="POST" class="w-full">
                    @csrf
                    <!-- if there is a button in form, it will close the modal -->
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text">Buku</span>
                        </div>
                        <select id="book_id" name="book_id" class="select select-bordered w-full" required>
                            <option disabled selected>Pick one</option>
                            <option>Star Wars</option>
                        </select>
                    </label>
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text">Mahasiswa</span>
                        </div>
                        <select id="student_id" name="student_id" class="select select-bordered w-full" required>
                            <option disabled selected>Pick one</option>
                            <option>Star Wars</option>
                        </select>
                    </label>
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text">Tanggal Pengembalian</span>
                        </div>
                        <input type="date" id="rental_length" name="rental_length" placeholder="Ketik disini" class="input input-bordered w-full" required />
                    </label>
                    <div class="flex justify-end pt-3">
                        <button type="submit" class="btn mx-3">Simpan</button>
                        <button type="button" class="btn" onclick="my_modal_1.close()">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </dialog>
    @if(!empty($rental))
        <dialog id="my_modal_2" class="modal modal-bottom sm:modal-middle">
            <div class="modal-box">
                <h3 class="text-lg font-bold">Ubah</h3>
                <div class="modal-action">
                    <form action="{{ route('rentals.update', $rental->id) }}" method="POST" class="w-full">
                        @csrf
                        @method('PUT')
                        <!-- if there is a button in form, it will close the modal -->
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">Buku</span>
                            </div>
                            <input type="text" id="title" name="title" value="{{ old('title', $rental->title) }}" placeholder="Ketik disini" class="input input-bordered w-full" required />
                        </label>
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">Mahasiswa</span>
                            </div>
                            <input type="text" id="name" name="name" value="{{ old('name', $rental->name) }}" placeholder="Ketik disini" class="input input-bordered w-full" required />
                        </label>
                        <div class="flex justify-end pt-3">
                            <button type="submit" class="btn mx-3">Simpan</button>
                            <button type="button" class="btn" onclick="my_modal_2.close()">Tutup</button>
                        </div>
                    </form>
                </div>
            </div>
        </dialog>
        <dialog id="my_modal_3" class="modal modal-bottom sm:modal-middle">
            <div class="modal-box">
                <h3 class="text-lg font-bold">Hapus</h3>
                <p class="py-4">Apakah anda yakin menghapus data tersebut?</p>
                <div class="modal-action">
                    <form action="{{ route('rentals.destroy', $rental->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <!-- if there is a button in form, it will close the modal -->
                        <button type="submit" class="btn">Hapus</button>
                        <button type="button" class="btn" onclick="my_modal_3.close()">Tutup</button>
                    </form>
                </div>
            </div>
        </dialog>
    @endif
</x-app-layout>
