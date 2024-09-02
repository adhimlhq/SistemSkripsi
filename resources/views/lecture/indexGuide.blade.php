@extends('layouts.global')

@section('title', 'SITA | Bimbingan Tugas Akhir')


@section('header')

    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">

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
            <h1>Daftar Bimbingan Tugas Akhir</h1>
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
                <div class="card card-primary">
                    <div class="card-header">
                        <ul class="nav nav-pills" id="myTab3" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" id="home-tab3" data-toggle="tab" href="#bim1"
                                    role="tab" aria-controls="home" aria-selected="true">Mahasiswa Bimbingan 1</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#bim2" role="tab"
                                    aria-controls="profile" aria-selected="false">Mahasiswa Bimbingan 2</a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">

                        <div class="tab-content" id="myTabContent2">
                            <div class="tab-pane fade active show" id="bim1" role="tabpanel"
                                aria-labelledby="home-tab3">

                                {{-- Bimbingan 1 --}}
                                <div class="table-responsive">
                                    <div id="table-2_wrapper"
                                        class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table class="table table-striped dataTable no-footer" id="table-2"
                                                    role="grid" aria-describedby="table-2_info">
                                                    <thead>
                                                        <tr>
                                                            <th><b>Nim</b></th>
                                                            <th><b>Judul</b></th>
                                                            <th><b>Nama</b></th>
                                                            <th><b>Email</b></th>
                                                            <th><b>Status</b></th>
                                                            <th><b>Aksi</b></th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        @foreach ($topics_1 as $topic)
                                                            <tr>
                                                                <td>{{ $topic->user_id }}</td>
                                                                <td>{{ $topic->judul }}</td>
                                                                <td>{{ $topic->nama }} {{ $topic->nama_b }}</td>
                                                                <td>{{ $topic->email }}</td>
                                                                <td>
                                                                    @if ($topic->status_id == '999' || $topic->status_id == '120')
                                                                        <span class="badge badge-danger">
                                                                            Penelitian Gagal
                                                                        </span>
                                                                    @else
                                                                        <span class="badge badge-success">
                                                                            Proses Penelitian
                                                                        </span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <a class="btn btn-sm btn-info"
                                                                        href="{{ route('lecture.guidance', [$topic->id]) }}"><i
                                                                            class="fas fa-info"></i> Detail</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane fade" id="bim2" role="tabpanel" aria-labelledby="profile-tab3">

                                {{-- Bimbingan 2 --}}

                                <div class="table-responsive">
                                    <div id="table-1_wrapper"
                                        class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table class="table table-striped dataTable no-footer" id="table-1"
                                                    role="grid" aria-describedby="table-1_info">
                                                    <thead>
                                                        <tr>
                                                            <th><b>Nim</b></th>
                                                            <th><b>Judul</b></th>
                                                            <th><b>Nama</b></th>
                                                            <th><b>Email</b></th>
                                                            <th><b>Status</b></th>
                                                            <th><b>Aksi</b></th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        @foreach ($topics_2 as $topic)
                                                            <tr>
                                                                <td>{{ $topic->user_id }}</td>
                                                                <td>{{ $topic->judul }}</td>
                                                                <td>{{ $topic->nama }} {{ $topic->nama_b }}</td>
                                                                <td>{{ $topic->email }}</td>
                                                                <td>
                                                                    @if ($topic->status_id == '999' || $topic->status_id == '120')
                                                                        <span class="badge badge-danger">
                                                                            Penelitian Gagal
                                                                        </span>
                                                                    @else
                                                                        <span class="badge badge-success">
                                                                            Proses Penelitian
                                                                        </span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <a class="btn btn-sm btn-info"
                                                                        href="{{ route('lecture.guidance', [$topic->id]) }}"><i
                                                                            class="fas fa-info"></i> Detail</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
    <script src="{{ asset('assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>
@endpush

@push('after-scripts')
    <script>
        // datatable bimbingan 
        $(document).ready(function() {
            $('#table-1').DataTable(

            );

            $('#table-2').DataTable(

            );
        });
    </script>
@endpush
