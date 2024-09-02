@extends('layouts.global')

@section('title', 'SITA | Detail Topik Penelitian')

@section('header')

    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.min.css') }}">

@endsection

@section('navbar.lecture')
    @if (Auth::check() && Auth::user()->roles_id == 4)
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
            <h1>Detail Topik Penelitian Mahasiswa</h1>
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
                    @if (Auth::check() && Auth::user()->roles_id == 2)
                        @if ($topic->surat_tugas == null)
                            <form enctype="multipart/form-data" class="card card-primary bg-white shadow-sm p-3"
                                action="{{ route('departement.uploadSurat', [$topic->id]) }}" method="POST">
                                @csrf
                                <input type="hidden" value="PUT" name="_method">

                                <label for="pkm" class="label ">Upload Surat Tugas</label>
                                <div class="">
                                    <input id="pkm" type="file"
                                        class="form-control @error('surat_tugas') is-invalid @enderror" name="surat_tugas"
                                        required autocomplete="surat_tugas" autofocus>
                                    <div class="invalid-feedback">
                                        {{ $errors->first('surat_tugas') }}
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input class="btn btn-info" type="submit" value="Submit" />
                                </div>
                            </form>
                        @endif
                    @endif


                    <div class="card card-primary profile-widget">
                        <div class="profile-widget-header">
                            @if ($user->avatar)
                                <img src="{{ asset('storage/' . $user->avatar) }}"
                                    class="rounded-circle profile-widget-picture" />
                            @else
                                <img src="{{ asset('storage/avatars/avatar-1.png') }}"
                                    class="rounded-circle profile-widget-picture">
                            @endif
                            <div class="profile-widget-items">
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-value">{{ $user->nama }} {{ $user->nama_b }}</div>
                                    <div class="profile-widget-item-label">{{ $user->user_id }}</div>
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
                            @elseif($topic->status_id >= 200 && $topic->status_id <= 700)
                                <span class="badge badge-warning">
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
                            <div class="form-control">{{ $user->program->nama }}</div>
                            <div class="label">Jurusan :</div>
                            <div class="form-control">{{ $user->jurusan }}</div>
                            <div class="label">No. Handphone :</div>
                            <div class="form-control">{{ $user->no_HP }}</div>
                            <div class="label">Alamat :</div>
                            <textarea rows="3" class="col-12" disabled>{{ $user->alamat }}</textarea>
                        </div>
                    </div>


                    <div class="card card-success">
                        <div class="card-header pb-0">
                            <h4><b> Seminar Penelitian Mahasiswa </b></h4>
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
                                    @elseif (Auth::check() && Auth::user()->roles_id == 4)
                                        @if ($topic->status_id == 23)
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

                                            <form action="{{ route('lecture.verifySeminar', [$sempro->topic_id]) }}"
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
                                    @elseif(Auth::check() && Auth::user()->roles_id == 3)
                                        @if ($topic->status_id == 24)
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
                                                {{ Carbon\Carbon::parse($sempro->waktu)->translatedFormat('l, H M Y') }}
                                            </div>

                                            {{-- form --}}
                                            <form action="{{ route('academic.approveSeminar', [$sempro->topic_id]) }}"
                                                method="POST">
                                                <input type="hidden" name="_method" value="PUT">
                                                @csrf

                                                <label for="ruangan" class="mt-1">Tempat Seminar :</label>
                                                <textarea rows="3" id="ruangan" name="ruangan" placeholder="Isi disini ..." class="col-12"></textarea>

                                                <small id="warning" class="form-text text-muted">
                                                    Akademik mengisi tempat pelaksanaan seminar
                                                </small>

                                                <button class="btn btn-info mt-3" type="submit">Unggah
                                                </button>

                                            </form>

                                            <form method="POST"
                                                action="{{ route('academic.rejectSempro', [$sempro->topic_id]) }}"
                                                class="d-inline">
                                                @csrf
                                                @method('delete')

                                                <button class="btn btn-danger mt-3" type="submit">Tolak Sempro
                                                </button>
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
                                            <div class="form-control ">
                                                @if ($sempro->ruangan == null)
                                                    Menunggu Persetujuan Akademik
                                                @else
                                                    {{ $sempro->ruangan }}
                                                @endif
                                            </div>
                                            <small id="warning" class="form-text text-muted mt-1 mb-3">
                                                @if ($sempro->ruangan == null)
                                                    Akademik mengisi tempat pelaksanaan seminar
                                                @endif
                                            </small>
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
                                    @elseif (Auth::check() && Auth::user()->roles_id == 4)
                                        @if ($topic->status_id == 73)
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

                                            <form action="{{ route('lecture.verifySeminar', [$semhas->topic_id]) }}"
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
                                    @elseif(Auth::check() && Auth::user()->roles_id == 3)
                                        @if ($topic->status_id == 74)
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
                                                {{ Carbon\Carbon::parse($semhas->waktu)->translatedFormat('l, H M Y') }}
                                            </div>

                                            {{-- form --}}
                                            <form action="{{ route('academic.approveSeminar', [$semhas->topic_id]) }}"
                                                method="POST">
                                                <input type="hidden" name="_method" value="PUT">
                                                @csrf

                                                <label for="ruangan" class="mt-1">Tempat Seminar :</label>
                                                <textarea rows="3" id="ruangan" name="ruangan" placeholder="Isi disini ..." class="col-12"></textarea>

                                                <small id="warning" class="form-text text-muted">
                                                    Akademik mengisi tempat pelaksanaan seminar
                                                </small>


                                                <button class="btn btn-info mt-3" type="submit">Unggah
                                                </button>

                                            </form>

                                            <form method="POST"
                                                action="{{ route('academic.rejectSemhas', [$semhas->topic_id]) }}"
                                                class="d-inline">
                                                @csrf
                                                @method('delete')

                                                <button class="btn btn-danger mt-3" type="submit">Tolak Semhas
                                                </button>
                                            </form>
                                        @elseif($topic->status_id <= 74)
                                            <div for="judul" class="col-sm-12 col-md-12">
                                                <input id="judul" type="text" class="form-control mt-1 mb-3"
                                                    value="Mahasiswa belum mengajukan Seminar Hasil" disabled>
                                            </div>
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
                                            <div class="form-control ">
                                                @if ($semhas->ruangan == null)
                                                    Menunggu Persetujuan Akademik
                                                @else
                                                    {{ $semhas->ruangan }}
                                                @endif
                                            </div>
                                            <small id="warning" class="form-text text-muted mt-1 mb-3">
                                                @if ($semhas->ruangan == null)
                                                    Akademik mengisi tempat pelaksanaan seminar
                                                @endif
                                            </small>
                                        @endif
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-12 col-lg-7">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>{{ $topic->judul }}</h4>
                        </div>
                        <div class="card-body">

                            <!-- Modal Mengganti dosen -->
                            @if (Auth::check() && Auth::user()->roles_id == 4)
                                @if ($topic->status_id <= 11)
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <!-- Button trigger modal -->

                                            <a href="#" class="badge badge-info edit-modal" data-toggle="modal"
                                                data-target="#myModal">
                                                <i class="fas fa-search"></i> Lihat Daftar Dosen
                                            </a>

                                            <!-- Modal -->
                                            <div class="modal fade" id="myModal" tabindex="-1" data-backdrop="false">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">
                                                                <span>X</span>
                                                            </button>
                                                        </div>
                                                        <h5 class="text-center">Daftar Dosen</h5>
                                                        <div class="modal-body">
                                                            <table class="table table-striped" id="modal-table"
                                                                width="100%">
                                                                <thead id="tblHead">
                                                                    <tr>
                                                                        <th>NIP</th>
                                                                        <th>Nama Depan</th>
                                                                        <th>Nama Belakang</th>
                                                                        <th>Ruangan</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="modal-footer">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <a href="#" class="badge badge-info edit-modal"
                                                data-target="#edit-modal" data-id="{{ $topic->id }}">
                                                <i class="fas fa-search"></i> Ganti Dosen
                                            </a>

                                            <!-- Modal Edit Dosen-->
                                            <div class="modal fade" id="edit-dosen" tabindex="-1" role="dialog"
                                                data-backdrop="false">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="text-center">Ganti Dosen</h5>
                                                            <button type="button" class="close" data-dismiss="modal">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('lecture.updateDosbing', [$topic->id]) }}"
                                                            method="post" id="form-edit">
                                                            @csrf
                                                            <div class="modal-body">
                                                                {{-- edit-dosen.blade --}}
                                                            </div>
                                                            <div class="modal-footer bg-whitesmoke br">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Tutup</button>
                                                                <button type="button"
                                                                    class="btn btn-primary update-modal"
                                                                    data-dismiss="modal">Simpan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @endif
                            @endif

                            <div class="row">
                                <div class="form-group col-12">
                                    <div class="label">Dosen Pembimbing 1 :</div>
                                    <div class="form-control">{{ $namadosen_awal[0] }} {{ $namadosen_akhir[0] }}</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <div class="label">Dosen Pembimbing 2 :</div>
                                    <div class="form-control">{{ $namadosen_awal[1] }} {{ $namadosen_akhir[1] }}</div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card card-success">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-12">
                                    <div class="label">Surat Tugas</div>
                                    @if ($topic->surat_tugas == null)
                                        <div class="badge badge-warning">Surat Tugas Masih Diproses oleh Jurusan</div>
                                    @else
                                        <a href="{{ asset('storage/' . $topic->surat_tugas) }}"
                                            class="form-control text-dark badge-primary">
                                            <i class="far fa-file-pdf"></i> Lihat Surat Tugas
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <div class="label">File Proposal :</div>
                                    <a href="{{ asset('storage/' . $topic->proposal) }}"
                                        class="form-control text-dark badge-primary">
                                        <i class="far fa-file-pdf"></i> Lihat File Proposal
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-12">
                                    <div class="label">File Pkm :</div>

                                    <a href="{{ asset('storage/' . $topic->PKM) }}"
                                        class="form-control text-dark badge-primary">
                                        <i class="far fa-file-pdf"></i> Lihat File PKM
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-12">
                                    <div class="label">Abstrak Penelitian :</div>
                                    <textarea class="col-12" rows="12" elastic ng-model="someProperty" disabled>{{ $topic->abstrak }}</textarea>
                                </div>
                            </div>

                            <div class="row">
                                @if (Auth::check() && Auth::user()->roles_id == 3)
                                    @if ($topic->status_id == '10')
                                        <div class="form-group col-6">
                                            <a class="label btn btn-info"
                                                href="{{ route('academic.verifProposal', [$topic->id]) }}">
                                                <i class="fa fa-edit"> Verifikasi Pengajuan Proposal</i>
                                            </a>
                                        </div>
                                        <div class="form-group col-6">
                                            <a class="label btn btn-danger"
                                                href="{{ route('academic.tolakProposal', [$topic->id]) }}">
                                                <i class="fa fa-trash"> Tolak Pengajuan Proposal</i>
                                            </a>
                                        </div>
                                    @endif
                                @elseif(Auth::check() && Auth::user()->roles_id == 4)
                                    <div class="form-group col-6">
                                        @if ($topic->status_id == '11')
                                            <a class="btn btn-info" href="{{ route('lecture.approved', [$topic->id]) }}">
                                                <i class="fa fa-edit">Approve Pengajuan Proposal</i>
                                            </a>
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
    <script src="{{ asset('assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
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

    <script>
        //untuk menampilkan data dosen
        $("#modal-table").DataTable({
            processing: true,
            type: "get",
            ajax: "{{ route('lecture.showdosen') }}",
            columns: [{
                    data: 'user_id',
                    name: 'NIP',
                },
                {
                    data: 'nama',
                    name: 'Nama Depan'
                },
                {
                    data: 'nama_b',
                    name: 'Nama Belakang'
                },
                {
                    data: 'ruangan',
                    name: 'Ruangan'
                },
            ]
        });

        $(".edit-modal").on('click', function() {
            // console.log($(this).data('id'))
            let id = $(this).data('id')
            $.ajax({
                url: `/lecture/editDosbing/${id}`,
                method: "GET",
                success: function(data) {
                    // console.log(data)
                    $('#edit-dosen').find('.modal-body').html(data)
                    $('#edit-dosen').modal('show')
                },
                error: function(error) {
                    console.log(error)
                }
            })
        })

        $(".update-modal").on('click', function() {
            let id = $('#form-edit').find('#id_data').val()
            let formData = $('#form-edit').serialize()
            console.log(formData)
            $.ajax({
                url: `/lecture/updateDosbing/${id}`,
                method: 'PUT',
                data: formData,
                success: function(data) {
                    $('#edit-dosen').modal('hide')
                    window.location.assign(`/topic/show/${id}`)
                },
                error: function(error) {
                    console.log(error)
                }
            })
        })
    </script>
@endpush
