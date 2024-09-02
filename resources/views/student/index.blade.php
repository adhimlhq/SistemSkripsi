@extends('layouts.global')

@section('header')

    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">

@endsection

@section('title', 'SITA | Manajemen Tugas Akhir Mahasiswa')
@section('content')

    <section class="section">
        <div class="section-header">
            <h1>Manajemen Skripsi</h1>
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

            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-success card-statistic-2">
                    <div class="card-icon shadow-primary bg-success">
                        <i class="fas fa-archive"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-body">
                            <h4> Informasi Topik Penelitian </h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-warning card-statistic-2">
                    <div class="card-icon shadow-primary bg-warning">
                        <i class="fas fa-archive"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-body">
                            <h4> Informasi Seminar Penelitian </h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-danger card-statistic-2">
                    <div class="card-icon shadow-primary bg-danger">
                        <i class="fas fa-archive"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-body">
                            <h4> Informasi Topik Penelitian </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($students->status_ta == 'INACTIVE')
            <div class="row">
                <div class="col-12">
                    <div class="card mb-0">
                        <div class="card-body">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <a class="nav-link active" href="{{ route('student.createtopic') }}">Ajukan Topik
                                        Penelitian</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="section-body">
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-5">
                    <div class="card card-primary profile-widget">
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
                            <label>Program Studi</label>
                            <div class="input-group">
                                <div class="form-control">{{ $students->program->nama }} </div>
                            </div>
                            <label>Jurusan</label>
                            <div class="input-group">
                                <div class="form-control">{{ $students->jurusan }}</div>
                            </div>
                            <label>No Handphone</label>
                            <div class="input-group">
                                <div class="form-control">{{ $users->no_HP }}</div>
                            </div>
                            <label>Alamat </label>
                            <textarea rows="3" class="col-12" disabled>{{ $students->alamat }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-7 col-lg-7">
                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="table-1_wrapper"
                                    class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-striped dataTable no-footer" id="table-1"
                                                role="grid" aria-describedby="table-1_info">
                                                <thead>
                                                    <tr>
                                                        <th><b>Judul Penelitian Mahasiswa</b></th>
                                                        <th><b>Status</b></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($topics as $topic)
                                                        <tr>
                                                            <td><a href="{{ route('student.show', [$topic->id]) }}"
                                                                    class="">
                                                                    <h6>{{ $topic->judul }}</h6>
                                                                </a></td>
                                                            <td>{{ $topic->text_stat }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td>
                                                                Data belum Tersedia, Silahkan Ajukan Topik Penelitian !
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
@endpush


@push('after-scripts')
    <script>
        $(document).ready(function() {
            $('#table-1').DataTable();
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
