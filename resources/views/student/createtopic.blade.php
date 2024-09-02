@extends('layouts.global')
@section('title', 'SITA | Manajemen Tugas Akhir Mahasiswa')

@section('header')
    <link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/summernote/summernote-bs4.css') }}">

@endsection


@section('content')

    <section class="section">
        <div class="section-header">
            <h1>Form Pengajuan Topik Penelitian</h1>
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


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3"
                        action="{{ route('student.storetopic') }}" method="POST">
                        @csrf

                        <div class="card-header">
                            <h4>Pengajuan Topik Penelitian</h4>
                        </div>

                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Judul</label>
                                <div for="judul" class="col-sm-12 col-md-7">
                                    <input id="judul" type="text"
                                        class="form-control @error('judul') is-invalid @enderror" name="judul"
                                        value="{{ old('judul') }}" required autocomplete="judul" autofocus>
                                </div>
                                <div class="invalid-feedback">
                                    {{ $errors->first('judul') }}
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="sks" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jumlah
                                    SKS Lulus</label>
                                <div class="col-sm-12 col-md-7">
                                    <input id="sks" type="text"
                                        class="form-control @error('sks') is-invalid @enderror" name="sks"
                                        value="{{ old('sks') }}" required autocomplete="sks" autofocus>
                                </div>
                                <div class="invalid-feedback">
                                    {{ $errors->first('sks') }}
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="proposal"
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Proposal</label>
                                <div class="col-sm-12 col-md-7">
                                    <input id="proposal" type="file"
                                        class="form-control @error('proposal') is-invalid @enderror" name="proposal"
                                        required autocomplete="proposal" autofocus>
                                </div>
                                <div class="invalid-feedback">
                                    {{ $errors->first('proposal') }}
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="abstrak"
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Abstrak</label>
                                <div class="col-sm-12 col-md-7">
                                    <textarea class="summernote-simple" class="@error('abstrak') is-invalid @enderror" id="abstrak" name="abstrak"
                                        value="{{ old('abstrak') }}" required autocomplete="abstrak" autofocus rows="15" cols="58"></textarea>
                                    <div class="invalid-feedback">
                                        {{ $errors->first('abstrak') }}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="dosen1_id" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Dosen
                                    Pembimbing 1</label>
                                <div class="col-sm-12 col-md-7">
                                    <select class="form-control select2" name="dosen1_id"
                                        class="form-control @error('dosen1_id') is-invalid @enderror"
                                        value="{{ old('dosen1_id') }}" required autocomplete="dosen1_id" autofocus>
                                        <option>Pilih Dosen Pembimbing 1</option>
                                        @foreach ($lecture as $dosen)
                                            <option value="{{ $dosen->id }}">{{ $dosen->nama }} {{ $dosen->nama_b }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="invalid-feedback">
                                    {{ $errors->first('dosen1_id') }}
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="dosen2_id" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Dosen
                                    Pembimbing 2</label>
                                <div class="col-sm-12 col-md-7">
                                    <select class="form-control select2" name="dosen2_id"
                                        class="form-control @error('dosen2_id') is-invalid @enderror"
                                        value="{{ old('dosen2_id') }}" required autocomplete="dosen2_id" autofocus>
                                        <option>Pilih Dosen Pembimbing 2</option>
                                        @foreach ($lecture as $dosen)
                                            <option value="{{ $dosen->id }}">{{ $dosen->nama }} {{ $dosen->nama_b }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="invalid-feedback">
                                    {{ $errors->first('dosen2_id') }}
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="pkm" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">File
                                    PKM</label>
                                <div class="col-sm-12 col-md-7">
                                    <input id="pkm" type="file"
                                        class="form-control @error('pkm') is-invalid @enderror" name="pkm" required
                                        autocomplete="pkm" autofocus>
                                </div>
                                <div class="invalid-feedback">
                                    {{ $errors->first('pkm') }}
                                </div>
                            </div>


                        </div>
                        <div class="card-footer">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <input class="btn btn-primary btn-lg text-right" type="submit"
                                        value="Unggah Topik Penelitian" />
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
    <script src="{{ asset('assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/modules/summernote/summernote-bs4.js') }}"></script>
@endpush
