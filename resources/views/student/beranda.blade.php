@extends('layouts.global')

@section('title', 'SITA | Dashboard Student')

@section('content')

<section class="section">
    <div class="section-header">
        <h1>Halaman Mahasiswa</h1>
    </div>
    <div class="section-body">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif

        Login sebagai Student!
    </div>
</section>

@endsection