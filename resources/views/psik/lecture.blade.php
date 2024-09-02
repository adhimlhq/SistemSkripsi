@extends('layouts.global')

@section('title', 'SITA | Manajemen Pengguna')


@section('header')

<link rel="stylesheet" href="{{asset('assets/modules/datatables/datatables.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css')}}">

@endsection

@section('content')

<section class="section">
    <div class="section-header">
        <h1>List Pengguna</h1>
    </div>

    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-primary card-statistic-1">
                <a href="{{route('psik.index')}}">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-users-cog"></i>
                    </div>
                </a>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Admin</h4>
                    </div>
                    <div class="card-body">
                        <h5>{{ $admin }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-success card-statistic-1">
                <a href="{{route('psik.indexEmploye')}}">
                    <div class="card-icon bg-success">
                        <i class="fas fa-user-tie"></i>
                    </div>
                </a>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Employe</h4>
                    </div>
                    <div class="card-body">
                        <h5>{{ $karyawan }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-warning card-statistic-1">
                <a href="#">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                </a>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Lecture</h4>
                    </div>
                    <div class="card-body">
                        <h5>{{ $dosen }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-danger card-statistic-1">
                <a href="{{route('psik.indexStudent')}}">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                </a>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Student</h4>
                    </div>
                    <div class="card-body">
                        {{ $mahasiswa }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4> <a href="{{route('psik.create')}}" class="btn btn-primary">Create user</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        #
                                    </th>
                                    <th><b>Username</b></th>
                                    <th><b>Nama</b></th>
                                    <th><b>Email</b></th>
                                    <th><b>Status</b></th>
                                    <th><b>Aksi</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach($users as $user)
                                <tr>
                                    <th scope="row">{{ $no }}</th>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->nama}} {{$user->nama_b}}</td>
                                    <td>{{$user->email}}</td>

                                    <td>
                                        @if($user->status == "1")
                                        <span class="badge badge-success">
                                            Aktif
                                        </span>
                                        @else
                                        <span class="badge badge-warning">
                                            Menunggu
                                        </span>
                                        @endif
                                        @if($user->status == "0")
                                        <a href="{{route('psik.approved',[$user->id])}}">
                                            <i class="fa fa-check"></i>
                                        </a>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="badge badge-info" href="{{route('psik.show', [$user->id])}}">Detail</a>
                                        <a href="#" data-id="{{$user->id}}" class="badge badge-danger swal-confirm">
                                            <form action="{{route('psik.destroy', [$user->id])}}" id="delete{{$user->id}}" method="POST">
                                                @csrf
                                                @method('delete')
                                            </form>
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                                <?php $no++; ?>
                                @endforeach
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
<script src="{{asset('assets/modules/sweetalert/sweetalert.min.js')}}"></script>

<script src="{{asset('assets/modules/datatables/datatables.min.js')}}"></script>
<script src="{{asset('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js')}}"></script>
<script src="{{asset('assets/modules/jquery-ui/jquery-ui.min.js')}}"></script>

@endpush

@push('after-scripts')
<script>
    $(document).ready(function() {
        $('#table-1').DataTable();
    });
</script>

<script>
    $(".swal-confirm").click(function(e) {
        id = e.target.dataset.id;
        swal({
                title: 'Yakin Akan Menghapus Data?',
                text: 'Data yang behasil dihapus tidak dapat dikembalikan',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    // swal('Poof! Your imaginary file has been deleted!', {
                    //     icon: 'success',
                    // });
                    $(`#delete${id}`).submit();
                } else {
                    // swal('Your imaginary file is safe!');
                }
            });
    });
</script>


@endpush