@extends('layouts.global')

@section('title', 'SITA | Detail Bimbingan')


@section('header')

    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">

@endsection

@section('navbar.lecture')
    @if ($lecture->previllege != 'DOSEN')
        <li class="menu-header">Kaprodi</li>
        <li class="nav-item" class="">
            <a href="" class="nav-link has-dropdown"><i class="fas fa-university"></i><span>Tugas Akhir</span></a>
            <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('lecture.indexKaprodi') }}">Topik Penelitian</a></li>
            </ul>
        </li>
    @endif

@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ $topic->judul }}</h1>
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
                    <div class="card card-primary profile-widget">
                        <div class="profile-widget-header">
                            @if ($student->avatar)
                                <img src="{{ asset('storage/' . $student->avatar) }}"
                                    class="rounded-circle profile-widget-picture" />
                            @else
                                <img src="{{ asset('storage/avatars/avatar-1.png') }}"
                                    class="rounded-circle profile-widget-picture">
                            @endif
                            <div class="profile-widget-items">
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-value">{{ $user->nama }} {{ $user->nama_b }}</div>
                                    <div class="profile-widget-item-label">{{ $user->id }}</div>
                                </div>
                            </div>
                            <div class="text-center">{{ $user->email }}</div>
                        </div>
                        <div class="profile-widget-description">
                            <div class="label">Stastus Tugas Akhir :</div>
                            @if ($topic->status_id == '999' || $topic->status_id == '120')
                                <span class="badge badge-danger">
                                    {{ $topic->statuses->text_stat }}
                                </span>
                            @else
                                <span class="badge badge-success">
                                    {{ $topic->statuses->text_stat }}
                                </span>
                            @endif
                            <div class="label">Jumlah SKS Lulus :</div>
                            <div class="form-control">{{ $topic->sks }}</div>
                            <div class="label">Program Studi :</div>
                            <div class="form-control">{{ $student->program->nama }}</div>
                            <div class="label">Jurusan :</div>
                            <div class="form-control">{{ $student->jurusan }}</div>
                            <div class="label">No. Handphone :</div>
                            <div class="form-control">{{ $user->no_HP }}</div>
                            <div class="label">Alamat :</div>
                            <textarea rows="3" class="col-12" disabled>{{ $student->alamat }}</textarea>
                        </div>
                    </div>

                    <div class="card card-success">

                        <div class="card-header pb-0">
                            <h4><b>Informasi Seminar Tugas Akhir Mahasiswa</b></h4>
                        </div>
                        <div class="card-body pb-0">
                            <ul class="nav nav-pills" id="myTab3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" id="home-tab3" data-toggle="tab" href="#sempro"
                                        role="tab" aria-controls="home" aria-selected="true">Sempro</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#semhas" role="tab"
                                        aria-controls="profile" aria-selected="false">Semhas</a>
                                </li>
                            </ul>

                            <div class="tab-content" id="myTabContent2">
                                <div class="tab-pane fade active show" id="sempro" role="tabpanel">

                                    @if ($sempro == null)
                                        <div for="judul" class="col-sm-12 col-md-12">
                                            <input id="judul" type="text" class="form-control mt-1 mb-3"
                                                value="Mahasiswa belum mengajukan Seminar Hasil" disabled>
                                        </div>
                                    @elseif (Auth::user()->id == $topic->dosen1_id)
                                        @if ($topic->status_id == 20 || $topic->status_id == 22)
                                            <div class="label mt-2">Nama Moderator :</div>
                                            <div class="form-control mt-1 mb-2">
                                                {{ $sempro->nama_moderator }}
                                            </div>
                                            <div class="label mt-2">Waktu Seminar :</div>
                                            <div class="form-control mt-1 mb-2">
                                                {{ Carbon\Carbon::parse($sempro->waktu)->format('H:i') }} WIB
                                            </div>
                                            <div class="label mt-2">Tanggal Seminar :</div>
                                            <div class="form-control mt-1 mb-3">
                                                {{ Carbon\Carbon::parse($sempro->waktu)->translatedFormat('l, H M Y') }}
                                            </div>
                                            <div class="label mt-2">Tempat Seminar :</div>
                                            <div class="form-control mt-1 mb-3">
                                                @if ($sempro->ruangan == null)
                                                    Menunggu Persetujuan Akademik
                                                @else
                                                    {{ $sempro->ruangan }}
                                                @endif
                                            </div>

                                            <form action="{{ route('lecture.verifSempro', [$sempro->topic_id]) }}"
                                                method="POST">
                                                <input type="hidden" name="_method" value="PUT">
                                                @csrf

                                                <div class="modal-footer">
                                                    <input class="btn btn-info" type="submit"
                                                        value="Menyetujui Sempro" />
                                                </div>
                                            </form>
                                        @else
                                            <div class="label mt-2">Nama Moderator :</div>
                                            <div class="form-control mt-1 mb-2">
                                                {{ $sempro->nama_moderator }}
                                            </div>
                                            <div class="label mt-2">Waktu Seminar :</div>
                                            <div class="form-control mt-1 mb-2">
                                                {{ Carbon\Carbon::parse($sempro->waktu)->format('H:i') }} WIB
                                            </div>
                                            <div class="label mt-2">Tanggal Seminar :</div>
                                            <div class="form-control mt-1 mb-3">
                                                {{ Carbon\Carbon::parse($sempro->waktu)->translatedFormat('l, H M Y') }}
                                            </div>
                                            <div class="label mt-2">Tempat Seminar :</div>
                                            <div class="form-control mt-1 mb-3">
                                                @if ($sempro->ruangan == null)
                                                    Menunggu Persetujuan Akademik
                                                @else
                                                    {{ $sempro->ruangan }}
                                                @endif
                                            </div>
                                        @endif
                                    @else
                                        @if ($topic->status_id == 20 || $topic->status_id == 21)
                                            <div class="label mt-2">Nama Moderator :</div>
                                            <div class="form-control mt-1 mb-2">
                                                {{ $sempro->nama_moderator }}
                                            </div>
                                            <div class="label mt-2">Waktu Seminar :</div>
                                            <div class="form-control mt-1 mb-2">
                                                {{ Carbon\Carbon::parse($sempro->waktu)->format('H:i') }} WIB
                                            </div>
                                            <div class="label mt-2">Tanggal Seminar:</div>
                                            <div class="form-control mt-1 mb-3">
                                                {{ Carbon\Carbon::parse($sempro->waktu)->translatedFormat('l, H M Y') }}
                                            </div>
                                            <div class="label mt-2">Tempat Seminar :</div>
                                            <div class="form-control mt-1 mb-3">
                                                @if ($sempro->ruangan == null)
                                                    Menunggu Persetujuan Akademik
                                                @else
                                                    {{ $sempro->ruangan }}
                                                @endif
                                            </div>

                                            <form action="{{ route('lecture.verifSempro', [$semhas->topic_id]) }}"
                                                method="POST">
                                                <input type="hidden" name="_method" value="PUT">
                                                @csrf

                                                <div class="modal-footer">
                                                    <input class="btn btn-info" type="submit"
                                                        value="Menyetujui Sempro" />
                                                </div>
                                            </form>
                                        @else
                                            <div class="label mt-2">Nama Moderator :</div>
                                            <div class="form-control mt-1 mb-2">
                                                {{ $sempro->nama_moderator }}
                                            </div>
                                            <div class="label mt-2">Waktu Seminar :</div>
                                            <div class="form-control mt-1 mb-2">
                                                {{ Carbon\Carbon::parse($sempro->waktu)->format('H:i') }} WIB
                                            </div>
                                            <div class="label mt-2">Tanggal :</div>
                                            <div class="form-control mt-1 mb-3">
                                                {{ Carbon\Carbon::parse($sempro->waktu)->translatedFormat('l, H M Y') }}
                                            </div>
                                            <div class="label mt-2">Tempat Seminar :</div>
                                            <div class="form-control mt-1 mb-3">
                                                @if ($sempro->ruangan == null)
                                                    Menunggu Persetujuan Akademik
                                                @else
                                                    {{ $sempro->ruangan }}
                                                @endif
                                            </div>
                                        @endif
                                    @endif
                                </div>

                                <div class="tab-pane fade" id="semhas" role="tabpanel"
                                    aria-labelledby="contact-tab3">
                                    @if ($semhas == null)
                                        <div for="judul" class="col-sm-12 col-md-12">
                                            <input id="judul" type="text" class="form-control mt-1 mb-3"
                                                value="Mahasiswa belum mengajukan Seminar Hasil" disabled>
                                        </div>
                                    @elseif (Auth::user()->id == $topic->dosen1_id)
                                        @if ($topic->status_id == 70 || $topic->status_id == 72)
                                            <div class="label mt-2">Nama Moderator :</div>
                                            <div class="form-control mt-1 mb-2">
                                                {{ $semhas->nama_moderator }}
                                            </div>
                                            <div class="label mt-2">Waktu Seminar :</div>
                                            <div class="form-control mt-1 mb-2">
                                                {{ Carbon\Carbon::parse($semhas->waktu)->format('H:i') }} WIB
                                            </div>
                                            <div class="label mt-2">Tanggal Seminar :</div>
                                            <div class="form-control mt-1 mb-3">
                                                {{ Carbon\Carbon::parse($semhas->waktu)->translatedFormat('l, H M Y') }}
                                            </div>
                                            <div class="label mt-2">Tempat Seminar :</div>
                                            <div class="form-control mt-1 mb-3">
                                                @if ($semhas->ruangan == null)
                                                    Menunggu Persetujuan Akademik
                                                @else
                                                    {{ $semhas->ruangan }}
                                                @endif
                                            </div>

                                            <form action="{{ route('lecture.verifSempro', [$semhas->topic_id]) }}"
                                                method="POST">
                                                <input type="hidden" name="_method" value="PUT">
                                                @csrf

                                                <div class="modal-footer">
                                                    <input class="btn btn-info" type="submit"
                                                        value="Menyetujui Semhas" />
                                                </div>
                                            </form>
                                        @else
                                            <div class="label mt-2">Nama Moderator :</div>
                                            <div class="form-control mt-1 mb-2">
                                                {{ $semhas->nama_moderator }}
                                            </div>
                                            <div class="label mt-2">Waktu Seminar :</div>
                                            <div class="form-control mt-1 mb-2">
                                                {{ Carbon\Carbon::parse($semhas->waktu)->format('H:i') }} WIB
                                            </div>
                                            <div class="label mt-2">Tanggal Seminar :</div>
                                            <div class="form-control mt-1 mb-3">
                                                {{ Carbon\Carbon::parse($semhas->waktu)->translatedFormat('l, H M Y') }}
                                            </div>
                                            <div class="label mt-2">Tempat Seminar :</div>
                                            <div class="form-control mt-1 mb-3">
                                                @if ($semhas->ruangan == null)
                                                    Menunggu Persetujuan Akademik
                                                @else
                                                    {{ $semhas->ruangan }}
                                                @endif
                                            </div>
                                        @endif
                                    @else
                                        @if ($topic->status_id == 20 || $topic->status_id == 21)
                                            <div class="label mt-2">Nama Moderator :</div>
                                            <div class="form-control mt-1 mb-2">
                                                {{ $semhas->nama_moderator }}
                                            </div>
                                            <div class="label mt-2">Waktu Seminar :</div>
                                            <div class="form-control mt-1 mb-2">
                                                {{ Carbon\Carbon::parse($semhas->waktu)->format('H:i') }} WIB
                                            </div>
                                            <div class="label mt-2">Tanggal Seminar:</div>
                                            <div class="form-control mt-1 mb-3">
                                                {{ Carbon\Carbon::parse($semhas->waktu)->translatedFormat('l, H M Y') }}
                                            </div>
                                            <div class="label mt-2">Tempat Seminar :</div>
                                            <div class="form-control mt-1 mb-3">
                                                @if ($semhas->ruangan == null)
                                                    Menunggu Persetujuan Akademik
                                                @else
                                                    {{ $semhas->ruangan }}
                                                @endif
                                            </div>

                                            <form action="{{ route('lecture.verifSempro', [$semhas->topic_id]) }}"
                                                method="POST">
                                                <input type="hidden" name="_method" value="PUT">
                                                @csrf

                                                <div class="modal-footer">
                                                    <input class="btn btn-info" type="submit"
                                                        value="Menyetujui Semhas" />
                                                </div>
                                            </form>
                                        @else
                                            <div class="label mt-2">Nama Moderator :</div>
                                            <div class="form-control mt-1 mb-2">
                                                {{ $semhas->nama_moderator }}
                                            </div>
                                            <div class="label mt-2">Waktu Seminar :</div>
                                            <div class="form-control mt-1 mb-2">
                                                {{ Carbon\Carbon::parse($semhas->waktu)->format('H:i') }} WIB
                                            </div>
                                            <div class="label mt-2">Tanggal :</div>
                                            <div class="form-control mt-1 mb-3">
                                                {{ Carbon\Carbon::parse($semhas->waktu)->translatedFormat('l, H M Y') }}
                                            </div>
                                            <div class="label mt-2">Tempat Seminar :</div>
                                            <div class="form-control mt-1 mb-3">
                                                @if ($semhas->ruangan == null)
                                                    Menunggu Persetujuan Akademik
                                                @else
                                                    {{ $semhas->ruangan }}
                                                @endif
                                            </div>
                                        @endif
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 col-md-4 col-sm-12">
                    <div class="card card-primary">
                        <div class="card-header pb-0">
                            <h4><b>Dosen Pembimbing </b></h4>
                        </div>
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="form-group col-12">
                                    <label>Dosen Pembimbing 1</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-phone"> </i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control"
                                            value="{{ $namadosen_awal[0] }} {{ $namadosen_akhir[0] }}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <label>Dosen Pembimbing 2</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-phone"> </i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control"
                                            value="{{ $namadosen_awal[1] }} {{ $namadosen_akhir[1] }}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card card-success">
                        <div class="card-header pb-0">
                            <h4><b> Dokumen Penelitian </b></h4>
                        </div>
                        <div class="card-body pb-0">

                            <ul class="nav nav-pills" id="myTab3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" id="home-tab3" data-toggle="tab" href="#abs"
                                        role="tab" aria-controls="home" aria-selected="true">Abstrak</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#pro"
                                        role="tab" aria-controls="profile" aria-selected="false">Proposal</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#st"
                                        role="tab" aria-controls="profile" aria-selected="false">Surat Tugas</a>
                                </li>
                            </ul>

                            <div class="tab-content" id="myTabContent2">
                                <div class="tab-pane fade active show" id="abs" role="tabpanel"
                                    aria-labelledby="home-tab3">
                                    <div class="form-group row mb-4">
                                        <div for="judul" class="col-sm-12 col-md-12">
                                            <textarea rows="8" class="col-12" disabled>{{ $topic->abstrak }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="pro" role="tabpanel"
                                    aria-labelledby="profile-tab3">
                                    <div class="form-group row mb-4">
                                        <label
                                            class="col-form-label text-md-right col-12 col-md-3 col-lg-2">Dokumen</label>
                                        <div for="judul" class="col-sm-12 col-md-8">
                                            <a href="{{ asset('storage/' . $topic->proposal) }}"
                                                class="form-control text-dark badge-primary">
                                                <i class="far fa-file-pdf"></i> Lihat Dokumen Proposal
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="st" role="tabpanel" aria-labelledby="home-tab3">
                                    <div class="form-group row mb-4">
                                        @if ($topic->surat_tugas == null)
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-2"></label>
                                            <div for="judul" class="col-sm-12 col-md-8">
                                                <input id="judul" type="text" class="form-control"
                                                    value="Surat Tugas Dalam Proses Jurusan" disabled>
                                            </div>
                                        @else
                                            <label
                                                class="col-form-label text-md-right col-12 col-md-3 col-lg-2">Dokumen</label>
                                            <div for="judul" class="col-sm-12 col-md-8">
                                                <a href="{{ asset('storage/' . $topic->proposal) }}"
                                                    class="form-control text-dark badge-primary">
                                                    <i class="far fa-file-pdf"></i> Lihat Dokumen Proposal
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>



                    <div class="card card-success">
                        <div class="card-header pb-0">
                            <h4><b> Dokumen Kemajuan Tugas Akhir </b></h4>
                        </div>
                        <div class="card-body pb-0">
                            <ul class="nav nav-pills" id="myTab3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" id="home-tab3" data-toggle="tab" href="#kemajuan1"
                                        role="tab" aria-controls="home" aria-selected="true">Kemajuan I</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#kemajuan2"
                                        role="tab" aria-controls="profile" aria-selected="false">Kemajuan II</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab3" data-toggle="tab" href="#kemajuan3"
                                        role="tab" aria-controls="contact" aria-selected="false">Kemajuan III</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab3" data-toggle="tab" href="#kemajuan4"
                                        role="tab" aria-controls="contact" aria-selected="false">Kemajuan IV </a>
                                </li>

                            </ul>

                            <div class="tab-content" id="myTabContent2">
                                <div class="tab-pane fade active show" id="kemajuan1" role="tabpanel"
                                    aria-labelledby="home-tab3">

                                    {{-- Doc 1 --}}
                                    @if ($progres->kemajuan_I == null)
                                        <label for="dok1" class="mt-1">Dokumen Kemajuan I :</label>
                                        <input id="judul" type="text" class="form-control"
                                            value="Mahasiswa Belum Mengunggah Dokumen I" disabled>
                                    @elseif (Auth::user()->id == $topic->dosen1_id)
                                        @if ($topic->status_id == 30 || $topic->status_id == 32)
                                            <label for="dok1" class="mt-1">Dokumen Kemajuan I :</label>
                                            <a href="{{ asset('storage/' . $progres->kemajuan_I) }}"
                                                class="form-control text-dark badge-primary">
                                                <i class="far fa-file-pdf"></i> Lihat Dokumen Kemajuan I
                                            </a>
                                            <form action="{{ route('lecture.aprov1', [$progres->topic_id]) }}"
                                                method="POST">
                                                <input type="hidden" name="_method" value="PUT">
                                                @csrf
                                                <label for="update_I" class="mt-1">Tanggal Disetujui :</label>
                                                <input type="text" id="update_I" name="update_I"
                                                    class="form-control datepicker" placeholder="yyyy-mm-dd">

                                                <label for="ulasan_I" class="mt-1">Catatan Dokumen I :</label>
                                                <textarea rows="3" id="ulasana_I" name="ulasan_I"
                                                    placeholder="Pembimbing I dapat menuliskan catatan pada kemajuan I mahasiswa" class="col-12"></textarea>

                                                <div class="modal-footer">
                                                    <input class="btn btn-info" type="submit" value="Submit" />
                                                </div>
                                            </form>
                                        @else
                                            <label for="dok1" class="mt-1">Dokumen Kemajuan I :</label>
                                            <a href="{{ asset('storage/' . $progres->kemajuan_I) }}"
                                                class="form-control text-dark badge-primary">
                                                <i class="far fa-file-pdf"></i> Lihat Dokumen Kemajuan I
                                            </a>
                                            <label for="dok1" class="mt-1">Tanggal Disetujui :</label>
                                            <div class="form-control">
                                                {{ $progres->update_I }}
                                            </div>

                                            <label for="dok1" class="mt-1">Catatan Dokumen I :</label>
                                            <textarea rows="3" class="col-12" disabled>{{ $progres->ulasan_I }}</textarea>
                                        @endif
                                    @else
                                        @if ($topic->status_id == 30 || $topic->status_id == 31)
                                            <label for="dok1" class="mt-1">Dokumen Kemajuan I :</label>
                                            <a href="{{ asset('storage/' . $progres->kemajuan_I) }}"
                                                class="form-control text-dark badge-primary">
                                                <i class="far fa-file-pdf"></i> Lihat Dokumen Kemajuan I
                                            </a>
                                            <form action="{{ route('lecture.aprov1', [$progres->topic_id]) }}"
                                                method="POST">
                                                <input type="hidden" name="_method" value="PUT">
                                                @csrf
                                                <div class="modal-footer">
                                                    <input class="btn btn-info" type="submit" value="Submit" />
                                                </div>
                                            </form>
                                        @else
                                            <label for="dok1" class="mt-1">Dokumen Kemajuan I :</label>
                                            <a href="{{ asset('storage/' . $progres->kemajuan_I) }}"
                                                class="form-control text-dark badge-primary">
                                                <i class="far fa-file-pdf"></i> Lihat Dokumen Kemajuan I
                                            </a>
                                            <label for="dok1" class="mt-1">Tanggal Disetujui :</label>
                                            <div class="form-control">
                                                {{ $progres->update_I }}
                                            </div>

                                            <label for="dok1" class="mt-1">Catatan Dokumen I :</label>
                                            <textarea rows="3" class="col-12" disabled>{{ $progres->ulasan_I }}</textarea>
                                        @endif
                                    @endif

                                </div>

                                <div class="tab-pane fade" id="kemajuan2" role="tabpanel"
                                    aria-labelledby="profile-tab3">

                                    {{-- Doc 2 --}}
                                    @if ($progres->kemajuan_II == null)
                                        <label for="dok1" class="mt-1">Dokumen Kemajuan II :</label>
                                        <input id="judul" type="text" class="form-control"
                                            value="Mahasiswa Belum Mengunggah Dokumen II" disabled>
                                    @elseif (Auth::user()->id == $topic->dosen1_id)
                                        @if ($topic->status_id == 30 || $topic->status_id == 42)
                                            <label for="dok1" class="mt-1">Dokumen Kemajuan II :</label>
                                            <a href="{{ asset('storage/' . $progres->kemajuan_II) }}"
                                                class="form-control text-dark badge-primary">
                                                <i class="far fa-file-pdf"></i> Lihat Dokumen Kemajuan II
                                            </a>
                                            <form action="{{ route('lecture.aprov2', [$progres->topic_id]) }}"
                                                method="POST">
                                                <input type="hidden" name="_method" value="PUT">
                                                @csrf
                                                <label for="update_I" class="mt-1">Tanggal Disetujui :</label>
                                                <input type="text" id="update_II" name="update_II"
                                                    class="form-control datepicker">

                                                <label for="ulasan_I" class="mt-1">Catatan Dokumen II :</label>
                                                <textarea rows="3" id="ulasana_II" name="ulasan_II"
                                                    placeholder="Pembimbing I dapat menuliskan catatan pada kemajuan II mahasiswa" class="col-12"></textarea>

                                                <div class="modal-footer">
                                                    <input class="btn btn-info" type="submit" value="Submit" />
                                                </div>
                                            </form>
                                        @else
                                            <label for="dok1" class="mt-1">Dokumen Kemajuan II :</label>
                                            <a href="{{ asset('storage/' . $progres->kemajuan_II) }}"
                                                class="form-control text-dark badge-primary">
                                                <i class="far fa-file-pdf"></i> Lihat Dokumen Kemajuan II
                                            </a>
                                            <label for="dok1" class="mt-1">Tanggal Disetujui :</label>
                                            <div class="form-control">
                                                {{ $progres->update_II }}
                                            </div>

                                            <label for="dok1" class="mt-1">Catatan Dokumen II :</label>
                                            <textarea rows="3" class="col-12" disabled>{{ $progres->ulasan_II }}</textarea>
                                        @endif
                                    @else
                                        @if ($topic->status_id == 40 || $topic->status_id == 41)
                                            <label for="dok1" class="mt-1">Dokumen Kemajuan II :</label>
                                            <a href="{{ asset('storage/' . $progres->kemajuan_II) }}"
                                                class="form-control text-dark badge-primary">
                                                <i class="far fa-file-pdf"></i> Lihat Dokumen Kemajuan II
                                            </a>
                                            <form action="{{ route('lecture.aprov2', [$progres->topic_id]) }}"
                                                method="POST">
                                                <input type="hidden" name="_method" value="PUT">
                                                @csrf

                                                <div class="modal-footer">
                                                    <input class="btn btn-info" type="submit" value="Submit" />
                                                </div>
                                            </form>
                                        @else
                                            <label for="dok1" class="mt-1">Dokumen Kemajuan II :</label>
                                            <a href="{{ asset('storage/' . $progres->kemajuan_II) }}"
                                                class="form-control text-dark badge-primary">
                                                <i class="far fa-file-pdf"></i> Lihat Dokumen Kemajuan II
                                            </a>
                                            <label for="dok1" class="mt-1">Tanggal Disetujui :</label>
                                            <div class="form-control">
                                                {{ $progres->update_II }}
                                            </div>

                                            <label for="dok1" class="mt-1">Catatan Dokumen II :</label>
                                            <textarea rows="3" class="col-12" disabled>{{ $progres->ulasan_II }}</textarea>
                                        @endif
                                    @endif

                                </div>

                                <div class="tab-pane fade" id="kemajuan3" role="tabpanel"
                                    aria-labelledby="contact-tab3">

                                    {{-- Doc 3 --}}
                                    @if ($progres->kemajuan_III == null)
                                        <label for="dok1" class="mt-1">Dokumen Kemajuan III :</label>
                                        <input id="judul" type="text" class="form-control"
                                            value="Mahasiswa Belum Mengunggah Dokumen II" disabled>
                                    @elseif (Auth::user()->id == $topic->dosen1_id)
                                        @if ($topic->status_id == 50 || $topic->status_id == 52)
                                            <label for="dok1" class="mt-1">Dokumen Kemajuan III :</label>
                                            <a href="{{ asset('storage/' . $progres->kemajuan_III) }}"
                                                class="form-control text-dark badge-primary">
                                                <i class="far fa-file-pdf"></i> Lihat Dokumen Kemajuan III
                                            </a>
                                            <form action="{{ route('lecture.aprov3', [$progres->topic_id]) }}"
                                                method="POST">
                                                <input type="hidden" name="_method" value="PUT">
                                                @csrf
                                                <label for="update_III" class="mt-1">Tanggal Disetujui :</label>
                                                <input type="text" id="update_III" name="update_III"
                                                    class="form-control datepicker" placeholder="yyyy-mm-dd">

                                                <label for="ulasan_I" class="mt-1">Catatan Dokumen III :</label>
                                                <textarea rows="3" id="ulasana_III" name="ulasan_III"
                                                    placeholder="Pembimbing I dapat menuliskan catatan pada kemajuan III mahasiswa" class="col-12"></textarea>

                                                <div class="modal-footer">
                                                    <input class="btn btn-info" type="submit" value="Submit" />
                                                </div>
                                            </form>
                                        @else
                                            <label for="dok1" class="mt-1">Dokumen Kemajuan III :</label>
                                            <a href="{{ asset('storage/' . $progres->kemajuan_III) }}"
                                                class="form-control text-dark badge-primary">
                                                <i class="far fa-file-pdf"></i> Lihat Dokumen Kemajuan III
                                            </a>
                                            <label for="dok1" class="mt-1">Tanggal Disetujui :</label>
                                            <div class="form-control">
                                                {{ $progres->update_III }}
                                            </div>

                                            <label for="dok1" class="mt-1">Catatan Dokumen III :</label>
                                            <textarea rows="3" class="col-12" disabled>{{ $progres->ulasan_III }}</textarea>
                                        @endif
                                    @else
                                        @if ($topic->status_id == 50 || $topic->status_id == 51)
                                            <label for="dok1" class="mt-1">Dokumen Kemajuan III :</label>
                                            <a href="{{ asset('storage/' . $progres->kemajuan_III) }}"
                                                class="form-control text-dark badge-primary">
                                                <i class="far fa-file-pdf"></i> Lihat Dokumen Kemajuan III
                                            </a>
                                            <form action="{{ route('lecture.aprov3', [$progres->topic_id]) }}"
                                                method="POST">
                                                <input type="hidden" name="_method" value="PUT">
                                                @csrf

                                                <div class="modal-footer">
                                                    <input class="btn btn-info" type="submit" value="Submit" />
                                                </div>
                                            </form>
                                        @else
                                            <label for="dok1" class="mt-1">Dokumen Kemajuan III :</label>
                                            <a href="{{ asset('storage/' . $progres->kemajuan_III) }}"
                                                class="form-control text-dark badge-primary">
                                                <i class="far fa-file-pdf"></i> Lihat Dokumen Kemajuan III
                                            </a>
                                            <label for="dok1" class="mt-1">Tanggal Disetujui :</label>
                                            <div class="form-control">
                                                {{ $progres->update_III }}
                                            </div>

                                            <label for="dok1" class="mt-1">Catatan Dokumen III :</label>
                                            <textarea rows="3" class="col-12" disabled>{{ $progres->ulasan_III }}</textarea>
                                        @endif
                                    @endif
                                </div>

                                <div class="tab-pane fade" id="kemajuan4" role="tabpanel"
                                    aria-labelledby="contact-tab3">

                                    {{-- Doc 4 --}}
                                    @if ($progres->kemajuan_IV == null)
                                        <label for="dok1" class="mt-1">Dokumen Kemajuan IV :</label>
                                        <input id="judul" type="text" class="form-control"
                                            value="Mahasiswa Belum Mengunggah Dokumen IV" disabled>
                                    @elseif ($topic->status_id == 60)
                                        <label for="dok1" class="mt-1">Dokumen Kemajuan IV :</label>
                                        <a href="{{ asset('storage/' . $progres->kemajuan_IV) }}"
                                            class="form-control text-dark badge-primary">
                                            <i class="far fa-file-pdf"></i> Lihat Dokumen Kemajuan IV
                                        </a>
                                        <form action="{{ route('lecture.aprov4', [$progres->topic_id]) }}"
                                            method="POST">
                                            <input type="hidden" name="_method" value="PUT">
                                            @csrf
                                            <label for="update_I" class="mt-1">Tanggal Disetujui :</label>
                                            <input type="text" id="update_IV" name="update_IV"
                                                class="form-control datepicker" placeholder="yyyy-mm-dd">

                                            <label for="ulasan_IV" class="mt-1">Catatan Dokumen IV :</label>
                                            <textarea rows="3" id="ulasana_IV" name="ulasan_IV"
                                                placeholder="Pembimbing I dapat menuliskan catatan pada kemajuan IV mahasiswa" class="col-12"></textarea>

                                            <div class="modal-footer">
                                                <input class="btn btn-info" type="submit" value="Submit" />
                                            </div>
                                        </form>
                                    @else
                                        <label for="dok1" class="mt-1">Dokumen Kemajuan IV :</label>
                                        <a href="{{ asset('storage/' . $progres->kemajuan_IV) }}"
                                            class="form-control text-dark badge-primary">
                                            <i class="far fa-file-pdf"></i> Lihat Dokumen Kemajuan IV
                                        </a>
                                        <label for="dok1" class="mt-1">Tanggal Disetujui :</label>
                                        <div class="form-control">
                                            {{ $progres->update_IV }}
                                        </div>

                                        <label for="dok1" class="mt-1">Catatan Dokumen IV :</label>
                                        <textarea rows="3" class="col-12" disabled>{{ $progres->ulasan_IV }}</textarea>
                                    @endif

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card card-warning ">
                        <div class="card-header pb-0">
                            <h4><b> Kartu Bimbingan Mahasiswa </b></h4>
                        </div>
                        <div class="card-body pb-0 mb-4">
                            <table class="table table-striped dataTable no-footer " id="table-1" role="grid"
                                aria-describedby="table-1_info">
                                <thead>
                                    <tr>
                                        <th><b>Jam</b></th>
                                        <th><b>Tempat</b></th>
                                        <th><b>Keterangan</b></th>
                                        <th><b>Status</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($logbook as $kartu)
                                        <tr>
                                            <td> {{ Carbon\Carbon::parse($kartu->waktu)->translatedFormat('l, H M Y') }}
                                            </td>
                                            <td> {{ $kartu->ruangan }}</td>
                                            <td> {{ $kartu->catatan }}</td>
                                            <td>
                                                @if ($kartu->status_lb == 'PENDING')
                                                    <form method="POST"
                                                        action="{{ route('lecture.aproveLogbook', [$kartu->id]) }}"
                                                        class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-info btn-sm"> <i
                                                                class="fas fa-check"></i></button>
                                                    </form>

                                                    <form method="POST"
                                                        action="{{ route('lecture.destroyLogbook', [$kartu->id]) }}"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger btn-sm"> <i
                                                                class="fas fa-trash"></i></button>
                                                    </form>
                                                @else
                                                    <span class="badge badge-success">
                                                        Disetujui
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>
                                                Data belum Tersedia, Mahasiswa belum melakukan pengisian kartu kendali !
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('page-scripts')
    <script src="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
@endpush

@push('after-scripts')
    <script>
        //script untuk text area
        .directive('elastic', [
            '$timeout',
            function($timeout) {
                return {
                    restrict: 'A',
                    link: function($scope, element) {
                        $scope.initialHeight = $scope.initialHeight || element[0].style.height;
                        var resize = function() {
                            element[0].style.height = $scope.initialHeight;
                            element[0].style.height = "" + element[0].scrollHeight + "px";
                        };
                        element.on("input change", resize);
                        $timeout(resize, 0);
                    }
                };
            }
        ]);
    </script>
@endpush
