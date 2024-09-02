@extends('layouts.app')

@section('title', 'SITA | Sistem Tugas Akhir')

@section('content')
<div class="section">
    <div class="container mt-8">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                <div class="login-brand">
                </div>

                <div class="card card-primary">

                    <div class="card-header">{{ __('Send Password Link') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif

                        <form enctype="multipart/form-data" action="{{route('psik.sendMail', [$user->id])}}" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input value="{{$user->email}}" class="form-control {{$errors->first('email') ? "is-invalid" : ""}} " type="text" name="email" id="email" />

                                <div class="invalid-feedback">
                                    {{$errors->first('email')}}
                                </div>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                    {{ __('Send Create Password Link') }}
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="simple-footer">
                    Copyright &copy; Stisla {{ date('Y') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection