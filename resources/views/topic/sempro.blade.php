@extends('layouts.global')

@section('title', 'SITA | Pengajuan Seminar Proposal')

@section('header')

    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">

@endsection


@section('content')


    <section class="section">
        <div class="section-header">
            <h1>Form Pengajuan Seminar Proposal</h1>
        </div>


        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3"
                        action="{{ route('student.storeSempro', [$topic->id]) }}" method="POST">
                        @csrf

                        <div class="card-header">
                            <h4>Pengajuan Seminar Proposal</h4>
                        </div>

                        <div class="card-body">

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Judul Tugas
                                    Akhir</label>
                                <div class="col-sm-12 col-md-7">
                                    <textarea class="form-control col-xs-12" rows="3" placeholder="{{ $topic->judul }}" disabled></textarea>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Pengajuan
                                    Seminar</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" placeholder="Seminar Proposal" disabled>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Surat Tugas Dosen
                                    Pembimbing</label>
                                <div class="col-sm-12 col-md-7">
                                    @if ($topic->surat_tugas == null)
                                        <div class="form-control">Surat Tugas Sedang Diproses</div>
                                    @else
                                        <a href="{{ asset('storage/' . $topic->surat_tugas) }}"
                                            class="form-control text-dark badge-primary">
                                            <i class="far fa-file-pdf "></i> Surat Tugas
                                            <a>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jam Seminar
                                    Proposal</label>
                                <div for="waktu" class="col-sm-12 col-md-7">
                                    <input id="waktu" type="text"
                                        class="form-control datetimepicker @error('waktu') is-invalid @enderror"
                                        name="waktu" value="{{ old('waktu') }}" required autocomplete="waktu" autofocus>
                                </div>
                                <div class="invalid-feedback">
                                    {{ $errors->first('waktu') }}
                                </div>
                            </div>

                            {{-- Nim Moderator? --}}

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Moderator
                                    Seminar</label>
                                <div for="nama_moderator" class="col-sm-12 col-md-7">
                                    <input id="nama_moderator" type="text"
                                        class="form-control
                                        @error('nama_moderator') is-invalid @enderror"
                                        name="nama_moderator" value="{{ old('nama_moderator') }}"
                                        autocomplete="nama_moderator" autofocus>
                                    <div class="invalid-feedback">
                                        {{ $errors->first('nama_moderator') }}
                                    </div>
                                    <small id="warning" class="form-text text-muted">
                                        Tempat Pelaksanaan Seminar Akan Ditinjau Oleh Akademik.
                                        Perubahan dapat terjadi sewaktu-waktu. Harap melakukan pengecekan informasi seminar
                                        proposal secara berkala.
                                    </small>
                                </div>

                            </div>

                        </div>
                        <div class="card-footer">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <input class="btn btn-primary btn-lg text-left" type="submit"
                                        value="Unggah Pengajuan" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('page-scripts')
    <script src="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
@endpush
