@extends('layouts.master')

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah Pengguna</h1>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Form Tambah Pengguna</h5>
        </div>
        <div class="card-body">

            <form action="/user-management/store" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="level">Peran</label>
                    <select class="form-control @error('id_bagian') is-invalid @enderror" id="level" name="level" required>
                        <option value="admin" {{ old('level') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="pimpinan" {{ old('level') == 'pimpinan' ? 'selected' : '' }}>Pimpinan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="password">Kata Sandi</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password') }}" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}" required>
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="/users-management" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
