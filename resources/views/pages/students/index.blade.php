<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Mahasiswa') }}
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
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>No. Telepon</th>
                                <th>Program Studi</th>
                                <th>Angkatan</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- row 1 -->
                            @forelse($students as $student)
                            <tr>
                                <th>{{ $loop->index + 1 }}</th>
                                <td>{{ $student->identification_number }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->phone_number }}</td>
                                <td>{{ $student->study_program }}</td>
                                <td>{{ $student->student_class }}</td>
                                <td>
                                    <label for="my_modal_2{{$student->id}}" class="btn">Ubah</label>
                                    <label for="my_modal_3{{$student->id}}" class="btn">Hapus</label>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td class="text-center text-mute" colspan="7">Data mahasiswa tidak tersedia</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $students->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    <dialog id="my_modal_1" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box">
            <h3 class="text-lg font-bold">Tambah</h3>
            <div class="modal-action">
                <form action="{{ route('students.store') }}" method="POST" class="w-full">
                    @csrf
                    <!-- if there is a button in form, it will close the modal -->
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text">NIM</span>
                        </div>
                        <input type="text" id="identification_number" name="identification_number" placeholder="Ketik disini" class="input input-bordered w-full" required />
                    </label>
                    <label class="form-control w-full pt-3">
                        <div class="label">
                            <span class="label-text">Nama</span>
                        </div>
                        <input type="text" id="name" name="name" placeholder="Ketik disini" class="input input-bordered w-full " required />
                    </label>
                    <label class="form-control w-full pt-3">
                        <div class="label">
                            <span class="label-text">No. Telepon</span>
                        </div>
                        <input type="text" id="phone_number" name="phone_number" placeholder="Ketik disini" class="input input-bordered w-full" required />
                    </label>
                    <label class="form-control w-full pt-3">
                        <div class="label">
                            <span class="label-text">Program Studi</span>
                        </div>
                        <input type="text" id="study_program" name="study_program" placeholder="Ketik disini" class="input input-bordered w-full" required />
                    </label>
                    <label class="form-control w-full pt-3">
                        <div class="label">
                            <span class="label-text">Angkatan</span>
                        </div>
                        <input type="text" id="student_class" name="student_class" placeholder="Ketik disini" class="input input-bordered w-full" required />
                    </label>
                    <div class="flex justify-end pt-3">
                        <button type="submit" class="btn mx-3">Simpan</button>
                        <button type="button" class="btn" onclick="my_modal_1.close()">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </dialog>
    @if(!empty($student))
        @foreach($students as $student)
            <input type="checkbox" id="my_modal_2{{$student->id}}" class="modal-toggle" />
            <div class="modal" role="dialog">
                <div class="modal-box">
                    <h3 class="text-lg font-bold">Ubah</h3>
                    <div class="modal-action">
                        <form action="{{ route('students.update', $student->id) }}" method="POST" class="w-full">
                            @csrf
                            @method('PUT')
                            <!-- if there is a button in form, it will close the modal -->
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text">NIM</span>
                                </div>
                                <input type="text" id="identification_number" name="identification_number" value="{{ old('identification_number', $student->identification_number) }}" placeholder="Ketik disini" class="input input-bordered w-full" required />
                            </label>
                            <label class="form-control w-full pt-3">
                                <div class="label">
                                    <span class="label-text">Nama</span>
                                </div>
                                <input type="text" id="name" name="name" value="{{ old('name', $student->name) }}" placeholder="Ketik disini" class="input input-bordered w-full " required />
                            </label>
                            <label class="form-control w-full pt-3">
                                <div class="label">
                                    <span class="label-text">No. Telepon</span>
                                </div>
                                <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number', $student->phone_number) }}" placeholder="Ketik disini" class="input input-bordered w-full" required />
                            </label>
                            <label class="form-control w-full pt-3">
                                <div class="label">
                                    <span class="label-text">Program Studi</span>
                                </div>
                                <input type="text" id="study_program" name="study_program" value="{{ old('study_program', $student->study_program) }}" placeholder="Ketik disini" class="input input-bordered w-full" required />
                            </label>
                            <label class="form-control w-full pt-3">
                                <div class="label">
                                    <span class="label-text">Angkatan</span>
                                </div>
                                <input type="text" id="student_class" name="student_class" value="{{ old('student_class', $student->student_class) }}" placeholder="Ketik disini" class="input input-bordered w-full" required />
                            </label>
                            <div class="flex justify-end pt-3">
                                <button type="submit" class="btn mx-3">Simpan</button>
                                <label for="my_modal_2{{$student->id}}" class="btn">Tutup</label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <input type="checkbox" id="my_modal_3{{$student->id}}" class="modal-toggle" />
            <div class="modal" role="dialog">
                <div class="modal-box">
                    <h3 class="text-lg font-bold">Hapus</h3>
                    <p class="py-4">Apakah anda yakin menghapus data tersebut?</p>
                    <div class="modal-action">
                        <form action="{{ route('students.destroy', $student->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <!-- if there is a button in form, it will close the modal -->
                            <button type="submit" class="btn">Hapus</button>
                            <label for="my_modal_3{{$student->id}}" class="btn">Tutup</label>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</x-app-layout>
