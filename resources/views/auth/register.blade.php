@extends('layouts.auth.master', ['title' => 'Register - Gudangku'])

@section('content')
    <form class="card card-md border-0 rounded-3" action="{{ route('register') }}" method="POST">
        @csrf
        <div class="card-body">
            <h3 class="text-center mb-3 font-weight-medium">
                Register
            </h3>
            <div class="mb-3">
                <label class="form-label" for="name">Nama</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Masukan Nama Anda" id="name" name="name">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label" for="email">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror"
                    placeholder="Masukan Email Anda" name="email" id="email">
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label" for="pass">Kata Sandi</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                    placeholder="Masukan Kata Sandi" id="pass" name="password">
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label" for="password">Konfirmasi Kata Sandi</label>
                <input type="password" id="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                placeholder="masukan konfirmasi kata sandi anda" name="password_confirmation">
                @error('password_confirmation')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-footer">
                <button type="submit" class="btn btn-primary btn-block">Daftar</button>
            </div>
        </div>
    </form>
@endsection
