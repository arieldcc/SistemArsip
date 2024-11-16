@extends('layouts.master')
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="{{ asset('css/style_awal.css') }}" rel="stylesheet"> <!-- Custom CSS -->
@endsection

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h1>Daftar Bagian</h1>
    </div>

    <!-- Card Container -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">List Bagian</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="bagianTable" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Bagian</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($data as $item)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td>{{ $item->nama_bagian }}</td>
                                <td class="text-center">
                                    <button type="button" class="action-btn btn-tampil" onclick="showBagian('{{ $item->id }}')" title="Tampil">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button type="button" class="action-btn btn-edit" onclick="editBagian('{{ $item->id }}')">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" class="action-btn btn-hapus" onclick="confirmDelete('{{ $item->id }}')" title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <form id="delete-form" action="" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    </div>

    <!-- Include Modal -->
    @include('bagian.show_modal')

    <!-- Include Modal Edit -->
    @include('bagian.modal_edit')

    <!-- Floating Action Button -->
    <a href="/bagian/create" class="fab-btn" title="Tambah Bagian">+</a>
</div>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#bagianTable').DataTable(); // Tanpa pengaturan `language.url`

            // Fungsi untuk menampilkan modal edit dan memuat data
            window.editBagian = function(id) {
                $.ajax({
                    url: `/bagian/${id}/edit`,
                    type: 'GET',
                    success: function(data) {
                        $('#bagianId').val(data.id);
                        $('#editNamaBagian').val(data.nama_bagian);

                        // Inisialisasi modal dengan backdrop statis
                        const editModal = new bootstrap.Modal(document.getElementById('editModal'), {
                            backdrop: 'static',
                            keyboard: false
                        });
                        editModal.show();
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Gagal memuat data!',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            };

            // Fungsi untuk menyimpan perubahan dengan AJAX
            $('#saveChangesBtn').on('click', function() {
                const id = $('#bagianId').val();
                $.ajax({
                    url: `/bagian/${id}`,
                    type: 'PUT',
                    data: $('#editForm').serialize(),
                    success: function(response) {
                        $('#editModal').modal('hide');
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Data berhasil diperbarui.',
                            icon: 'success',
                            timer: 2000,
                            timerProgressBar: true
                        }).then(() => {
                            location.reload(); // Reload halaman untuk memperbarui tabel
                        });
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Gagal memperbarui data.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });

            @if(session('success'))
                Swal.fire({
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonText: 'OK',
                    timer: 2000,
                    timerProgressBar: true
                });
            @endif
        });

        // console.log('jQuery version:', $.fn.jquery);
        // console.log('Bootstrap modal available:', typeof $.fn.modal === 'function');

        // Fungsi untuk menampilkan modal dengan pengaturan backdrop dan keyboard
        function showBagian(id) {
            $.ajax({
                url: `/bagian/${id}`,
                type: 'GET',
                success: function(data) {
                    $('#bagianId').text(data.id);
                    $('#namaBagian').text(data.nama_bagian);

                    // Atur modal dengan backdrop static dan keyboard false
                    const modal = new bootstrap.Modal(document.getElementById('showModal'), {
                        backdrop: 'static',
                        keyboard: false
                    });
                    modal.show(); // Tampilkan modal
                },
                error: function() {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Gagal memuat data!',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }

        // Fungsi untuk menampilkan modal edit dan memuat data
            window.editBagian = function(id) {
                $.ajax({
                    url: `/bagian/${id}/edit`,
                    type: 'GET',
                    success: function(data) {
                        $('#bagianId').val(data.id);
                        $('#editNamaBagian').val(data.nama_bagian);

                        // Inisialisasi modal dengan backdrop statis
                        const editModal = new bootstrap.Modal(document.getElementById('editModal'), {
                            backdrop: 'static',
                            keyboard: false
                        });
                        editModal.show();
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Gagal memuat data!',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            };

        // Fungsi Konfirmasi dan Hapus Data
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Lakukan request AJAX untuk menghapus data
                    $.ajax({
                        url: `/bagian/${id}`,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Data berhasil dihapus.',
                                icon: 'success',
                                timer: 2000,
                                timerProgressBar: true
                            }).then(() => {
                                location.reload(); // Reload halaman untuk memperbarui tabel
                            });
                        },
                        error: function() {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Gagal menghapus data.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    });
                }
            });
        }
    </script>
@endsection
