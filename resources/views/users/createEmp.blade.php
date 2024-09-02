@extends('layouts.global')

@section('title', 'SITA | Manajemen Pengguna')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Membuat Akun Pengguna</h1>
        </div>
        <div class="row ">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{ route('psik.store') }}"
                        method="POST">
                        @csrf
                        <div class="card-header">
                            <ul class="nav nav-pills card-header-pills">
                                <li class="nav-item">
                                    <a class="nav-link active" href="{{ route('psik.create') }}"> <i
                                            class="fas fa-user-tie"></i> Employe</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="{{ route('psik.createLec') }}"> <i
                                            class="fas fa-chalkboard-teacher"></i> Lecture</a>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="nama">Nama Depan</label>
                                    <input id="nama" type="text"
                                        class="form-control @error('nama') is-invalid @enderror" name="nama"
                                        value="{{ old('nama') }}" required autocomplete="nama" autofocus>
                                </div>
                                <div class="form-group col-6">
                                    <label for="nama_b">Nama Belakang</label>
                                    <input id="nama_b" type="text"
                                        class="form-control @error('nama_b') is-invalid @enderror" name="nama_b"
                                        value="{{ old('nama_b') }}" required autocomplete="nama_b" autofocus>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="id">NIP/Username</label>
                                    <input id="id" type="text"
                                        class="form-control @error('id') is-invalid @enderror" name="id"
                                        value="{{ old('id') }}" required autocomplete="id" autofocus>

                                    @error('id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="email">Email</label>
                                    <input id="email" type="text"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="id" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-6 ">
                                    <label for="no_HP">Nomor HP</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-phone"></i>
                                            </div>
                                        </div>
                                        <input type="text" name="no_HP"
                                            class="form-control phone-number {{ $errors->first('no_HP') ? 'is-invalid' : '' }}">

                                        @error('no_HP')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group col-6">
                                    <label for="roles_id">Jabatan</label>
                                    <select type="number" name="roles_id" id="roles_id" class="form-control">
                                        <option value="2">Jurusan</option>
                                        <option value="3">Akademik</option>
                                    </select>

                                    @error('roles_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <input class="btn btn-success" type="submit" value="Submit" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
