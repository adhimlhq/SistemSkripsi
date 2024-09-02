@extends('layouts.app')

@section('title', 'SITA | Sistem Tugas Akhir')

@section('content')

<div class="container mt-8">
    <div class="row">
        <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">

            <div class="login-brand">
                <img src="../assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>


            <div class="mt-6 text-muted text-center">
                Already have account? <a href="{{ route('login') }}">Sign In</a>
            </div>

            <div class="card card-primary">
                <div class="card-header">
                    <h4>Register</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row">
                            <div class="form-group col-6">
                                <label for="nama">Nama Depan</label>
                                <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" required autocomplete="nama" autofocus>

                                @error('nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label for="nama_b">Nama Belakang</label>
                                <input id="nama_b" type="text" class="form-control @error('nama_b') is-invalid @enderror" name="nama_b" value="{{ old('nama_b') }}" required autocomplete="nama_b" autofocus>

                                @error('nama_b')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label for="id">NIM</label>
                                <input id="id" type="id" class="form-control @error('id') is-invalid @enderror" name="id" value="{{ old('id') }}" required autocomplete="id" autofocus>

                                @error('id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-12">
                                <label>Progam Studi</label>
                                <select class="form-control" id="js-example-basic-single" name="program_id" class="form-control @error('program_id') is-invalid @enderror" value="{{ old('program_id') }}" required autocomplete="program_id" autofocus>
                                    <option value="">Pilih Program Studi</option>
                                    @foreach($program as $prodi)
                                    <option value="{{$prodi->id??null}}">{{$prodi->nama??null}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                Register
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection