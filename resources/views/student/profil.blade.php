@extends('layouts.global')

@section('title', 'SITA | Manajemen Tugas Akhir Mahasiswa')

@section('header')
    <!-- CSS Libraries -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')

    <section class="section">
        <div class="section-header">
            <h1>Profil Mahasiswa</h1>
        </div>

        @if ($message = Session::get('status'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif

        @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif

        <div class="section-body">
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-5">
                    <div class="card profile-widget">
                        <div class="profile-widget-header">
                            @if ($students->avatar)
                                <img src="{{ asset('storage/' . $students->avatar) }}"
                                    class="rounded-circle profile-widget-picture" />
                            @else
                                <img src="{{ asset('storage/avatars/avatar-1.png') }}"
                                    class="rounded-circle profile-widget-picture">
                            @endif
                            <div class="profile-widget-items">
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-value">{{ $users->nama }} {{ $users->nama_b }}</div>
                                    <div class="profile-widget-item-label">{{ $users->id }}</div>
                                </div>
                            </div>
                            <div class="text-center">{{ $users->email }}</div>
                        </div>
                        <div class="profile-widget-description">
                            <div class="label">Program Studi :</div>
                            <div class="form-control">{{ $students->program->nama }}</div>
                            <div class="label">Jurusan :</div>
                            <div class="form-control">{{ $students->jurusan }}</div>
                            <div class="label">No. Handphone :</div>
                            <div class="form-control">{{ $users->no_HP }}</div>
                            <div class="label">Alamat :</div>
                            <textarea rows="3" class="col-12" disabled>{{ $students->alamat }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-12 col-lg-7">
                    <div class="card">
                        <form action="{{ route('student.updateprofil', Auth::user()->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-header">
                                <h4>Edit Profile</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label for="password">Password Baru</label>
                                        <input id="password" type="password" class="form-control"
                                            value="{{ $users->password }}" name="password" required
                                            autocomplete="new-password">

                                        <div class="invalid-feedback">
                                            {{ $errors->first('password') }}
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6 col-12">
                                        <label for="password-confirm">{{ __('Confirm Password') }}</label>

                                        <input id="password-confirm" type="password" class="form-control"
                                            value="{{ $users->password }}" name="password_confirmation" required
                                            autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-8 col-12">
                                        <label for="no_HP">Nomer Handphone</label>
                                        <input type="text" value="{{ $users->no_HP }}" name="no_HP"
                                            class="form-control {{ $errors->first('no_HP') ? ' is-invalid' : '' }}"
                                            value="">
                                        <div class="invalid-feedback">
                                            {{ $errors->first('no_HP') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-8 col-12">
                                        <label for="avatar">Unggah Foto Profil</label>
                                        <input type="file" name="avatar"
                                            class="form-control {{ $errors->first('avatar') ? ' is-invalid' : '' }}"
                                            value="">
                                        <div class="invalid-feedback">
                                            {{ $errors->first('avatar') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="alamat">Alamat</label>
                                        <textarea class="form-control {{ $errors->first('alamat') ? 'is-invalid' : '' }}" placeholder="Domisili di malang"
                                            type="text" name="alamat" id="alamat"></textarea>
                                        <div class="invalid-feedback">
                                            {{ $errors->first('alamat') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">
                                    Perbaharui
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection


@push('page-scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
@endpush
<!-- Page Specific JS File -->

@push('after-scripts')
    <script>
        $(document).ready(function() {
            $("#js-example-basic-single").select2();
            $("#js-example-basic-single-2").on("change", function(e) {
                var data = $(this).val();
                if (data == 0) {
                    alert("nothing selected");
                } else {
                    console.log(data);
                    alert(data);
                }
            });
        });
    </script>
@endpush
