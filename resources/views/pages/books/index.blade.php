<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Buku') }}
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
                                <th>Judul</th>
                                <th>Jumlah Awal</th>
                                <th>Jumlah Saat Ini</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- row 1 -->
                            @forelse($books as $book)
                                <tr>
                                    <th>{{ $loop->index + 1 }}</th>
                                    <td>{{ $book->title }}</td>
                                    <td>{{ $book->amount }}</td>
                                    <td>{{ $book->current_amount }}</td>
                                    <td>@if($book->amount > 0) Tersedia @else Tidak tersedia @endif</td>
                                    <td>
                                        <label for="my_modal_2{{$book->id}}" class="btn">Ubah</label>
                                        <label for="my_modal_3{{$book->id}}" class="btn">Hapus</label>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center text-mute" colspan="7">Data buku tidak tersedia</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $books->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    <dialog id="my_modal_1" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box">
            <h3 class="text-lg font-bold">Tambah</h3>
            <div class="modal-action">
                <form action="{{ route('books.store') }}" method="POST" class="w-full">
                    @csrf
                    <!-- if there is a button in form, it will close the modal -->
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text">Judul</span>
                        </div>
                        <input type="text" id="title" name="title" placeholder="Ketik disini" class="input input-bordered w-full" required />
                    </label>
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text">Jumlah Buku</span>
                        </div>
                        <input type="text" id="amount" name="amount" placeholder="Ketik disini" class="input input-bordered w-full" required />
                    </label>
                    <div class="flex justify-end pt-3">
                        <button type="submit" class="btn mx-3">Simpan</button>
                        <button type="button" class="btn" onclick="my_modal_1.close()">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </dialog>
    @if(!empty($book))
        @foreach($books as $book)
            <input type="checkbox" id="my_modal_2{{$book->id}}" class="modal-toggle" />
            <div class="modal" role="dialog">
                <div class="modal-box">
                    <h3 class="text-lg font-bold">Ubah</h3>
                    <div class="modal-action">
                        <form action="{{ route('books.update', $book->id) }}" method="POST" class="w-full">
                            @csrf
                            @method('PUT')
                            <!-- if there is a button in form, it will close the modal -->
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text">Judul</span>
                                </div>
                                <input type="text" id="title" name="title" value="{{ old('title', $book->title) }}" placeholder="Ketik disini" class="input input-bordered w-full" required />
                            </label>
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text">Jumlah Buku</span>
                                </div>
                                <input type="text" id="amount" name="amount" value="{{ old('amount', $book->amount) }}" placeholder="Ketik disini" class="input input-bordered w-full" required />
                            </label>
                            <div class="flex justify-end pt-3">
                                <button type="submit" class="btn mx-3">Simpan</button>
                                <label for="my_modal_2{{$book->id}}" class="btn">Tutup</label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <input type="checkbox" id="my_modal_3{{$book->id}}" class="modal-toggle" />
            <div class="modal" role="dialog">
                <div class="modal-box">
                    <h3 class="text-lg font-bold">Hapus</h3>
                    <p class="py-4">Apakah anda yakin menghapus data tersebut?</p>
                    <div class="modal-action">
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <!-- if there is a button in form, it will close the modal -->
                            <button type="submit" class="btn">Hapus</button>
                            <label for="my_modal_3{{$book->id}}" class="btn">Tutup</label>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</x-app-layout>
