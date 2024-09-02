@extends('layouts.global')

@section('title', 'SITA | Manajemen Pengguna')

@section('content')

<section class="section">
    <div class="section-header">
        <h1>Edit Akun</h1>
    </div>
</section>
<div class="row">
    <div class="col-12 col-md-12 col-lg-7">
        <div class="card card-primary">
            <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{route('psik.update', [$user->id])}}" method="POST">
                @csrf
                <input type="hidden" value="PUT" name="_method">
                <div class="card-header">
                    <h4>Edit Profile</h4>
                </div>

                <div class="card-body">
                    <div class="row">
                        @if(session('status'))
                        <div class="alert alert-success">
                            {{session('status')}}
                        </div>
                        @endif

                        @if(session('status'))
                        <div class="alert alert-success">
                            {{session('status')}}
                        </div>
                        @endif

                        <div class="form-group col-md-6 col-12">
                            <label>Nama Depan</label>
                            <input value="{{old('nama') ? old('nama') : $user->nama}}" class="form-control {{$errors->first('nama') ? "is-invalid" : "" }}" placeholder="Nama Depan" type="text" name="nama" id="nama">
                            <div class="invalid-feedback">
                                {{$errors->first('nama')}}
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-12">
                            <label>Nama Belakang</label>
                            <input value="{{old('nama_b') ? old('nama_b') : $user->nama_b}}" class="form-control {{$errors->first('nama_b') ? "is-invalid" : "" }}" placeholder="Nama Belakang" type="text" name="nama_b" id="nama_b">
                            <div class="invalid-feedback">
                                {{$errors->first('nama_b')}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 col-12">
                            <label>NIK/NIM</label>
                            <input value="{{$user->id}}" disabled class="form-control" placeholder="username" type="text" name="username" id="username" />
                        </div>
                        <div class="form-group col-md-6 col-12">
                            <label for="email">Email</label>
                            <input value="{{$user->email}}" disabled class="form-control {{$errors->first('email') ? "is-invalid" : ""}} " placeholder="user@mail.com" type="text" name="email" id="email" />
                            <div class="invalid-feedback">
                                {{$errors->first('email')}}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6 col-12">
                            <label for="">Role</label>
                            <div>
                                @if($user->roles_id == "1")
                                <span class="badge badge-danger">PSIK</span>
                                @elseif($user->roles_id == "2")
                                <span class="badge badge-warning">SEKJUR</span>
                                @elseif($user->roles_id == "3")
                                <span class="badge badge-info">AKADEMIK</span>
                                @elseif($user->roles_id == "4")
                                <span class="badge badge-success">DOSEN</span>
                                @elseif($user->roles_id == "5")
                                <span class="badge badge-secondary">MAHASISWA</span>
                                @endif
                            </div>
                        </div>
                        @if($user->roles_id != "1")
                        <div class="form-group col-md-6 col-12">
                            <label for="">Status</label>
                            <div>
                                <label for="active">Active</label>
                                <input {{$user->status == "1" ? "checked" : ""}} value="1" type="radio" class="form-check form-check-inline" id="active" name="status">
                                <label for="inactive">Inactive</label>
                                <input {{$user->status == "0" ? "checked" : ""}} value="0" type="radio" class="form-check form-check-inline" id="inactive" name="status">
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6 col-12">
                            <label for="">Nomer HP</label>
                            <input type="text" name="no_HP" class="form-control {{$errors->first('no_HP') ? "is-invalid" : ""}}" value="{{old('no_HP') ? old('no_HP') : $user->no_HP}}">
                            <div class="invalid-feedback">
                                {{$errors->first('no_HP')}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer text-right">
                    <input class="btn btn-success" type="submit" value="Update" />
                </div>
            </form>
        </div>
    </div>
</div>
@endsection