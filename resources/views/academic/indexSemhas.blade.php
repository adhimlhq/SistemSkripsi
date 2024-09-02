@extends('layouts.global')

@section('title', 'SITA | Seminar Hasil')

@section('header')

    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">

@endsection

@section('content')


    <section class="section">
        <div class="section-header">
            <h1>Seminar Hasil Mahasiswa</h1>
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
                <div class="card card-primary   ">

                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="table-1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-striped dataTable no-footer" id="table-1" role="grid"
                                            aria-describedby="table-1_info">
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
                                                @foreach ($topics as $topic)
                                                    <tr>
                                                        <td>{{ $topic->user_id }}</td>
                                                        <td>{{ $topic->judul }}</td>
                                                        <td>{{ $topic->nama }} {{ $topic->nama_b }}</td>
                                                        <td>{{ $topic->email }}</td>
                                                        <td>{{ $topic->statuses->text_stat }}
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-sm btn-info"
                                                                href="{{ route('topic.show', [$topic->topic_id]) }}"><i
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
        $(document).ready(function() {
            $('#table-1').DataTable();
        });
    </script>
@endpush
