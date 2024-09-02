@extends('layouts.global')

@section('title', 'SITA | Dashboard PSIK')

@section('content')

<section class="section">
    <div class="section-header">
        <h1>Halaman PSIK</h1>
    </div>
    <div class="section-body">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif

        Login sebagai PSIK!
    </div>
</section>

@endsection