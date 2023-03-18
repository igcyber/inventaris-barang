@extends('layouts.auth.master', ['title' => 'Login - Gudangku'])

@section('content')
    <form class="card card-md border-0 rounded-3" action="{{ route('login') }}" method="POST">
        @csrf
        <div class="card-body">
            <h3 class="text-center mt-2 font-weight-medium">
                HALAMAN LOGIN
            </h3>
            <hr>
            <div class="mb-3">
                <label class="form-label" for="email">Alamat Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror"
                    placeholder="Masukan Alamat Email Anda" name="email" id="email">
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label" for="sandi">Kata Sandi</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                    placeholder="Masukan Kata Sandi Anda" name="password" id="sandi">
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-footer">
                <button type="submit" class="btn btn-primary btn-block">Masuk</button>
            </div>
        </div>
    </form>
@endsection
