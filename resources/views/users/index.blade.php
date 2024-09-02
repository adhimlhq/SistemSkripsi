@extends('layouts.global')
@section('title', 'SITA | Manajemen Pengguna')
@section('content')

<section class="section">
    <div class="section-header">
        <h1>List Pengguna</h1>
    </div>

    <div class="col-md-12 text-right">
        <div class="row">
            <div class="col-md-6">
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Semua Pengguna</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('user.indexEmploye')}}">Karyawan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('user.indexLecture')}}">Dosen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{{route('user.indexStudent')}}">Mahasiswa</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-12 text-right">
        <a href="{{route('user.create')}}" class="btn btn-primary">Create user</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th><b>#</b></th>
                <th><b>Username</b></th>
                <th><b>Name</b></th>
                <th><b>Email</b></th>
                <th><b>Status</b></th>
                <th><b>Action</b></th>
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
                    <span class="badge badge-danger">
                        Menunggu
                    </span>
                    @endif
                </td>
                <td>
                    <a href="#" class="btn btn-info btn-sm">Detail</a>
                    <a class="btn btn-warning text-white btn-sm" href="{{route('user.edit', [$user->id])}}">Edit</a>
                    <form onsubmit="return confirm('Delete this user permanently?')" class="d-inline" action="#" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                    </form>
                </td>
            </tr>
            <?php $no++; ?>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan=10>
                    {{$users->appends(Request::all())->links()}}
                </td>
            </tr>
        </tfoot>
    </table>

    <div class="card">
        <div class="card-header">
            <div class="col-md-12 text-right">
                <div class="row">
                    <div class="col-md-6">
                        <ul class="nav nav-pills card-header-pills">
                            <li class="nav-item">
                                <a class="nav-link active" href="{{route('user.index')}}">Semua Pengguna</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Karyawan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Dosen</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="{{route('user.indexStudent')}}">Mahasiswa</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <div id="table-1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="dataTables_length" id="table-1_length"><label>Show <select name="table-1_length" aria-controls="table-1" class="form-control form-control-sm">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select> entries</label></div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div id="table-1_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="table-1"></label></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-striped dataTable no-footer" id="table-1" role="grid" aria-describedby="table-1_info">
                                <thead>
                                    <tr role="row">
                                        <th><b>#</b></th>
                                        <th><b>Username</b></th>
                                        <th><b>Name</b></th>
                                        <th><b>Email</b></th>
                                        <th><b>Status</b></th>
                                        <th><b>Action</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    @foreach($users as $user)
                                    <tr role="row" class="odd">
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
                                            <span class="badge badge-danger">
                                                Menunggu
                                            </span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-info btn-sm">Detail</a>
                                            <a class="btn btn-warning text-white btn-sm" href="{{route('user.edit', [$user->id])}}">Edit</a>
                                            <form onsubmit="return confirm('Delete this user permanently?')" class="d-inline" action="#" method="POST">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                                            </form>
                                        </td>
                                    </tr>
                                    <?php $no++; ?>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-5">
                            <div class="dataTables_info" id="table-1_info" role="status" aria-live="polite">Showing 1 to 4 of 4 entries</div>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="table-1_paginate">
                                <ul class="pagination">
                                    <li class="paginate_button page-item previous disabled" id="table-1_previous"><a href="#" aria-controls="table-1" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>
                                    <li class="paginate_button page-item active"><a href="#" aria-controls="table-1" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                                    <li class="paginate_button page-item next disabled" id="table-1_next"><a href="#" aria-controls="table-1" data-dt-idx="2" tabindex="0" class="page-link">Next</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection