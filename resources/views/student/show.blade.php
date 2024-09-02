@extends('layouts.global')

@section('title', 'SITA | Bimbingan Tugas Akhir Mahasiswa')

@section('header')

    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
@endsection

@section('content')

    <section class="section">
        <div class="section-header">
            <h1>{{ $topics->judul }}</h1>
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
            <div class="col-lg-12 col-md-4 col-sm-12">
                <div class="card card-warning">
                    <div class="card-header pb-0">
                        <h4><b> Data Mahasiswa </b></h4>
                    </div>
                    <div class="card-body pb-0">
                        <div class="row">
                            <div class="form-group col-4">
                                <label>Nama Mahasiswa</label>
                                <div class="form-control">{{ $users->nama }} {{ $users->nama_b }}</div>
                            </div>
                            <div class="form-group col-4">
                                <label>Status Tugas Akhir</label>
                                <div class="form-control">{{ $topics->statuses->text_stat }}</div>
                            </div>
                            <div class="form-group col-4">
                                <label>File Proposal</label>
                                <a href="{{ asset('storage/' . $topics->proposal) }}"
                                    class="form-control text-dark badge-primary">
                                    <i class="far fa-file-pdf"></i> Lihat File Proposal
                                </a>
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group col-4">
                                <label>Nomer Induk Mahasiswa</label>
                                <div class="form-control">{{ $users->user_id }}</div>
                            </div>
                            <div class="form-group col-4">
                                <label>Surat Tugas</label>
                                @if ($topics->surat_tugas == null)
                                    <div class="form-control">Surat Tugas Sedang Diproses</div>
                                @else
                                    <a href="{{ asset('storage/' . $topics->surat_tugas) }}"
                                        class="form-control text-dark badge-primary">
                                        <i class="far fa-file-pdf "></i> Surat Tugas
                                        <a>
                                @endif
                            </div>
                            <div class="form-group col-4">
                                <label>File Proposal</label>
                                <a href="{{ asset('storage/' . $topics->proposal) }}"
                                    class="form-control text-dark badge-primary">
                                    <i class="far fa-file-pdf"></i> Lihat File Proposal
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 col-md-4 col-sm-12">
                <div class="card card-success">
                    <div class="card-header pb-0">
                        <h4><b> Progres Penelitian </b></h4>
                    </div>
                    <div class="card-body pb-0">

                        <ul class="nav nav-pills" id="myTab3" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" id="home-tab3" data-toggle="tab" href="#kemajuan1"
                                    role="tab" aria-controls="home" aria-selected="true">Kemajuan I</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#kemajuan2" role="tab"
                                    aria-controls="profile" aria-selected="false">Kemajuan II</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab3" data-toggle="tab" href="#kemajuan3" role="tab"
                                    aria-controls="contact" aria-selected="false">Kemajuan III</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab3" data-toggle="tab" href="#kemajuan4" role="tab"
                                    aria-controls="contact" aria-selected="false">Kemajuan IV </a>
                            </li>
                        </ul>

                        <div class="tab-content" id="myTabContent2">

                            <div class="tab-pane fade active show" id="kemajuan1" role="tabpanel"
                                aria-labelledby="home-tab3">

                                @if ($progres->kemajuan_I == null)
                                    @if ($topics->status_id == 25)
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-2"></label>
                                            <div for="judul" class="col-sm-12 col-md-8">
                                                <input id="judul" type="text" class="form-control"
                                                    value="Data Belum Tersedia, Silahkan Mengunggah Dokumen I" disabled>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-2"></label>
                                            <form class="col-sm-12 col-md-8" enctype="multipart/form-data"
                                                action="{{ route('student.addProgres1', [$progres->id]) }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" value="PUT" name="_method">

                                                <div class="">
                                                    <input id="kemajuan_I" name="kemajuan_I" type="file"
                                                        class="form-control">

                                                </div>
                                                <div class="modal-footer">
                                                    <input class="btn btn-info" type="submit" value="Submit" />
                                                </div>
                                            </form>
                                        </div>
                                    @else
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-2"></label>
                                            <div for="judul" class="col-sm-12 col-md-8">
                                                <input id="judul" type="text" class="form-control"
                                                    value="Data Belum Tersedia" disabled>
                                            </div>
                                        </div>
                                    @endif
                                @else
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-2">Tanggal
                                            Disetujui</label>
                                        <div for="judul" class="col-sm-12 col-md-8">
                                            <input id="judul" type="text" class="form-control"
                                                value="{{ $progres->update_I }}" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label
                                            class="col-form-label text-md-right col-12 col-md-3 col-lg-2">Dokumen</label>
                                        <div for="judul" class="col-sm-12 col-md-8">
                                            <a href="{{ asset('storage/' . $progres->kemajuan_I) }}"
                                                class="form-control text-dark badge-primary">
                                                <i class="far fa-file-pdf"></i> Lihat Dokumen Kemajuan I
                                            </a>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-2">Catatan
                                        </label>
                                        <div for="judul" class="col-sm-12 col-md-8">
                                            <textarea rows="4" class="col-12" disabled>{{ $progres->ulasan_I }}    
                                        </textarea>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="tab-pane fade" id="kemajuan2" role="tabpanel" aria-labelledby="profile-tab3">
                                @if ($progres->kemajuan_II == null)
                                    @if ($topics->status_id == 33)
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-2"></label>
                                            <div for="judul" class="col-sm-12 col-md-8">
                                                <input id="judul" type="text" class="form-control"
                                                    value="Data Belum Tersedia, Silahkan Mengunggah Dokumen II" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-2"></label>
                                            <form class="col-sm-12 col-md-8" enctype="multipart/form-data"
                                                action="{{ route('student.addProgres2', [$progres->id]) }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" value="PUT" name="_method">

                                                <div class="">
                                                    <input id="kemajuan_II" name="kemajuan_II" type="file"
                                                        class="form-control">

                                                </div>
                                                <div class="modal-footer">
                                                    <input class="btn btn-info" type="submit" value="Submit" />
                                                </div>
                                            </form>
                                        </div>
                                    @else
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-2"></label>
                                            <div for="judul" class="col-sm-12 col-md-8">
                                                <input id="judul" type="text" class="form-control"
                                                    value="Data Belum Tersedia" disabled>
                                            </div>
                                        </div>
                                    @endif
                                @else
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-2">Tanggal
                                            Disetujui</label>
                                        <div for="judul" class="col-sm-12 col-md-8">
                                            <input id="judul" type="text" class="form-control"
                                                value="{{ $progres->update_II }}" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label
                                            class="col-form-label text-md-right col-12 col-md-3 col-lg-2">Dokumen</label>
                                        <div for="judul" class="col-sm-12 col-md-8">
                                            <a href="{{ asset('storage/' . $progres->kemajuan_II) }}"
                                                class="form-control text-dark badge-primary">
                                                <i class="far fa-file-pdf"></i> Lihat Dokument Kemajuan II
                                            </a>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-2">Catatan
                                        </label>
                                        <div for="judul" class="col-sm-12 col-md-8">
                                            <textarea rows="4" class="col-12" disabled> {{ $progres->ulasan_II }}    
                                            </textarea>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="tab-pane fade" id="kemajuan3" role="tabpanel" aria-labelledby="contact-tab3">
                                @if ($progres->kemajuan_III == null)
                                    @if ($topics->status_id == 43)
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-2"></label>
                                            <div for="judul" class="col-sm-12 col-md-8">
                                                <input id="judul" type="text" class="form-control"
                                                    value="Data Belum Tersedia, Silahkan Mengunggah Dokumen III" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-2"></label>
                                            <form class="col-sm-12 col-md-8" enctype="multipart/form-data"
                                                action="{{ route('student.addProgres3', [$progres->id]) }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" value="PUT" name="_method">

                                                <div class="">
                                                    <input id="kemajuan_III" name="kemajuan_III" type="file"
                                                        class="form-control">
                                                </div>
                                                <div class="modal-footer">
                                                    <input class="btn btn-info" type="submit" value="Submit" />
                                                </div>
                                            </form>
                                        </div>
                                    @else
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-2"></label>
                                            <div for="judul" class="col-sm-12 col-md-8">
                                                <input id="judul" type="text" class="form-control"
                                                    value="Data Belum Tersedia" disabled>
                                            </div>
                                        </div>
                                    @endif
                                @else
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-2">Tanggal
                                            Disetujui</label>
                                        <div for="judul" class="col-sm-12 col-md-8">
                                            <input id="judul" type="text" class="form-control"
                                                value="{{ $progres->update_III }}" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label
                                            class="col-form-label text-md-right col-12 col-md-3 col-lg-2">Dokumen</label>
                                        <div for="judul" class="col-sm-12 col-md-8">
                                            <a href="{{ asset('storage/' . $progres->kemajuan_III) }}"
                                                class="form-control text-dark badge-primary">
                                                <i class="far fa-file-pdf"></i> Lihat Dokument Kemajuan III
                                            </a>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-2">Catatan
                                        </label>
                                        <div for="judul" class="col-sm-12 col-md-8">
                                            <textarea rows="4" class="col-12" disabled> {{ $progres->ulasan_II }}    
                                            </textarea>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="tab-pane fade" id="kemajuan4" role="tabpanel" aria-labelledby="contact-tab3">
                                @if ($progres->kemajuan_IV == null)
                                    @if ($topics->status_id == 53)
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-2"></label>
                                            <div for="judul" class="col-sm-12 col-md-8">
                                                <input id="judul" type="text" class="form-control"
                                                    value="Data Belum Tersedia, Silahkan Mengunggah Dokumen IV" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-2"></label>
                                            <form class="col-sm-12 col-md-8" enctype="multipart/form-data"
                                                action="{{ route('student.addProgres4', [$progres->id]) }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" value="PUT" name="_method">

                                                <div class="">
                                                    <input id="kemajuan_IV" name="kemajuan_IV" type="file"
                                                        class="form-control">
                                                </div>
                                                <div class="modal-footer">
                                                    <input class="btn btn-info" type="submit" value="Submit" />
                                                </div>
                                            </form>
                                        </div>
                                    @else
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-2"></label>
                                            <div for="judul" class="col-sm-12 col-md-8">
                                                <input id="judul" type="text" class="form-control"
                                                    value="Data Belum Tersedia" disabled>
                                            </div>
                                        </div>
                                    @endif
                                @else
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-2">Tanggal
                                            Disetujui</label>
                                        <div for="judul" class="col-sm-12 col-md-8">
                                            <input id="judul" type="text" class="form-control"
                                                value="{{ $progres->update_IV }}" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label
                                            class="col-form-label text-md-right col-12 col-md-3 col-lg-2">Dokumen</label>
                                        <div for="judul" class="col-sm-12 col-md-8">
                                            <a href="{{ asset('storage/' . $progres->kemajuan_IV) }}"
                                                class="form-control text-dark badge-primary">
                                                <i class="far fa-file-pdf"></i> Lihat Dokument Kemajuan IV
                                            </a>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-2">Catatan
                                        </label>
                                        <div for="judul" class="col-sm-12 col-md-8">
                                            <textarea rows="4" class="col-12" disabled>{{ $progres->ulasan_IV }}    
                                            </textarea>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 col-md-4 col-sm-12">
                <div class="card card-primary">
                    <div class="card-header pb-0">
                        <h4><b> Dosen Pembimbing </b></h4>
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
                                        value="{{ $awal[0] }} {{ $akhir[0] }}" disabled>
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
                                        value="{{ $awal[1] }} {{ $akhir[1] }}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-12 col-md-12 col-lg-6">
                <div class="card card-warning ">
                    <div class="card-header pb-0">
                        <h4><b>Informasi Kartu Bimbingan</b></h4>
                        <div class="card-header-action">
                            <a href="{{ route('student.createLogbook', [$progres->topic_id]) }}"
                                class="badge badge-info btn-edit">
                                <i class="fas fa-plus"></i> Tambah Data
                            </a>
                            <a href="{{ route('student.createLogbook', [$progres->topic_id]) }}"
                                class="badge badge-info btn-edit">
                                <i class="fas fa-print"></i> Print Kartu
                            </a>
                        </div>
                    </div>
                    <div class="card-body pb-0 mb-4">
                        <table class="table table-striped dataTable no-footer" id="table-1" role="grid"
                            aria-describedby="table-1_info">
                            <thead>
                                <tr>
                                    <th><b>Jam</b></th>
                                    <th><b>Tempat</b></th>
                                    <th><b>Keterangan</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($logbook as $kartu)
                                    <tr>
                                        <td> {{ Carbon\Carbon::parse($kartu->waktu)->translatedFormat('l, H M Y') }}
                                        </td>
                                        <td> {{ $kartu->ruangan }}</td>
                                        <td> {{ $kartu->catatan }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>
                                            Data belum Tersedia, Silahkan Lakukan Bimbingan dengan Dosen !
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-12 col-lg-6">
                <div class="card card-warning ">
                    <div class="card-header pb-0">
                        <h4><b>Informasi Seminar</b></h4>
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
                                    @if ($topics->status_id == 12 || $topics->status_id == 200)
                                        <div class="label mt-2">Tautan Pengajuan :</div>
                                        <div class="form-control mt-1 mb-3">
                                            <a href="{{ route('student.createSempro', [$topics->id]) }}">
                                                Ajukan Seminar Proposal
                                            </a>
                                        </div>
                                    @else
                                        <input id="judul" type="text" class="form-control mb-3"
                                            value="Belum dapat mengajukan Seminar Proposal" disabled>
                                    @endif
                                @else
                                    <div class="label mt-2">Nama Moderator :</div>
                                    <div class="form-control mt-1 mb-2">
                                        {{ $sempro->nama_moderator }}
                                    </div>
                                    <div class="label mt-2">Waktu Pelaksanaan :</div>
                                    <div class="form-control mt-1 mb-2">
                                        {{ Carbon\Carbon::parse($sempro->waktu)->format('H:i') }} WIB
                                    </div>
                                    <div class="label mt-2">Tanggal :</div>
                                    <div class="form-control mt-1 mb-3">
                                        {{ Carbon\Carbon::parse($sempro->waktu)->translatedFormat('l , H M Y') }}
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
                            </div>

                            <div class="tab-pane fade" id="semhas" role="tabpanel" aria-labelledby="contact-tab3">
                                @if ($semhas == null)
                                    @if ($topics->status_id == 70 || $topics->status_id == 700)
                                        <div class="label mt-2">Tautan Pengajuan :</div>
                                        <div class="form-control mt-1 mb-3">
                                            <a href="{{ route('student.createSemhas', [$topics->id]) }}">
                                                Ajukan Seminar Hasil
                                            </a>
                                        </div>
                                    @else
                                        <input id="judul" type="text" class="form-control mb-3"
                                            value="Belum dapat mengajukan Seminar Hasil" disabled>
                                    @endif
                                @else
                                    <div class="label mt-2">Nama Moderator :</div>
                                    <div class="form-control mt-1 mb-2">
                                        {{ $semhas->nama_moderator }}
                                    </div>
                                    <div class="label mt-2">Waktu Pelaksanaan :</div>
                                    <div class="form-control mt-1 mb-2">
                                        {{ Carbon\Carbon::parse($semhas->waktu)->format('H:i') }} WIB
                                    </div>
                                    <div class="label mt-2">Tanggal :</div>
                                    <div class="form-control mt-1 mb-3">
                                        {{ Carbon\Carbon::parse($semhas->waktu)->translatedFormat('l , H M Y') }}
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
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection

@push('page-scripts')
    <script src="{{ asset('assets/modules/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>


    <script src="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
@endpush

@push('after-scripts')
    <script>
        $(document).ready(function() {
            $('#table-1').DataTable({
                pageLength: 5,
                lengthMenu: [
                    [5, 10, 20, -1],
                    [5, 10, 20, 'All']
                ]
            });
        });

        directive('elastic', [
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
