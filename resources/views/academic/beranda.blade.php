@extends('layouts.global')

@section('title', 'SITA | Dashboard Lecture')

@section('content')

    <section class="section">
        <div class="section-header">
            <h1>Halaman Akademik</h1>
        </div>
        <div class="section-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div class="row">

                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1 card-success">
                        <div class="card-icon bg-success">
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
                    <div class="card card-statistic-1 card-warning">
                        <div class="card-icon bg-warning">
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
                    <div class="card card-statistic-1 card-danger">
                        <div class="card-icon bg-danger">
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

        </div>
    </section>

@endsection
