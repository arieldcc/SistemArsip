@extends('layouts.master')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Pengguna</h1>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Form Edit data Pengguna</h5>
        </div>
        <div class="card-body">

            <form action="/user-management/{{ $user->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="level">Peran</label>
                    <select class="form-control @error('level') is-invalid @enderror" id="level" name="level" required>
                        <option value="admin" {{ old('level', $user->level) == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="pimpinan" {{ old('level', $user->level) == 'pimpinan' ? 'selected' : '' }}>Pimpinan</option>
                    </select>
                    @error('level')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Kata Sandi (opsional)</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation">
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="/user-management" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
