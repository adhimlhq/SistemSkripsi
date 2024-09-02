@extends('layouts.global')

@section('title', 'SITA | Dashboard Lecture')

@if ($lecture->previllege != 'DOSEN')
    @section('navbar.lecture')
        <li class="menu-header">Kaprodi</li>
        <li class="nav-item" class="">
            <a href="" class="nav-link has-dropdown"><i class="fas fa-university"></i><span>Tugas Akhir</span></a>
            <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('lecture.indexKaprodi') }}">Topik Penelitian</a></li>
            </ul>
        </li>
    @endsection
@endif

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Halaman Dosen</h1>
        </div>
        <div class="section-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            @if ($lecture->previllege == 'DOSEN')
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1 card-primary">
                            <div class="card-icon bg-primary">
                                <i class="far fa-user"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Topik Bimbingan 1</h4>
                                </div>
                                <div class="card-body">
                                    {{ $bimbingan1 }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1 card-success">
                            <div class="card-icon bg-success">
                                <i class="far fa-user"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Topik Bimbingan 2</h4>
                                </div>
                                <div class="card-body">
                                    {{ $bimbingan2 }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1 card-warning">
                            <div class="card-icon bg-warning">
                                <i class="far fa-file"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Bimbingan Sempro</h4>
                                </div>
                                <div class="card-body">
                                    {{ $bsempro }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1 card-danger">
                            <div class="card-icon bg-danger">
                                <i class="far fa-file"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Bimbingan Semhas</h4>
                                </div>
                                <div class="card-body">
                                    {{ $bsemhas }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1 card-info">
                            <div class="card-icon bg-info">
                                <i class="fas fa-book"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Pengajuan Topik</h4>
                                </div>
                                <div class="card-body">
                                    {{ $topic }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1 card-secondary">
                            <div class="card-icon bg-secondary">
                                <i class="fas fa-file-word"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Pengajuan Sempro</h4>
                                </div>
                                <div class="card-body">
                                    {{ $sempro }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1 card-dark">
                            <div class="card-icon bg-dark">
                                <i class="fas fa-file-pdf"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Pengajuan Semhas</h4>
                                </div>
                                <div class="card-body">
                                    {{ $semhas }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1 card-primary">
                            <div class="card-icon bg-primary ">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Topik Bimbingan 1</h4>
                                </div>
                                <div class="card-body">
                                    {{ $bimbingan1 }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1 card-success">
                            <div class="card-icon bg-success ">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Topik Bimbingan 2</h4>
                                </div>
                                <div class="card-body">
                                    {{ $bimbingan2 }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1 card-warning">
                            <div class="card-icon bg-warning">
                                <i class="fas fa-file"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Bimbingan Sempro</h4>
                                </div>
                                <div class="card-body">
                                    {{ $bsempro }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1 card-danger">
                            <div class="card-icon bg-danger">
                                <i class="fas fa-file"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Bimbingan Semhas</h4>
                                </div>
                                <div class="card-body">
                                    {{ $bsemhas }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </section>
@endsection
