@extends('layouts.global')

@section('title', 'SITA | Dashboard Departement')

@section('content')

<section class="section">
    <div class="section-header">
        <h1>Halaman Jurusan</h1>
    </div>
    <div class="section-body">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif

        Login sebagai Jurusan!
    </div>
</section>

@endsection